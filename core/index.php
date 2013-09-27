<?php
//test


//try {
//===============================================================================
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
ini_set("register_globals","off");
ini_set("display_errors","on");
//===============================================================================INC
//error_reporting(E_ALL);
//print_r($_SERVER);
//print_r($_GET);
//parse_str($_SERVER['REDIRECT_QUERY_STRING'], $_GET);
//parse_str($_SERVER['REDIRECT_REQUEST_METHOD'], $_POST);

$tmp=$_SERVER["REQUEST_URI"];



if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
$uri=explode('/',$tmp);
//print_r($uri);
$admin=false;$debug=false;$speciale=false;
foreach($uri as $x){if($x){if($x!='admin' AND $x!='debug' AND substr($x,0,1)!='-'){$world=$x;}elseif($x=='admin'){$admin=true;}elseif($x=='debug'){$debug=true;}else{$speciale=true;$GLOBALS['url_param']=substr($x,1);}}}
//die($world);


$GLOBALS['inc']['urld']=str_replace('[world]',$GLOBALS['inc']['world'],$GLOBALS['inc']['url']);
$GLOBALS['inc']['url']=str_replace('[world]',$world,$GLOBALS['inc']['url']);
if(!$world/**/ or str_replace(array('.','?'),'',$world)!=$world){header('Location: '.$GLOBALS['inc']['urld']);exit;}
//$tmp=$_SERVER["REQUEST_URI"];
//if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));

$gooduri=str_replace('/'.'/','',$GLOBALS['inc']['url']);
$gooduri=substr($gooduri,strpos($gooduri,'/'));
//die($gooduri);
if(!$admin and !$debug and !$speciale)if($tmp!=$gooduri){header('Location: '.$GLOBALS['inc']['url']);exit;}

$GLOBALS['inc']['world']=$world;
//$GLOBALS['inc']['url']=str_replace('[world]',$world,$GLOBALS['inc']['url']);
define('core',$GLOBALS['inc']['core']);
define('base',$GLOBALS['inc']['base']);

if(!$debug)define('debug',0);

if(!$admin){
	//TO JE DOLE
	/*if(substr(core,-4)!='.php'){
   	require(core.'/index.php');
	}else{
   	require(core);
	}*/
}else{
   eval("r"."equire(\$GLOBALS['inc']['app'].'/admin/index.php');");
   exit;
}





//===============================================================================
//if($_GET["e"])$_GET['e']=$_GET["e"];
list($GLOBALS['url_param'])=explode('#',$GLOBALS['url_param']);

//===============================================================================
define("timeplan",false);
define("timestart", time()+microtime());
function t($text=""){if(timeplan and debug){
$text=htmlspecialchars(round(time()+microtime()-timestart,2)." - ".$text);
echo("$text<br/>");}}
t('start');
//--------------------------------------------
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
define("root", "");
//--------------------------------------------
require(root.core."/func_vals.php");
require(root.core."/func_object.php");
require(root.core."/func_main.php");
require(root.core."/memory.php");


//error_reporting(E_ALL);
//exit(ini_get("register_globals"));
//try {
//define("url","http://localhost/4/");
//define("notmp",1);
//--------------------------------------------
if(!$GLOBALS['ss']["ww"])$GLOBALS['ss']["ww"]=1;
//--------------------------------------------
//if(w!=$GLOBALS['ss']["worldsession"]){session_destroy();$GLOBALS['ss']["worldsession"]=w;}
//--------------------------------------------

//define("mapsize",50);
//$GLOBALS['ss']["url"]=url;//"http://localhost/towns4/";
if($_GET['e']!='-export')require(root.core."/output.php");

require(root.core."/func.php");
require(root.core."/func_core.php");

//--------------------------------------------

require(root.core."/login/func_core.php");
require(root.core."/create/func_core.php");
require(root.core."/attack/func_core.php");
require(root.core."/text/func_core.php");
require(root.core."/hold/func_core.php");
//die('hovno');
//--------------------------------------------
define("single", true);
//--------------------------------------------
//------------------------------------------------------------------
if(defined('service'))die('{world_in_service}');
//------------------------------------------------------------------
//die(url);
$GLOBALS['ss']["url"]=url;
//require("control/cron.php");
t("start");
//------------
//if($GLOBALS['get']["session_destroy"]){session_destroy();}
//------------------------------
if(!$GLOBALS['ss']["useid"])$GLOBALS['ss']["useid"]=$GLOBALS['ss']["logid"];
define("useid", $GLOBALS['ss']["useid"]);
define("logid", $GLOBALS['ss']["logid"]);
//if($GLOBALS['ss']["logid"] and $GLOBALS['ss']["useid"]){
//if(!$GLOBALS['ss']["log_object"]->loaded/* or !$GLOBALS['ss']["use_object"]->loaded*/){session_destroy();refresh();}}
//------------------------------------------------------------------QUERY
if($_GET["q"]){$q=($_GET["q"]);}
//if($GLOBALS['get']["query"]){$q=($GLOBALS['get']["query"]);}
if($q){
    $q=valsintext($q,$_POST,true);
    $q=valsintext($q,$_GET,true);
    if(!$post["login_permanent"])r($q);
    xquery($q);
    
    //xreport();
}
//r('set0'.$GLOBALS['ss']["use_object"]->x.','.$GLOBALS['ss']["use_object"]->y);
//r($GLOBALS['config']);
//------------------------------------------------------------------FBLOGIN -> REDIRECT
if($GLOBALS['url_param']=='fblogin'){
    //echo('aaa');
    eval(subpage_('login-fb_redirect'));
    //echo('ddd');
}
if($GLOBALS['ss']['fbid']){
    eval(subpage_('login-fb_process'));
}
//print_r($GLOBALS['get']);
if($GLOBALS['get']['fb_select_id'] and $GLOBALS['get']['fb_select_key']){
    //e($GLOBALS['get']['fb_select_id'].$GLOBALS['get']['fb_select_key']);
    xquery('login',$GLOBALS['get']['fb_select_id'],'facebook',$GLOBALS['get']['fb_select_key']);
}
//--------------------------------------------
//r($_COOKIE);
//r($post);
if(!logged() and $_COOKIE["towns_login_username"] and !$GLOBALS['get']["logout"]){
    xquery("login",$_COOKIE["towns_login_username"],$_COOKIE["towns_login_password"]);
}
if(logged() and !useid){//e('log1');
    if($post["login_permanent"]){//e('log2');
      setcookie('towns_login_username',$post["login_username"],cookietime);
      setcookie('towns_login_password',$post["login_password"],cookietime);
      //die('ahoj');
    }
    reloc();
    //refresh("page=main");
}
//---------------------------------------------------------------------------------------------
if(logged() and $_GET['e']!="none"/**/){//Udělat přímo VVV
    //r("t");
    t("xxx");
    $info=xquery("info");//Udělat přímo přes OBJECT
    t("xxx");
    //r("t");
    $info["func"]=new func($info["func"]);
    $funcs=$info["func"]->vals2list();
    $support=$info["support"];
    $tasks=csv2array($info["tasks"]);
    //r($tasks);
    $info["set"]=new set($info["set"]);
    $info["profile"]=new profile($info["profile"]);
    $info["hold"]=new hold($info["hold"]);

    //------------------
    $info2=xquery("info","log");//Udělat přímo přes OBJECT
    //print_r($info2);
    $info2["func"]=new func($info2["func"]);
    $info2["set"]=new set($info2["set"]);
    $info2["profile"]=new profile($info2["profile"]);
    $info2["hold"]=new hold($info2["hold"]);
    //r($info2["own2"]);
    //$info2["own2"]=xx2x($info2["own2"]);
    //r($info2["own2"]);
    $in2=xquery("items");
    $in2=$in2["items"];
    $in2=csv2array($in2);
    //r($in2);
        $own2=csv2array($info2["own2"]);
    //r($own2);
    //print_r($own2);
    if(!$GLOBALS['ss']["useid"]){$GLOBALS['ss']["useid"]=$info["id"];}
    if(!$GLOBALS['ss']["logid"]){$GLOBALS['ss']["logid"]=$info2["id"];}
}
//-------------------------------RESETS
if($_GET["resetwindow"]){
    $GLOBALS['ss']["log_object"]->set->delete("interface");
    reloc();
}
if($_GET["resetmemory"]){
    sql_query('DROP TABLE [mpx]memory');
    reloc();
}
//------------------------------------NOPASSWORD
    $nofb=true;
    $nopass=true;
    foreach(sql_array('SELECT `method`,`key` FROM `[mpx]login` WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\'') as $row){
        list($method,$key)=$row;    
        if($key){
            if($method=='towns')$nopass=false;
            if($method=='facebook')$nofb=false;
        }
    }
    define('nofb',$nofb);
    define('nopass',$nopass);
//-----------------------------------WINDOWS
$nwindows=$_GET["i"];
if(logged() and $nwindows){
    //r($nwindows);
	$nwindows=explode(";",$nwindows);
	foreach($nwindows as $nwindow){if($nwindow){
		list($w_name,$w_content,$w_x,$w_y)=explode(",",$nwindow);
		//r($w_name);
		$interface=xx2x($GLOBALS['ss']["log_object"]->set->val("interface"));
        $interface=new windows($interface);
        list($ow_content,$ow_x,$ow_y)=explode(",",$interface->val($w_name));
        if(!$w_content)$w_content=$ow_content;
        if(!$w_x)$w_x=$ow_x;
        if(!$w_y)$w_y=$ow_y;
        $nwindow="$w_content,$w_x,$w_y";
        //r($interface->val($w_name));
        if($w_content!="none"){
            $interface->add($w_name,$nwindow);
        }else{
            $interface->delete($w_name);
        }
        //r($interface->val($w_name));
        $interface=$interface->vals2str($interface);
        $interface=str_replace(nln,"",$interface);
        //echo(nl2br($interface));
        $GLOBALS['ss']["log_object"]->set->add("interface",x2xx($interface));
	}}
}
//-------------------------------SET
//r('set2'.$GLOBALS['ss']["use_object"]->x.','.$GLOBALS['ss']["use_object"]->y);
$nsets=$_GET["set"];
if(logged() and $nsets){
    //r($nwindows);
	$nsets=explode(";",$nsets);
	foreach($nsets as $nset){if($nset){
		list($s_key,$s_value)=explode(",",$nset);
		//r($w_name);
		$set=xx2x($GLOBALS['ss']["use_object"]->set->val("set"));
        $set=new windows($set);
        $ss_value=$set->val($s_key);
        if(!$s_value)$s_value=$ss_value;
        $nset=$s_value;
        //r($interface->val($w_name));
        if($s_value!="none"){
            $set->add($s_key,$nset);
        }else{
            $set->delete($s_key);
        }
        //r($interface->val($w_name));
        $set=$set->vals2str();//$interface
        $set=str_replace(nln,"",$set);
        //echo(nl2br($interface));
        $GLOBALS['ss']["use_object"]->set->add("set",x2xx($set));
	}}
}
//r($GLOBALS['ss']["use_object"]->id);
if(logged() and $_GET['e']!="none"/**/){$settings=str2list(xx2x($GLOBALS['ss']["use_object"]->set->val("set")));
$GLOBALS['settings']=$settings;}
//r($settings);
//-------------------------------
$lang=$GLOBALS['ss']["lang"];
	if(!$lang){
		//echo($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            //list($tmp)=explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']); 
	    $tmp=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
            $tmp=strtolower($tmp);
		//echo($tmp);
            if($tmp=='en'){
                $lang='en';
            }elseif($tmp=='cs'){
                $lang='cz';
            }else{
                $lang=lang;
            }
            
            
            
            
            
        }
	if($GLOBALS['get']["lang"]){$lang=$GLOBALS['get']["lang"];}
	$GLOBALS['ss']["lang"]=$lang; 
//-------------------------------
//r('set3'.$GLOBALS['ss']["use_object"]->x.','.$GLOBALS['ss']["use_object"]->y);
t("before content");
if($_GET['e']){
	if(logged() or $_GET['e']=='map_units' or substr($_GET['e'],0,6)=='login-' or $_GET['e']=='help' or  substr($_GET['e'],0,5)=='text-' or  substr($_GET['e'],0,12)=='plus-paypal-'){
	    //if($_GET["ee"]){$e=$_GET["ee"];}else{$e=$_GET['e'];}
	    $e=$_GET['e'];
	    define("subpage", $e);
	
	    //echo($e);
	    list($dir,$e)=explode('-',$e,2);
	    //echo($dir.','.$e);
	    $e=str_replace('-','/',$e);
	    if(!$e){$e=$dir;$dir='page';}
	    if($e!="none")require(core."/$dir/".$e.".php");
    }else{
    	refresh();
    }
}else{
    define("subpage", false);
    require(core."/html.php");
}


if(logged() and $_GET['e']!="none"/**/){
$GLOBALS['ss']["log_object"]->update();
$GLOBALS['ss']["use_object"]->update();
$GLOBALS['ss']["aac_object"]->update();

unset($GLOBALS['ss']["log_object"]);
unset($GLOBALS['ss']["use_object"]);
unset($GLOBALS['ss']["aac_object"]);
}
//die2();
//cleartmp(1);
if($endshow){echo($endshow);}
//================================================SESSIONEND

//================================================
//echo(contentlang("abc{nature}sdf{nature}saddsd{0}sdfzsdg{nature}"));
t("end");
exit2();
//---------------------------------------------
//} catch (Exception $e) {
//    echo 'Caught exception: ',  $e->getMessage(), "\n";
//}
//===============================================================================CATCH
/*}catch(Exception $e){
    echo(''.$e->getMessage().'<br>');
}*/
?>
