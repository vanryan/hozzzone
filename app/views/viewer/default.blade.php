// items
//   -> avatar
//   -> img
//   -> subItems
//   -> hit
//   -> title

// initJSON



@extends('base')

@section('title')
default
@stop

@section('nav')
    @include('layouts.nav_index')
@stop

@section('rightBar')
    @include('layouts.rightbar_index')
@stop


@section('content')
    <ul class="default" id="defaultItems">
    @include('layouts.defaultItem', array('items' => $items))
    </ul>
@stop

@section('js')
    <script>

        var defaultViewerJSON = {{ $initJSON }};            
        H.init(defaultViewerJSON);
        
    </script>
@stop
