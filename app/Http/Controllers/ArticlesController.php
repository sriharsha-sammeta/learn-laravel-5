<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;

use Illuminate\Http\Request;
use Log;

use \Illuminate\View\View;
use App\Article;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published('<=')->get();

        return view('articles.index', compact('articles'));
    }


    /**
     * @param $id
     * @return View
     */
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

    /**
     * @return View
     */
    public function create()
    {
        return view('articles.create');
    }


    /**
     *
     * @param CreateArticleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateArticleRequest $request)
    {

//        $this->validate($request, [
//            'title' => 'required|min:3|unique:articles,title',
//            'body' => 'required|min:5',
//            'published_at' => 'required|date'
//        ]);

        Article::create($request->all());

        return redirect('articles');


    }

}
