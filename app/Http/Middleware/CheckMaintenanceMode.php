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
        try {
            $settings = app(SiteSettings::class);

            if ($settings->maintenance_mode) {
                // Giriş yapmış admin kullanıcıları siteyi normal görebilir
                if ($request->user() && $request->user()->hasRole('super_admin')) {
                    return $next($request);
                }

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
