@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-1">

            </div>
            <div class="col-md-6 div-sm-4">
                <form action="/list/search"  method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="search"  type="text" name="referal" placeholder="Пошук..."  class="form-control" >

                    <center>
                    <button type="submit"  class="btn btn-primary" style="margin-top: 1%;"  value="Пошук">Пошук</button>
                    </center>
                </form>
            </div>
        </div>
    </div>


@endsection
