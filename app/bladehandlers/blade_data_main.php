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

        $place: destination place u r placing those data: 'default', 'brick', 'user-admin' ...

        $genre: the genre of the embodiment of the data : 'items'

        @end-parameters
		*/

		public static function Factory($type, $place, $genre){
			if($genre == 'items'){
				if($place == 'default' || $place == 'sqaure' || $place == 'brick'){
					$item_data = hoz_dataplane_factory::factory('show',$place,'items');
					$item_data = $item_data->datalist;
					for($i=0;$i<Config::get('hoz_global_vars.' . $place . '_item_num');$i++)
					{
						$items[$i] = new hoz_viewBld_item;
						$items[$i]->authorname = $item_data[$i]->upuname;
						$items[$i]->avatar = $item_data[$i]->upuicon;
						$items[$i]->img = $item_data[$i]->filename;
						$items[$i]->title = $item_data[$i]->imgtitle;
						$items[$i]->hit = $item_data[$i]->hits; 
					} // End- if($place == 'default' || $place == 'sqaure' || $place == 'brick')

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
	class hoz_viewBld_item{
		public $authorname,$avatar,$img,$title,$hit;
		public $subItems=array();
	}

	/*
	>End- Class Lib
	*/
?>
