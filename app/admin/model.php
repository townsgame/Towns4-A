<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
session_start();
$nocontroling = 1;
//$root = "../";
//require("../funkce.php");
require("model_funkce.php");
//---------------------------------------------------------------------------------
$res=$GLOBALS['ss']["res"];//$_GET["model"];
if($_POST["model"]){$res=$_POST["model"];}
$s=$_GET["size"];
$rot=$_GET["rotation"];
$slnko=$_GET["sun"];
$zburane=$_GET["zburane"];
$hore=$_GET["hore"];
$noln=$_GET["noln"];
if(!$slnko){$slnko=1;}
if(!$rot){$rot=0;}
if($noln==1){$ln=0;}
if(!$noln){$ln=1;}
if(!$res){$res="qw";}
if(!$s){$s=1;}
//---------------------------------------------------------------------------------
//$res=hnet("towns3_models","SELECT res FROM towns3_models WHERE meno='".$res."' AND hrac='1'");
//if(!$res){$res=$_GET["model"];}


model($res,$s,$rot,$slnko,$ln,$zburane,$hore);


header("Cache-Control: max-age=3600");
header("Content-type: image/png");
ImagePng($GLOBALS['ss']["im"]/*,$file*/);
ImageDestroy($GLOBALS['ss']["im"]);
?>
