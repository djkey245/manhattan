
<div class="container">
    <div class="row"><h4><center>Сервер </center></h4>
        @if(!empty($error))<h4 style="color:red"><center>{{$error}}</center></h4> @endif
        @if($servers['purpose'] == 'rdp')
        <div class="col-md-3">
            <h5>Ім’я:</h5>
            <input type="text" class="form-control" id="name" value="{{$servers['name']}}">
        </div>
        <div class="col-md-3">
            <h5>ІР:</h5>
            <input type="text" class="form-control" id="ip" value="{{$servers['ip']}}">
        </div>
        <div class="col-md-3">
            <h5>RDP:</h5>
            <input type="text" class="form-control" id="rdp" value="{{$servers['rdp']}}">
        </div>

        <div class="col-md-3">
            <h5>VNC:</h5>
            <input type="text" class="form-control" id="vnc" value="{{$servers['vnc']}}">
            <button onclick="save_server('rdp')" style=" margin-top: 10%" class="btn btn-success">Зберегти</button>
        </div>
@elseif($servers['purpose'] == 'vrt')
            <div class="col-md-3">
                <h5>Ім’я:</h5>
                <input type="text" class="form-control" id="name" value="{{$servers['name']}}">
            </div>
            <div class="col-md-3">
                <h5>ІР:</h5>
                <input type="text" class="form-control" id="ip" value="{{$servers['ip']}}">
            </div>
            <div class="col-md-3">
                <h5>Login:</h5>
                <input type="text" class="form-control" id="login" value="{{$servers['login']}}">
            </div>
            <div class="col-md-3">
                <h5>Pass:</h5>
                <input type="text" class="form-control" id="rdp" value="{{$servers['rdp']}}">
            </div>
            <div class="col-md-3">
                <h5>VNC:</h5>
                <input type="text" class="form-control" id="vnc" value="{{$servers['vnc']}}">
                <button onclick="save_server('vrt')" style=" margin-top: 10%" class="btn btn-success">Зберегти</button>
            </div>



        @endif
    </div>
</div>
<script>
    function save_server(type) {
        var id = {{$servers['id']}};
        var name = document.getElementById('name').value;
        var ip = document.getElementById('ip').value;
        var vnc = document.getElementById('vnc').value;
        var id_user = {{Auth::user()->id}};
        var rdp = document.getElementById('rdp').value;
        var login = document.getElementById('login').value;
        if(type == 'rdp'){


            $.ajax({
                type: 'post',
                url: '/server/edit_server',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'ip': ip,
                    'vnc': vnc,
                    'rdp': rdp,
                    'id_user': id_user

                },
                success: function (msg) {
                    location.reload(true);
                    //$('#test').html(msg);
                }
            })
        }
        if(type == 'vrt') {


            $.ajax({
                type: 'post',
                url: '/server/edit_server',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'ip': ip,
                    'vnc': vnc,
                    'login': login,
                    'rdp': rdp,
                    'id_user': id_user

                },
                success: function (msg) {
                    location.reload(true);
                    //$('#test').html(msg);
                }
            })
        }
    }
</script>
