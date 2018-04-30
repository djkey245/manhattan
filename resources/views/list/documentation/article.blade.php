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
    <div id="error-alert">
        @if(!empty(session()->get('msg')))
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
            <div style="color: red;background-color: grey; width: 20%; display: inline-block" >{{session()->get('msg')}}
            <div class="right" onclick="document.getElementById('error-alert').remove()" style="cursor: pointer; display: inline-block;">X</div></div>
        @endif
    </div>
        <div class="container" id="popup">

    <div class="row">
        <p id="title"><b>{{$article->title}}</b>
        <button class="btn btn-primary" onclick="showEdit({{$article->id}})">Edit</button>
        <button class="btn btn-danger" onclick="deleteArticle({{$article->id}})">Delete</button>
        </p>
    </div>
    <div class="row" style="background-color: grey !important; padding: 10px 10px">
        <p id="article" >
            {!! $article->text !!}
        </p>
    </div>
</div>
    <script>

        function showEdit(id) {
            $.ajax({


                type:'post',
                url: '/article/'+id+'/edit-show',
                data:{'_token':"{{csrf_token()}}"},
                dataType: 'html',
                success: function (message) {


                    $('#popup').append(message);

                }
            });

        }

        function deleteArticle(id) {
            $.ajax({


                type:'post',
                url: '/article/'+id+'/remove',
                data:{'_token':"{{csrf_token()}}"},
                dataType: 'html',
                success: function () {

                    window.location = "/doc";

                }
            });
        }
    </script>


    @endsection