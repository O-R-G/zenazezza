<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$media = $oo->media($item['id']);
$children = $oo->children($item['id']);
foreach($children as $key => $child)
    if(substr($child['name1'], 0, 1) == '.')
        unset($children[$key]);
$seasons = ($uri[1] == 'seasons');
$season = ($uri[2]);
if ($season || $seasons){
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
    $events = ($uri[3] == 'events');
    $readings = ($uri[3] == 'reading');
    $images = ($uri[3] == 'images');
    $videos = ($uri[3] == 'videos');
}

?><div id='fullwindow'></div>
<div id="layout-container">
    <main id="main" class='content-container support'>
        <div id='content'><?
            ?><div id='content-text' class='palatino'><?
                if ($season) {
                    ?><div id='body' class='palatino'><?
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
                    if ($images) {
                        ?><div id='images'><?
                            foreach ($media as $m) {
                                ?><img class="" src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
                                <div class='captionContainer'>
                                    <div class='caption euler'>
                                    <?= $m['caption']; ?>
                                    </div>
                                </div><?
                            }
                        ?></div><?
                    }
                }
                if ($sub) {
                    foreach($children as $child){
                        $title = $child['name1'];
                        $deck = $child['deck'];
                        $url = implode('/', $uri) .'/'. $child['url'];
                        $child_images = $oo->media($child['id']);
                        ?><div class = 'list-child'>
                            <a class="list-child-link" href = '<?= $url; ?>'>
							    <?= $title; ?>
						    </a><?
                            if($seasons && !$season){
                                ?><div class='seasons'>
                                    <div class='dates'><?
                                        echo $deck;
                                    ?></div><?
                                    $i = $child_images[0];
                                    if (empty($i)) 
                                        $u = '/media/jpg/label.jpg';
                                    else 
                                        $u = m_url($i);
                                    ?><a class="list-child-link" href = '<?= $url; ?>'>
                                        <img class="list-child-link no-windowfull" src = '<?= $u; ?>' alt = '<?= $i['caption']; ?>'>
                                    </a>
                                </div><?
                            }
                            if($events){
                                ?><div class='events'><?
                                    $i = $child_images[0];
                                    if (empty($i)) 
                                        $u = '/media/jpg/label.jpg';
                                    else 
                                        $u = m_url($i);
                                    ?><img class="list-child-link" src = '<?= $u; ?>' alt = '<?= $i['caption']; ?>'>
                                    <div class='captionContainer'>
                                        <div class='caption euler'>
                                            <?= $i['caption']; ?>
                                        </div>
                                    </div>
                                    <?= $child['body']; ?>
                                </div><?
                            }
                            if($readings){
                                ?><div class='readings'>
                                    <!-- <a href="<?= $child['url']; ?>">Continue reading ...</a> -->
                                    <?= $child['body']; ?>
                                </div>
                                <div class='continues'></div><?
                            }
                            if($images){
                                ?><div class='images'><?
                                    foreach($child_images as $i) {
                                        ?><img class="list-child-link" src = '<?= m_url($i); ?>' alt = '<?= $i['caption']; ?>'>
                                        <div class='captionContainer'>
                                            <div class='caption euler'>
                                                <?= $i['caption']; ?>
                                            </div>
                                        </div><?
                                    }
                                ?></div><?
                            }
                            if($videos){
                                if ($child['body']) {
                                    $vimeo = 'vimeo.com';
                                    $youtube = 'youtube.com';
                                    $video = (strpos($child['body'], $vimeo) || strpos($child['body'], $youtube));
                                    if ($video)
                                        $child_video = $child['body'];
                                }
                                ?><div class='video'>
                                    <?= $child_video; ?>
                                <div><?
                            }
                        ?></div><?
                    }
                    ?></div><?
                }
            ?></div>
        </div>
    </main>
    <aside class="sub-children-container"><?
        if ($season) {
            ?><div class = 'list-child'>
                <a class="list-child-link" href = '<?= $url; ?>'>
                    Season <?= $sub['name1']; ?>
                </a>
            </div><?
            if($sub_media){
                foreach($sub_media as $m) {
                    ?><div class = 'list-child'>
                        <img class="list-child-link no-windowfull" src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
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
