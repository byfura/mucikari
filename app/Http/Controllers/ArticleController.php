<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    
    public function index()
    {
        //
        $articles = Article::orderBy('created_at','desc')->paginate(10);

        //
        return ArticleResource::collection($articles);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $article = $request->isMethod('put') ? Article::findOrFail($request->input('article_id')) : new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    public function show($id)
    {
        //
        $article = Article::findOrFail($id);

        //
        return new ArticleResource($article);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        //
        if ($article->delete()) {
            return new ArticleResource($article);
        }
        //
    }
}
