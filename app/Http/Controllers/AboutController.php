<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Settings\SiteSettings;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $settings = app(SiteSettings::class);
        $page = Page::where('slug', 'hakkimda')->first();

        return view('pages.about', compact('settings', 'page'));
    }
}
