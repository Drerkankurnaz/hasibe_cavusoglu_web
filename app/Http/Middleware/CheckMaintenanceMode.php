<?php

namespace App\Http\Middleware;

use App\Settings\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Admin paneli yollarını atla (Filament erişimi engellenmemeli)
        if ($request->is('admin/*') || $request->is('admin') || $request->is('livewire/*')) {
            return $next($request);
        }

        // Giriş yapmış admin kullanıcıları da atla
        if ($request->user() && $request->user()->hasRole('super_admin')) {
            return $next($request);
        }

        try {
            $settings = app(SiteSettings::class);

            if ($settings->maintenance_mode) {
                return response()->view('errors.503', [
                    'title' => $settings->maintenance_title,
                    'message' => $settings->maintenance_message,
                ], 503);
            }
        } catch (\Exception $e) {
            // Settings tablosu henüz yoksa veya hata oluşursa siteyi engelleme
        }

        return $next($request);
    }
}
