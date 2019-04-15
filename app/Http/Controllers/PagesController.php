<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $h1Title = "Welcome To the Online Shopping Website";
        return view('pages.index')->with('h1Title', $h1Title);
    }

    public function about()
    {
        $h1Title = "About Online Shopping";
        return view('pages.about')->with('h1Title', $h1Title);
    }

    public function services()
    {
        $data = array(
            'h1Title' => 'Online Shopping Services',
            'services' => ['Web Design', 'Programmins', 'SEO']
        );

        return view('pages.services')->with($data);
    }

    public function enabling_seller_panel()
    {
        return view('pages.enable_sellers');
    }
}
