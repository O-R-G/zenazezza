<?
$name = $item['name1'];
$deck = $item['deck'];
$body = $item['body'];
$notes = $item['notes'];
$date = $item['begin'];
$media = $oo->media($item['id']);
$find = '/<div><br><\/div>/';
$replace = '';
$body = preg_replace($find, $replace, $body); 

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
            ?></div>
        </div>
    </main>
</div>
<!--
<script type="text/javascript" src="/static/js/screenfull.min.js"></script>
<script type="text/javascript" src="/static/js/windowfull.js"></script>
<script>
    var imgs = document.querySelectorAll('img,video');
    var i;
    var index;
    for (i = 0; i < imgs.length; i++) {
        if (screenfull.isEnabled) {
            imgs[i].addEventListener('click', function () {
                screenfull.toggle(this);
            }, false);
        } else {
            imgs[i].addEventListener('click', function () {
                windowfull.toggle(this);
            }, false);
        }
    }
</script>
-->
