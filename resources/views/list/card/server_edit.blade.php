<script>
    function next_krok() {
        var id = document.getElementsByName('server');
        var a = id.length;
        var id_people = {{$id}};
        var id_server;
        for(var i = 0; i<a; i++){
            if(id[i].checked){
                id_server = id[i].value;
            }
        }

        $.ajax({


            type:'post',
            url: '/list/virtual_edit/'+id_people,
            data:{'_token':"{{csrf_token()}}",
                'id_server': id_server

            },
            dataType: 'html',
            success: function (message) {


                $('#list').html(message);

            }
        });

    }
    
    
    
    
</script>


<div style="margin-left: 40%; padding-left: 10%; padding-bottom: 5%; border: 1px solid ;  border-radius: 4px;" >
@foreach($servers as $server)

    <label class="radio">
        <input type="radio" name="server" checked value="{{$server->id}}">
        {{$server->name.' '.$server->ip}}
    </label>

    @endforeach
    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 10%;"   onclick="next_krok()">Далі..</button>
</div>