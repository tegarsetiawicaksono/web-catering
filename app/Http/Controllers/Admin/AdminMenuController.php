<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminMenuController extends Controller
{
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
            return back();
        }

        $targetIndex = $request->direction === 'up' ? $currentIndex - 1 : $currentIndex + 1;

        if (!isset($orderedIds[$targetIndex])) {
            return back();
        }

        $currentId = $orderedIds[$currentIndex];
        $targetId = $orderedIds[$targetIndex];

        Menu::whereKey($currentId)->update(['order' => $targetIndex + 1]);
        Menu::whereKey($targetId)->update(['order' => $currentIndex + 1]);

        return back()->with('success', 'Urutan menu berhasil diperbarui.');
    }

    public function create()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        return view('admin.menus.create', compact('categories'));
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
            $gambar->move(public_path('foto'), $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $validated['order'] = (int) Menu::where('kategori', $validated['kategori'])->max('order') + 1;

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        return view('admin.menus.edit', compact('menu', 'categories'));
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
            if ($menu->gambar && file_exists(public_path('foto/' . $menu->gambar))) {
                unlink(public_path('foto/' . $menu->gambar));
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('foto'), $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy(Menu $menu)
    {
        // Hapus gambar
        if ($menu->gambar && file_exists(public_path('foto/' . $menu->gambar))) {
            unlink(public_path('foto/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}
