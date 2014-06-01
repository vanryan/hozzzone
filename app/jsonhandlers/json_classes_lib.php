<?php
// Gadgets -- under units
class hoz_json_gadget_attrs{
    public $className;

    public function __construct($cname){
        $this->className = $cname;
    }
}

class hoz_json_gadget_data_onlycreatedtime{
    public $createdAt;

    public function __construct(){
        $this->createdAt = date('YmdHis',time());
    }
}

// Units

class hoz_json_unit_items{
	public $uid, $name, $attrs, $data, $children;
    	// $uid, $name: string
    	// $attrs, $data: object
    	// $children: an array of objects


	public function __construct(){
        	$args = func_get_args(); // func_get_args() returns an array
        	// Expected: array($place) 
            // $place: 'default', 'brick', 'square' ... 

            $args=$args[0];

        	$this->uid = $args[0] . 'Items';
        	$this->name = $args[0] . 'Items';
            $this->attrs = new hoz_json_gadget_attrs($args[0]);
            $this->data = new hoz_json_gadget_data_onlycreatedtime;
            
            $data = new hoz_dataplane_items('init',$args[0]);

            for($i=0;$i < Config::get('hoz_global_vars.'. $args[0] .'_item_num');$i++)
            {
                $children_obj_array[$i] = (object) array(
                    'uid'=>'item-' . ($i+1),
                    'name'=>'item',
                    'attrs'=>new hoz_json_gadget_attrs('item'),
                    'children'=>array( (object) array(
                        'uid'=>'button-' . ($i+1),
                        'name'=>'likeButton',
                        'likeId'=>'82942934294',
                        'attrs'=>new hoz_json_gadget_attrs('like')
                        )),
                    'data'=>$data->datalist[$i]
                    );
            }

            $this->children = $children_obj_array;
        }
    }

    class hoz_json_unit_nav{

    	public $uid='nav', $name = 'Navigate', $children = array();

    }

    class hoz_json_unit_rightbar{
        public $uid,$name,$children;

    	public function  __construct(){
            $this->uid = 'rightBar';
            $this->name = 'rightBar';

            $children_tmp = array(
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
                    );

    		$this->children = $children_tmp;
    	}
    	
    }

    // End of units
    ?>