@extends('layouts.app')


@section('content')


        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Луцьк','#add_report')">Луцьк</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Тернопіль','#add_report')">Тернопіль</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Івано-Франківськ','#add_report')">Івано-Франківськ</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Чернівці','#add_report')">Чернівці</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Вінниця','#add_report')">Вінниця</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Черкаси','#add_report')">Черкаси</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Чернігів','#add_report')">Чернігів</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Полтава','#add_report')">Полтава</button>
                    <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/report/add_page/Рівне','#add_report')">Рівне</button>

                    <div id="add_report"></div>

                </div>
                <div class="col-md-2"></div>




            </div>





        </div>




















<script>






</script>

    @stop