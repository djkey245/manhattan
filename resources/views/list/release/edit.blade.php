@if (Auth::guest())
@else
@foreach($release as $rel)

    <table class="table table-condensed table-bordered ">
        <input type="hidden" id="id" value="{{$rel->id}}">
        @if(Auth::user()->actual == 2)
        <tr>
            <th><div class="col-md-10">  Підтвердження Адміна </div>

                <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#release_edit')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
            </th>
        </tr>
        <tr>
            <th>
                <select class="form-control" id="admin">
                    @if($rel->admin == 0)
                    <option value="0" selected>Не підтверджено</option>
                    <option value="1">Підтверджено</option>
                    @else
                        <option value="0" >Не підтверджено</option>
                        <option value="1" selected>Підтверджено</option>
                    @endif
                </select>
            </th>
        </tr>
            <input type="hidden" id="chief" value="{{$rel->chief}}">

        @endif
        @if(Auth::user()->actual == 3)

            <tr>
            <th>   Підтвердження Директора

                 </th>
        </tr>
        <tr>
            <th>
                <select class="form-control" id="chief">
                    @if($rel->chief === 0)
                        <option value="0" selected>Не підтверджено</option>
                        <option value="1">Підтверджено</option>
                    @else
                        <option value="0" >Не підтверджено</option>
                        <option value="1" selected>Підтверджено</option>
                    @endif
                </select>
            </th>
        </tr>
            <input type="hidden" id="admin" value="{{$rel->admin}}">

        @endif
        @if(Auth::user()->id == $rel->id_user)
            <tr>
                <th>Причина<span id="reason1"></span><span id="reason2"></span> </th>
            </tr>
            <tr>
                <th>
                    <textarea class="form-control" id="reason" minlength="15">{{$rel->reason}} </textarea>
                </th>
            </tr>
            @elseif(Auth::user()->actual != 2)
                <input type="hidden" id="admin" value="{{$rel->admin}}">
                <input type="hidden" id="reason" value="{{$rel->reason}}">

            @elseif(Auth::user()->actual != 3)
                    <input type="hidden" id="chief" value="{{$rel->chief}}">
                    <input type="hidden" id="reason" value="{{$rel->reason}}">

            @else

            <input type="hidden" id="reason" value="{{$rel->reason}}">
            @endif


        <tr>
            <th>
                @if(Auth::user()->id == $rel->id_user or Auth::user()->actual == 3 or Auth::user()->actual == 2)
                    <button onclick="updater()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>
                @endif
                <button onclick="cancel_hide('#release_edit')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button></th>
        </tr>
    </table>
    @endforeach
<script>

    function updater(){
        var InpObjId = document.getElementById("id");
        var InpObjAdmin = document.getElementById("admin");
        var InpObjChief = document.getElementById("chief");
        var InpObjReason = document.getElementById("reason");


        var id = InpObjId.value;
        var admin = InpObjAdmin.value;
        var chief = InpObjChief.value;
        var reason = InpObjReason.value;
        $.ajax({


            type:'POST',
            url:'/upload/release_edit_reg',
            data:{'_token':"{{csrf_token()}}",
                'id' : id,
                'reason': reason,
                'chief' : chief,
                'admin' : admin,


            },

            success: function(msg){

                location.reload(true);

            }

        });



    }
</script>
    @endif