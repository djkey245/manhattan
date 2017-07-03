<?php
    $item;
    foreach ($items as $item){}

?>
<table class="table-bordered table">
    <tbody>
    <tr><input type="hidden" id="edit_id" value="{{$item->id}}">
        <th><div align="left" class="col-md-10"> Ім’я(укр) </div>

            <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#page_edit')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
        </th>
    </tr>
    <tr>
        <th><input type="text" id="edit_name_ukr" class="form-control" value="{{$item->name_ukr}}"></th>
    </tr>

    <tr>
        <th>Мінімум</th>
    </tr>
    <tr>
        <th><input id="edit_min" type="number" value="{{$item->min}}"  class="form-control"></th>
    </tr>
    <tr>
        <th>Максимум</th>
    </tr>
    <tr>
        <th><input id="edit_max" type="number" value="{{$item->max}}" class="form-control"></th>
    </tr>
    <tr>
        <th>Опції англ(через ,)</th>
    </tr>
    <tr>
        <th><textarea id="edit_option"  class="form-control">{{$item->option}}</textarea></th>
    </tr>
    <tr>
    <tr>
        <th>Опції укр(через ,)</th>
    </tr>
    <tr>
        <th><textarea id="edit_option_name"  class="form-control">{{$item->option_name}}</textarea></th>
    </tr>
    <tr>
        <th>Активне</th>
    </tr>
    <tr>
        <th>
            <select id="edit_active" class="form-control">
                @if($item->active == 1)
                <option value="1" selected>Так</option>
                <option value="0">Ні</option>
                @else
                    <option value="1" >Так</option>
                    <option value="0" selected>Ні</option>
                @endif
            </select>
        </th>
    </tr>
    <tr>
        <th>Важливe</th>
    </tr>
    <tr>
        <th>
            <select id="edit_list_menu" class="form-control">
                @if($item->list_menu == 1)
                    <option value="1" selected>Так</option>
                    <option value="0">Ні</option>
                @else
                    <option value="1" >Так</option>
                    <option value="0" selected>Ні</option>
                @endif
            </select>
        </th>
    </tr>
    <tr>
        <th>Порядок</th>
    </tr>
    <tr>
        <th><input value="{{$item->actual}}" id="edit_actual" type="number" class="form-control"></th>
    </tr>
    <tr>
        <th>
            <div class="btn-group">
                <button class="btn btn-primary" onclick="edit_item()">Редагувати</button>
                <button class="btn btn-primary " onclick="cancel_hide('#page_edit')">Відмінити</button>
            </div>
        </th>
    </tr>
    </tbody>
</table>
<script>
    function edit_item(){
    var id = document.getElementById('edit_id').value;
    var name_ukr = document.getElementById('edit_name_ukr').value;
    var min = document.getElementById('edit_min').value;
    var max = document.getElementById('edit_max').value;
    var option = document.getElementById('edit_option').value;
    var option_name = document.getElementById('edit_option_name').value;
    var active = document.getElementById('edit_active').value;
    var actual = document.getElementById('edit_actual').value;
    var list_menu = document.getElementById('edit_list_menu').value;
    $.ajax(
        {   type: 'post',
            url: '/menu/edit',
            data:{'_token':"{{csrf_token()}}",
                'id': id,
                'name_ukr': name_ukr,
                'min': min,
                'max': max,
                'option_name': option_name,
                'option': option,
                'active': active,
                'actual': actual,
                'list_menu': list_menu
            },
            success: function (msg) {
                location.reload(true);
            }

        }
    );
    }



</script>


</table>