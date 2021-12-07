@extends('layouts.app')
@section('content')
    <div class="raw">
        {{ $article->content->getContent() }}
    </div>
   <div class="content">
       {!! $article->content->getContent() !!}
   </div>
@endsection
