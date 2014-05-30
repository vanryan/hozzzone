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

        var defaultViewerJSON = {
            modules: {
                uid: 'app',
                name: 'app',
                children: [
                    {
                        uid: 'defaultItems',
                        name: 'defaultItems',
                        attrs: {
                            className: 'default'
                        },
                        data: {
                            createdAt: '20140515092039'
                        },
                        children: [
                            {
                                uid: 'item-1',
                                name: 'item',
                                attrs: {
                                    className: 'item'
                                },
                                children: [
                                    {
                                        uid: 'button-1',
                                        name: 'likeButton',
                                        likeId: '82942934294',
                                        attrs: {
                                            className: 'like'
                                        }
                                    }   
                                ],
                                data: {
                                    itemId: '239879342089304582304',
                                    author: 'Brian Long',
                                    time: '201405161129',
                                    like: '1548'
                                }
                            },
                            {
                                uid: 'item-2',
                                name: 'item',
                                attrs: {
                                    className: 'item'
                                },
                                data: {
                                    itemId: '304582304',
                                    author: 'B Long',
                                    time: '20105161129',
                                    like: '148'
                                },
                                children: [
                                    {
                                        uid: 'button-2',
                                        name: 'likeButton',
                                        likeId: '908203842042',
                                        attrs: {
                                            className: 'like'
                                        }
                                    }   
                                ]
                            },
                            {
                                uid: 'item-3',
                                name: 'item',
                                attrs: {
                                    className: 'item'
                                },
                                children: [
                                    {
                                        uid: 'button-3',
                                        name: 'likeButton',
                                        likeId: '294829304242',
                                        attrs: {
                                            className: 'like'
                                        }
                                    }   
                                ],
                                data: {
                                    itemId: '2398',
                                    author: 'Brian asdfasLong',
                                    time: '201405161129',
                                    like: '154'
                                }
                            }
                        ]
                    },
                    {
                        uid: 'rightBar',
                        name: 'rightBar',
                        children: [
                            {
                                uid: 'viewLayout',
                                name: 'viewLayout',
                                children: [
                                    {
                                        uid: 'layoutButton-1',
                                        name: 'layoutButton',
                                        data: {
                                            view: 'default'
                                        }
                                    },
                                    {
                                        uid: 'layoutButton-2',
                                        name: 'layoutButton',
                                        data: {
                                            view: 'square'
                                        }
                                    },
                                    {
                                        uid: 'layoutButton-3',
                                        name: 'layoutButton',
                                        data: {
                                            view: 'brick'
                                        }
                                    }
                                ]
                            },
                            {
                                uid: 'searchBox',
                                name: 'searchBox'
                            },
                            {
                                uid: 'addHoz',
                                name: 'addHoz',
                                data: {
                                        
                                } 
                            }
                        ] 
                    },
                    {
                        uid: 'nav',
                        name: 'Navigate',
                        children: [
                        ]
                    }
                ]
            }
        };
            

    
        H.init(defaultViewerJSON);
        
    </script>
@stop
