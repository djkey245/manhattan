<script>
    /*function save_virtual() {
        var id = document.getElementsByName('virtual');
        var a = id.length;
        var id_people = //$id}};
        var id_user = {//Auth::user()->id}};
        var id_virtual;
        for(var i = 0; i<a; i++){
            if(id[i].checked){
                id_virtual = id[i].value;
            }
        }

        $.ajax({


            type:'post',
            url: '/list/save_virtual/'+id_people,
            data:{'_token':"{//csrf_token()}}",
                'id_virtual': id_virtual,
                'id_user': id_user

            },

            success: function (message) {

                //$('#list').html(message);

                location.reload(true);

            }
        });

    }*/
    function save_virtual() {
        var name = document.getElementById('name').value;
        var pass = document.getElementById('pass').value;
        var ip = document.getElementById('ip').value;
        var id_server = {{$id_server}};
        var id_user = {{Auth::user()->id}};
        var id_people = {{$id}};
        var type = {{$type}};
        $.ajax({


            type:'post',
            url: '/list/save_virtual/'+id_people,
            data:{'_token':"{{csrf_token()}}",
                'name': name,
                'lp': pass,
                'ip': ip,
                'id_server': id_server,
                'id_user': id_user,
                'id_people': id_people

            },

            success: function (message) {
                $('#vrt').html('Збережено');
            }
        });
    }
    
    
    
</script>


<div>


    <label>Name(Login)
        <input type="text" id="name"  >
    </label>
    <label>IP<p></p>
        <input type="text" id="ip"  >
    </label>
    <label>Pass<p></p>
        <input type="text" id="pass"  >
    </label>


    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 5%;"   onclick="save_virtual()">Зберегти</button>
    <!--<button class="btn btn-primary" style="margin-top: 5%; "   onclick="open_page_ajax('/list/server_edit/{{$id}}','#list')">Назад</button>-->
</div>