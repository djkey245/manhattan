<input type="hidden" id="id_v" value="{{$virtuals['id']}}">

<div class="container" id="test">

    <h4><center>Віртуалкa </center></h4>


        <div class="row">

        <div class="col-md-3">
            <h5>Login:</h5>
            <input type="text" class="form-control" name="name_v[]" id="name_v" value="{{$virtuals['name']}}">
        </div>
        <div class="col-md-3">

            <h5>ІР:</h5>
            <input type="text" class="form-control" name="ip_v[]" id="ip_v" value="{{$virtuals['ip']}}">



        </div>
        <div class="col-md-2">
            <h5>Pass:</h5>
            <input type="text" class="form-control" name="lp_v[]" id="lp_v" value="{{$virtuals['lp']}}">
        </div>
            <div class="col-md-2">
                <h5>OS:</h5>
                <input type="text" class="form-control" name="os_v[]" id="os_v" value="{{$virtuals['os']}}">
            </div>

                <button onclick="save_virtual()"   class="btn btn-primary ">Зберегти</button>


        </div>

    </div>
<script>
    function save_virtual() {
        var id_virtual = document.getElementById('id_v').value;
        var name = document.getElementById('name_v').value;
        var ip = document.getElementById('ip_v').value;
        var lp = document.getElementById('lp_v').value;
        var os = document.getElementById('os_v').value;
        var id_user = {{Auth::user()->id}};
        $.ajax({
            type: 'post',
            url: '/server/edit_virtual',
            data: {
                '_token': "{{csrf_token()}}",
                'id_virtual': id_virtual,
                'name': name,
                'ip': ip,
                'lp': lp,
                'os': os,
                'id_user': id_user

            },
            success: function (msg) {
                location.reload(true);
                //$('#test').html(msg);
            }
        })

    }
</script>
