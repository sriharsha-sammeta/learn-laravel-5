<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Request;

use Log;

use App\Article;
use App\Http\Requests;
use Response;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest('published_at')->published('<=')->get();

        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {

        $article = Article::find($id);

        if (is_null($article)) {
            Log::alert('article failed to fetch', ['id' => $id]);
            abort(404);
        }

//        dd($article->published_at->diffForHumans());

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }


    public function store()
    {

        $input = Request::all();
        $validator = \Validator::make(
            $input,
            array(
                'title' => 'required|min:5',
                'body' => 'required|min:10',
                'published_at' => 'required|date'
            )
        );

        if ($validator->fails()) {
            return redirect('articles/create')->withErrors($validator);
        }
        Article::create(Request::all());

        return redirect('articles');

    }

}
