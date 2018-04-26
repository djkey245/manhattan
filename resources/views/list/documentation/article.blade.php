@extends('layouts.app')


@section('content')
    <style>
        #title{
            width: 100%;
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        #article{
            width: 100%;
        }

    </style>
    @if(Auth::user()->theme == 'black')
        <style>
            #article>p,span,b,td,tr,th,table,tbody{
                color: white !important;
            }
            .row{
                color: white !important;

            }
        </style>
    @else
        <style>
            #article>p,span{
                color: black !important;
            }
        </style>
        @endif
        <div class="container">
    <div class="row">
        <p id="title"><b>{{$article->title}}</b></p>
    </div>
    <div class="row">
        <p id="article">
            {!! $article->text !!}
        </p>
    </div>
</div>



    @endsection