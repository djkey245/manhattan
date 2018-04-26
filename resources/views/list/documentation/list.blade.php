@extends('layouts.app')


@section('content')
    <div class="container">
        <br>
        <div class="row-fluid" id="popup">

            <div>
                <h2 style="display: inline-block">{{\App\DocumentationCategory::find($id)->name}}</h2>
                <button class="btn btn-success" onclick="showAdd({{$id}})" style="display: inline-block; margin-left: 1%">
                    Додати статтю
                </button>
            </div>
            <br>
            @foreach($articles as $article)

                <h4><a href="/article/{{$article->id}}">{{$article->title}}</a></h4>

                @endforeach
        </div>
    </div>



    <script>

        function showAdd(id) {
            $.ajax({


                type:'post',
                url: '/doc/'+id+'/add-popup',
                data:{'_token':"{{csrf_token()}}"},
                dataType: 'html',
                success: function (message) {


                    $('#popup').append(message);

                }
            });

        }
    </script>



@stop