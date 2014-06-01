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

                $object1 = new hoz_initjson_unit_factory('items',$place);
                $object2 = new hoz_initjson_unit_factory('rightbar');
                $object3 = new hoz_initjson_unit_factory('nav');

                $children = array(
                    $object1,
                    $object2,
                    $object3
                    );
            }
        }
    }

    class hoz_json_factory{
        // The root factory for json in hozzz
        public function __construct($type,$name,$place){
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
            require_once($type.'_json_classes_lib.php');
            require_once($type.'_json_classes_main.php'); 
            // Note the sequence. Watch for the definitions.
            
            $whole_classname = 'hoz_'. $type .'json_'. $name;
            if($object = new $whole_classname($type,$name,$place) )
                return $object;
            else 
                throw new Exception('No such thing, dude.');
        }
    }

    // Old Fashioned
    // Old Fashioned
    // Old Fashioned
    // Old Fashioned

	class defaultitem{

    	public $uid;

    	public $name = 'item';

    	//public $attrs = new StdClass;
    	//$attrs->className = 'item';  // not working in php 5
    	protected $attrs;

    	public $children;

    	public $data;

    	public function __construct(){
    		$this->attrs = (object) array('className'=>'item');
    	}
    }

	class defaultitemChild{

    	public $uid;

    	public $name = 'likeButton', $likeId = '82942934294';

    	protected $attrs;

    	public function __construct(){
    		$this->attrs = (object) array('className'=>'likeButton');
    	}
    }

    for($i=0;$i<$default_item_num;$i++){
    	$defitemKids[$i] = new defaultitemChild;
    	$defitemKids[$i]->uid = 'button-'. ($i+1);
    }
    	

    $data_list = Imageind::take($default_item_num)->get(array('id','upuname','created_at','hits'));

    for($i=0;$i<$default_item_num;$i++){
    	$defitems[$i] = new defaultitem;
    	$defitems[$i]->uid = 'item-'.($i+1);
    	$defitems[$i]->children = array($defitemKids[$i]);
    	$defitems[$i]->data = $data_list[$i];
    }

?>
