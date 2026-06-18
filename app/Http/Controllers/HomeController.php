<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;
use App\Settings\SiteSettings;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = app(SiteSettings::class);
        $services = Service::active()->get();
        $posts = Post::published()->latest('published_at')->take(3)->get();
        $testimonials = Testimonial::approved()->get();

        return view('pages.home', compact('settings', 'services', 'posts', 'testimonials'));
    }
}
