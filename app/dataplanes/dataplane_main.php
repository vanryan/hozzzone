<?php

/* 
<Root Factory 
*/
class hoz_dataplane_factory{
	/* 
        A factory class for data fetching (mostly models and arrays)
        
        @e.g.
        $object = new hoz_initjson_unit_factory('rightbar');
        $anotherobject = new hoz_initjson_unit_factory('nav);
        @end-e.g.

        @parameters
        $type: the type of usage of the data: 'init', 'ajax', 'show' ...
        // The 'show' type is for instantiating the showing pages (such as instantiating a blade)

        $place: destination place u r placing those data: 'default', 'brick', 'user-admin' ...

        $genre: the genre of the embodiment of the data : 'items'

        @end-parameters

    */
	public static function factory($type,$place,$genre){
		$tmp_name = 'hoz_dataplane_'. $genre;
		return new $tmp_name($type,$place);
	}
}
/* 
>End- Root Factory 
*/

/* 
<Major Factories
*/

/* 
>End- Major Factories
*/

/*
<Classes Lib
*/
class hoz_dataplane_items{
	public $datalist;

	public function __construct($type,$place){
		if($type == 'init'){
			if($place == 'default' || $place == 'sqaure' || $place == 'brick' ){
				$this->datalist = Imageind::take(Config::get('hoz_global_vars.'. $place .'_item_num'))
                        ->get(array('id','upuname','created_at','hits'));
			}	
		} // End- if($type == 'init')
		if($type == 'show'){
			if($place == 'default' || $place == 'sqaure' || $place == 'brick' ){
				$this->datalist = Imageind::take(Config::get('hoz_global_vars.'. $place .'_item_num'))
                        ->get(array('upuname','upuicon','filename','imgtitle','hits'));
			}
		} // End- if($type == 'show')
	} // End- __construct
}

/*
>End-Classes Lib
*/

?>