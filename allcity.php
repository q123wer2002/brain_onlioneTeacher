<?php
define('allcity_page',true);
require_once(dirname(__FILE__)."/f/global.php");
include_once(ROOT_PATH."data/all_area.php");

if($webdb[Info_allcityType]==1){
	$query = $db->query("SELECT * FROM {$_pre}city ORDER BY letter ASC,list DESC");
	while($rs = $db->fetch_array($query)){
		$listdb[$rs[letter]][]=$rs;
	}
}

//SEO
$titleDB[title] = $city_DB[metaT][$city_id]?$city_DB[metaT][$city_id]:"{$city_DB[name][$city_id]} $webdb[webname]";
$titleDB[keywords]	= $city_DB[metaK][$city_id]?$city_DB[metaK][$city_id]:$webdb[metakeywords];
$titleDB[description] = $city_DB[metaD][$city_id]?$city_DB[metaD][$city_id]:$webdb[description];

require(Mpath."inc/head.php");
require(html("allcity"));
require(Mpath."inc/foot.php");
?>