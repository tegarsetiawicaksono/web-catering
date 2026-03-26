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

        $menus = $query->orderBy('kategori')->orderBy('nama')->paginate(20);
        return view('admin.menus.index', compact('menus', 'categories'));
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('foto'), $namaFile);
            $validated['gambar'] = $namaFile;
        }

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

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
