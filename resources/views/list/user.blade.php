@extends('layouts.app')

@section('content')
    @if (Auth::guest())

    @else
        @if(Auth::user()->actual == 2)


    <script>
         function delete_user(id) {
             if (confirm("Ви впевнені?") == true) {
                 $.ajax({


                     type:'POST',
                     url:'/delete_user/'+id,
                     data:{'_token':"{{csrf_token()}}"},

                     success: function(msg){
                         var del = document.getElementById('user_'+msg);
                         del.remove();


                     }

                 });
             } else {
                 return 0;
             }
        }


    </script>
<p id="message"></p>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-condensed">
                    <thead>
                        <tr class="info">
                                <th>ID</th>


                                <th>Name</th>
                                <th>Surname</th>


                                <th>Email</th>

                                <th>Role</th>

                                <th>Created</th>
                                <th><button class="btn btn-success btn-sm" onclick="open_add_user()">Add new user</button></th>
                        </tr>
                    </thead>
                    <tbody>

                @foreach($users as $user)
                    <div id="div_edit_user">
                        <tr class="warning" id="user_{{$user->id}}">


                            <td>{{$user->id}}  </td>


                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>


                            <td>{{$user->email}} </td>

                            <td>{{$user->actual}}  </td>

                            <td>{{$user->created_at}} </td>
                            <td><button class="btn btn-danger btn-sm" onclick="delete_user({{$user->id}})">Delete</button>
                                <button class="btn btn-primary btn-sm" onclick="open_edit_user({{$user->id}})">Edit</button></td>

                        </tr>
                    </div>
                    @endforeach

                    </tbody>
                </table>
            </div>

                <div class="col-md-1" >

                </div>
            <!--Registration form -->
            <div  class="col-md-3">
            <div id="add_user"></div>

            <!-- Edit user form -->
            <div id="edit_user" ></div>
            </div>
        </div>
       <script>
           function open_add_user(){

               $.ajax({


                   type:'post',
                   url:'/upload/add_user',
                   data:{'_token':"{{csrf_token()}}"},
                   dataType: 'html',
                   success: function (message) {


                        $('#add_user').html(message);

                   }
               });
               $('#add_user').show();


           }


           function open_edit_user(id){

               $.ajax({


                   type:'post',
                   url:'/upload/edit_user/'+id,
                   data:{'_token':"{{csrf_token()}}"},
                   dataType: 'html',
                   success: function (message) {


                       $('#edit_user').html(message);
                   }
               });
               $('#edit_user').show();

           }





       </script>
        @endif
    @endif
@stop
