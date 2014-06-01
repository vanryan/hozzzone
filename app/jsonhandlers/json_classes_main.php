<?php
	
	class hoz_initjson_app{
        // Creating a initjson in an 'app' manner

        public $modules; 

        public function __construct($type,$name,$place){
            $this->modules = new hoz_json_modules($type,$name,$place);

        }
    }



    class hoz_json_unit_factory{
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

        public static function factory($classname){
            $factory_args = func_get_args(); // func_get_args() returns an array
            $class_args = array_slice( $factory_args, 1 );
            $whole_classname = "hoz_json_unit_" . $classname;

            //var_dump($factory_args) ;
            //exit();
            if($object = new $whole_classname($class_args))
            {
                return $object;
            }
                
            else 
                throw new Exception('No such class, dude.');
        }
    }

?>