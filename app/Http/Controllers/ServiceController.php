<?php

namespace App\Http\Controllers;

use App\Models\Service;
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
    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.services.show', compact('service'));
    }
}
