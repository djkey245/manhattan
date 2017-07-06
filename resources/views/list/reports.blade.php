@extends('layouts.app')


@section('content')


        <div class="container">
            <div class="row">
                <div id="add_report">
                <div class="col-md-2"></div>
                <div class="col-md-8">




                </div>
                <div class="col-md-2">
                    <button onclick="open_page_ajax('/report/add_page','#add_report')" style="width: 100%; margin-top: 5%" class="btn btn-success " id="button_cansel">Додати звіт</button>
                </div>




            </div>
            </div>





        </div>



<?php $pass = Hash::make('123456890+');
//echo $pass; ?>
















<script>






</script>

    @stop