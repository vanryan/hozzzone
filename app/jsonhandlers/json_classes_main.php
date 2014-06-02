<?php

/*
    <Major parts of the ending json objects
    */

class hoz_json_modules_init {
    // Creating the modules -- the necessary object in all backbone jsons
    public $uid, $name, $children;

    public function __construct( $name, $intention, $genre ) {
        $this->uid = $name;
        $this->name = $name;

        if ( $intention == 'defaultItems' || $intention == 'brickItems' || $intention == 'squareItems' ) {
            // Init JSON modules for Views
            $object1 = hoz_json_unit_factory::factory( $intention );
            //var_dump($object1);exit();
            $object2 = hoz_json_unit_factory::factory( 'rightbar' );
            //var_dump($object2);exit();
            $object3 = hoz_json_unit_factory::factory( 'nav' );
            //var_dump($object3);exit();

            $this->children = array(
                $object1,
                $object2,
                $object3
            );
            //var_dump(); exit();
        } // end- if($intention == 'default' || $intention == 'brick' || $intention == 'square')

    }
}

class hoz_json_modules_ajax {
    public static function produce( $name, $intention, $genrek, $data ) {
        if ( $intention == 'defaultItems' || $intention == 'brickItems' || $intention == 'squareItems' ) {
            // Ajax JSON modules for Views
            return hoz_json_unit_factory::factory( $intention );
        } // end- if($intention == 'default' || $intention == 'brick' || $intention == 'square')
    }
}
/*
    >End- Major parts of the ending json object
    */

/*
    <Factories for Major parts of the ending json object
    */

class hoz_json_html_factory {
    public static function factory( $type, $name, $intention, $genre, $data ) {
        /*
            @parameters
            $type: json type : 'init', 'ajax'
            $name: :'app', 'sec'
            $intention: 'defaultItems', 'brickItems' ...
            */
        if ( $type == 'ajax' && $name == 'sec' ) {
            if ( $genre == 'get' ) {

                $items = hoz_blade_data_factory::factory( 'show', $intention, 'items' );

                return View::make( 'layouts.' . $intention, array("items" => $items) )->render();
            } // end- if ( $genre == 'get' )
        } // end- if ( $type == 'ajax' && $name == 'sec' )

    }
}

class hoz_json_modules_factory {
    public static function factory( $type, $name, $intention, $genre, $data ) {
        if ( $type == 'init' ) {
            $tmp_classname = 'hoz_json_modules_'. $type;

            return new $tmp_classname( $name, $intention, $genre );
        }
        elseif ( $type == 'ajax' )
            return hoz_json_modules_ajax::produce( $name, $intention, $genre, $data );
    }
}

/*
    >End-Factories for Major parts of the ending json object
    */



/*
    <Ending json objects
    */

class hoz_initjson_app {
    // Creating an initjson in an 'app' manner

    public $modules;

    public function __construct( $type, $name, $intention, $genre, $data ) {
        $this->modules = hoz_json_modules_factory::factory( $type, $name, $intention, $genre, $data );
    }
}

class hoz_ajaxjson_sec {
    // Creating an ajaxjson in an 'sec'(sector/ partial) manner

    public $html, $modules;

    public function __construct( $type, $name, $intention, $genre, $data ) {
        /*
        The ajax data will be processed here
        */

        $this->html = hoz_json_html_factory::factory( $type, $name, $intention, $genre, $data );
        $this->modules = hoz_json_modules_factory::factory( $type, $name, $intention, $genre , $data );
    }

}

/*
    >End- Ending json objects
    */




class hoz_json_unit_factory {
    /*
        A factory class for units of initjson

        @e.g.
        $object = new hoz_initjson_unit_factory('rightbar');
        $anotherobject = new hoz_initjson_unit_factory('nav);
        @end-e.g.

        @parameters
        $classname: the name of the class you wanna create
        @end-parameters

        */

    public static function factory( $classname ) {
        $factory_args = func_get_args(); // func_get_args() returns an array
        $class_args = array_slice( $factory_args, 1 );
        //expected $class_args: array($other)

        $whole_classname = "hoz_json_unit_" . $classname;

        //var_dump($factory_args) ;
        //exit();
        if ( $object = new $whole_classname( $class_args ) ) {
            return $object;
        }

        else
            throw new Exception( 'No such class, dude.' );
    }
}

?>
