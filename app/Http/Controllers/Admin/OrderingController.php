<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\PackageMenu;
use Illuminate\Http\Request;

class OrderingController extends Controller
{
    public function categoriesIndex()
    {
        $categories = Category::orderBy('order')->orderBy('id')->get();
        return view('admin.ordering.categories', compact('categories'));
    }

    public function menusIndex($category = null)
    {
        $categories = Category::orderBy('order')->pluck('nama');
        
        $query = Menu::query();
        if ($category) {
            $query->where('kategori', $category);
        }
        $menus = $query->orderBy('order')->orderBy('id')->get();
        
        return view('admin.ordering.menus', compact('menus', 'categories', 'category'));
    }

    public function packageMenusIndex()
    {
        $packageMenus = PackageMenu::orderBy('order')->orderBy('id')->get();
        $categories = PackageMenu::distinct()->pluck('category');
        
        return view('admin.ordering.package-menus', compact('packageMenus', 'categories'));
    }

    public function updateCategoryOrder(Request $request, Category $category)
    {
        $request->validate([
            'direction' => 'required|in:up,down'
        ]);

        $direction = $request->direction;
        
        if ($direction === 'up') {
            // Find the previous item
            $previous = Category::where('order', '<', $category->order)
                ->orderBy('order', 'desc')
                ->first();
            
            if ($previous) {
                $tempOrder = $category->order;
                $category->update(['order' => $previous->order]);
                $previous->update(['order' => $tempOrder]);
            }
        } else {
            // Find the next item
            $next = Category::where('order', '>', $category->order)
                ->orderBy('order', 'asc')
                ->first();
            
            if ($next) {
                $tempOrder = $category->order;
                $category->update(['order' => $next->order]);
                $next->update(['order' => $tempOrder]);
            }
        }

        return back()->with('success', 'Urutan kategori berhasil diperbarui');
    }

    public function updateMenuOrder(Request $request, Menu $menu)
    {
        $request->validate([
            'direction' => 'required|in:up,down'
        ]);

        $direction = $request->direction;
        
        if ($direction === 'up') {
            // Find the previous item in the same category
            $previous = Menu::where('kategori', $menu->kategori)
                ->where('order', '<', $menu->order)
                ->orderBy('order', 'desc')
                ->first();
            
            if ($previous) {
                $tempOrder = $menu->order;
                $menu->update(['order' => $previous->order]);
                $previous->update(['order' => $tempOrder]);
            }
        } else {
            // Find the next item in the same category
            $next = Menu::where('kategori', $menu->kategori)
                ->where('order', '>', $menu->order)
                ->orderBy('order', 'asc')
                ->first();
            
            if ($next) {
                $tempOrder = $menu->order;
                $menu->update(['order' => $next->order]);
                $next->update(['order' => $tempOrder]);
            }
        }

        return back()->with('success', 'Urutan menu berhasil diperbarui');
    }

    public function updatePackageMenuOrder(Request $request, PackageMenu $packageMenu)
    {
        $request->validate([
            'direction' => 'required|in:up,down'
        ]);

        $direction = $request->direction;
        
        if ($direction === 'up') {
            // Find the previous item
            $previous = PackageMenu::where('order', '<', $packageMenu->order)
                ->orderBy('order', 'desc')
                ->first();
            
            if ($previous) {
                $tempOrder = $packageMenu->order;
                $packageMenu->update(['order' => $previous->order]);
                $previous->update(['order' => $tempOrder]);
            }
        } else {
            // Find the next item
            $next = PackageMenu::where('order', '>', $packageMenu->order)
                ->orderBy('order', 'asc')
                ->first();
            
            if ($next) {
                $tempOrder = $packageMenu->order;
                $packageMenu->update(['order' => $next->order]);
                $next->update(['order' => $tempOrder]);
            }
        }

        return back()->with('success', 'Urutan package menu berhasil diperbarui');
    }
}
