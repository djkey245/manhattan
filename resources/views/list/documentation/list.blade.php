@extends('layouts.app')


@section('content')
    <div class="container">
        <br>
        <div class="row-fluid">
            <h2>{{\App\DocumentationCategory::find($id)->name}}</h2>
            <br>
            @foreach($articles as $article)

                <h4><a href="/document/{{$article->id}}">{{$article->title}}</a></h4>

                @endforeach
        </div>
    </div>







@stop