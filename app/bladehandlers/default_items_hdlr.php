<?php
	class defBld_item{
		public $authorname,$avatar,$img,$title,$hit;
		public $subitems=array();
	}



	$item_data = Imageind::take($default_item_num)->get(array('upuname','upuicon','filename','imgtitle','hits'));

	for($i=0;$i<$default_item_num;$i++)
	{
		$items[$i] = new defBld_item;
		$items[$i]->authorname = $item_data[$i]->upuname;
		$items[$i]->avatar = $item_data[$i]->upuicon . '.jpg';
		$items[$i]->img = $item_data[$i]->filename . '.jpg';
		$items[$i]->title = $item_data[$i]->imgtitle;
		$items[$i]->hit = $item_data[$i]->hits;
	}
?>