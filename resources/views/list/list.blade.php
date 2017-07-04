@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-md-8">
        <table class="table table-condensed">
            <thead>


            <!--  Заголовки  -->
                <tr class="info">
                    @foreach($items as $item)
                        @if($item->list_menu == 1)
                                <th>{{$item->name_ukr}}</th>


                        @endif


                    @endforeach
                    <!--  Buttons  -->

<th></th>
                </tr>
            </thead>
            <tbody>
            <!--  Peoples  -->

            @foreach($objects as $object)

            <tr class="warning" id="person_{{$object->id}}">

                @if(empty($search))

                @foreach($items as $item)
                    @if($item->list_menu == 1)

                           <?php echo ' <th><a href=/list/'.$object->id.'>'.$object->{$item->name_eng}.'</a></th>'; ?>

                    @endif

                @endforeach
                    <th><!--<button onclick="delete_user({--$object->id--})" class="btn btn-danger btn-sm">Delete</button> -->
                        <button  id="open_page_edit" onclick="open_page_ajax('/upload/list_edit/{{$object->id}}','#list')" class="btn btn-primary btn-sm">Edit</button>

                    </th>
                @else
                    @foreach($items as $item)
                        @if($item->list_menu == 1)
                            @foreach($search as $id)
                                @if($object->id == $id)
                                    <?php echo ' <th><a href=/list/'.$object->id.'>'.$object->{$item->name_eng}.'</a></th>'; ?>
                                @endif

                            @endforeach
                        @endif

                    @endforeach

                @endif




                        </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="col-md-2"><th>
            <div class="btn-group">
                <button id="open_page_add" onclick="open_page_ajax('/upload/list_add','#list')" class="btn btn-success btn-sm">Add new person</button>
                <button id="open_page_add" onclick="open_page_ajax('/list/page_search','#list')" class="btn btn-default btn-sm">Search</button>
                <button onclick="cancel_hide('#list')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>

            </div>
        </th></div>
    <div class="col-md-2">
        <div id="list"></div>

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

                    alert(msg);
                    //var del = document.getElementById('person_'+msg);
                    //del.remove();


                }

            });
        } else {
            return 0;
        }
    }

</script>

@stop
