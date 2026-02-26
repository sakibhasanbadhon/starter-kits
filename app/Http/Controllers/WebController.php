<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function subscribe(Request $request)
    {
        // Handle subscription logic here
        return response()->json(['message' => 'Subscribed successfully']);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactMessageSend(Request $request)
    {

    }

    public function usefulLink($slug)
    {

    }

    // Additional page methods
    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function blog()
    {
        return view('frontend.web_journals');
    }

    public function blogDetails($slug)
    {

    }




}
