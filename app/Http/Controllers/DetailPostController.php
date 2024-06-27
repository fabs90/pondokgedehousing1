<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ContactService;

class DetailPostController extends Controller
{

    public function show($slug)
    {
        $data = Article::where('slug', $slug)->firstOrFail();
        $satpam = ContactService::all();
        $news = Article::latest()->take(5)->get();
        $random = Article::where('slug', '<>', $slug)->take(5)->get();

        return view('detail.detail', compact('satpam', 'data', 'news', 'random'));
    }
}
