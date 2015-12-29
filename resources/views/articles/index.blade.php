@extends('app')

@section('content')

    <h1>Articles</h1>
    <hr/>
    @foreach($articles as $article)

        <article>
            <h2><a href="{{ route('article_using_id',['article_id'=>$article->id] ) }}"> {{ $article->title }} </a></h2>

            <div class="body">
                {{ $article->body }}
            </div>

        </article>

    @endforeach

@stop