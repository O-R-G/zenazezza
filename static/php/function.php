<?

function nav_zenazezza($ids, $oo, $root_id=0)
{
	$nav = array();
	$pass = true;
	
	$top = $oo->children_ids_nav($root_id);

	$root_index = array_search($root_id, $ids);
	if($root_index === FALSE)
		$root_index = 0;
	else
		$root_index++;
	
	foreach($top as $t)
	{
		$o = $oo->get($t);
		$d = $root+1;
		$urls = array($o['url']);
		$url = implode("/", $urls);			
		$nav[] = array('depth'=>$d, 'o'=>$o, 'url'=>$url);
		
		if($pass && $t == $ids[$root_index])
		{
			$pass = false; // short-circuit if statement
			$kids = $oo->children_ids_nav(end($ids));
			if(empty($kids) && count($ids) > 1)
			{
				$kids = $oo->children_ids_nav($ids[count($ids)-2]);
				array_pop($ids); // leaf is included in siblings
			}
			array_shift($ids);
			
			// show direct ancestors (and self, if children)
			foreach(array_slice($ids, $root_index) as $id)
			{
				$d++;
				$o = $oo->get($id);
				$urls[] = $o['url'];
				$url = implode("/", $urls);
				$nav[] = array('depth'=>$d, 'o'=>$o, 'url'=>$url);
			}
			// show children, if no children, show self + siblings
			$d++;
			foreach($kids as $k)
			{	
				$o = $oo->get($k);
				$urls[] = $o['url'];
				$url = implode("/", $urls);
				$nav[] = array('depth'=>$d, 'o'=>$o, 'url'=>$url);
				array_pop($urls);
			}
		}
	}
	return $nav;
}
function displayFloatImage($m, $caption, $alt, $type){
    global $oo;

    $src = m_url($m);
    $src_size = 'media/'.m_pad($m['id']).'.'.$m['type'];

    $margin = rand(10, 100);
    $sizer = rand(75, 95) * .01;
    $specs  = getimagesize($src_size); 

    $class = 'thumbsContainer black euler ' . $type;
    $style = 'margin: '.$margin.'px; width: '.$specs[0] * $sizer.'px; height: '.$specs[1] * $sizer.'px';

    $output = '<div class = "'.$class.'" style = "'.$style.'"><img src = "'. $src .'" alt = "'.$alt.'"><div class = "captionContainer caption">'. $caption .'</div></div>';

    return $output;
}

function displayNormalImage($m, $caption, $alt){
    global $oo;

    $src = m_url($m);
    $src_size = 'media/'.m_pad($m['id']).'.'.$m['type'];

    // $margin = rand(10, 100);
    // $sizer = rand(75, 95) * .01;
    // $specs  = getimagesize($src_size); 

    $class = 'thumbsContainer black euler mobile_thumbnail ' . $type;

    $output = '<div class = "'.$class.'" ><img src = "'. $src .'" alt = "'.$alt.'"><div class = "captionContainer caption">'. $caption .'</div></div>';

    return $output;
}
?>