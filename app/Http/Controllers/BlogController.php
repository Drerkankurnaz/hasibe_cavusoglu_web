<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Yayınlanan blog yazılarını paginated olarak listeler.
     * Sidebar: kategoriler ve son yazılar.
     */
    public function index(): View
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(6);

        $categories = Category::withCount(['posts' => function ($query) {
            $query->published();
        }])->get();

        $recentPosts = Post::published()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('pages.blog.index', compact('posts', 'categories', 'recentPosts'));
    }

    /**
     * Slug ile blog yazısı detay sayfasını gösterir.
     * Her görüntülemede views sayacını 1 artırır.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->first();

        if (! $post) {
            // Slug degismis olabilir: eski adresi kalicilikla yenisine tasi
            $renamed = Post::findByHistoricalSlug($slug);

            abort_unless(
                $renamed && Post::published()->whereKey($renamed->getKey())->exists(),
                404,
            );

            return redirect()->route('blog.show', $renamed->slug, 301);
        }

        // Views sayacını artır
        $post->increment('views');

        // İlgili yazılar (aynı kategoriden, mevcut yazı hariç)
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
