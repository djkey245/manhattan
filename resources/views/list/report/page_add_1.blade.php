<script>

    var id_user =  document.getElementById('id_user').value;
    var date_up = document.getElementById('date_up').value;
    var date_down = document.getElementById('date_down').value;
    var office = document.getElementById('office').value;
    function next_add(){
        var cbx = document.getElementById("checkid").getElementsByTagName("input");
        var id_people = [];

        for (i=0; i < cbx.length; i++) {

            if (cbx[i].type == "checkbox" && cbx[i].checked) {
                id_people += cbx[i].value+',';

            }
        }

        var report = document.getElementById('report').value;

        $.ajax({
            type: 'post',
            url: '/report/report_add_next/'+ office,
            data:{
                '_token': "{{csrf_token()}}",
                'id_user': id_user,
                'date_up': date_up,
                'date_down': date_down,
                'office': office,
                'id_peoples': id_people,
                'report': report
            },
            dataType: 'html',
            success: function (message) {
                $("#add_report").html(message);

            }
        });

        }


   function submit(){

       var cbx = document.getElementById("checkid").getElementsByTagName("input");
       var id_people = "";

       for (i=0; i < cbx.length; i++) {

           if (cbx[i].type == "checkbox" && cbx[i].checked) {
               id_people += cbx[i].value+',';

           }
       }

       var report = document.getElementById('report').value;

       $.ajax({
           type: 'post',
           url: '/report/report_add',
           data:{
               '_token': "{{csrf_token()}}",
               'id_user': id_user,
               'date_up': date_up,
               'date_down': date_down,
               'office': office,
               'id_peoples': id_people,
               'report': report
           },
           success: function () {
               location.reload(true);
           }
       });
        }



</script>
<input type="hidden" id="id_user" value="{{Auth::user()->id}}">
<input type="hidden" id="date_up" value="{{$date_up}}">
<input type="hidden" id="date_down" value="{{$date_down}}">
<input type="hidden" id="office" value="{{$office}}">


<div class="container" id="add_report">
    <div class="row" style="margin-top: 2%">
        <div class="col-md-5"><label>Виконана робота:</label><textarea id="report"  rows="6" cols="55"></textarea>


            <div class="row">
                <center>
                    <button onclick="next_add()"  class="btn btn-default ">Додати пункт</button>
                    <button onclick="submit()"  class="btn btn-default ">Зберегти звіт</button>

                </center>

            </div>



        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3"><form name="forma" method="post" id="input" action="">
            <div >
                <input id="all" type="checkbox" value="all" onChange='for (i in this.form.elements) this.form.elements[i].checked = this.checked'>
                <label>Вибрати/зняти все </label>
            </div>
                <div id="checkid">
            @foreach($peoples as $people)

                <div>
                    <input id="id_people" type="checkbox" name="id_people[]" value="{{$people['id']}}" >
                    <label>{{$people['surname'].' '.$people['name'].' '.$people['profession']}} </label>

                </div>
            @endforeach</div></form></div>
        <div class="col-md-3">


        </div>
    </div>

</div>
