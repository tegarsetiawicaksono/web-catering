<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private function renderCategoryMenu(string $slug)
    {
        $normalizedSlug = in_array($slug, ['nasibox', 'nasi-box'], true) ? 'nasi-box' : $slug;
        $menuCategorySlugs = $normalizedSlug === 'nasi-box'
            ? ['nasibox', 'nasi-box']
            : [$normalizedSlug];

        $menus = Menu::whereIn('kategori', $menuCategorySlugs)
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        $category = Category::whereIn('slug', $menuCategorySlugs)->first();

        if (! $category) {
            abort(404);
        }

        $view = match ($normalizedSlug) {
            'buffet' => 'menu.buffet.index',
            'tumpeng' => 'menu.tumpeng.index',
            'snack' => 'menu.snack.index',
            default => 'menu.nasibox.index',
        };

        return view($view, compact('menus', 'category'));
    }

    public function buffet()
    {
        return $this->renderCategoryMenu('buffet');
    }

    public function tumpeng()
    {
        return $this->renderCategoryMenu('tumpeng');
    }

    public function nasibox()
    {
        return $this->renderCategoryMenu('nasi-box');
    }

    public function hampers()
    {
        return $this->renderCategoryMenu('hampers');
    }

    public function snack()
    {
        return $this->renderCategoryMenu('snack');
    }

    public function category(string $slug)
    {
        return $this->renderCategoryMenu($slug);
    }
}
