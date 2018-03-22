@extends('layouts.app')


@section('content')
    <div class="container">
        <br>
        <div class="row-fluid">

            <form action="/doc-addCategory" method="post" class="form-horizontal" style="display: inline-block;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-xs-8">
                    <input type="text" name="name" class="form-control " >
                </div>
                <div class="col-xs-1">
                    <input type="submit" class="btn btn-success" value="Додати категорію">
                </div>
            </form>
        <div class="col-xs-1 " style="position: relative; right: 50px">
    <button class="btn btn-success">
        Додати статтю
    </button>
</div>

        </div>
        <div class="row-fluid">
            <br>
            @foreach(App\DocumentationCategory::all() as $category)

                <a class="cm-link" href="/doc/{{$category->id}}" style="font-size: 24px; margin: 5px; margin-top: 5px">{{$category->name}}</a>
                <br>
                <br>


                @endforeach
        </div>
    </div>











    @stop