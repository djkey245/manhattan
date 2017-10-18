@extends('layouts.app')


@section('content')


    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-9">
                <table class="table-contracts table-condensed">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>IP</th>
                        <th>MAC</th>
                        <th>ppp0e</th>
                        <th>Pass</th>
                        <th>NAT</th>
                        <th>Type</th>
                        <th><button  class="btn btn-success" onclick="$('.add').show();">Add</button></th>
                    </thead>
                    <tbody id="">

                            @foreach($contracts as $contract)
                                <tr class="table-contracts-tr">
                                    <td id="t_id">                                  <div id="t_id1">{{$contract->id}}</div></td>
                                    <td id="t_name" ondblclick="edit(this);">       <div id="t_name1">{{$contract->name}}</div></td>
                                    <td id="t_ip" ondblclick="edit(this);">          <div id="t_ip1">{{$contract->ip}}</div></td>
                                    <td id="t_mac_address" ondblclick="edit(this);"> <div id="t_mac_address1">{{$contract->mac_address}}</div></td>
                                    <td id="t_ppp0e_login" ondblclick="edit(this);">  <div id="t_ppp0e_login1">{{$contract->ppp0e_login}}</div></td>
                                    <td id="t_pass" ondblclick="edit(this);">         <div id="t_pass1">{{$contract->pass}}</div></td>
                                    <td id="t_nat_login" ondblclick="edit(this);">    <div id="t_nat_login1">{{$contract->nat_login}}</div></td>
                                    <td id="t_type"> @if($contract->ppp0e == 1)
                                                        ppp0e
                                                         @elseif($contract->nat == 1)
                                                            nat
                                                         @elseif($contract->mac == 1)
                                                            mac
                                                         @endif
                                    </td>
                                    <td>
                                        <button  class="btn btn-primary" onclick="edit({{$contract->id}})">Edit</button>
                                        <button  class="btn btn-danger" onclick="del({{$contract->id}})">Del</button>
                                    </td>
                                </tr>
                                @endforeach


                    </tbody>


                </table>


            </div>
            <div class="col-md-3" id="edit">
                <table  class="table-contracts table-condensed contract-add">
                    <tbody class="add" style="display: none;">
                        <tr>
                            <th>
                                Name:
                            </th>

                            <td colspan="2">
                                <input type="text" id="name" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="ppp0e">ppp0e</label>
                                <input type="radio" id="ppp0e" name="bool" class="">
                            </td>
                            <td>
                                <label>NAT</label>
                                <input type="radio" id="nat" name="bool" class="">
                            </td>

                            <td>
                                <label>MAC</label>
                                <input type="radio" checked id="mac" name="bool" class="">
                            </td>
                        </tr>

                         <tr class="ppp-block">
                            <th>
                                <b>ppp0e:</b>
                            </th>
                             <td colspan="2">
                                <input type="text" id="ppp0e-login" class="form-control">
                            </td>
                        </tr>
                        <tr class="ppp-block">
                            <th>
                                <b>pass:</b>
                            </th>
                            <td colspan="2">
                                <input type="text" id="pass" class="form-control">
                            </td>
                        </tr>

                        <tr class="nat-block">
                            <th>
                                NAT:
                            </th>
                            <td colspan="2">
                                <input type="text" id="nat-login" class="form-control">
                            </td>
                        </tr>



                        <tr>
                            <th>
                                MAC:
                            </th>

                                <td colspan="2">
                                    <input type="text" id="mac-address" class="form-control">
                                </td>
                            </tr>

                        <tr>
                            <th>
                                IP:
                            </th>

                            <td colspan="2">
                                <input type="text" id="ip" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <button  class="btn btn-success" onclick="add()">Add</button>
                            </td>
                            <td>
                                <button class="btn btn-primary" onclick="$('.add').hide()">Cancel</button>
                            </td>
                        </tr>

                </table>

            </div>
        </div>
    </div>


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
        $(".add").hide();
    //Edit-block(refactoring in input td-blocks)

        /*var i_id = document.getElementById("i_id") ;
        var i_name = document.getElementById("i_name").ondblclick = function () {
        $("#i_name").html('<input class="form-edit" type="text" id="e_name">'); };
        var i_ip = document.getElementById("i_ip").ondblclick = function () {
            $("#i_ip").html('<input class="form-edit" type="text" id="e_ip">');};
        var i_mac_address = document.getElementById("i_mac_address").ondblclick = function () {
        $("#i_mac_address").html('<input class="form-edit" type="text" id="e_mac_address">');};
        var i_ppp0e_login = document.getElementById("i_ppp0e_login").ondblclick = function () {
            $("#i_ppp0e_login").html('<input class="form-edit" type="text" id="e_ppp0e_login">');};
        var i_pass = document.getElementById("i_pass").ondblclick = function () {
            $("#i_pass").html('<input class="form-edit" type="text" id="e_pass">');};
        var i_nat_login = document.getElementById("i_nat_login").ondblclick = function () {
            $("#i_nat_login").html('<input class="form-edit" type="text" id="i_nat_login">');};
        var i_type = document.getElementById("i_type");*/
        function edit(id) {
            $.ajax({
                type: "POST",
                url: "/contracts/edit/"+id,
                data:{'_token':"{{csrf_token()}}"},
                dataType: 'html',
                success: function (msg) {
                    $(".add").show();

                    $("#edit").html(msg);

                }
            });

        }
    function del(id) {
        if (confirm("Ви впевнені?") == true) {
            $.ajax({

                type: "POST",
                url: "/contracts/del/" + id,
                data: {"_token": "{{csrf_token()}}"},
                success: function () {
                    location.reload(true);
                }

            });
        }else {
            return 0;
        }
    }
    function add(){
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
            url: "/contracts/add",
            data: {
                "_token" : "{{csrf_token()}}",
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














@stop