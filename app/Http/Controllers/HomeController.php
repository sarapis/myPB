<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home($value='')
    {
        $home = Page::find(1);
    	return view('frontEnd.home', compact('home'));
    }
    public function about($value='')
    {
        $about = Page::find(2);
        return view('frontEnd.about', compact('about'));
    }
    public function YourhomePage($value='')
    {
    	return view('home');
    }
    public function dashboard($value='')
    {
    	return view('backEnd.dashboard');
    }

    public function logviewerdashboard($value='')
    {
        return redirect('log-viewer');
    }
}
