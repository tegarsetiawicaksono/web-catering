<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function buffet()
    {
        $menus = Menu::where('kategori', 'buffet')
            ->orderBy('harga')
            ->get();
        
        $category = Category::where('slug', 'buffet')->first();

        return view('menu.buffet.index', compact('menus', 'category'));
    }

    public function tumpeng()
    {
        $menus = Menu::where('kategori', 'tumpeng')
            ->orderBy('harga')
            ->get();
        
        $category = Category::where('slug', 'tumpeng')->first();

        return view('menu.tumpeng.index', compact('menus', 'category'));
    }

    public function nasibox()
    {
        $menus = Menu::where('kategori', 'nasibox')
            ->orderBy('harga')
            ->get();
        
        $category = Category::where('slug', 'nasibox')->first();

        return view('menu.nasibox.index', compact('menus', 'category'));
    }

    public function snack()
    {
        $menus = Menu::where('kategori', 'snack')
            ->orderBy('harga')
            ->get();
        
        $category = Category::where('slug', 'snack')->first();

        return view('menu.snack.index', compact('menus', 'category'));
    }
}
