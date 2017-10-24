<div class="col-md-4">
    @foreach($importants as $key => $important)


        @foreach($peoples as $people)
            @if($important == $people->id)
            <a href="/list/{{$people->id}}">{{$people->surname.' '.$people->name}}</a>
                <br>
            @endif
        @endforeach
        @if($key >= 20 )
            @break
        @endif
    @endforeach
</div>
<div class="col-md-4">
    @foreach($importants as $key => $important)

        @if($key > 20)
            @foreach($peoples as $people)
                @if($important == $people->id)
                    <a href="/list/{{$people->id}}">{{$people->surname.' '.$people->name}}</a>
                    <br>
                @endif
            @endforeach
            @if($key > 40 )
                @break
            @endif
        @endif
    @endforeach
</div>
<div class="col-md-4">
    @foreach($importants as $key => $important)

        @if($key > 41)
            @foreach($peoples as $people)
                @if($important == $people->id)
                    <a href="/list/{{$people->id}}">{{$people->surname.' '.$people->name}}</a>
                    <br>
                @endif
            @endforeach
            @if($key > 61 )
                @break
            @endif
        @endif
    @endforeach
</div>
<button class="btn btn-primary" style="margin-top: 3%; margin-left: 3%;"   onclick="reload()">Назад</button>
