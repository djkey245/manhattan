<div id="docPopup" style="background-color: #343434; width: 40%; border-radius: 10px; border: 2px solid #3163a7; position: absolute; left: 10%; top: 10%; z-index: 101;">
    <div class="container">
        <div style="cursor: pointer; background-color: red; padding: 5px; color: black; border-radius: 15px; width: 28px; text-align: center; position: absolute; right: 5px; top: 5px;" onclick="$('#docPopup').remove();">x</div>
        <div class="row" style="padding: 20px 20px">
            <button onclick="addDoc()" class="btn btn-primary">Back</button>
            <br>
            <br>
            @foreach($docs as $doc)

                <p>
                    <a style="cursor: pointer" onclick="accept({{$doc->id}})">{{$doc->title}}</a>
                </p>


                @endforeach
        </div>
    </div>
</div>
<script>
    function accept(id) {
        document.getElementById('doc'+openDoc).value = id;
        $('#docPopup').remove();

    }
    function addDoc(){
        $.ajax({
            type:'post',
            url: '/reports-show-doc',
            data:{'_token':"{{csrf_token()}}"},
            dataType: 'html',
            success: function (message) {


                $('#popup').html(message);

            }
        });
    }
</script>