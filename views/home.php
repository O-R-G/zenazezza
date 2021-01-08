<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$find = '/<div><br><\/div>/';
$replace = '';
$body = preg_replace($find, $replace, $body); 

function displayFloatImage($m, $caption, $alt){
    global $oo;

    $src = m_url($m);
    $src_size = 'media/'.m_pad($m['id']).'.'.$m['type'];

    $margin = rand(10, 100);
    $sizer = rand(75, 95) * .01;
    $specs  = getimagesize($src_size); 

    $class = 'thumbsContainer black euler';
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

    $class = 'thumbsContainer black euler mobile_thumbnail';

    $output = '<div class = "'.$class.'" ><img src = "'. $src .'" alt = "'.$alt.'"><div class = "captionContainer caption">'. $caption .'</div></div>';

    return $output;
}

$home_id = end($oo->urls_to_ids(array('home')));
$home_children_photo_raw = $oo->children($home_id);
$home_children_photo = array();
foreach($home_children_photo_raw as $child)
{
    $this_m = $oo->media($child['id'])[0];
    $home_children_photo[] = array(
        'media' => $this_m,
        'caption' => $child['deck'],
        'alt' => $child['deck']
    );
}
$home_children_installation = array();
$past_id = end($oo->urls_to_ids(array('past')));
$past_events = $oo->children($past_id);
foreach($past_events as $event){
    $this_artist_name = $event['name1'];
    if(substr($event['name1'], 0, 1) != '.')
    {
        $event_children = $oo->children($event['id']);
        foreach($event_children as $e_child)
        {
            if($e_child['url'] == 'images')
            {
                $images_children = $oo->children($e_child['id']);
                foreach($images_children as $i_child){
                    if($oo->media($i_child['id']) && strpos($i_child['name1'], "W.I.T.C.H") === false)
                    {
                        $this_media = $oo->media($i_child['id']);
                        foreach($this_media as $m)
                        {
                            
                            $home_children_installation[] = array(
                                'media' => $m,
                                'caption' => $m['caption'],
                                'alt' => $m['caption']
                            );
                            
                        }
                    }
                }
                break;
            }
        }
    }
};

$home_thumbnail_num_photo = rand(4, 8);
$home_thumbnail_num_installation = rand(2, 3);
$home_thumbnail_num = $home_thumbnail_num_photo + $home_thumbnail_num_installation;
shuffle($home_children_photo);
shuffle($home_children_installation);
for($i = 0 ; $i < $home_thumbnail_num_photo ; $i++)
    $home_children[] = $home_children_photo[$i];

for($i = 0 ; $i < $home_thumbnail_num_installation ; $i++)
    $home_children[] = $home_children_installation[$i];
shuffle($home_children);

$time = date('Y-m-d g:i:s A');
?><div id='fullwindow'></div>
<section id="main" class = 'home_main_section'>
    <div id='content'>
        
        <? 
            foreach($home_children as $h_child)
            {
                echo displayFloatImage($h_child['media'], $h_child['caption'], $h_child['alt']);
                echo displayNormalImage($h_child['media'], $h_child['caption'], $h_child['alt']);
            }
            // for($i = 0; $i < $home_thumbnail_num ; $i ++)
            // {
            //     $this_m = $oo->media($home_children[$i]['id'])[0];
            //     $this_caption = $home_children[$i]['deck'];
            //     echo displayFloatImage($this_m, $this_caption);
            //     echo displayNormalImage($this_m, $this_caption);
            // }
        ?>
    </div>
</section>
<div class = 'timeContainer caption'>
    <a href='https://www.facebook.com/zenazezzaprojects' target='new'><img windowfullDisabled='1' src='media/facebook.gif'></a>
    <a href='https://twitter.com/zenazezza' target='new'><img windowfullDisabled='1' src='media/twitter.gif'></a>
    &nbsp;
    <a href='http://instagram.com/zenazezza' target='new'><img windowfullDisabled='1' src='media/instagram.gif'></a>
    &nbsp;&nbsp;&nbsp;
    <?= $time; ?>
</div>

<!-- <script type="text/javascript" src="/static/js/screenfull.min.js"></script>	 -->
<script type="text/javascript" src="/static/js/windowfull.js"></script>	
<script>
    var imgs = document.querySelectorAll('img,video');
	var i;
	var index;

	for (i = 0; i < imgs.length; i++) {

		// if (screenfull.isEnabled) {
  //   		imgs[i].addEventListener('click', function () {
  //               screenfull.toggle(this);
  //   		}, false);
		// } else {
  //           console.log('window');
  //   		imgs[i].addEventListener('click', function () {
  //               windowfull.toggle(this);
  //   		}, false);
  //       }
        if(!imgs[i].getAttribute('windowfullDisabled')) {
            imgs[i].addEventListener('click', function () {
                windowfull.toggle(this);
            }, false);
        }
        
	}
    var sThumbsContainer = document.getElementsByClassName('thumbsContainer');
    
    
</script>
