
<table class="table table-condensed table-bordered ">
    <tr>
        <th><div class="col-md-10"> Дія </div>

            <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#release_add')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
        </th>
    </tr>
    <tr>
        <th>
            <select class="form-control" id="release_event">
                <option value="1">Звільнення</option>
            </select>
        </th>
    </tr>

    <tr>
        <th>
            Створив користувач
        </th>
    </tr>
    <tr>
        <th>
            <input type="hidden" id="release_id_user" value="{{Auth::user()->id}}"> <i>{{Auth::user()->surname}} {{Auth::user()->name}}</i>
        </th>
    </tr>
    <tr>
        <th>
            Відносно
        </th>
    </tr>
    <tr>
        <th>
            <select class="form-control" id="release_person_id">
                @foreach($peoples as $people)

                    <option value="{{$people->id}}">{{$people->surname}} {{$people->name}}</option>


                    @endforeach

            </select>
        </th>
    </tr>
    <tr>
        <th>
            Причина <span id="reason"></span><span id="reason1"></span>
        </th>
    </tr>
    <tr>
        <th>
            <textarea class="form-control" id="release_reason" minlength="15"></textarea>
        </th>
    </tr>
    <tr>
        <th>
            <button onclick="submit_valid()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>

            <button onclick="cancel_hide('#release_add')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>
        </th>
    </tr>
</table>
<script>
    function submit_valid() {
        var InpObjReason = document.getElementById("release_reason");
        if(InpObjReason.value == ""){
            $('#reason1').html('<i>Enter data</i>');
        }
        else{

            document.getElementById("reason1").innerHTML = "";

        }

        if (InpObjReason.checkValidity() == false) {
            document.getElementById("reason").innerHTML = InpObjReason.validationMessage.fontcolor('red');
        }
        else{
            document.getElementById("reason").innerHTML = "";
        }
        if(InpObjReason.value != "" && InpObjReason.checkValidity() != false )
        {
            register();

        }


    }
    function register(){
        var InpObjEvent = document.getElementById("release_event");
        var InpObjReason = document.getElementById("release_reason");
        var InpObjIdUser = document.getElementById("release_id_user");
        var InpObjIdPerson = document.getElementById("release_person_id");


        var event = InpObjEvent.value;
        var reason = InpObjReason.value;
        var id_user = InpObjIdUser.value;
        var id_person = InpObjIdPerson.value;
        $.ajax({


            type:'POST',
            url:'/upload/release_add_reg',
            data:{'_token':"{{csrf_token()}}",
                'event' : event,
                'reason': reason,
                'id_user' : id_user,
                'id_person' : id_person,


            },

            success: function(msg){

                location.reload(true);

            }

        });



    }
</script>