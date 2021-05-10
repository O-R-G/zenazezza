<?
$uri = explode('/', $_SERVER['REQUEST_URI']);

require_once("views/head.php");
if(!$uri[1])
    require_once("views/home.php");
elseif($uri[1] == 'seasons')
	require_once("views/seasons.php");
else
	require_once("views/main.php");
require_once("views/foot.php");
?>
