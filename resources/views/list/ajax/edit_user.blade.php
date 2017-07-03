@foreach($user as $usr)

    @endforeach
<table class="table table-bordered">
    <div id="message_ajax"></div>
    <tr>

        <th><div class="col-md-10"> Name: <span id="demo_name"></span><span id="demo_name_empty"></span></div>

            <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#edit_user')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
        </th>


    </tr>
    <tr>
        <th>
            <input hidden id="add_user_id" value={{$usr['id']}}>
            <input class="form-control" type="text" id="add_user_name" minlength="5" maxlength="15" value={{$usr['name']}}>
        </th>
    </tr>
    <tr>
        <th>
            Surname: <span id="demo_surname"></span><span id="demo_surname_empty"></span>
        </th>
    </tr>
    <tr>
        <th>
            <input class="form-control" type="text" id="add_user_surname" value='{{$usr['surname']}}' minlength="3" maxlength="20">
        </th>
    </tr>
    <tr>
        <th>
            Email: <span id="demo_email"></span><span id="demo_email_empty"></span>
        </th>
    </tr>

    <tr>
        <th>
            <input class="form-control" type="email" id="add_user_email" minlength="12" maxlength="35" value={{$usr['email']}}>
        </th>
    </tr>

    <tr>
        <th>
            Role:
        </th>
    </tr>
    <tr>
        <th>
            <select class="form-control" id="add_user_actual">
                @if($usr['actual'] == 1)
                <option value="1" selected>HR</option>
                <option value="2">Admin</option>
                <option value="3">Special</option>
                @elseif($usr['actual'] == 2)
                    <option value="1" >HR</option>
                    <option value="2" selected>Admin</option>
                    <option value="3">Special</option>
                @elseif($usr['actual'] == 3)
                    <option value="1" >HR</option>
                    <option value="2" >Admin</option>
                    <option value="3" selected>Special</option>
                @endif
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <button onclick="submit_valid()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>

            <button onclick="cancel_hide('#edit_user')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>
        </th>
    </tr>
</table>
<script>
    function submit_valid() {
        var InpObjName = document.getElementById("add_user_name");
        var InpObjSurname = document.getElementById("add_user_surname");
        var InpObjEmail = document.getElementById("add_user_email");
        var InpObjActual = document.getElementById("add_user_actual");



        if(InpObjName.value == ""){
            $('#demo_name_empty').html('<i>Enter Data</i>');
        }
        else{
            document.getElementById("demo_name_empty").innerHTML = "";

        }
        if(InpObjSurname.value == ""){
            $('#demo_surname_empty').html('<i>Enter Data</i>');
        }
        else{
            document.getElementById("demo_surname_empty").innerHTML = "";

        }
        if(InpObjEmail.value == ""){
            $('#demo_email_empty').html('<i>Enter Data</i>');

        }
        else{
            document.getElementById("demo_email_empty").innerHTML = "";
        }
        if (InpObjName.checkValidity() == false) {
            document.getElementById("demo_name").innerHTML = InpObjName.validationMessage.fontcolor('red');
        }
        else{
            document.getElementById("demo_name").innerHTML = "";
        }
        if (InpObjSurname.checkValidity() == false) {
            document.getElementById("demo_surname").innerHTML = InpObjName.validationMessage.fontcolor('red');
        }
        else{
            document.getElementById("demo_surname").innerHTML = "";
        }
        if (InpObjEmail.checkValidity() == false) {
            document.getElementById("demo_email").innerHTML = InpObjEmail.validationMessage.fontcolor('red');
        }
        else{
            document.getElementById("demo_email").innerHTML = "";

        }

        if(InpObjName.value != "" && InpObjEmail.value != "" && InpObjName.checkValidity() != false && InpObjEmail.checkValidity() != false )
        {
            updater();

        }


    }
    function updater(){
        var InpObjName = document.getElementById("add_user_name");
        var InpObjEmail = document.getElementById("add_user_email");
        var InpObjSurname = document.getElementById("add_user_surname");
        var InpObjActual = document.getElementById("add_user_actual");
        var InpObjId = document.getElementById("add_user_id");
        var name = InpObjName.value;
        var email = InpObjEmail.value;
        var surname = InpObjSurname.value;
        var actual = InpObjActual.value;
        var id = InpObjId.value;

        $.ajax({


            type:'POST',
            url:'/user_edit',
            data:{'_token':"{{csrf_token()}}",
                'name' : name,
                'email' : email,
                'actual' : actual,
                'id' : id,
                'surname': surname,


            },

            success: function(msg){

                $('#message_ajax').html(msg);
                location.reload(true);

            }

        });



    }
</script>