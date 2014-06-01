<?php

class hoz_dataplane_items{
	public $datalist;

	public function __construct($type,$place){
		if($type == 'init'){
			$this->datalist = Imageind::take(Config::get('hoz_global_vars.'. $place .'_item_num'))
                        ->get(array('id','upuname','created_at','hits'));
		}
	}
}

?>