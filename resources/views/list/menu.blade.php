@extends('layouts.app')



@section('content')
    @if(Auth::user()->actual == 2)

        <div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <th>
                            ID
                        </th>
                        <th>
                            Ім’я(укр)
                        </th>
                        <th>Ім’я(англ)</th>
                        <th>Тип</th>
                        <th>Мінімум</th>
                        <th>Максимум</th>
                        <th>Опція англ(Вибір)</th>
                        <th>Опція укр(Вибір)</th>
                        <th>Активне</th>
                        <th>Порядок</th>
                        <th>Важливе</th>
                        <th>Обновлено</th>
                        <th>Дії</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr id="tr_{{$item->id}}" class="warning">
                        <th>{{$item->id}}</th>
                        <th>{{$item->name_ukr}}</th>
                        <th>{{$item->name_eng}}</th>
                        <th>{{$item->type}}</th>
                        <th>{{$item->min}}</th>
                        <th>{{$item->max}}</th>
                        <th>{{$item->option}}</th>
                        <th>{{$item->option_name}}</th>
                        <th>{{$item->active}}</th>
                        <th>{{$item->actual}}</th>
                        <th>{{$item->list_menu}}</th>
                        <th>{{$item->updated_at}}</th>

                        <th><div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="open_page_ajax('/menu/page_edit/{{$item->name_eng}}','#page_edit')">Редагувати</button>
                        <button class="btn btn-danger btn-sm" onclick="delete_item('/menu/delete/{{$item->id}}','tr_{{$item->id}}')">X</button>
                            </div>
                        </th>





                    </tr>



                        @endforeach
                </tbody>



            </table>
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" onclick="open_page_ajax('/menu/page_add','#page_add')"  >Додати пункт</button>
        </div>
        <div class="col-md-2">
            <div id="page_add"></div>
            <div id="page_edit">


        </div>
    </div>
</div>




<script>







</script>





@endif









    @stop