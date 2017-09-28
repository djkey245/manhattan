@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div id="list"></div>
            <table class="table table-condensed">



                <!--  Заголовки  -->

                <!--  Peoples  -->
                @if(empty($search))

                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 col-sm-1">
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h4>Нічого не знайдено!</h4>

                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-6 div-sm-4">

                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                    <div class="col-md-2 col-sm-1">
                    </div>


                    </div>
                <br>
                    <thead>
                    <tr >
                        @foreach($items as $item)
                            @if($item->list_menu == 1)
                                <th>{{$item->name_ukr}}</th>


                        @endif


                    @endforeach
                    <!--  Buttons  -->

                        <th>                    <button id="open_page_add" onclick="open_page_ajax('/upload/list_add','#list')" class="btn btn-success btn-sm">Add</button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach($objects as $object)

                    <tr id="person_{{$object->id}}">


                            @foreach($items as $item)
                                @if($item->list_menu == 1)
                                    @foreach($search as $id)
                                        @if($object->id == $id)
                                            <?php echo ' <th><a href=/list/'.$object->id.'>'.$object->{$item->name_eng}.'</a></th>'; ?>
                                        @endif

                                    @endforeach
                                @endif

                            @endforeach






                    </tr>
                @endforeach

                </tbody>
                @endif
            </table>

        {{--<div class="col-md-1"><th>
                <div class="btn-group">
                    <!--<button id="open_page_add" onclick="open_page_ajax('/list/page_search','#list')" class="btn btn-default btn-sm">Search</button>-->
                    <button onclick="cancel_hide('#list')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>

                </div>
            </th></div>--}}
        <div class="col-md-2">


        </div>
    </div>
    <script>
        function delete_user(id) {
            if (confirm("Ви впевнені?") == true) {
                $.ajax({


                    type:'POST',
                    url:'/upload/list_delete/'+id,
                    data:{'_token':"{{csrf_token()}}"},

                    success: function(msg){
                        var del = document.getElementById('person_'+msg);
                        del.remove();


                    }

                });
            } else {
                return 0;
            }
        }

    </script>

@stop
