@extends('layouts.app')
@section('content')
    <div class="raw">
        {{ $article->getContent() }}
    </div>
   <div class="content">
       {!! $article->getContent() !!}
   </div>
@endsection
