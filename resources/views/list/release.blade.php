    @extends('layouts.app')

@section('content')
    @if (Auth::guest())
    @else
    <div class="container-fluid">
        <div class="col-md-9">
            <table class="table table-condensed table-bordered">

                    @foreach($releases_all as $release)


                    <tr class="info" id="release_{{$release->id}}_1">
                        <th>ID </th>
                        <th>Дія </th>
                        <th>Створив користувач </th>
                        <th>Відносно  </th>
                        <th>Підтвердження Адміна</th>
                        <th>Підтвердження Директора </th>
                    </tr>

                    <tr class="warning" id="release_{{$release->id}}_2">
                        <th class="active" rowspan="3">{{$release->id}}</th>
                        <th>
                            @if($release->event == 1)
                                Звільнення
                            @endif

                        </th>
                        <th>@foreach($users as $user)
                                @if($user->id == $release->id_user)
                                    {{$user->name}} {{$user->surname}}
                                @endif
                            @endforeach</th>
                        <th>@foreach($peoples as $people)
                                @if($people->id == $release->id_person)
                                    <a href="/list/{{$release->id_person}}"> {{$people->name}} {{$people->surname}}</a>
                                @endif
                            @endforeach</th>
                        @if($release->admin == 1)
                            <th class="">Підтверджено</th>
                            @else <th class="">Не підтверджено</th>
                            @endif
                        @if($release->chief == 1)
                            <th class="">Підтверджено</th>
                            @else <th class="">Не підтверджено</th>
                            @endif
                    </tr>



                <tr class="info" id="release_{{$release->id}}_3">

                        <th>Причина</th>

                        <th>Створено</th>
                        <th>Змінено</th>

                        <th>Дію виконано</th>
                        <th>
                                Дії
                        </th>


                    </tr>

                    <tr class="warning" id="release_{{$release->id}}_4">
                                    <th>{{$release->reason}}</th>

                                    <th>{{$release->created_at}}</th>
                                    <th>{{$release->updated_at}}</th>
                                    <th>@if($release->action == 1)
                                            Виконано
                                        @else Не виконано
                                        @endif</th>
                                    <th>
                                            @if(Auth::user()->id == $release->id_user or Auth::user()->actual == 3 or Auth::user()->actual == 2)
                                            <!--<button id="open_page_add" onclick="delete_release({{--$release->id--}})" class="btn btn-danger btn-sm">Delete</button>-->
                                            @endif
                                            <button id="open_page_add" onclick="open_page_ajax('/upload/release_edit/{{$release->id}}','#release_edit')" class="btn btn-primary btn-sm">Edit</button>
                                    </th>


                                </tr>

                            @endforeach








            </table>

        </div>


        <div class="col-md-1"><button id="open_page_add" onclick="open_page_ajax('/upload/release_add','#release_add')" class="btn btn-success btn-sm">Add new event</button>
        </div>
        <div class="col-md-2">
            <div id="release_add"></div>
            <div id="release_edit"></div>


        </div>
    </div>












<script>
    function delete_release(id) {
        if (confirm("Ви впевнені?") == true) {
            $.ajax({


                type:'POST',
                url:'/delete_release/'+id,
                data:{'_token':"{{csrf_token()}}"},

                success: function(msg){

                    var del1 = document.getElementById('release_'+msg+'_1');
                    del1.remove();
                    var del2 = document.getElementById('release_'+msg+'_2');
                    del2.remove();
                    var del3 = document.getElementById('release_'+msg+'_3');
                    del3.remove();
                    var del4 = document.getElementById('release_'+msg+'_4');
                    del4.remove();
                    //location.reload(true);

                }

            });
        } else {
            return 0;
        }
    }

</script>







    @endif
@stop
