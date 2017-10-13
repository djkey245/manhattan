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
                        <th colspan="2">Type</th>
                        <th><button  class="btn btn-success" onclick="$('.add').show();">Add</button></th>
                    </thead>
                    <tbody>

                            @foreach($contracts as $contract)
                                <tr class="table-contracts-tr">
                                    <td id="t_id">                                  <div id="t_id1">{{$contract->id}}</div></td>
                                    <td id="t_name" ondblclick="edit(this);">       <div id="t_name1">{{$contract->name}}</div></td>
                                    <td id="t_ip" ondblclick="edit(this);">          <div id="t_ip1">{{$contract->ip}}</div></td>
                                    <td id="t_mac_address" ondblclick="edit(this);"> <div id="t_mac_address1">{{$contract->mac_address}}</div></td>
                                    <td id="t_ppp0e_login" ondblclick="edit(this);">  <div id="t_ppp0e_login1">{{$contract->ppp0e_login}}</div></td>
                                    <td id="t_pass" ondblclick="edit(this);">         <div id="t_pass1">{{$contract->pass}}</div></td>
                                    <td id="t_nat_login" ondblclick="edit(this);">    <div id="t_nat_login1">{{$contract->nat_login}}</div></td>
                                    <td id="t_type" colspan="2"></td>
                                    <td>
                                        <button  class="btn btn-primary">Edit</button>
                                        <button  class="btn btn-danger">Del</button>
                                    </td>
                                </tr>
                                @endforeach


                    </tbody>


                </table>


            </div>
            <div class="col-md-3">
                <table  class="table-contracts table-condensed contract-add">
                    <tbody class="add">
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
                                <input type="text" name="pass" class="form-control">
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
            //alert($(id).text());
            $(id).append('<form onsubmit="editing()"> <input class="form-edit" value="'+$(id).text()+'" type="text" id="edi'+id.id+'" ></form> ');
            $('#'+id.id+'1').hide();
        }



</script>














@stop