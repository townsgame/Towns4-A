<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/memory.php

   Tento soubor slouží ke správě paměti sezení - tabulka [mpx]memory, (Towns nepoužívá PHP session, ale má vlastní systém).
*/
//==============================




define('memory_time',3600*5);
//================================================SESSIONSTART

//session_cache_expire(9999);
//session_start();
//if($_GET['s']){$ssid=$_GET['s'];}else{$ssid=rand(10000,99999);}
if($_COOKIE['TOWNSSESSID']){$ssid=$_COOKIE['TOWNSSESSID'];}else{$ssid=rand(10000,99999);setcookie("TOWNSSESSID", $ssid);}
define('ssid',$ssid);
//$GLOBALS['ss']=$_SESSION['ss'];
$GLOBALS['ss']=array();
foreach(sql_array('SELECT `key`, `value` FROM [mpx]memory WHERE id=\''.ssid.'\'') as $row){
    list($key,$value)=$row;
    $GLOBALS['ss'][$key]=unserialize($value);
}
t("memory_load");
$GLOBALS['ss_']=$GLOBALS['ss'];
//unset($_SESSION['ss']);
//print_r($GLOBALS['ss']);
//---------------------------------
function exit2($e=false){
	//echo('exit2');
	if($e)echo($e);
	//print_r($GLOBALS['ss']);
	$values='';$tmp='';
	foreach($GLOBALS['ss'] as $key=>$value){
	    
	    if($GLOBALS['ss_'][$key]!=$value){
	       if(!is_object($value)){
                $value=addslashes(serialize($value));
                //if(strlen($value)>7000)$value=serialize('');
                if($value)$values.=$tmp."('".ssid."','$key','".($value)."','".time()."')";
                $tmp=',';
            }
        }
	}
	$deletes='';$tmp='';
	foreach($GLOBALS['ss_'] as $key=>$value){    
	    if($GLOBALS['ss'][$key]!=$value){
            $deletes=$deletes.$tmp." `key`='$key' ";
            $tmp='OR';
        }
	}
	//echo($values);
    sql_query('CREATE TABLE IF NOT EXISTS `[mpx]memory` (
                 `id` int(11) NOT NULL,
                 `key` varchar(100) COLLATE utf8_czech_ci NOT NULL,
                 `value` text COLLATE utf8_czech_ci NOT NULL,
                 `time` int(11) NOT NULL,
                 UNIQUE KEY `id` (`id`,`key`),
                 KEY `time` (`time`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;');
    if($deletes)sql_query('DELETE FROM [mpx]memory WHERE (`id`=\''.ssid.'\' AND ('.$deletes.')) OR `time`<'.(time()-memory_time));
    if($values)sql_query('INSERT INTO [mpx]memory (`id`, `key`, `value`, `time`) VALUES '.$values.';');	
	//mysql_close();
	//$_SESSION['ss']=$GLOBALS['ss'];
	t("memory_save");
	exit;
}
//================================================
//GRM413
?>
