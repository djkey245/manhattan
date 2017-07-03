@extends('layouts.app')


@section('content')
    <table class="table table-bordered">
    @foreach($items as $item)



        <tr>

            <th>{{$item->name_ukr}} </th>

        </tr>
        <tr>
            <th>
                @if($item->type == 'select')
                    <select id="add_{{$item->name_eng}}">

                    </select>

                @elseif($item->type == 'textarea')

                    <textarea id="add_{{$item->name_eng}}"></textarea>

                    @else<input type="{{$item->type}}" id="add_{{$item->name_eng}}" min="{{$item->min}}" max="{{$item->max}}">
@endif
            </th>
        </tr>


















    @endforeach
    </table>






    @stop
    @foreach($items as $item)
                            @if($item->list_menu == 1)
                                @foreach($search as $id)
                                    @if($object->id == $id)
                                        <?php echo ' <th><a href=/list/'.$object->id.'>'.$object->{$item->name_eng}.'</a></th>'; ?>
                                    @endif

                                @endforeach
                            @endif

                        @endforeach