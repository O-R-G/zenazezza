<?
$db = db_connect("main");
// $browse_url = $admin_path.'browse/'.$uu->urls();

$vars = array("name1", "deck", "body", "notes",  "url", "rank", "begin", "end");

// $var_info = array();

// $var_info["input-type"] = array();
// $var_info["input-type"]["name1"] = "text";
// $var_info["input-type"]["deck"] = "textarea";
// $var_info["input-type"]["body"] = "textarea";
// $var_info["input-type"]["notes"] = "textarea";
// $var_info["input-type"]["begin"] = "text";
// $var_info["input-type"]["end"] = "text";
// $var_info["input-type"]["url"] = "text";
// $var_info["input-type"]["rank"] = "text";

// $var_info["label"] = array();
// $var_info["label"]["name1"] = "Name";
// $var_info["label"]["deck"] = "Synopsis";
// $var_info["label"]["body"] = "Detail";
// $var_info["label"]["notes"] = "Notes";
// $var_info["label"]["begin"] = "Begin";
// $var_info["label"]["end"] = "End";
// $var_info["label"]["url"] = "URL Slug";
// $var_info["label"]["rank"] = "Rank";

// global $db;
// if(!is_numeric($id))
// 	throw new Exception('id not numeric.');
// $sql = "SELECT id FROM objects WHERE url = 'temp_url'";


// $res = $db->query($sql);
// if(!$res)
// 	throw new Exception("I can't read German: " . $db->error);
// if($res->num_rows == 0)
// 	return NULL;
// $nourl_ids = $res->fetch_assoc();
// $res->close();
// var_dump($nourl_ids);
// die();

$fields = array("objects.*");
$tables = array("objects");
$where	= array("objects.active = '1'", "objects.url = 'temp_url'");
$order 	= array("objects.rank", "objects.begin", "objects.end", "objects.name1");
/* exception for ICA, applies globally */
// $order 	= array("objects.rank", "objects.modified DESC", "objects.end", "objects.begin", "objects.name1");

$nourl = $oo->get_all($fields, $tables, $where, $order);



// return false if object not updated,
// else, return true
function update_object(&$old, &$new, $siblings, $vars)
{
	global $oo;

	// set default name if no name given
	if(!$new['name1'])
		$new['name1'] = "untitled";

	// add a sort of url break statement for urls that are already in existence
	// (and potentially violate our new rules?)
    // urldecode() is for query strings, ' ' -> '+'
    // rawurldecode() is for urls, ' ' -> '%20'
	$url_updated = rawurldecode($old['url']) != $new['url'];

	if($url_updated)
	{
		// slug-ify url
		if($new['url'])
			$new['url'] = slug($new['url']);

		// if the slugified url is empty,
		// or the original url field is empty,
		// slugify the name of the object
		if(empty($new['url']))
			$new['url'] = slug($new['name1']);

		// make sure url doesn't clash with urls of siblings

		$s_urls = array();
		foreach($siblings as $s_id)
			$s_urls[] = $oo->get($s_id)['url'];

		$new['url'] = valid_url($new['url'], strval($old['id']), $s_urls);
	}
	// deal with dates
	if(!empty($new['begin']))
	{
		$dt = strtotime($new['begin']);
		$new['begin'] = date($oo::MYSQL_DATE_FMT, $dt);
	}

	if(!empty($new['end']))
	{
		$dt = strtotime($new['end']);
		$new['end'] = date($oo::MYSQL_DATE_FMT, $dt);
	}

	// check for differences
	$arr = array();
	foreach($vars as $v)
		if($old[$v] != $new[$v])
			$arr[$v] = $new[$v] ?  "'".$new[$v]."'" : "null";

	$updated = false;
	if(!empty($arr))
	{
		$updated = $oo->update($old['id'], $arr);
	}

	return $updated;
}

foreach($nourl as $item)
{
	
	$new_url = slug($item['name1']);
	$new_n = $item;

	$new_n['url'] = $new_url;

	foreach($vars as $var)
	{
		$new_n[$var] = addslashes($new_n[$var]);
		$item[$var] = addslashes($item[$var]);
	}

	$siblings = $oo->siblings($item['id']);
	$updated = update_object($item, $new_n, $siblings, $vars);

	// break;
}
die();
