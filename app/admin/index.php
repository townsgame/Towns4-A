<?php
//session_cache_expire(9999);
//session_start();
if(!function_exists('t')){function t($tmp){}}
if(!function_exists('require2')){function require2($url){require(root.core.'/'.$url);}}
if(!function_exists('require2_once')){function require2_once($url){require_once(root.core.'/'.$url);}}
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
define("timestart", time()+microtime());
define("root", "");
define("adminroot", "app/admin/");
//define("root", "../../");
//define("core",core);
//require(root.'inc.php');
$dir=root.'world';
if(!file_exists($dir)){mkdir($dir);chmod($dir,0777);}

$worldfile=root.'world/'.$GLOBALS['inc']['world'].'.txt';
if(file_exists($worldfile)){
require2("func_vals.php");
require2("func_object.php");
require2("func_main.php");
require2("memory.php");
}

ini_set("max_execution_time","1000");
ini_set('memory_limit','128M');
//-----------------------------------
if($_POST['changeworld']){
   $GLOBALS['ss']["ww"]=intval($_POST['changeworld']);
}
if(!$GLOBALS['ss']["ww"])$GLOBALS['ss']["ww"]=1;
//-----------------------------------
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Towns4Admin</title>
<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
body {
	background-color: #FFFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #000000;
}
a:active {
	color: #000000;
}
-->
</style></head>
<body>

<?php
//=============================================================================
if(file_exists(adminroot.'password')){
//echo('('.file_get_contents('password').')');
if($_POST["password_new"]){
	if($_POST["password_new"]==trim(file_get_contents(adminroot.'password'))){
		$GLOBALS['ss']["logged_new"]=true;
	}else{
		echo("Nesprávné heslo!<br/>");
		//echo($_POST["password_new"].'-'.file_get_contents(adminroot.'password'));
	}
}
if($_GET["logout"]){/*$GLOBALS['ss']=array();*/$GLOBALS['ss']["logged_new"]=false;}
if($GLOBALS['ss']["logged_new"]!=true){
?>
<form name="login" method="POST" action="?">
<b>Heslo:</b><input type="password" name="password_new" value="" />
<input type="submit" value="OK" />
</form>
<?php
exit2();
}
}
//=============================================================================
//if($_GET["world"])$GLOBALS['ss']["world"]=$_GET["world"];
//if($GLOBALS['ss']["world"]){
	define("nodie",1);	
	//define("w", $GLOBALS['ss']["world"]);
	if(file_exists($worldfile)){require2("func.php");require2_once("func_components.php");}
	$GLOBALS['ss']["url"]=url;
//}
//----------------
if($_GET["page"])$GLOBALS['ss']["page"]=$_GET["page"];
if($_POST["page"])$GLOBALS['ss']["page"]=$_POST["page"];
//--------------------------------------------
?>
<table width="100%" height="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
  <tr>
    <td width="150" align="left" valign="top" bgcolor="#C0C6D9">

<strong>Towns4Admin</strong> <br>
<?php echo(ssid.'@'.w); ?> <br>
<a href="?">Obnovit</a><br> 
<a href="?logout=1">Odhlásit se</a><br>
<?php
$tmp=$_SERVER["REQUEST_URI"];
if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
$tmp=str_replace('admin','',$tmp);
?>
<a href="<?php echo($tmp); ?>">Hrát</a>
<hr/>
<?php
foreach(glob(root.'world/*txt') as $world){
	$world=basename($world,".txt");
	if($world==w/*$GLOBALS['ss']["world"]*/){
		echo('<b>'.$world.'</b>');
	}else{
		echo('<a href="'.str_replace(w,$world,$_SERVER["REQUEST_URI"]).'">'.$world.'</a>');
	}
	echo('<br>');
}
?>
<hr/>
<form id="changeworld" name="login" method="POST" action="?page=<?php echo($GLOBALS['ss']["page"]); ?>">
Podsvět:<br>
<?php input_text("changeworld",$GLOBALS['ss']["ww"],NULL,4); ?>
<input type="submit" value="OK" />
</form>
<hr/>

<?php
$links=array(
'none'=>'Úvod',
'adminer'=>'Adminer',
'config'=>'Config',
'object'=>'Object',
'createuser'=>'CreateUser',
'patchmap'=>'PatchMap',
'createunique'=>'CreateUnique',
'showunique'=>'ShowUnique',
'createimg'=>'CreateImg',
'createmap'=>'CreateMap',
'createtmp'=>'CreateTmp',
'createglob'=>'CreateGlob',
'createworld'=>'CreateWorld',
'deleteworld'=>'DeleteWorld',
'deletetmp'=>'DeleteTmp',
/*'setdefault'=>'SetDefault',*/
'export'=>'Export',
'import'=>'Import',
'sync'=>'Sync');
foreach($links as $key=>$value){
	if($key==$GLOBALS['ss']["page"] or ($key=='none' and ''==$GLOBALS['ss']["page"])){
		echo('<b>'.$value.'</b>');
	}else{
		echo('<a href="?page='.$key.'">'.$value.'</a>');
	}
	if($key=='adminer')echo('<a href="../'.$GLOBALS['inc']['app'].'/adminer" target="_blank">(W)</a>');
	echo('<br>');
}
?>	</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">
	
<div style="width:100%;height:100%;overflow:scroll;">
        <?php 


if($GLOBALS['ss']["page"] and $GLOBALS['ss']["page"]!='none' and (defined('w') or $GLOBALS['ss']["page"]=='createworld' or $GLOBALS['ss']["page"]=='res')){
include("page/".$GLOBALS['ss']["page"].".php");
}else{
?>
<h3>Towns4Admin</h3>
Administrační prostředí hry Towns4<br/>
<br/>
<b>Upozornění: </b>Není vhodné používat Towns4Admin a Towns4 na stejném sezení.<br/>
  <?php } ?>	
</div></td>
  </tr>
</table>

</body>
</html>
<?php
exit2();
?>
