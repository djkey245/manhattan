
                <table class="table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <th><div align="left" class="col-md-10"> Ім’я(укр) </div>

                                <div class="col-md-2"><div align="right"><button onclick="cancel_hide('#page_add')" class="btn btn-danger btn-xs " id="button_cansel">X</button></div> </div>
                            </th>
                        </tr>
                        <tr>
                            <th><input type="text" id="name_ukr" class="form-control"></th>
                        </tr>
                        <tr>
                            <th>Ім’я(англ)</th>
                        </tr>
                        <tr>
                            <th><input type="text" id="name_eng" class="form-control"></th>
                        </tr>
                        <tr>
                            <th>Тип</th>
                        </tr>
                        <tr>
                            <th>
                                <select id="type" class="form-control">
                                    <option value="text">Текст</option>
                                    <option value="textarea">Довгий текст</option>
                                    <option value="number">Число</option>
                                    <option value="password">Пароль</option>
                                    <option value="select">Вибірка</option>
                                    <option value="date">Дата</option>
                                    <option value="email">E-mail</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Мінімум</th>
                        </tr>
                        <tr>
                            <th><input id="min" type="number" class="form-control"></th>
                        </tr>
                        <tr>
                            <th>Максимум</th>
                        </tr>
                        <tr>
                            <th><input id="max" type="number" class="form-control"></th>
                        </tr>
                        <tr>
                            <th>Опції англ(через ,)</th>
                        </tr>
                        <tr>
                            <th><textarea id="option" class="form-control"></textarea></th>
                        </tr>
                        <tr>
                            <th>Опції укр(через ,)</th>
                        </tr>
                        <tr>
                            <th><textarea id="option_name" class="form-control"></textarea></th>
                        </tr>
                        <tr>
                            <th>Активне</th>
                        </tr>
                        <tr>
                            <th>
                                <select id="active" class="form-control">
                                    <option value="1">Так</option>
                                    <option value="0">Ні</option>

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Важливе</th>
                        </tr>
                        <tr>
                            <th>
                                <select id="list_menu" class="form-control">
                                    <option value="1">Так</option>
                                    <option value="0">Ні</option>

                                </select>
                            </th>
                        </tr>

                        <tr>
                            <th>Порядок</th>
                        </tr>
                        <tr>
                            <th><input id="actual" type="number" class="form-control"></th>
                        </tr>
                        <tr>
                            <th>
                                <div class="btn-group">
                                <button class="btn btn-primary" onclick="add_item()">Додати</button>
                                <button class="btn btn-primary " onclick="cancel_hide('#page_add')">Відмінити</button>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
<script>
    function add_item() {


        var name_ukr = document.getElementById('name_ukr').value;
        var name_eng = document.getElementById('name_eng').value;
        var type = document.getElementById('type').value;
        var min = document.getElementById('min').value;
        var max = document.getElementById('max').value;
        var option = document.getElementById('option').value;
        var option_name = document.getElementById('option_name').value;
        var active = document.getElementById('active').value;
        var actual = document.getElementById('actual').value;
        var list_menu = document.getElementById('list_menu').value;
        alert(name_ukr);

        $.ajax(
            {   type: 'post',
                url: '/menu/add',
                data:{'_token':"{{csrf_token()}}",
                    'name_ukr': name_ukr,
                    'name_eng': name_eng,
                    'type': type,
                    'min': min,
                    'max': max,
                    'option': option,
                    'option_name': option_name,
                    'active': active,
                    'actual': actual,
                    'list_menu': list_menu
                },
                success: function(msg){

                location.reload(true);            }

            }
        );
    }














</script>

















