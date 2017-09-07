@extends('layouts.app')


@section('content')
    <?php
        $date = "";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="text-align: center">{{$users1['0']->name.' '.$users1['0']->surname.' '.$users1['0']->email }}</h4>
                @if(Auth::user()->id == 17)

                    <div class="form-inline" style="width: 100%; display: inline-block" >
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="user" value="{{Auth::user()->id}}">
                        <input class="input-sm input-group"  type="text" id="time">
                        <textarea class="form-control input-group" id="comment"></textarea>
                        <button class="input-group btn" onclick="save_test()">Enter</button>

                    </div>


                @endif
                <table style="width: 100%">
                    <tbody style="width: 100%">
                        @foreach($tests as $test)
                            @if($test->id_user == 17)
                                @if($date == $test->date)
                                    <tr>
                                        <td style="width: 20%">{{$test->time}} </td>
                                        <td style="width: 80%">{{$test->comment}}</td>
                                    </tr>
                                @else

                                    <tr style="width: 100%"> <th style=" text-align: center" colspan="2">{{$test->date}}</th></tr>
                                    <tr style="width: 100%">
                                        <td style="width: 20%; text-align: left">{{$test->time}}</td>
                                        <td style="width: 80%; text-align: left">{{$test->comment}}</td>
                                    </tr>
                                @endif

                                <?php
                                $date = $test->date;
                                ?>


                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">

                <h4 style="text-align: center">{{$users2['0']->name.' '.$users2['0']->surname.' '.$users2['0']->email }}</h4>
                @if(Auth::user()->id == 27)

                    <div class="form-inline" style="width: 100%; display: inline-block" >
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="user" value="{{Auth::user()->id}}">
                        <input class="input-sm input-group"  type="text" id="time">
                        <textarea class="form-control input-group" id="comment"></textarea>
                        <button class="input-group btn" onclick="save_test()">Enter</button>

                    </div>


                @endif

                <table style="width: 100%">
                    <tbody style="width: 100%">
                    <?php
                    $date = "";
                    ?>
                    @foreach($tests as $test)
                        @if($test->id_user == 27)
                            @if($date == $test->date)
                                <tr>
                                    <td style="width: 20%">{{$test->time}} </td>
                                    <td style="width: 80%">{{$test->comment}}</td>
                                </tr>
                            @else

                                <tr style="width: 100%"> <th style=" text-align: center" colspan="2">{{$test->date}}</th></tr>
                                <tr style="width: 100%">
                                    <td style="width: 20%; text-align: left">{{$test->time}}</td>
                                    <td style="width: 80%; text-align: left">{{$test->comment}}</td>
                                </tr>
                            @endif

                            <?php
                            $date = $test->date;
                            ?>


                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<script>
    function save_test() {

        var user = {{Auth::user()->id}};
        var comment = document.getElementById('comment').value;
        var time = document.getElementById('time').value;

        $.ajax({

            type: 'post',
            url: '/admin',
            data:{
                '_token': "{{csrf_token()}}",
                'user': user,
                'comment': comment,
                'time': time
            },
            success: function () {
                location.reload(true);
            }

        });

    }

</script>










    @stop