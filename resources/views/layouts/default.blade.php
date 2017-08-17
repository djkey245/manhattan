<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manhattan Project</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{'css/default.css'}}" >
    <link rel="stylesheet" href="{{'css/bootstrap.min.css'}}">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('components.nav')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>



<!-- JavaScripts -->
<script src="{{'js/bootstrap.min.js'}}"></script>
<script src="{{'js/npm.js'}}"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
