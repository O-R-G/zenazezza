<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$find = '/<div><br><\/div>/';
$replace = '';
$body = preg_replace($find, $replace, $body); 

function displayFloatImage($m, $caption){
    global $oo;

    $src = m_url($m);
    $src_size = 'media/'.m_pad($m['id']).'.'.$m['type'];

    $margin = rand(10, 100);
    $sizer = rand(75, 95) * .01;
    $specs  = getimagesize($src_size); 

    $class = 'thumbsContainer black euler';
    $style = 'margin: '.$margin.'px; width: '.$specs[0] * $sizer.'px; height: '.$specs[1] * $sizer.'px';

    $output = '<div class = "'.$class.'" style = "'.$style.'"><img src = "'. $src .'" alt = "'.$caption.'"><div class = "captionContainer caption">'. $caption .'</div></div>';

    return $output;
}

$home_id = end($oo->urls_to_ids(array('home')));
$home_children = $oo->children($home_id);

$home_thumbnail_num = rand(4, 8);
shuffle($home_children);
$time = date('Y-m-d g:i:s A');
?><div id='fullwindow'></div>
<section id="main" class = 'home_main_section'>
    <div id='content'>
        <!-- <? foreach($home_children as $hc){
            $this_m = $oo->media($hc['id'])[0];
            $this_caption = $hc['deck'];
            echo displayFloatImage($this_m, $this_caption);
        } ?> -->
        <? 
            for($i = 0; $i < $home_thumbnail_num ; $i ++)
            {
                $this_m = $oo->media($home_children[$i]['id'])[0];
                $this_caption = $home_children[$i]['deck'];
                echo displayFloatImage($this_m, $this_caption);
            }
        ?>
    </div>
</section>
<div class = 'timeContainer caption'>
    <a href='https://www.facebook.com/zenazezzaprojects' target='new'><img windowfullDisabled='1' src='MEDIA/facebook.gif'></a>
    <a href='https://twitter.com/zenazezza' target='new'><img windowfullDisabled='1' src='MEDIA/twitter.gif'></a>
    &nbsp;
    <a href='http://instagram.com/zenazezza' target='new'><img windowfullDisabled='1' src='MEDIA/instagram.gif'></a>
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
    console.log(imgs[i].getAttribute('windowfullDisabled'));
        if(!imgs[i].getAttribute('windowfullDisabled')) {
            imgs[i].addEventListener('click', function () {
                windowfull.toggle(this);
            }, false);
        }
        
	}
</script>
