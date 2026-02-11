<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryPageController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = Gallery::query();
        
        if ($category) {
            $query->where('category', $category);
        }
        
        $galleries = $query->orderByDesc('created_at')->paginate(12);
        
        return view('gallery.index', compact('galleries', 'category'));
    }
}
