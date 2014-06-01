<?php
    /*
    @Global rules:

    # All the classnames are in lower case.

    @end-global rules

    */

    class hoz_json_factory{
        // The root factory for json in hozzz
        public static function factory($type,$name,$place,$genre = 'items'){
            /*
            @e.g.
            $initJSON = hoz_json_factory::factory('init','app','default','items');
            $ajaxJSON = hoz_json_factory::factory('ajax','sec','default','items');
            @end-e.g.

            @parameters:
            $type: :'init', 'ajax'
            $name:'app','sec' ......
            $place: The page the JSON is expected to be in. : 'default', 'square', brick' ...  
            $genre: The genre of embodiment of the JSON: 'items','data' ...
            @end-parameters
            */
            require_once('json_classes_lib.php');
            require_once('json_classes_main.php'); 
            // Note the sequence. Watch for the definitions.
            
            $whole_classname = 'hoz_'. $type .'json_'. $name;
            if($object = new $whole_classname($type,$name,$place,$genre) ){
                return $object;
            }

            else 
                throw new Exception('No such thing, dude.');
        }
    }


    ?>
