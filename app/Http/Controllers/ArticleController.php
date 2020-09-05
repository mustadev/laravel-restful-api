<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // get all articles
    public function index()
    {
        return Article::all();
    }

    // show article by id
    public function show(Article $article){
        return $article;
    }

    // store article
    public function store(Request $request){
        $article = Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id
        ]);

        return response()->json($article, 201);
    }

    // update article
    public function update(Request $request, Article $article){
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }


}
