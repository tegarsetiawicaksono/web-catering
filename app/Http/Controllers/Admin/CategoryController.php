<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('nama')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'fitur_unggulan' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_mulai' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Simpan path gambar jika ada upload
        $gambarPath = null;
        $backgroundPath = null;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('foto'), $namaFile);
            $gambarPath = 'foto/' . $namaFile;
        }

        // Handle gambar background upload
        if ($request->hasFile('gambar_background')) {
            $background = $request->file('gambar_background');
            $namaFile = time() . '_bg_' . $background->getClientOriginalName();
            $background->move(public_path('foto'), $namaFile);
            $backgroundPath = 'foto/' . $namaFile;
        }

        // Remove file inputs from validated
        unset($validated['gambar']);
        unset($validated['gambar_background']);
        
        // Add paths back to validated
        if ($gambarPath) {
            $validated['gambar_url'] = $gambarPath;
        }
        if ($backgroundPath) {
            $validated['gambar_background'] = $backgroundPath;
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'fitur_unggulan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_mulai' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Simpan path gambar jika ada upload
        $gambarPath = null;
        $backgroundPath = null;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($category->gambar_url && file_exists(public_path($category->gambar_url))) {
                unlink(public_path($category->gambar_url));
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('foto'), $namaFile);
            $gambarPath = 'foto/' . $namaFile;
        }

        // Handle gambar background upload
        if ($request->hasFile('gambar_background')) {
            // Hapus background lama
            if ($category->gambar_background && file_exists(public_path($category->gambar_background))) {
                unlink(public_path($category->gambar_background));
            }

            $background = $request->file('gambar_background');
            $namaFile = time() . '_bg_' . $background->getClientOriginalName();
            $background->move(public_path('foto'), $namaFile);
            $backgroundPath = 'foto/' . $namaFile;
        }

        // Remove file inputs from validated
        unset($validated['gambar']);
        unset($validated['gambar_background']);
        
        // Add paths back to validated
        if ($gambarPath) {
            $validated['gambar_url'] = $gambarPath;
        }
        if ($backgroundPath) {
            $validated['gambar_background'] = $backgroundPath;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        // Cek apakah ada menu yang menggunakan kategori ini
        $menusCount = $category->menus()->count();
        
        if ($menusCount > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', "Kategori tidak dapat dihapus karena masih digunakan oleh {$menusCount} menu.");
        }

        // Hapus gambar
        if ($category->gambar_url && file_exists(public_path($category->gambar_url))) {
            unlink(public_path($category->gambar_url));
        }

        // Hapus background
        if ($category->gambar_background && file_exists(public_path($category->gambar_background))) {
            unlink(public_path($category->gambar_background));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
