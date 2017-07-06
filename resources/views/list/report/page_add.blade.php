<script>
    function next_page() {
        var office = document.getElementById('office').value;
        var date_up = document.getElementById('date_up').value;
        var date_down = document.getElementById('date_down').value;
        $.ajax({

         type: 'post',
         url: '/report/add_page/'+ office,
         dataType: 'html',
         data:{
         '_token': "{{csrf_token()}}" ,
         'date_up': date_up,
         'date_down': date_down
         },
         success: function (message) {
         $("#add_report").html(message);
             //location.reload(true);

         }



         });


    }



</script><div class="container">
    <div class="row " style="margin-top: 2%">
        <div class="col-md-3">
            <select id="office" name="office" class="form-control">
                <option value="Луцьк">Луцьк</option>
                <option value="Тернопіль">Тернопіль</option>
                <option value="Івано-Франківськ">Івано-Франківськ</option>
                <option value="Чернівці">Чернівці</option>
                <option value="Вінниця">Вінниця</option>
                <option value="Черкаси">Черкаси</option>
                <option value="Чернігів">Чернігів</option>
                <option value="Полтава">Полтава</option>
            </select>
        </div>
        <div class="col-md-3 form-inline"><label style="padding-left: 10%">з   </label> <input type="date" id="date_up" class="form-control form-inline" title="mm/dd/yyyy">
            <script>
                document.getElementById('date_up').valueAsDate = new Date();
            </script></div>
        <div class="col-md-3 form-inline"> <label>по</label> <input type="date" id="date_down" class="form-control" title="mm/dd/yyyy">
            <script>
                document.getElementById('date_down').valueAsDate = new Date();
            </script></div>
        <div class="col-md-3">
            <button onclick="next_page()" style="width: 100%;" class="btn btn-default ">Далі...</button>
        </div>

    </div>
</div>
