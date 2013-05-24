<?php
function export(){
$limit='';
if($_GET['limit'])$limit='LIMIT '.$_GET['limit'];
if($limit)$nln='
';else$nln='';
//------------------
$stream='';
$stream.='<?xml version="1.0" encoding="UTF-8" ?>'.$nln;
$stream.='<world>'.$nln;

//-----------------------------------------CONFIG
$file=(root."world/".w.".txt");
$config=file_get_contents($file);
$config=astream($config,false);
unset($config['debug']);
unset($config['notmpimg']);
unset($config['timeplan']);
unset($config['lem']);
unset($config['url']);
unset($config['cache']);
unset($config['mysql_server']);
unset($config['mysql_user']);
unset($config['mysql_password']);
unset($config['mysql_db']);
unset($config['mysql_prefix']);
unset($config['lang']);
unset($config['password']);
unset($config['master']);
$stream.="<config>".$nln;
foreach($config as $key=>$value){

$stream.="<param key=\"$key\" value=\"$value\"/>".$nln;

}
$stream.="</config>".$nln;
//-----------------------------------------MAP
$stream.="<map>".$nln;
foreach(sql_array('SELECT `x`, `y`, `ww`, `terrain`, `hard`, `name` FROM `[mpx]map` WHERE 1 '.$limit) as $row){
	list($x,$y,$ww,$terrain,$hard,$name)=$row;
	$stream.="<field x=\"$x\" y=\"$y\" ww=\"$ww\" terrain=\"$terrain\" hard=\"$hard\" name=\"$name\"/>".$nln;	
}
$stream.="</map>".$nln;
//-----------------------------------------TEXT
$stream.="<text>".$nln;
foreach(sql_array('SELECT `id`, `idle`, `type`, `new`, `from`, `to`, `title`, `text`, `time`, `timestop` FROM `[mpx]text` WHERE 1 '.$limit) as $row){
	list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop)=$row;
	$text=htmlspecialchars($text);
	$stream.="<row id=\"$id\" idle=\"$idle\" type=\"$type\" new=\"$new\" from=\"$from\" to=\"$to\" title=\"$title\" text=\"$text\" time=\"$time\" timestop=\"$timestop\"/>".$nln;

}
$stream.="</text>".$nln;
//-----------------------------------------LOGIN
$stream.="<login>".$nln;
foreach(sql_array('SELECT `id`, `method`, `key`, `text`, `time_create`, `time_change`, `time_use` FROM `[mpx]text` WHERE 1 '.$limit) as $row){
	list($id, $method, $key, $text, $time_create, $time_change, $time_use)=$row;
	$text=htmlspecialchars($text);
	$stream.="<row id=\"$id\" method=\"$method\" key=\"$key\" text=\"$text\" time_create=\"$time_create\" time_change=\"$time_change\" time_use=\"$time_use\"/>".$nln;

}
$stream.="</login>".$nln;
//-----------------------------------------OBJECTS
foreach(sql_array('SELECT `id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, `in`, `ww`, `x`, `y`, `t` FROM `[mpx]objects` WHERE 1 '.$limit) as $row){
	list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$fc,$func,$hold,$res,$profile,$set,$hard,$own,$in,$ww,$x,$y,$t)=$row;
	$stream.="<object id=\"$id\">".$nln;

	$stream.="<param key=\"name\" value=\"$name\"/>".$nln;
	$stream.="<param key=\"type\" value=\"$type\"/>".$nln;
	$stream.="<param key=\"dev\" value=\"$dev\"/>".$nln;
	$stream.="<param key=\"fs\" value=\"$fs\"/>".$nln;
	$stream.="<param key=\"fp\" value=\"$fp\"/>".$nln;
	$stream.="<param key=\"fr\" value=\"$fr\"/>".$nln;
	$stream.="<param key=\"fx\" value=\"$fx\"/>".$nln;
	$stream.="<param key=\"fc\" value=\"$fc\"/>".$nln;
	$stream.="<param key=\"func\" value=\"$func\"/>".$nln;
	$stream.="<param key=\"hold\" value=\"$hold\"/>".$nln;
	$stream.="<param key=\"res\" value=\"$res\"/>".$nln;
	$stream.="<param key=\"profile\" value=\"$profile\"/>".$nln;
	$stream.="<param key=\"set\" value=\"$set\"/>".$nln;
	$stream.="<param key=\"hard\" value=\"$hard\"/>".$nln;
	$stream.="<param key=\"own\" value=\"$own\"/>".$nln;
	$stream.="<param key=\"in\" value=\"$in\"/>".$nln;
	$stream.="<param key=\"ww\" value=\"$ww\"/>".$nln;
	$stream.="<param key=\"x\" value=\"$x\"/>".$nln;
	$stream.="<param key=\"y\" value=\"$y\"/>".$nln;
	$stream.="<param key=\"t\" value=\"$t\"/>".$nln;

		
	$stream.="</object>".$nln;
	
}

//-----------------------------------------
$stream.='</world>'.$nln;

return($stream);
}
if(defined('password') and $_GET['password']==password){
echo(export());
}
?>
