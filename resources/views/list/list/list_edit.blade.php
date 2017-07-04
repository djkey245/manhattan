<?php
$people;
foreach ($peoples as $people){

}


?>
<?php $mas = array(); ?>
<table class="table-bordered table">
<input type="hidden" value="{{$people->id}}" id="add_id">
    <tbody>
    @foreach($menuses as $item)
        @if($item->actual < 49 )
            @if(Auth::user())
                @if($item->type != 'button')
                    <tr>
                        <th><b>{{$item->name_ukr}}</b></th>

                    </tr>
                @endif
                <tr>
                    <th>

                        @if($item->type == 'text' or $item->type == 'number' or $item->type == 'email' or $item->type == 'password' or $item->type == 'date')
                            <input type="{{$item->type}}" class="form-control" id="add_{{$item->name_eng}}" value="{{$people[$item->name_eng]}}" maxlength="{{$item->max}}" minlength="{{$item->min}}" >
                        @elseif($item->type == 'textarea')


                                    <textarea minlength="{{$item->min}}"  maxlength="{{$item->max}}" id="add_{{$item->name_eng}}" class="form-control">{{$people[$item->name_eng]}}</textarea>



                        @elseif($item->type == 'select')
                            <select class="form-control" id="add_{{$item->name_eng}}">
                                <?php $option = explode( ',',$item->option);
                                $option_name = explode(',' ,$item->option_name);
                                $a = count($option);
                                ?>
                                @for($i = 0; $i<$a; $i++)
                                    @if($people->{$item->name_eng} == $option_name[$i])
                                    <option value="{{$option_name[$i]}}" selected>{{$option_name[$i]}}</option>
                                        @else
                                    <option value="{{$option_name[$i]}}">{{$option_name[$i]}}</option>
                                    @endif
                                @endfor
                            </select>
                        @endif
                    </th>
                </tr>
            @endif
            <?php array_push($mas,$item->name_eng) ; ?>


        @elseif($item->actual > 49)
            @if(Auth::user()->actual == 2)

                @if($item->type != 'button')
                    <tr>
                        <th><b>{{$item->name_ukr}}</b></th>
                    </tr>
                @endif

                @if($item->type == 'text' or $item->type == 'number' or $item->type == 'email' or $item->type == 'password' or $item->type == 'date')
                    <tr>
                        <th><input type="{{$item->type}}" class="form-control" id="add_{{$item->name_eng}}" maxlength="{{$item->max}}" minlength="{{$item->min}}" ></th></tr>
                @elseif($item->type == 'textarea')
                    <tr>
                        <th><textarea minlength="{{$item->min}}"  maxlength="{{$item->max}}" id="add_{{$item->name_eng}}" class="form-control"></textarea></th></tr>
                @elseif($item->type == 'select')
                    <tr>
                        <th> <select class="form-control" id="add_{{$item->name_eng}}">
                                <?php $option = explode( ',',$item->option);
                                $option_name = explode(',' ,$item->option_name);
                                $a = count($option);
                                ?>
                                @for($i = 0; $i<$a; $i++)
                                    @if($people->{$item->name_eng} == $option_name[$i])
                                        <option value="{{$option_name[$i]}}" selected>{{$option_name[$i]}}</option>
                                    @else
                                        <option value="{{$option_name[$i]}}">{{$option_name[$i]}}</option>
                                    @endif
                                @endfor
                            </select></th></tr>
                @endif
                <?php array_push($mas,$item->name_eng) ; ?>
            @endif


        @endif
    @endforeach
    <tr><th>
            <button onclick="updater()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>
            <button onclick="cancel_hide('#list')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>
        </th></tr>
    </tbody>

</table>
<?php $add = json_encode($mas);?>
<script>
    var mas = <?php  echo $add; ?>;

    var len = mas.length;

    var id = document.getElementById('add_id').value;
    var id_user = <?php echo Auth::user()->id; ?>;
    var a = [];
    function updater() {
        for(var i = 0; i < len; i++){
            a[i] = [document.getElementById('add_'+mas[i]).value];

        }

        $.ajax({
            type: 'post',
            url: '/upload/list_edit_edit',
            data: {
                '_token': "{{csrf_token()}}",
                'val': a,
                'keys': mas,
                'id': id,
                'id_user': id_user
            },
            success: function (msg) {

                location.reload(true);

            }



        });







    }




</script>






