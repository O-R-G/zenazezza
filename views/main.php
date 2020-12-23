<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$media = $oo->media($item['id']);
// $find = '/<div><br><\/div>/';
// $replace = '';
// $body = preg_replace($find, $replace, $body); 

?><div id='fullwindow'></div>
<section id="main">
	
    <div id='content'>
        <? if(!empty($media)) {
        ?><div id = 'content-image'><?
        
            foreach($media as $m)
            {
                $m_path = 'media/'.m_pad($m['id']).'.'.$m['type'];
                $m_size = getimagesize($m_path);
                $m_style = 'width:'.$m_size[0].'px; height:'.$m_size[1].'px;';
                ?><div class = 'imageContainer'><img style = '<?= $m_style; ?>' src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>' title = '<?= $m['caption']; ?>'><div class = 'captionContainer caption euler'><?= $m['caption']; ?></div></div><?
            }
        ?></div><?
        } 
        ?>
        <div id='content-text'><?
            echo $body;
            if ($date) {
                ?><div id='notes' class='mono'><?
                    echo date("F j, Y", strtotime($date));
                    echo '<br/>';
                    echo $deck;
                    echo '<br/><br/>';
                    echo $notes;
                ?></div><?
            }
        ?></div>
    </div>
</section>

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

    var imgs_in_main = document.querySelectorAll('#main img');
    var iframes_in_main = document.querySelectorAll('#main iframe');
    if(body.classList.contains('mobile')){
        [].forEach.call(imgs_in_main, function(el, i){
            el.style.width = '100%';
            el.style.height = 'initial';
        });
        [].forEach.call(iframes_in_main, function(el, i){
            // el.style.width = '100%';
            // el.style.height = 'initial';
            var this_width = parseInt(el.getAttribute('width'));
            var this_height = parseInt(el.getAttribute('height'));
            var parent_width = el.parentNode.offsetWidth;
            el.width = '100%';
            el.height = this_height / this_width * parent_width + 'px';
            if(i == 0)
                el.style.marginTop = 0;
            // el.height = 'initial';
        });
    }
    
</script>
