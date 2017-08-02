<div class="container">
    <div class="row">
        <div class="col-md-5">
            @foreach($virtuals as $virtual)
                <label class="radio">

                <input type="radio" name="virt_move" value="{{$virtual['id']}}" checked > Віртуалка {{$virtual['name']}}
                @foreach($servers as $server)
                    @if($server['id'] == $virtual['id_server'])

                        , що на сервері {{$server['name']}}

                    @endif
                @endforeach
                </label>

                <br>
            @endforeach
        </div>
        <div class="col-md-2"><button onclick="moving()"  class="btn btn-primary ">Перенести</button></div>
        <div class="col-md-5">
            @foreach($servers as $server)

                <label class="radio">
                    <input type="radio" name="serv_move" value="{{$server['id']}}" checked> на сервер {{$server['name']}}
                </label>
                <br>
            @endforeach</div>
    </div>
</div>
<script>
    function moving() {

        var id_vrt = document.getElementsByName('virt_move');
        var a = id_vrt.length;
        var id_virtual;
        for(var i = 0; i<a; i++){
            if(id_vrt[i].checked){
                id_virtual = id_vrt[i].value;
            }
        }
        var id_srv = document.getElementsByName('serv_move');
        a = id_srv.length;
        var id_server;
        for(i = 0; i<a; i++){
            if(id_srv[i].checked){
                id_server = id_srv[i].value;
            }
        }
        var id_user = {{Auth::user()->id}};

        $.ajax({

            type: 'post',
            url: '/server/moving',
            data: {
                '_token': "{{csrf_token()}}",
                'id_virtual': id_virtual,
                'id_server': id_server,
                'id_user': id_user
            },
            success: function () {
                location.reload(true);
            }
        });



    }


</script>