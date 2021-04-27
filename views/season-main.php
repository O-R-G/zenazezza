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
$children = $oo->children($item['id']);
foreach($children as $key => &$child){
    if(substr($child['name1'], 0, 1) == '.')
        unset($children[$key]);
}
unset($child);

if(count($uri) == 3)
    $season_title = $item['name1'];
else
    $season_title = '';
?><div id='fullwindow'></div>
<div id="layout-container">
    
    <main id="main" class='content-container'>
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
            <!-- <? if(count($children) > 0 && count($uri) > 5){
                ?><br><?
                foreach($children as $child)
                {
                    $url = implode('/', $uri) .'/'. $child['url'];
                    $title = $child['name1'];
                    ?><a href="<?= $url; ?>"><?= $title; ?></a><br><?
                }
            } ?> -->
        </div>
        <?
        foreach($children as $child){
            $m = $oo->media($child['id'])[0];
            if($m != null)
            {
                $thumbnail_url = m_url($m);
                $thumbnail_alt = $m['caption'];
            }
            $title = $child['name1'];
            $url = implode('/', $uri) .'/'. $child['url'];
            $section_children = $oo->children($child['id']);
            ?><div id="season-section-<?= $child['url']; ?>" class = 'season-section'>
                <br><h2><?= strtoupper($child['name1']); ?></h2><br>
                <? foreach($section_children as $s_child){
                    $m = $oo->media($s_child['id'])[0];
                    if($m != null)
                    {
                        $thumbnail_url = m_url($m);
                        $thumbnail_alt = $m['caption'];
                    }
                    $s_title = $s_child['name1'];
                    $url = implode('/', $uri) .'/'.$child['url'] . '/' . $s_child['url'];
                    ?><div class = 'list-child'>
                        <a class="list-child-link reverse" href = '<?= $url; ?>'>
                            <h1><?= $s_title; ?></h1>
                            <? if($m != null){
                                ?><img src = '<?= $thumbnail_url; ?>' alt = '<?= $thumbnail_alt; ?>'><?
                            } ?>
                        </a>
                    </div><br><?
                } ?>
            </div><?
        }
        ?>
    </main>
    <? if(count($uri) == 3 && count($children) > 0){
        ?><aside class="season-children-container">
            <h1 class="season-title">Season <?= $season_title; ?></h1>
        <?
        foreach($children as $child){
            $m = $oo->media($child['id'])[0];
            if($m != null)
            {
                $thumbnail_url = m_url($m);
                $thumbnail_alt = $m['caption'];
            }
            $title = $child['name1'];
            $url = implode('/', $uri) .'/'. $child['url'];
            ?><div class = 'list-child'>
                <a class="list-child-link" href = '<?= $url; ?>'>
                    <? if($m != null){
                        ?><img src = '<?= $thumbnail_url; ?>' alt = '<?= $thumbnail_alt; ?>'><?
                    } ?>
                    <h1><?= $title; ?></h1>
                </a>
            </div><?
        }
        ?></aside><?
    } ?>
</div>
<script type="text/javascript" src="/static/js/windowfull.js"></script>	
<script>
    var imgs = document.querySelectorAll('img,video');
	var i;
	var index;
	for (i = 0; i < imgs.length; i++) {
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
