<table  class="table-contracts table-condensed contract-add">
    <tbody class="add" >
    <tr>
        <th>
            Name:
        </th>

        <td colspan="2">
            <input type="text" id="name" value="{{$contract['name']}}" class="form-control">
        </td>
    </tr>
    <tr>
        @if($contract['ppp0e'] == 1)
            <td>
                <label>ppp0e</label>
                <input type="radio" id="ppp0e" checked name="bool" class="">
            </td>
        @else
            <td>
                <label>ppp0e</label>
                <input type="radio" id="ppp0e" name="bool" class="">
            </td>
        @endif
            @if($contract['nat'] == 1)
                <td>
                    <label>NAT</label>
                    <input type="radio" checked id="nat" name="bool" class="">
                </td>
            @else
                <td>
                    <label>NAT</label>
                    <input type="radio" id="nat" name="bool" class="">
                </td>
            @endif
        @if($contract['mac'] == 1)
        <td>
            <label>MAC</label>
            <input type="radio" checked id="mac" name="bool" class="">
        </td>
            @else
                <td>
                    <label>MAC</label>
                    <input type="radio"  id="mac" name="bool" class="">
                </td>
        @endif
    </tr>

    <tr class="ppp-block">
        <th>
            <b>ppp0e:</b>
        </th>
        <td colspan="2">
            <input type="text" id="ppp0e-login" value="{{$contract['ppp0e_login']}}" class="form-control">
        </td>
    </tr>
    <tr class="ppp-block">
        <th>
            <b>pass:</b>
        </th>
        <td colspan="2">
            <input type="text" id="pass" value="{{$contract['pass']}}" class="form-control">
        </td>
    </tr>

    <tr class="nat-block">
        <th>
            NAT:
        </th>
        <td colspan="2">
            <input type="text" id="nat-login" value="{{$contract['nat_login']}}" class="form-control">
        </td>
    </tr>



    <tr>
        <th>
            MAC:
        </th>

        <td colspan="2">
            <input type="text" id="mac-address" value="{{$contract['mac_address']}}" class="form-control">
        </td>
    </tr>

    <tr>
        <th>
            IP:
        </th>

        <td colspan="2">
            <input type="text" id="ip" value="{{$contract['ip']}}" class="form-control">
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <button  class="btn btn-success" onclick="save()">Save</button>
        </td>
        <td>
            <button class="btn btn-primary" onclick="$('.add').hide()">Cancel</button>
        </td>
    </tr>
    </tbody>
</table>
<script>
    //Add-block(show and hide elements)
    var ppp0e = document.getElementById('ppp0e').onclick = function () {
        $(".ppp-block").show();
        $(".nat-block").hide();
    };
    var nat = document.getElementById('nat').onclick = function () {
        $(".ppp-block").hide();
        $(".nat-block").show();
    };
    var mac = document.getElementById('mac').onclick = function () {
        $(".ppp-block").hide();
        $(".nat-block").hide();
    };
    function save() {
        var id = {{$contract['id']}};
        var name = document.getElementById('name').value;
        var ppp0e = document.getElementById('ppp0e').valueOf().checked;
        var mac = document.getElementById('mac').valueOf().checked;
        var nat = document.getElementById('nat').valueOf().checked;
        if(ppp0e == true){
            ppp0e = 1;
        }
        else{
            ppp0e = 0;
        }
        if(mac == true){
            mac = 1;
        }
        else{
            mac = 0;
        }
        if(nat == true){
            nat = 1;
        }
        else{
            nat = 0;
        }
        var ppp0e_login = document.getElementById('ppp0e-login').value;
        var pass = document.getElementById('pass').value;
        var mac_address = document.getElementById('mac-address').value;
        var ip = document.getElementById('ip').value;
        var nat_login = document.getElementById('nat-login').value;
        $.ajax({

            type: "POST",
            url: "/contracts/save",
            data: {
                "_token" : "{{csrf_token()}}",
                id: id,
                name: name,
                ppp0e: ppp0e,
                mac: mac,
                nat: nat,
                ppp0e_login: ppp0e_login,
                pass: pass,
                mac_address: mac_address,
                ip: ip,
                nat_login: nat_login
            },
            success: function () {
                location.reload(true);
            }

        });
    }
</script>