<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tüm public route'ların kayıtlı olduğunu doğrular.
     */
    public function test_all_public_routes_are_registered(): void
    {
        $expectedRoutes = [
            'home',
            'about',
            'services.index',
            'services.show',
            'blog.index',
            'blog.show',
            'faq',
            'appointment.create',
            'appointment.store',
            'contact.create',
            'contact.store',
            'page.show',
            'sitemap',
        ];

        foreach ($expectedRoutes as $routeName) {
            $this->assertTrue(
                Route::has($routeName),
                "Route [{$routeName}] kayıtlı değil."
            );
        }
    }
}
