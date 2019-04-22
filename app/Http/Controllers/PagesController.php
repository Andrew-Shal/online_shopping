<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $h1Title = "Welcome To the Online Shopping Website";
        return view('static_pages.index')->with('h1Title', $h1Title);
    }

    public function about()
    {
        return view('static_pages.about');
    }
    public function contact()
    {
        return view('static_pages.contact');
    }

    public function services()
    {
        $data = array(
            'h1Title' => 'Online Shopping Services',
            'services' => ['Web Design', 'Programmins', 'SEO']
        );

        return view('static_pages.services')->with($data);
    }

    public function enabling_seller_panel()
    {
        return view('static_pages.enable_sellers');
    }
}
