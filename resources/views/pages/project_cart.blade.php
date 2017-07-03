@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$project->title}}</h1>
            <img src="/uploads/projects/large/{{$project->image}}" alt="" />
            <div class="content">
                {!!$project->content!!}
            </div>
        </div>
        <div class="row">
            @foreach($project->galleries as $image)
            <div class="col-md-6">
                <img src="/uploads/images/medium/{{$image->image}}" alt="{{$image->alt}}" title="{{$image->title}}">
            </div>
            @endforeach
        </div>
    </div>

@stop