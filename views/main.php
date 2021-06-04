<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$media = $oo->media($item['id']);
$children = $oo->children($item['id']);
$zena = ($uri[2] == 'zena'); 
if ($zena) {
    $child = $children[array_rand($children)];
    $media = $oo->media($child['id']);
}
foreach($children as $key => $child)
    if(substr($child['name1'], 0, 1) == '.')
        unset($children[$key]);
$sub = ($uri[2]);
$detail = ($uri[3]);
$main = !$sub;
if ($sub){
    $sub_uri = $uri;
    while (count($sub_uri) > 3)
        array_pop($sub_uri);
    $sub_url = implode('/', $sub_uri);
    array_shift($sub_uri);
    $sub_id = array_pop($oo->urls_to_ids($sub_uri));
    $sub = $oo->get($sub_id);
    $sub_media = $oo->media($sub['id']);
    $sub_children = $oo->children($sub['id']);
    foreach($sub_children as $key => $child)
        if(substr($child['name1'], 0, 1) == '.')
            unset($sesson_children[$key]);
}

?><div id='fullwindow'>
    <div id='x'><img src='/media/svg/x-6-k.svg'></div>
</div>
<div id="layout-container">
    <main id="main" class='content-container support'>
        <div id='content'>
            <div id='content-text' class='palatino'>
                <div id='body'><?
                    echo $body;
                ?></div><?
                if ($date) {
                    ?><div id='notes' class='mono'><?
                        echo date("F j, Y", strtotime($date));
                        echo '<br/>';
                        echo $deck;
                        echo '<br/><br/>';
                        echo $notes;
                    ?></div><?
                }
                ?><div id='images'><?
                    foreach ($media as $m) {
                        ?><img class='<?= ($uri[2] == "books-for-purchase") ? "color" : ""; ?>' src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
                        <div class='captionContainer'>
                            <div class='caption euler'>
                                <?= $m['caption']; ?>
                            </div>
                        </div><?
                        if ($zena) {
                            ?><a href=''>Another?</a> or <a href='/about'>Back to About . . .</a><?
                        }                        
                    }
                ?></div><?
                if ($sub) {
                    foreach($children as $child){
                        $title = $child['name1'];
                        $url = implode('/', $uri) .'/'. $child['url'];
                        $child_images = $oo->media($child['id']);
                        ?><div class = 'list-child'>
                            <a class="list-child-link" href = '<?= $url; ?>'>
							    <?= $title; ?>
						    </a><?
                            $i = $child_images[0];
                            ?><div class='sub'>
                                <a class="list-child-link" href = '<?= $url; ?>'>
                                    <img class="list-child-link no-windowfull" src = '<?= m_url($i); ?>' alt = '<?= $i['caption']; ?>'>
                                </a>
							</div><?
                        ?></div><?
                    }
                    ?></div><?
                }
            ?></div>
        </div>
    </main>
    <aside class="sub-children-container"><?
        if ($sub && $detail) {
            if($sub_media){
                foreach($sub_media as $m) {
                    ?><div class = 'list-child'>
                        <img class="list-child-link" src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
                        <!-- 
                        <div class='captionContainer'>
                            <div class='caption euler'>
                                <?= $m['caption']; ?>
                            </div>
                        </div> 
                        -->
                    </div><?
                }
            }
            if ($sub_children) {
                foreach($sub_children as $child){
                    $title = $child['name1'];
                    // $url = implode('/', $uri) .'/'. $child['url'];
                    $url = $sub_url .'/'. $child['url'];
                    ?><div class = 'list-child'>
                        <a class="list-child-link" href = '<?= $url; ?>'><? 
                            ?><?= $title; ?>
                        </a>
                    </div><?
                }
            }
        }
    ?></aside>   
</div>
<script type="text/javascript" src="/static/js/windowfull.js"></script>
<script>
    // var imgs = document.querySelectorAll('img,video');
    var imgs = document.querySelectorAll('img:not(.no-windowfull),video');
    var i;
    var index;

    for (i = 0; i < imgs.length; i++) {
        if(!imgs[i].getAttribute('windowfullDisabled')) {
            imgs[i].addEventListener('click', function () {
                windowfull.toggle(this);
            }, false);
        }
    }
    // var sThumbsContainer = document.getElementsByClassName('thumbsContainer');
</script>
