<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Aktif hizmetlerin sıralı listesini gösterir.
     */
    public function index(): View
    {
        $services = Service::active()->get();

        return view('pages.services.index', compact('services'));
    }

    /**
     * Slug ile hizmet detay sayfasını gösterir.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (! $service) {
            // Slug degismis olabilir: eski adresi kalicilikla yenisine tasi
            $renamed = Service::findByHistoricalSlug($slug);

            abort_unless($renamed?->is_active, 404);

            return redirect()->route('services.show', $renamed->slug, 301);
        }

        return view('pages.services.show', compact('service'));
    }
}
