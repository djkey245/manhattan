<div id="vrtPopup" style="background-color: #343434; width: 40%; border-radius: 10px; border: 2px solid #3163a7; position: absolute; left: 10%; top: 10%; z-index: 101;">
    <div class="container">
        <div style="cursor: pointer; background-color: red; padding: 5px; color: black; border-radius: 15px; width: 28px; text-align: center; position: absolute; right: 5px; top: 5px;" onclick="$('#vrtPopup').remove();">x</div>
        <div class="row" style="padding: 20px 20px">
            <br>
            <br>
            {{--{{dd($servers)}}--}}
            @foreach($servers as $server)

                <p>
                    <a style="cursor: pointer" onclick="showVRT({{$server->id}})">{{$server->name}} type: {{$server->purpose}}</a>
                </p>
                <br>

            @endforeach
        </div>
    </div>
</div>
<script>
    function showVRT(id) {
        $.ajax({
            type:'post',
            url: '/reports-show-vrt/'+id,
            data:{'_token':"{{csrf_token()}}"},
            dataType: 'html',
            success: function (message) {


                $('#popup').html(message);

            }
        });
    }
</script>