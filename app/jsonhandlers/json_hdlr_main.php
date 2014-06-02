<?php
/*
    @Global rules:

    # All the classnames are in lower case.

    @end-global rules

    */

class hoz_json_factory {
    // The root factory for json in hozzz
    public static function factory( $type, $name, $intention, $genre = 'items', $data = '') 
    {
        /*
            @e.g.
            $initJSON = hoz_json_factory::factory('init','app','default','items');
            $ajaxJSON = hoz_json_factory::factory('ajax','sec','defaultItems','get',data);
            @end-e.g.

            @parameters:
            $type: :'init', 'ajax'
            $name:'app','sec' ......
            $intention: 
            | Init: The page the JSON is expected to be in. : 'default', 'square', brick' ...
            | Ajax: The name of the ajax, telling us what does it want or what it intends to do
            $genre: 
            | Init: The genre of embodiment of the JSON: 'items','data' ...
            | Ajax: The method of the ajax 
                    (Not 'get', 'post', but in a context of 'get', 'create', 'update', 'delete')
            $data:
            |Only Available in Ajax. The data array sent by the ajax request in a form of a string -- a JSON array

            @end-parameters
            */

        require_once 'json_classes_lib.php';
        require_once 'json_classes_main.php';
        // Note the sequence. Watch for the definitions.

        $whole_classname = 'hoz_'. $type .'json_'. $name;
        if ( $object = new $whole_classname( $type, $name, $intention, $genre, json_decode($data) ) ) {
            return $object;
        }

        else
            throw new Exception( 'No such thing, dude.' );
    }
}


?>
