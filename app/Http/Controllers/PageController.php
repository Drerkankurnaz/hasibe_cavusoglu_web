<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Slug ile dinamik sayfa detayını gösterir (KVKK, Gizlilik Politikası vb.).
     */
    public function show(string $slug): View|RedirectResponse
    {
        $page = Page::where('slug', $slug)->first();

        if (! $page) {
            // Slug degismis olabilir: eski adresi kalicilikla yenisine tasi
            $renamed = Page::findByHistoricalSlug($slug);

            abort_unless($renamed, 404);

            return redirect()->route('page.show', $renamed->slug, 301);
        }

        return view('pages.page', compact('page'));
    }
}
