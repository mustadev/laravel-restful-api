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
    public function show($id){
        return Article::find($id);
    }

    // store article
    public function store(Request $request){
        return Article::create($request->all());
    }

    // update article
    public function update(Request $request, $id){
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return $article;
    }

    public function delete(Request $request, $id){
        $article = Article::findOrFail();
        $article->delete();

        return 204;
    }


}
