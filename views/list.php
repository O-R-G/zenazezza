<? 

	$children = $oo->children($item['id']);

?>
<div id="layout-container">
<main id="main" class = 'list-container'>
	<? foreach($children as $child){
		if(substr($child['name1'], 0, 1) != '.')
		{
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
	} ?>
</main>
</div>