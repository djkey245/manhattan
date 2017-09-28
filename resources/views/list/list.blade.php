@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row-fluid">

        <div class="span8">
            <div class="alert-edit">
                <div id="list" ></div>

            </div>
            <table class="table table-condensed">
                <thead>


                <!--  Заголовки  -->
                    <tr >
                        @foreach($items as $item)
                            @if($item->list_menu == 1)
                                    <th>{{$item->name_ukr}}</th>


                            @endif


                        @endforeach
                        <!--  Buttons  -->

    <th>                    <button id="open_page_add" onclick="open_page_ajax('/upload/list_add','#list')" class="btn btn-success btn-sm">Add </button>
    </th>
                    </tr>
                </thead>
                <tbody>
                <!--  Peoples  -->

                @foreach($objects as $object)

                <tr  id="person_{{$object->id}}">

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
