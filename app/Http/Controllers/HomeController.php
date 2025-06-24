<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

namespace App\Http\Controllers;
use App\Models\Article;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        $articles = Article::latest()->paginate(3);
        return view('public.home', compact('articles'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}