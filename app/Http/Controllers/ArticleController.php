<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('pages.article-list', [
            'articles' => Article::orderBy('publication_date', 'desc')->get(),
        ]);
    }

    public function show(Article $article)
    {
        return view('pages.article', [
            'article' => $article,
        ]);
    }
}
