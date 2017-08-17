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
        var name1 = document.getElementById('name1').value;
        var pass1 = document.getElementById('pass1').value;
        var ip1 = document.getElementById('ip1').value;
        var id_server1 = {{$id_server}};
        var id_user = {{Auth::user()->id}};
        var id_people = {{$id}};
        var type = {{$type}};
        $.ajax({


            type:'post',
            url: '/list/save_virtual/'+id_people,
            data:{'_token':"{{csrf_token()}}",
                'name': name1,
                'lp': pass1,
                'ip': ip1,
                'id_server': id_server1,
                'id_user': id_user,
                'id_people': id_people

            },

            success: function (message) {

                    $('#rdp').html('Збережено');




            }
        });
    }
    
    
    
</script>


<div>


    <label>Name(Login)
        <input type="text" id="name1"  >
    </label>
    <label>IP<p></p>
        <input type="text" id="ip1"  >
    </label>
    <label>Pass<p></p>
        <input type="text" id="pass1"  >
    </label>


    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 5%;"   onclick="save_virtual()">Зберегти</button>
    <!--<button class="btn btn-primary" style="margin-top: 5%; "   onclick="open_page_ajax('/list/server_edit/{{$id}}','#list')">Назад</button>-->
</div>