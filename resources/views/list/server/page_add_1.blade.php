<script>
    var i = 0;
    function del_virtual() {



        $("kl:last").remove();
    }
    function add_virtual() {
        var virtual = '<kl><div class="row" id="virt'+i+'"><div class="col-md-3"><h5>Ім’я:</h5><input type="text" class="form-control" name="name_v[]"></div><div class="col-md-3">' +
            '<h5>ІР:</h5><input type="text" class="form-control" name="ip_v[]"></div><div class="col-md-4"><h5>LoginPass:</h5><input type="text" class="form-control" name="lp_v[]"></div>' +
            '<div class="col-md-2"><button id='+i+' onclick="del_virtual()" style=" margin-top: 21%" class="btn btn-danger ">-</button></div></div></kl>';
        $("#add_v").append(virtual);
        i++;
    }


</script>

<input type="hidden" id="id" value='{{$id}}'>

<div class="container">
    <h4><center>Віртуалки </center></h4>
    <div class="row">
        <div class="col-md-3">
            <h5>Ім’я(Login):</h5>
            <input type="text" class="form-control" name="name_v[]">
        </div>
        <div class="col-md-3">

            <h5>ІР:</h5>
            <input type="text" class="form-control" name="ip_v[]">



        </div>
        <div class="col-md-4">
            <h5>Pass:</h5>
            <input type="text" class="form-control" name="lp_v[]">
        </div>
        <div class="col-md-2"><div class="btn-group"><button onclick="add_virtual()" style=" margin-top: 30%" class="btn btn-success ">+</button>
                <button onclick="save_server()" style=" margin-top: 30%"  class="btn btn-primary ">Зберегти</button></div></div>

    </div>
    <div id="add_v"></div>
</div>
<div id="prob"></div>
<script>
    function save_server(){


        var id = document.getElementById('id').value;
        var name_v = document.getElementsByName('name_v[]');
        var ip_v = document.getElementsByName('ip_v[]');
        var lp_v = document.getElementsByName('lp_v[]');
        var id_user = {{Auth::user()->id}};
        var j ;
        var vrt = "";
        for(j = 0;j<=i;j++){

            vrt += name_v[j].value+','+ip_v[j].value+','+lp_v[j].value+';';

        }

        $.ajax({

         type: 'post',
         url: '/server/save',
         dataType: 'html',
         data:{
         '_token': "{{csrf_token()}}" ,
             'vrt': vrt,
             'id_serv':id,
             'id_user':id_user

         },
         success: function (message) {
            //alert(message);
             //$("#prob").html(message);
         location.reload(true);

         }



         });


    }



</script>