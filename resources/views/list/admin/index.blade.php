@extends('layouts.app')


@section('content')
    <script type="text/css">
        input{
            color: black !important;
        }
    </script>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-xs-1">Час</div>
            <div class="col-xs-2">Дата</div>
            <div class="col-xs-2">Суть роботи</div>
            <div class="col-xs-2">Тип роботи</div>
            <div class="col-xs-3">Кроки виконання</div>
            <div class="col-xs-2" align="center"> Відправити </div>
        </div>
            <div class="row-fluid">
                <div class="col-xs-1"><input type="text" id="time" class="form-control "></div>
                <div class="col-xs-2"><input type="date" id="date" class="form-control "></div>

                <div class="col-xs-2"><input type="text" id="title"  class="form-control "></div>

                <div class="col-xs-2"><select id="type"  class="form-control ">
                        <option value="OTRS">OTRS</option>
                        <option value="Zabbix">Zabbix</option>
                        <option value="GLPI">GLPI</option>
                        <option value="Завдання Тараса">Завдання Тараса</option>
                    </select></div>

                <div class="col-xs-3" id="points">
                    <div class="row" id="point">
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="points[]">
                        </div>
                        <div class="col-xs-1">
                            <button onclick="add_point()" class="btn btn-success">+</button><br>
                        </div>
                        <div class="col-xs-3">
                            <button  class="btn btn-primary">Документація</button>
                        </div>
                    </div>
                </div>



                <div class="col-xs-2" align="center"><button class="btn btn-success" onclick="save()">ОК</button></div>
            </div>
    </div>
{{--{{dd($tests['0']->points)}}--}}
    <br>
    <div class="container-fluid">
            <div class="row">
                <div class="col-xs-1">Час</div>
                <div class="col-xs-2">Суть роботи</div>
                <div class="col-xs-2">Тип роботи</div>
                <div class="col-xs-7">Кроки виконання</div>
            </div>
        {{--{{dd($tests)}}--}}
        <?php $date = 0;?>
        @foreach($tests as $test)
            @if($date !== $test->date)
                <br>
                <br>
                <hr>
                <b>{{$test->date}}</b>

                    @else
            @endif
        <?php $date = $test->date;?>
                <div class="row">
                    <div class="col-xs-1">{{$test->time}}</div>
                    <div class="col-xs-2">{{$test->title}}</div>
                    <div class="col-xs-2">{{$test->type}}</div>
                    <div class="col-xs-7">
                        @foreach($test->points as $point)
                            <li>{{$point->text}}</li>
                            @endforeach
                    </div>
                </div>
            <br>

            @endforeach

    </div>



    <script>
        function save() {
            var type = document.getElementById('type').value;
            var time = document.getElementById('time').value;
            var title = document.getElementById('title').value;
            var date = document.getElementById('date').value;
            var points_name = document.getElementsByName('points[]');
            var points = [];
            for(var i = 0;i<point;i++) {
                points[i] = points_name[i].value;
//                alert(points_name[i].value);
            }
                $.ajax({
                type: 'post',
                url: '/reportsAdm',
                data: {
                    '_token': "{{csrf_token()}}",
                    'type': type,
                    'time': time,
                    'title': title,
                    'date': date,
                    'points': points
                },
                success: function (msg) {
//                    $('#points').append(msg);
                    location.reload();
                }

            });
        }

        function add_point() {
            point++;
            $('#points').append(
                '<div class="row" id="point_'+point+'"><br>'+
                    '<div class="col-xs-8">'+
                        '<input type="text" class="form-control" name="points[]">'+
                    '</div>'+
                    '<div class="col-xs-1">'+
                        '<button class="btn btn-danger" onclick="remove_point('+point+')">-</button>'+
                    '</div>'+
                    '<div class="col-xs-3">'+
                        '<button  class="btn btn-primary">Документація</button>'+
                    '</div>'+
                '</div>');
        }

        function remove_point(n) {
            $('#point_'+n).remove();
            point--;
        }

        var point = 1;
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth()+1);
        var day = now.getDate();
        var date = ""+year+"-0"+month+"-"+day+"";
        date = date.toString();
        document.getElementById('date').value = date;

    </script>










    @stop