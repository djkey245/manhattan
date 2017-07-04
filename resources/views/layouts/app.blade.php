<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manhattan Project</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">-->

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{'/css/default.css'}}"
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
<!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

   <style>



    </style>
</head>

<body  id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Головна
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (Auth::guest())
                @else

                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="/list" class="dropdown-toggle" data-toggle="dropdown" >
                                Список працівників<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/list') }}"><i class="fa fa-btn"></i>Усі працівники</a></li>
                                <li><a href="{{ url('/office/Рівне') }}"><i class="fa fa-btn"></i>Рівне</a></li>
                                <li><a href="{{ url('/office/Луцьк') }}"><i class="fa fa-btn"></i>Луцьк</a></li>
                                <li><a href="{{ url('/office/Тернопіль') }}"><i class="fa fa-btn"></i>Тернопіль</a></li>
                                <li><a href="{{ url('/office/Івано-Франківськ') }}"><i class="fa fa-btn"></i>Івано-Франківськ</a></li>
                                <li><a href="{{ url('/office/Чернівці') }}"><i class="fa fa-btn"></i>Чернівці</a></li>
                                <li><a href="{{ url('/office/Черкаси') }}"><i class="fa fa-btn"></i>Черкаси</a></li>
                                <li><a href="{{ url('/office/Чернігів') }}"><i class="fa fa-btn"></i>Чернігів</a></li>
                                <li><a href="{{ url('/office/Вінниця') }}"><i class="fa fa-btn"></i>Вінниця</a></li>
                                <li><a href="{{ url('/office/Полтава') }}"><i class="fa fa-btn"></i>Полтава</a></li>
                                <li><a href="{{ url('/office/Інші') }}"><i class="fa fa-btn"></i>Інші</a></li>
                            </ul>


                        </li>
                    </ul>


                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/release') }}">Список подій</a></li>
                    </ul>

                    @if(Auth::user()->actual == 2)

                        <ul class="nav navbar-nav">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Налаштування<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/menu') }}"><i class="fa fa-btn"></i>Меню Працівники</a></li>
                                    <li><a href="{{ url('/users') }}"><i class="fa fa-btn"></i>Список користувачів</a></li>

                                </ul>


                            </li>
                        </ul>
                @endif
                @endif


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} {{ Auth::user()->surname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Вихід</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{'/js/default.js'}}"></script>
    <script>
        function open_page_ajax(url, div){

            $.ajax({


                type:'post',
                url: url,
                data:{'_token':"{{csrf_token()}}"},
                dataType: 'html',
                success: function (message) {


                    $(div).html(message);

                }
            });
            $(div).show();



        }
        function cancel_hide(id) {

            $(id).hide();

        }


        function delete_item(url1,div1) {
            var id_user = <?php echo Auth::user()->id; ?>;
            if (confirm("Ви впевнені?") == true) {
                $.ajax({


                    type:'POST',
                    url:url1,
                    data:{'_token':"{{csrf_token()}}",
                            'id_user': id_user
                    },

                    success: function(){

                        var del = document.getElementById(div1);
                        del.remove();


                    }

                });
            } else {
                return 0;
            }
        }
    </script>

    </body>
</html>
