<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminMenuController extends Controller
{
    private function imageDirectory(): string
    {
        $directory = base_path('../public_html/foto');

        if (!is_dir($directory)) {
            $directory = public_path('foto');
        }

        return $directory;
    }

    private function deleteImage(?string $image): void
    {
        if (!$image) {
            return;
        }

        $filename = basename($image);
        $paths = [
            public_path('foto/' . $filename),
            $this->imageDirectory() . '/' . $filename,
        ];

        foreach (array_unique($paths) as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    private function activeCategorySlugs(): array
    {
        $slugs = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->pluck('slug')
            ->filter()
            ->values()
            ->all();

        if (!empty($slugs)) {
            return $slugs;
        }

        return ['buffet', 'tumpeng', 'nasibox', 'snack'];
    }

    public function index(Request $request)
    {
        $query = Menu::query();
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        // Filter by category
        if ($request->has('kategori') && $request->kategori) {
            if (in_array($request->kategori, ['nasi-box', 'nasibox'], true)) {
                $query->whereIn('kategori', ['nasi-box', 'nasibox']);
            } else {
                $query->where('kategori', $request->kategori);
            }
        }

        if ($request->boolean('custom_only')) {
            $query->where('is_custom', true);
        }

        $menus = $query->orderBy('kategori')->orderBy('order')->orderBy('id')->paginate(20)->withQueryString();
        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function move(Request $request, Menu $menu)
    {
        $request->validate([
            'direction' => 'required|in:up,down',
        ]);

        $filters = $request->only(['kategori', 'custom_only']);

        $menusInCategory = Menu::where('kategori', $menu->kategori)
            ->orderBy('order')
            ->orderBy('id')
            ->get(['id', 'order']);

        // Normalize existing order to avoid ties from old rows with same order value.
        foreach ($menusInCategory as $index => $item) {
            $expectedOrder = $index + 1;
            if ((int) $item->order !== $expectedOrder) {
                Menu::whereKey($item->id)->update(['order' => $expectedOrder]);
            }
        }

        $orderedIds = Menu::where('kategori', $menu->kategori)
            ->orderBy('order')
            ->orderBy('id')
            ->pluck('id')
            ->values();

        $currentIndex = $orderedIds->search($menu->id);

        if ($currentIndex === false) {
            return redirect()->route('admin.menus.index', $filters);
        }

        $targetIndex = $request->direction === 'up' ? $currentIndex - 1 : $currentIndex + 1;

        if (!isset($orderedIds[$targetIndex])) {
            return redirect()->route('admin.menus.index', $filters);
        }

        $currentId = $orderedIds[$currentIndex];
        $targetId = $orderedIds[$targetIndex];

        Menu::whereKey($currentId)->update(['order' => $targetIndex + 1]);
        Menu::whereKey($targetId)->update(['order' => $currentIndex + 1]);

        return redirect()->route('admin.menus.index', $filters)
            ->with('success', 'Urutan menu berhasil diperbarui.');
    }

    public function create(Request $request)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        $customOnly = $request->boolean('custom_only');

        return view('admin.menus.create', compact('categories', 'customOnly'));
    }

    public function store(Request $request)
    {
        $allowedCategories = $this->activeCategorySlugs();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => ['required', Rule::in($allowedCategories)],
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'min_order' => 'required|integer|min:1',
            'is_custom' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['is_custom'] = $request->boolean('is_custom');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move($this->imageDirectory(), $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $validated['order'] = (int) Menu::where('kategori', $validated['kategori'])->max('order') + 1;

        Menu::create($validated);

        return redirect()->route('admin.menus.index', $request->boolean('custom_only') ? ['custom_only' => 1] : [])
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Request $request, Menu $menu)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        $filters = $request->only(['kategori', 'custom_only']);

        return view('admin.menus.edit', compact('menu', 'categories', 'filters'));
    }

    public function update(Request $request, Menu $menu)
    {
        $allowedCategories = $this->activeCategorySlugs();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => ['required', Rule::in($allowedCategories)],
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'min_order' => 'required|integer|min:1',
            'is_custom' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['is_custom'] = $request->boolean('is_custom');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            $this->deleteImage($menu->gambar);

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move($this->imageDirectory(), $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $menu->update($validated);

        return redirect()->route('admin.menus.index', $request->only(['kategori', 'custom_only']))
            ->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy(Request $request, Menu $menu)
    {
        // Hapus gambar
        $this->deleteImage($menu->gambar);

        $menu->delete();

        return redirect()->route('admin.menus.index', $request->only(['kategori', 'custom_only']))
            ->with('success', 'Menu berhasil dihapus!');
    }
}
