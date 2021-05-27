<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$time = date('Y-m-d g:i:s A');
$media = $oo->media($item['id']);
shuffle($media);

?><div id='fullwindow'>
    <div id='x'><img src='/media/svg/x-6-k.svg'></div>
</div>
<section id="main" class = 'home'>
    <div id='content'><? 
        foreach ($media as $m) {
            $width = rand(25, 50);
            $margin = rand(10, 100);
            $float = ((bool)rand(0,1)) ? 'left' : 'right';
            $style = 'width:' . $width . '%; margin:' . $margin . 'px;' . ' float:' . $float . ';';
            ?><div class='thumbsContainer' style="<?= $style; ?>">
                <img src = '<?= m_url($m); ?>' alt = '<?= $m['caption']; ?>'>
                <div class='captionContainer'>
                    <div class='caption euler'>
                        <?= $m['caption']; ?>
                    </div>                
                </div>
            </div><?
        }
    ?></div>
</section>
<div class='time caption'>
    <?= $time; ?>
</div>
<div class='social'>
    <a href='https://www.facebook.com/zenazezzaprojects' target='new'><img windowfullDisabled='1' src='media/facebook.gif'></a>
    <a href='https://twitter.com/zenazezza' target='new'><img windowfullDisabled='1' src='media/twitter.gif'></a>&nbsp;
    <a href='http://instagram.com/zenazezza' target='new'><img windowfullDisabled='1' src='media/instagram.gif'></a>
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
