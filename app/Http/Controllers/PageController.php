<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function events(): View
    {
        return view('pages.events');
    }

    public function menu(): View
    {
        return view('pages.menu');
    }

    public function book(): View
    {
        return view('pages.book');
    }
}
