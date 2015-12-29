@extends('app')

@section('content')

    <h1> {{ $article->title }} </h1>
    <time>
        {{ $article->published_at->diffForHumans() }}
    </time>
    <article>
        {{ $article->body }}
    </article>
@stop