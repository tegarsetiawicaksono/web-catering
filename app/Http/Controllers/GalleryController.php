<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the gallery.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = Gallery::query();
        
        if ($category) {
            $query->where('category', $category);
        }
        
        $galleries = $query->orderByDesc('created_at')->paginate(20);
        
        return view('admin.gallery.index', compact('galleries', 'category'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:buffet,tumpeng,nasibox,snack',
            'caption' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('photo')->store('foto/galeri', 'public');
        
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
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'category' => 'required|in:buffet,tumpeng,nasibox,snack',
            'caption' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Update photo if new one is uploaded
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            $gallery->path = $request->file('photo')->store('foto/galeri', 'public');
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
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }
        
        $gallery->delete();
        
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}
