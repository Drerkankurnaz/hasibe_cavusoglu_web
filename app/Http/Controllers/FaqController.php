<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Aktif SSS'leri kategoriye göre gruplu olarak listeler.
     */
    public function index(): View
    {
        $faqs = Faq::active()->get()->groupBy('category');

        return view('pages.faq', compact('faqs'));
    }
}
