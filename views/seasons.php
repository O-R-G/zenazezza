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
$season = ($uri[2]);
if ($season){
    $season_uri = $uri;
    while (count($season_uri) > 3)
        array_pop($season_uri);
    $season_url = implode('/', $season_uri);
    array_shift($season_uri);
    $season_id = array_pop($oo->urls_to_ids($season_uri));
    $season = $oo->get($season_id);
    $season_media = $oo->media($season['id']);
    $season_children = $oo->children($season['id']);
    foreach($season_children as $key => $child)
        if(substr($child['name1'], 0, 1) == '.')
            unset($sesson_children[$key]);
}

?><div id='fullwindow'></div>
<div id="layout-container">
    <main id="main" class='content-container'>
        <div id='content'>
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
                foreach($children as $child){
                    $title = $child['name1'];
                    if (!$season) {
                        $title = 'Season ' . $title;
                        $deck = $child['deck'];
                    }
                    $url = implode('/', $uri) .'/'. $child['url'];
                    $child_images = $oo->media($child['id']);
                    if ($child['body']) {
                        $vimeo = 'vimeo.com';
                        $youtube = 'youtube.com';
                        $video = (strpos($child['body'], $vimeo) || strpos($child['body'], $youtube));
                        if ($video)
                            $child_video = $child['body'];
                        else if (!$something_tbd)
                            $child_reading = $child['body'];
                        else
                            // events usually have images so that may be a good way to filter here
                            $child_event = $child['body'];
                    }
                    ?><div class = 'list-child'>
                        <a class="list-child-link" href = '<?= $url; ?>'><? 
                            ?><h1><?= $title; ?></h1>
                        </a>
                        <div class='deck'><?= $deck; ?></div><?
                        if($child_event){ 
                            ?><div class='reading'>
                                <?= $child_reading; ?>
                            <div><?
                        }
                        if($child_reading){ 
                            ?><div class='reading'>
                                <?= $child_reading; ?>
                            <div><?
                        }
                        if($child_images){
                            foreach($child_images as $i) {
                                if (!$season) {
                                    ?><a class="list-child-link" href = '<?= $url; ?>'><? 
                                }
                                ?><img class="list-child-link <?= (!$season) ? 'no-windowfull' : ''; ?>" src = '<?= m_url($i); ?>' alt = '<?= $i['caption']; ?>'>
                                <div class='captionContainer'>
                                    <div class='caption'>
                                        <?= $i['caption']; ?>
                                    </div>
                                </div><?
                                if (!$season) {
                                    ?></a><?
                                }
                            }
                        }
                        if($child_video){ 
                            ?><div class='video'>
                                <?= $child_video; ?>
                            <div><?
                        }
                    ?></div><?
                }        
            ?></div>
        </div>
    </main>
    <aside class="season-children-container">
        <div class = 'list-child'>
            <a class="list-child-link" href = '<?= $url; ?>'>
                Season <?= $season['name1']; ?>
            </a>
        </div><?
        if($season_media){
            foreach($season_media as $m) {
                ?><div class = 'list-child'>
                    <img class="list-child-link" src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
                    <!-- 
                    <div class='captionContainer'>
                        <div class='caption'>
                            <?= $m['caption']; ?>
                        </div>
                    </div> 
                    -->
                </div><?
            }
        }
        if ($season_children) {
            foreach($season_children as $child){
                $title = $child['name1'];
                // $url = implode('/', $uri) .'/'. $child['url'];
                $url = $season_url .'/'. $child['url'];
                ?><div class = 'list-child'>
                    <a class="list-child-link" href = '<?= $url; ?>'><? 
                        ?><h1><?= $title; ?></h1>
                    </a>
                </div><?
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
