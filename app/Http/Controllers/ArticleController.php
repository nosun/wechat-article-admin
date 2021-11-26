<?php

namespace App\Http\Controllers;

use App\Models\WechatArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(WechatArticle $article)
    {
        return view('articles.show')->with('article', $article);
    }
}
