@extends('layouts.app')
@section('content')
    <div class="raw">
        {{ $article->content->content_html }}
    </div>

    <hr>
   <div class="content">
       {{ $article->content->getContent() }}
   </div>
@endsection
