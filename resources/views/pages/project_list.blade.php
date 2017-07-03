@extends('layouts.default')

@section('content')

    @foreach($projects as $id=>$project)
        @if($id%2 ==0)
            @include('partials.project_odd', ['project' => $project])
        @else
            @include('partials.project_even', ['project' => $project])
        @endif

    @endforeach

@stop