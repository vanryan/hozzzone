<?php
    // The root factory for json in hozzz
    class hoz_json_factory{
        public function __construct($type,$name){
            /*
            @e.g
            $initJSON = new hoz_json_factory('init','app');

            @Parameters:
            $type:'init', 'ajax'
            $name:'app', ......
            */
            $whole_classname = 'hoz_'. $type .'json_'. $name;
            if($object = new $whole_classname($type,$name) )
                return $object;
            else 
                throw new Exception('No such thing, dude.');
        }
    }

    // Creating the modules
    class hoz_json_modules{
        public $uid = 'app', $name = 'app', $children;

        public function __construct($type,$name){}
    }


    // Creating a initjson in an 'app' manner
    class hoz_initjson_app{
        public $modules; 

        public function __construct($type,$name){
            $this->modules = new hoz_json_modules($type,$name);
        }
    }

    // Factory for creating units
    class hoz_initjson_unit_factory{
        public function __construct($classname){
            $factory_args = func_get_args();
            $class_args = array_slice( $factory_args, 1 );
            $whole_classname = "hoz_initjson_unit_" . $classname;
            if($object = new $whole_classname($class_args))
                return $object;
            else 
                throw new Exception('No such class, dude.');
        }
    }

    class hoz_initjson_app{
        public function __construct(){}
    }

    // Units

    class hoz_initjson_defaultItems{
        public function __construct(){}
    }

    class hoz_initjson_nav{

        public $uid='nav', $name = 'Navigate', $children = array();

    }

    class hoz_initjson_rightbar{

        public function __construct(){

            $rightBar = array(
                'uid'=>'rightBar',
                'name'=>'rightBar',
                'children'=>array(
                    (object) array(
                        'uid'=>'viewLayout',
                        'name'=>'viewLayout',
                        'children'=>array(
                            (object) array('uid'=>'layoutButton-1','name'=>'layoutButton','data'=> (object) array('view'=>'default')),
                            (object) array('uid'=>'layoutButton-2','name'=>'layoutButton','data'=> (object) array('view'=>'square')),
                            (object) array('uid'=>'layoutButton-3','name'=>'layoutButton','data'=> (object) array('view'=>'brick')),
                            )
                        ),
                    (object) array('uid'=>'searchBox','name'=>'searchBox'),
                    (object) array('uid'=>'addHoz','name'=>'addHoz','data'=>(object)null)
                )
            );

            $rightBar = (object)$rightBar;

            return $rightBar;
        }
        
    }

    // End of units


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
