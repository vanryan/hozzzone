<?php
	/*
	<Root Factory
	*/
	class hoz_blade_data_factory{
		/*
		 @parameters
        $type: the type of usage of the data: 'init', 'ajax', 'show' ...
        // The 'show' type is for instantiating the showing pages (such as instantiating a blade)
        // In this class, 'show' is obligatory

        $intention: destination place u r placing those data: 'default', 'brick', 'user-admin' ...

        $genre: the genre of the embodiment of the data : 'items'

        @end-parameters
		*/

		public static function Factory($type, $intention, $genre){
			if($genre == 'items'){
				if($intention == 'defaultItems' || $intention == 'sqaureItems' || $intention == 'brickItems'){
					$items = hoz_dataplane_factory::factory('show',$intention,'items');
					$items = $items->datalist;
					for($i=0;$i<Config::get('hoz_global_vars.' . $intention . '_num');$i++)
					{

						$items[$i]->subItems = array(); 

					} // End- if($intention == 'default' || $intention == 'sqaure' || $intention == 'brick')

					return $items;
				}
				

			} // End-if($genre == 'items')

		}
	}

	/*
	>End- Root Factory
	*/

	/*
	<Class Lib
	*/
	/*
	class hoz_viewBld_item{
		public $authorname,$avatar,$img,$title,$hit;
		public $subItems = array();
	}
	*/

	/*
	>End- Class Lib
	*/
?>
