<?
$uri = explode('/', $_SERVER['REQUEST_URI']);

require_once("views/head.php");
if(!$uri[1])
    require_once("views/home.php");
elseif($uri[1] == 'seasons')
	require_once("views/seasons.php");
elseif($uri[1] == 'support')
	require_once("views/support.php");
/*    
// does not exist but should have a fallback here
else
	require_once("views/main.php");
*/
require_once("views/foot.php");
?>
