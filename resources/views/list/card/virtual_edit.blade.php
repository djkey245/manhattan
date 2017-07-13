<script>
    function save_virtual() {
        var id = document.getElementsByName('virtual');
        var a = id.length;
        var id_people = {{$id}};
        var id_user = {{Auth::user()->id}};
        var id_virtual;
        for(var i = 0; i<a; i++){
            if(id[i].checked){
                id_virtual = id[i].value;
            }
        }

        $.ajax({


            type:'post',
            url: '/list/save_virtual/'+id_people,
            data:{'_token':"{{csrf_token()}}",
                'id_virtual': id_virtual,
                'id_user': id_user

            },

            success: function (message) {

                //$('#list').html(message);

                location.reload(true);

            }
        });

    }
    
    
    
    
</script>


<div style="margin-left: 40%; padding-left: 10%; padding-bottom: 5%; border: 1px solid ;  border-radius: 4px;" >
@foreach($virtuals as $virtual)

    <label class="radio">
        <input type="radio" name="virtual" checked value="{{$virtual->id}}">
        {{$virtual->name.' '.$virtual->ip}}
    </label>

    @endforeach
    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 5%;"   onclick="save_virtual()">Зберегти</button>
    <button class="btn btn-primary" style="margin-top: 5%; "   onclick="open_page_ajax('/list/server_edit/{{$id}}','#list')">Назад</button>
</div>