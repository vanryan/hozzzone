@extends('base')

@section('title')
square
@stop

@section('nav')
    @include('layouts.nav_index')
@stop

@section('rightBar')
    @include('layouts.rightbar_index')
@stop


@section('content')
    <ul class="square" id="squareItems">
    @include('layouts.squareItem', array('items' => $items))
    </ul>
@stop

@section('js')
    <script>

        var squareViewerJSON = {

        };
    
        H.init(squareViewerJSON);
        
    </script>
@stop
