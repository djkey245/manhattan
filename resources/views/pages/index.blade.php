@extends('layouts.default')

@section('content')
    @foreach($slides as $slide)
        <img src="/uploads/slides/large/{{$slide->image}}" alt="" />
    @endforeach

@stop