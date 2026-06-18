<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Slug ile dinamik sayfa detayını gösterir (KVKK, Gizlilik Politikası vb.).
     */
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.page', compact('page'));
    }
}
