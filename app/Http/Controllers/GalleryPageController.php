<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryPageController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get(['nama', 'slug']);
        $query = Gallery::query();
        
        if ($category) {
            if (in_array($category, ['nasibox', 'nasi-box'], true)) {
                $query->whereIn('category', ['nasibox', 'nasi-box']);
            } else {
                $query->where('category', $category);
            }
        }
        
        $galleries = $query->orderByDesc('created_at')->paginate(12);
        
        return view('gallery.index', compact('galleries', 'category', 'categories'));
    }
}
