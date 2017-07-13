<script>
    function next_page_add(){
        var name = document.getElementById('name').value;
        var ip = document.getElementById('ip').value;
        var vnc = document.getElementById('vnc').value;
        var rdp = document.getElementById('rdp').value;
        $.ajax({

            type: 'post',
            url: '/server/page_add_1',
            dataType: 'html',
            data:{
                '_token': "{{csrf_token()}}" ,
                'name': name,
                'ip': ip,
                'vnc': vnc,
                'rdp': rdp

            },
            success: function (message) {
                $("#serv").html(message);
                //location.reload(true);

            }



        });


    }



</script>

<div class="container">
    <div class="row"><h4><center>Сервер </center></h4>
        @if(!empty($error))<h4 style="color:red"><center>{{$error}}</center></h4> @endif
        <div class="col-md-3">
            <h5>Ім’я:</h5>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="col-md-3">
            <h5>ІР:</h5>
            <input type="text" class="form-control" id="ip">
        </div>
        <div class="col-md-3">
            <h5>RDP:</h5>
            <input type="text" class="form-control" id="rdp">
        </div>

        <div class="col-md-3">
            <h5>VNC:</h5>
            <input type="text" class="form-control" id="vnc">
            <button onclick="next_page_add()" style=" margin-top: 10%" class="btn btn-success">Далі..</button>
        </div>

    </div>
</div>