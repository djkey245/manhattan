<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manhattan Project</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@if(Auth::user()->theme == 'black')
        <link rel="stylesheet" href="/css/black-theme.css">
    @elseif(Auth::user()->theme == 'white')
        <link rel="stylesheet" href="/css/white-theme.css">
    @else
        <link rel="stylesheet" href="/css/black-theme.css">
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">-->
    <link rel="stylesheet" href="/css/css.css">

    <!-- Styles -->
 <link href="{{ url('/css/index.css') }}" rel="stylesheet">
<!-- JavaScripts -->
    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

   <style>



    </style>
</head>

@if(Auth::user()->theme == 'black')
    <link rel="stylesheet" href="/css/black-theme.css">

    <nav class=" navbar-inverse navbar-default navbar-static-top">
        <body  id="app-layout" style="background-color: black; ">
        @elseif(Auth::user()->theme == 'white')
            <nav class=" navbar navbar-default navbar-static-top">
                <body  id="app-layout">
                <link rel="stylesheet" href="/css/white-theme.css">
                @else
            <nav class=" navbar navbar-default navbar-static-top">
                <body  id="app-layout">
                @endif
            <div class="container-fluid" style="margin-left: 8%; margin-right: 8%">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand menu" href="{{ url('/home') }}">
                    Головна
                </a>
            </div>

            <div class="collapse navbar-collapse"  id="app-navbar-collapse" style="display:">
                <!-- Left Side Of Navbar -->
                @if (Auth::guest())
                @else

                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="/list" class="dropdown-toggle menu" data-toggle="dropdown" >
                                Працівники<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/list') }}" class="menu"><i class="fa fa-btn"></i>Усі працівники</a></li>
                                <li><a href="{{ url('/office/Рівне') }}" class="menu"><i class="fa fa-btn"></i>Рівне</a></li>
                                <li><a href="{{ url('/office/Луцьк') }}" class="menu"><i class="fa fa-btn"></i>Луцьк</a></li>
                                <li><a href="{{ url('/office/Тернопіль') }}" class="menu"><i class="fa fa-btn"></i>Тернопіль</a></li>
                                <li><a href="{{ url('/office/Івано-Франківськ') }}" class="menu"><i class="fa fa-btn"></i>Івано-Франківськ</a></li>
                                <li><a href="{{ url('/office/Чернівці') }}" class="menu"><i class="fa fa-btn"></i>Чернівці</a></li>
                                <li><a href="{{ url('/office/Черкаси') }}" class="menu"><i class="fa fa-btn"></i>Черкаси</a></li>
                                <li><a href="{{ url('/office/Чернігів') }}" class="menu"><i class="fa fa-btn"></i>Чернігів</a></li>
                                <li><a href="{{ url('/office/Вінниця') }}" class="menu"><i class="fa fa-btn"></i>Вінниця</a></li>
                                <li><a href="{{ url('/office/Полтава') }}" class="menu"><i class="fa fa-btn"></i>Полтава</a></li>
                                <li><a href="{{ url('/office/Інші') }}" class="menu"><i class="fa fa-btn"></i>Інші</a></li>
                            </ul>


                        </li>
                    </ul>


                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="{{ url('/release') }}" class="dropdown-toggle menu" data-toggle="dropdown" >
                            Події<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/release') }}"  class="menu"><i class="fa fa-btn"></i> Звільнення</a></li>
                                <li><a href="{{ url('/report') }}"  class="menu"><i class="fa fa-btn"></i> Рапорт</a></li>

                            </ul>


                        </li>
                    </ul>

                    @if(Auth::user()->actual == 2)

                        <ul class="nav navbar-nav form-inline">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle menu" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Сервіси<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/server') }}"  class="menu"><i class="fa fa-btn"></i>Сервери</a></li>
                                    <li><a href="{{ url('/contracts') }}"  class="menu"><i class="fa fa-btn"></i>Договори</a></li>
                                    <li><a href="{{ url('/history') }}"  class="menu"><i class="fa fa-btn"></i>Історія</a></li>

                                </ul>


                            </li>


                        </ul>
                        <ul class="nav navbar-nav form-inline">
                            <li>
                                <a href="/doc" class="menu">
                                    Документація
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-search" style="width: 500px;">
                            <form action="/list/search" class="navbar-form pull-left" style="width: 100%; display: flex"  method="post">
                                <input type="hidden" name="_token"   value="{{ csrf_token() }}">
                                <input id="search"  type="text"  style="width: 100%" name="referal" placeholder="Пошук..."  class="form-control" >

                                <button type="submit"  class="btn btn-primary" style="margin-left: 5px"   value="Пошук">Пошук</button>
                            </form>
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
                                <li><a href="{{ url('/reports/17') }}">Звіт Діми</a></li>
                                <li><a href="{{ url('/reports/27') }}">Звіт Андрія</a></li>
                                <li><a href="{{ url('/reports/24') }}">Звіт Тараса</a></li>
                                <li><a href="{{ url('/users') }}">Користувачі</a></li>
                                <li><a href="{{ url('/menu') }}">Пункти меню</a></li>
                                <li><a href="{{ url('/theme/black/'.Auth::user()->id) }}">Тема black</a></li>
                                <li><a href="{{ url('/theme/white/'.Auth::user()->id) }}">Тема white</a></li>

                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Вихід</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
            <script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>
    {{--<script src="{{'/js/main.js'}}"></script>--}}
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
        function reload()
        { location.reload(true);      }
    </script>

    </body>
</html>
