<script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>
<div class="container" style="z-index: 100; background-color: gray; position: absolute; left: 10%; top: 10%;">
    <div class="row">
        <div class="position-ref full-height">
            <div class="content" style="text-align: center">
                <form action=" {{ route('article.store') }} " method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="documentationCategory_id" value="{{$id}}">
                    <label for="title">Заголовок</label><br />
                    <input type="text" name="title" class="form-control" id="title"><br />
                    <label for="text">Текст</label><br />

                    <textarea name="text" id="chizi1"></textarea>
                    <script>
                        var editor = CKEDITOR.replace( 'chizi1',
                            {
                                filebrowserBrowseUrl: '/elfinder/ckeditor',
                                language: 'en-us'
                            }
                        );
                    </script>
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>
<script>



    function sendFile(file, el) {
        var  data = new FormData();
        data.append("file", file);
        var url = '{{ route('article.upload-file') }}';
        $.ajax({
            data: data,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            success: function(url2) {
                el.summernote('insertImage', url2);
            }
        });
    }

</script>












