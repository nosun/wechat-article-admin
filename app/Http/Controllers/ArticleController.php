<?php

namespace App\Http\Controllers;

use App\Http\Resources\WechatArticleResource;
use App\Models\WechatArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(WechatArticle $article)
    {
        return view('articles.show')->with('article', $article);
    }

    public function getArticle(WechatArticle $article)
    {
        return WechatArticleResource::make($article);
    }
}
