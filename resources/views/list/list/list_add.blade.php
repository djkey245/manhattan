
<?php $mas = array(); ?>
<table class="table-bordered table">

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
                                    <input type="{{$item->type}}" class="form-control" id="add_{{$item->name_eng}}" maxlength="{{$item->max}}" minlength="{{$item->min}}" >
                                @elseif($item->type == 'textarea')
                                    <textarea minlength="{{$item->min}}"  maxlength="{{$item->max}}" id="add_{{$item->name_eng}}" class="form-control"></textarea>
                                @elseif($item->type == 'select')
                                    <select class="form-control" id="add_{{$item->name_eng}}">
                                        <?php $options = explode( ',',$item->option);
                                        $options_name = explode(',' ,$item->option_name);
                                        $a = count($options);
                                        ?>
                                        @for($i = 0; $i<$a; $i++)

                                            <option value="{{$options_name[$i]}}">{{$options_name[$i]}}</option>

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
                                                <?php $options = explode( ',',$item->option);
                                                $options_name = explode(',' ,$item->option_name);
                                                $a = count($options);
                                                ?>
                                                @for($i = 0; $i<$a; $i++)

                                                    <option value="{{$options_name[$i]}}">{{$options_name[$i]}}</option>

                                                @endfor
                                            </select></th></tr>
                                @endif
                    <?php array_push($mas,$item->name_eng) ; ?>

                    @endif

                @endif
                @endforeach
        <tr><th>

                <button onclick="register()" class="btn btn-primary btn-sm" id="button_add_user">OK</button>
        <button onclick="cancel_hide('#list')" class="btn btn-primary btn-sm" id="button_cansel">Cancel</button>
            </th></tr>
    </tbody>

</table>
<?php $add = json_encode($mas);?>
<script>
    var mas = <?php  echo $add; ?>;
    var len = mas.length;
    var id_user = <?php echo Auth::user()->id; ?>;

    var a = [];
        function register() {
    for(var i = 0; i < len; i++){
        a[i] = [document.getElementById('add_'+mas[i]).value];

    }

        $.ajax({
         type: 'post',
         url: '/upload/list_add_reg',
         data: {
         '_token': "{{csrf_token()}}",
            'val': a,
            'keys': mas,
             'id_user': id_user
         },
         success: function (msg) {

             location.reload(true);

         }



         });







    }
    
    
    
    
</script>






