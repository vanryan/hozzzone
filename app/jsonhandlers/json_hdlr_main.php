<?php
    /*
    @Global rules:

    # All the classnames are in lower case.

    @end-global rules

    */
    class hoz_json_modules{
        // Creating the modules -- the necessary object in all backbone jsons
        public $uid, $name, $children;

        public function __construct($type,$name,$place){
            if($type == 'init'){
                $this->uid = $name;
                $this->name = $name;

                $object1 = hoz_json_unit_factory::factory('items',$place);
                //var_dump($object1);exit();
                $object2 = hoz_json_unit_factory::factory('rightbar');
                //var_dump($object2);exit();
                $object3 = hoz_json_unit_factory::factory('nav');
                //var_dump($object3);exit();

                $this->children = array(
                    $object1,
                    $object2,
                    $object3
                    );



            }
        }
    }

    class hoz_json_factory{
        // The root factory for json in hozzz
        public static function factory($type,$name,$place){
            /*
            @e.g.
            $initJSON = new hoz_json_factory('init','app','default');
            @end-e.g.

            @parameters:
            $type:'init', 'ajax'
            $name:'app', ......
            $place:'default', 'square', brick', ......
            @end-parameters
            */
            require_once('json_classes_lib.php');
            require_once('json_classes_main.php'); 
            // Note the sequence. Watch for the definitions.
            
            $whole_classname = 'hoz_'. $type .'json_'. $name;
            if($object = new $whole_classname($type,$name,$place) ){
                return $object;
            }
                
            else 
                throw new Exception('No such thing, dude.');
        }
    }


?>
