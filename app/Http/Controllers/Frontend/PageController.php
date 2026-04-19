<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function shipping()
    {
        return view('frontend.pages.shipping');
    }

    public function returns()
    {
        return view('frontend.pages.returns');
    }

    public function sizeGuide()
    {
        return view('frontend.pages.size-guide');
    }

    public function faqs()
    {
        return view('frontend.pages.faqs');
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }
}
