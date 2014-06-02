@extends('base')

@section('title')
square
@stop

@section('nav')
    @include('layouts.nav_index')
@stop

@section('rightBar')
    @include('layouts.rightbar_index', array('viewer' => $viewer))
@stop


@section('content')
    <ul class="square" id="squareItems">
    @include('layouts.squareItems', array('items' => $items))
    </ul>
@stop

@section('js')
    <script>

        var squareViewerJSON = {{ $initJSON }};
    
        H.init(squareViewerJSON);
        
    </script>
@stop
