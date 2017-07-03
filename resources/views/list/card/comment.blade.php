<table class="table-bordered table">
    <tbody>
    <tr>
        <td>Коментар:</td>
    </tr>
    <tr>
        <td><input type="text" class="form-control" id="comment"></td>
    </tr>
    <tr>
        <td>Оцінка:</td>
    </tr>
    <tr>
        <td><select id="mark" class="form-control">
                <option value="2">Крас</option>
                <option value="1">Добр</option>
                <option value="0" selected>Норм</option>
                <option value="-1">Лаж</option>
                <option value="-2">Козл</option>
            </select></td>
    </tr>
    <tr>
        <td>
            <button class="btn btn-default" onclick="comment_add()">Зберегти</button>
        </td>
    </tr>
    </tbody>
</table>
<script>


    function comment_add(){
        var comment = document.getElementById('comment').value;
        var mark = document.getElementById('mark').value;

        var id_user = <?php echo Auth::user()->id;?> ;
        var id_people = <?php echo $id; ?> ;
        $.ajax({

            method: 'post',
            url: '/card/comment_add',
            data: {
                '_token': "{{csrf_token()}}",
                'comment': comment,
                'mark': mark,
                'id_user': id_user,
                'id_people': id_people
            },
            success: function (msg) {
                location.reload(true);
            }



        });

    }


</script>