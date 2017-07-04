
<table class="table table-bordered">
    <div id="message_ajax"></div>
    <tr>


        <th><div class="col-md-10"> Name: <span id="demo_name"></span><span id="demo_name_empty"></span></div>

            <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#add_user')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
        </th>

    </tr>
    <tr>
        <th>
            <input class="form-control" type="text" id="add_user_name" minlength="2" maxlength="15">
        </th>
    </tr>
    <tr>
        <th>
            Surname: <span id="demo_surname"></span><span id="demo_surname_empty"></span>
        </th>
    </tr>
    <tr>
        <th>
            <input class="form-control" type="text" id="add_user_surname" minlength="3" maxlength="20">
        </th>
    </tr>
    <tr>
        <th>
            Email: <span id="demo_email"></span><span id="demo_email_empty"></span>
        </th>
    </tr>

    <tr>
        <th>
            <input class="form-control" type="email" id="add_user_email" minlength="12" maxlength="35">
        </th>
    </tr>
    <tr>
        <th>
            Pass: <span id="demo_pass"></span><span id="demo_pass_empty"></span>
        </th>
    </tr>
    <tr>
        <th>
            <input class="form-control" type="password" id="add_user_pass" minlength="6" maxlength="18">
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
                <option value="1">HR</option>
                <option value="2">Admin</option>
                <option value="3">Special</option>
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <button onclick="submit_valid()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>

            <button onclick="cancel_hide('#add_user')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>
        </th>
    </tr>
</table>
<script>
    function submit_valid() {
        var InpObjName = document.getElementById("add_user_name");
        var InpObjSurname = document.getElementById("add_user_surname");
        var InpObjEmail = document.getElementById("add_user_email");
        var InpObjPass = document.getElementById("add_user_pass");
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
        if(InpObjPass.value == ""){
            $('#demo_pass_empty').html('<i>Enter Data</i>');
        }
        else{
            document.getElementById("demo_pass_empty").innerHTML = "";
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
        if (InpObjPass.checkValidity() == false) {
            document.getElementById("demo_pass").innerHTML = InpObjPass.validationMessage.fontcolor('red');
        }
        else{
            document.getElementById("demo_pass").innerHTML = "";

        }
        if(InpObjName.value != "" && InpObjEmail.value != "" && InpObjPass.value != "" && InpObjName.checkValidity() != false && InpObjEmail.checkValidity() != false &&InpObjPass.checkValidity() != false)
        {
            register();

        }


    }
    function register(){
        var InpObjName = document.getElementById("add_user_name");
        var InpObjSurname = document.getElementById("add_user_surname");
        var InpObjEmail = document.getElementById("add_user_email");
        var InpObjPass = document.getElementById("add_user_pass");
        var InpObjActual = document.getElementById("add_user_actual");
        var name = InpObjName.value;
        var surname = InpObjSurname.value;
        var email = InpObjEmail.value;
        var pass = InpObjPass.value;
        var actual = InpObjActual.value;
        var id_user  = <?php echo Auth::user()->id;?> ;

        $.ajax({


            type:'POST',
            url:'/user_add',
            data:{'_token':"{{csrf_token()}}",
                'name' : name,
                'surname': surname,
                'email' : email,
                'pass' : pass,
                'actual' : actual,
                'id_user': id_user


            },

            success: function(msg){

                $('#message_ajax').html(msg);
                location.reload(true);

            }

        });



    }
</script>