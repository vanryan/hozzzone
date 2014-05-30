@extends('base')

@section('title')
brick
@stop

@section('nav')
    @include('layouts.nav_index')
@stop

@section('rightBar')
    @include('layouts.rightbar_index')
@stop


@section('content')
    <ul class="brick" id="brickItems">
    @include('layouts.brickItem', array('items' => $items))
    </ul>
@stop

@section('js')
    <script>

        var brickViewerJSON = {

        };
    
        H.init(brickViewerJSON);
        
    </script>
@stop
