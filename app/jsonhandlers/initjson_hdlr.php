<?php

	class defaultitem{

    	public $uid;

    	private $name = 'item';

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

    	private $name = 'likeButton', $likeId = '82942934294';

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
    	$defitems[$i]->children = $defitemKids[$i];
    	$defitems[$i]->data = $data_list[$i];
    }


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

    $nav = array('uid'=>'nav','name'=>'Navigate','children'=>array()); 
    $nav = (object)$nav;
?>