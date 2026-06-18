<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create();

        // Statik rotalar
        $staticRoutes = [
            '/',
            '/hakkimda',
            '/hizmetler',
            '/blog',
            '/sss',
            '/randevu',
            '/iletisim',
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(Url::create($route));
        }

        // Yayınlanmış blog yazıları
        Post::published()->get()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create("/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
            );
        });

        // Aktif hizmetler
        Service::active()->get()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create("/hizmetler/{$service->slug}")
                    ->setLastModificationDate($service->updated_at)
            );
        });

        // Dinamik sayfalar
        Page::all()->each(function (Page $page) use ($sitemap) {
            $sitemap->add(
                Url::create("/sayfa/{$page->slug}")
                    ->setLastModificationDate($page->updated_at)
            );
        });

        return response($sitemap->render(), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
