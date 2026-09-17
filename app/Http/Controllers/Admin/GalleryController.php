<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    private function galleryDirectory(): string
    {
        $directory = base_path('../public_html/foto/galeri');

        if (!is_dir($directory)) {
            $directory = public_path('foto/galeri');
        }

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        return $directory;
    }

    private function deleteGalleryFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        $relativePath = ltrim($path, '/');
        $paths = [
            public_path($relativePath),
            base_path('../public_html/' . $relativePath),
            storage_path('app/public/' . $relativePath),
        ];

        foreach (array_unique($paths) as $file) {
            if (file_exists($file)) {
                unlink($file);
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

    /**
     * Display a listing of the gallery.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);
        $query = Gallery::query();
        
        if ($category) {
            if (in_array($category, ['nasi-box', 'nasibox'], true)) {
                $query->whereIn('category', ['nasi-box', 'nasibox']);
            } else {
                $query->where('category', $category);
            }
        }
        
        $galleries = $query->orderByDesc('created_at')->paginate(20);
        
        return view('admin.gallery.index', compact('galleries', 'category', 'categories'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $allowedCategories = $this->activeCategorySlugs();

        $validated = $request->validate([
            'category' => ['required', Rule::in($allowedCategories)],
            'caption' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($this->galleryDirectory(), $filename);
        $path = 'foto/galeri/' . $filename;
        
        Gallery::create([
            'category' => $validated['category'],
            'caption' => $validated['caption'] ?? null,
            'path' => $path,
        ]);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function edit(Gallery $gallery)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);

        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $allowedCategories = $this->activeCategorySlugs();

        $validated = $request->validate([
            'category' => ['required', Rule::in($allowedCategories)],
            'caption' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Update photo if new one is uploaded
        if ($request->hasFile('photo')) {
            if (!$request->file('photo')->isValid()) {
                return back()->withErrors([
                    'photo' => 'Upload foto gagal. Coba pilih file lain lalu simpan kembali.',
                ])->withInput();
            }

            // Delete old photo
            $this->deleteGalleryFile($gallery->path);
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($this->galleryDirectory(), $filename);
            $gallery->path = 'foto/galeri/' . $filename;
        }
        
        // Update category and caption
        $gallery->category = $validated['category'];
        $gallery->caption = $validated['caption'] ?? null;
        $gallery->save();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil diperbarui!');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete the photo file
        $this->deleteGalleryFile($gallery->path);
        
        $gallery->delete();
        
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}
