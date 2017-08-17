<script>

    function postjson() {
        alert('few');
        var req = {"jsonrpc":"2.0",
            "method":"apiinfo.version",
            "id":1,
            "auth":null,
            "params":{}};
        $.ajax({
            'type': 'post',
            'url': 'http://192.168.0.100/zabbix/api_jsonrpc.php',
            'contentType': 'application/json-rpc',
            'data': JSON.stringify(req),

                /*"jsonrpc":"2.0",
                "method":"user.login",
                "params":{
                    "user":"Dimon",
                    "password":"z1x2c3v4"
                },
                "id":1,
                "auth":null*/

            'success': function (mess) {
                alert(mess);
                //$('#answer').html(mess);
            },
            'error': function(error){
                alert(error);
                //$('#answer').html(error);
                }
        });


    }



</script>
<button onclick="postjson()" >Enter</button>
<div id="answer">

</div>