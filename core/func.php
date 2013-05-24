<?php
require_once(root.core."/func_vals.php");
require_once(root.core."/func_object.php");
require_once(root.core."/func_main.php");
require_once(root.core."/memory.php");
//=============================================================
//(4.5*6+5*6+4.5*6+3*2+5*7+1*2)/(6+6+6+2+7+2)
define("notmp", false);
//define("notmp", true);
if($_GET["output"]=="js"){
    define("noreport", true);
}else{
    define("noreport", false);
}
define("imgext", "jpg");
//$GLOBALS['ss']["useid"]=$GLOBALS['ss']["useid"];
//$GLOBALS['ss']["logid"]=$GLOBALS['ss']["logid"];

//===============================================================================================================
if(!defined('mapsize')){
    $mapsize1=sql_1data('SELECT max(x) FROM [mpx]map WHERE ww=\''.$GLOBALS['ss']["ww"].'\'');
    $mapsize2=sql_1data('SELECT max(y) FROM [mpx]map WHERE ww=\''.$GLOBALS['ss']["ww"].'\'');
    $mapsize1=intval($mapsize1)+1;
    $mapsize2=intval($mapsize2)+1;
    //echo("($mapsize1,$mapsize2)");
    if($mapsize1>$mapsize2){
        $mapsize=$mapsize1;
    }else{
        $mapsize=$mapsize2;
    }
    define('mapsize',$mapsize);
}
//===============================================================================================================
define('cookietime',time()+60*60*24*30*12);
/*if($GLOBALS['ss']["setcookie"] and array()!=$GLOBALS['ss']["setcookie"]){
    print_r($GLOBALS['ss']["setcookie"]);die();
    $t=time()+60*60*24*30;
    foreach($GLOBALS['ss']["setcookie"] as $a=>$b)
    setcookie($a,$b,$t);
}
$GLOBALS['ss']["setcookie"]=array();*/

//=============================================================
function changemap($x,$y,$files=false){
    if($files){
    //r($x.','.$y);
    if(!defined("func_map"))require(root.core."/func_map.php");
    //$gx=(intval(($x-1)/5)*5)+1;
    //$gy=(intval(($y-1)/5)*5)+1;
    //r($gx.",".$gy);
    //$file=tmpfile2("map2,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.$GLOBALS['ss']["ww"],"png","map");e("<img src=\"$file\" width=\"100\"/>");unlink($file);
    
    
    
    //-------------------
    
    //r('changemap');
    //$gx=floor((($y-1)/-10)+(($x-1)/10));
    $gy=floor((($y-1)/10)+(($x-1)/10)-0.5);
    $gx_=round((($y-1)/-10)+(($x-1)/10));
    $gy_=round((($y-1)/10)+(($x-1)/10)-0.5);
    $gs=array(/*array($gx,$gy),array($gx_,$gy),*/array($gx,$gy_),array($gx_,$gy_));
    //r($gx.",".$gy.",".$gx_.",".$gy_);
    $x=round($x);
    $y=round($y);
    
    foreach($gs as $g){list($gx,$gy)=$g;
        //$x=($gy+$gx)*5+1;
        //s$y=($gy-$gx)*5+1;
        //2NOCACHE//$file=tmpfile2("map2,".size.",".zoom.",".$x.",".$y.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.$GLOBALS['ss']["ww"],"png","map");e("<img src=\"$file\" width=\"100\"/>");/**/unlink2($file);
        //---      
        //r("outimgunits,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"]);
        //$file=tmpfile2("outimgunits,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"],"png","map");/*if(debug){e("<img src=\"$file\" width=\"200\"/>");}*/
        //r($gx,$gy);        
        //htmlmap($gx,$gy);
        $file=htmlmap($gx,$gy,2,true);        
        unlink2($file);
        //---
        //NOCACHE//$file=tmpfile2("output6,".root.",$gx,$gy,".$GLOBALS['ss']["ww"],"txt","map");unlink2($file);
    }
    }
    //sql_query("UPDATE `".mpx."map` SET  `hard` =  IF(`terrain`='t1' OR `terrain`='t11',1,0)+(SELECT SUM(`".mpx."objects`. `hard`) FROM `".mpx."objects` WHERE `".mpx."objects`.`ww`=`".mpx."map`.`ww` AND  ROUND(`".mpx."objects`.`x`)=`".mpx."map`.`x` AND ROUND(`".mpx."objects`.`y`)=`".mpx."map`.`y`) WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `x`=$x AND `y`=$y");
}
//------------------------
function hard($rx,$ry,$w=false){
    if(!$w)$w=$GLOBALS['ss']["ww"];
    $hard1=sql_1data("SELECT IF(`terrain`='t1' OR `terrain`='t11',1,0) FROM `".mpx."map`  WHERE `".mpx."map`.`ww`=".$w." AND  `".mpx."map`.`x`=$rx AND `".mpx."map`.`y`=$ry");// WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `x`=$x AND `y`=$y");
    $hard2=sql_1data("SELECT SUM(`".mpx."objects`. `hard`) FROM `".mpx."objects` WHERE `".mpx."objects`.`ww`=".$w." AND  ROUND(`".mpx."objects`.`x`)=$rx AND ROUND(`".mpx."objects`.`y`)=$ry");// WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `x`=$x AND `y`=$y");
    $hard=floatval($hard1)+floatval($hard2);
    return($hard);
}
//======================================================================================
//CONFIG
if($_GET["w"]){
    $GLOBALS['get']=$GLOBALS['ss'][$_GET["w"]];
}
if($GLOBALS['get']){
    $GLOBALS['ss']["get"]=$GLOBALS['get'];
}
//print_r($GLOBALS['ss']["get"]);

function get($key){return($GLOBALS['ss']["get"][$key]);}
//$GLOBALS['ss']["getvars"]=array();
//---------------------------------------------------------
$post=$_POST;
//---------------------------------------------------------
function sg($value,$d=false){
global $$value;
if(!$GLOBALS['ss'][$value])$GLOBALS['ss'][$value]=$d;
if($GLOBALS['ss']["get"][$value]){
    $GLOBALS['ss'][$value]=$GLOBALS['ss']["get"][$value];
}
if($GLOBALS['ss']["get"][$value]==="0"){
    $GLOBALS['ss'][$value]=$d;
}
$$value=$GLOBALS['ss'][$value];
return($GLOBALS['ss'][$value]);
}
//---------------------------------------------------------
/*$i=0;foreach($md5 as $a){
$md5[$i]=hexdec($a);
$i++;}*/
function md52($text){
    $md5=md5($text);
    $md5=str_split($md5,4);
    $count=0;
    foreach($md5 as $a){
        $count=$count+hexdec($a);
    }
    return($count);
}
//---------------------------------------------------------
function md5t($text){
    $md5=md5($text);
    $md5=str_split($md5,4);
    $i=intval(hexdec($md5[0])/(256*256)*100000);
    //echo($i);
    $names=explode(",",$GLOBALS['config']["names"]);
    $i1=mod($i,count($names));
    $i=div($i,count($names));
    $i2=mod($i,count($names));
    $i=div($i,count($names));
    $i=$names[$i1].$names[$i2];//.dechex($i)
    return($i);
    //return($names[$i]);
}
//===================================================URSL, SUBPAGE, WINDOWS
function target($sub,$w="",$ee="",$q,$only=false,$rot="",$noi=false,$prompt='',$set=''){
    //newwindow
    if($q)$q="&q=$q";
    if($w)$w="&w=$w";
    if($rot)$rot="&rot=$rot";
    if(!$ee)$ee=$sub;
    if($set)$set="&set=$set";
    if($prompt)$prompt="pokracovat = confirm('$prompt');if(pokracovat)";
    $apart=("w_open('$sub','$ee','$w$q$set');");
    //oldwindow
    $vi="\$('#loading').css('visibility','visible');";
    $iv="\$('#loading').css('visibility','hidden');";
    if(!$noi){$inter="&i=$sub,$ee";}else{$inter="";}
    $bpart=("\$(function()x{\$.get('?e=$ee$w$q$rot$inter$set', function(vystup)x{\$('#$sub').html(vystup);$iv}x);$vi}x);");
    //-------
    //return("if(getElementById('$sub'))x{alert(1);}x;");
    if(!$only){
        return($prompt."x{if($('#$sub').html())x{1;$bpart}xelsex{1;$apart}x}x");
    }else{
        return($prompt."x{if($('#$sub').html())x{1;$bpart}x}x");
    }
}
//---------------------------------------------------------
function subpage($sub,$ee=""){
    if(!$ee)$ee=$sub;
    list($dir,$ee)=explode('-',$ee);
    if(!$ee){$ee=$dir;$dir='page';}
    $eval='echo("<span id=\"'.$sub.'\">");
    include(core."/'.$dir.'/'.$ee.'.php");
    echo("</span>");';
    return($eval);
    //? ><script><?php echo(target($sub)); ? ></script><?php
}
//---------------------------------------------------------
function subpage_($sub,$ee=""){
    if(!$ee)$ee=$sub;
    list($dir,$ee)=explode('-',$ee);
    if(!$ee){$ee=$dir;$dir='page';}
    $eval='include(core."/'.$dir.'/'.$ee.'.php");';
    return($eval);
    //? ><script><?php echo(target($sub)); ? ></script><?php
}
//---------------------------------------------------------
function subref($sub,$period=false){$period=$period*1000;
if($period){
    ?>
    <script>
    setInterval(function() x{
    <?php echo(target($sub,"","","",true,"",true)); ?>
    }x, <?php echo($period); ?>);
    </script>
    <?php
}else{
    ?>
    <script>
    <?php echo(target($sub,"","","",true,"",true)); ?>
    </script>
    <?php
}
}
//---------------------------------------------------------
function subjs($sub){
    if(!$ee)$ee=$sub;
    list($dir,$ee)=explode('-',$ee);
    if(!$ee){$ee=$dir;$dir='page';}
     ob_start();
     include(core.'/'.$dir.'/'.$ee.'.php');
     $stream = ob_get_contents();
     ob_end_clean();
     echo('$("#'.$sub.'").html("'.addslashes($stream).'");');
}
//---------------------------------------------------------
function urlr($tmp){//$tmpx="&amp;tmp=".$tmp;$tmpxx="&tmp=".$tmp;
    //r($tmp);
    if(str_replace("http://","",$tmp)==$tmp){
        if(logged()){
            //echo("rand");
            $md5=md52(session_id().$tmp);
        }else{
            $md5=md52($tmp);
        }
        $GLOBALS['ss'][$md5]=array();
        $tmp=explode(";",$tmp);
        foreach($tmp as $row){
            list($a,$b)=explode("=",$row);
            $GLOBALS['ss'][$md5][$a]=$b;
        }
        $e=$GLOBALS['ss'][$md5]["e"];
        $q=$GLOBALS['ss'][$md5]["q"];$qq=$q;
        $ee=$GLOBALS['ss'][$md5]["ee"];
        $js=$GLOBALS['ss'][$md5]["js"];
        $ref=$GLOBALS['ss'][$md5]["ref"];
        $rot=$GLOBALS['ss'][$md5]["rot"];
        $i=$GLOBALS['ss'][$md5]["i"];
        $set=$GLOBALS['ss'][$md5]["set"];
        if($q){$q="&amp;q=$q";}else{$q="";}
        if($rot){$rot="&amp;rot=$rot";}else{$rot="";}
        if($i){$i="&amp;i=$i";}else{$i="";}
        if($set){$set="&amp;set=$set";}else{$set="";}
        if(!$prompt)$prompt='';        
        if(!$e and !$js  and !$ref){
            //r("outling(!$e and !$js  and !$ref)");
            return(/*$GLOBALS['ss']["url"]*/url."?w=".$md5.$q.$rot.$i.$set);//.$tmpx
        }else{
            if($e=="s"){$e=$GLOBALS['ss']["page"];}
            if($ee=="s"){$ee=$GLOBALS['ss']["page"];}
            if($js)$js=xx2x($js).";";
            $js=str_replace("[semicolon]",";",$js);
            $rot=$GLOBALS['ss'][$md5]["rot"];
            $noi=$GLOBALS['ss'][$md5]["noi"];
            $prompt=$GLOBALS['ss'][$md5]["prompt"];
            $set=$GLOBALS['ss'][$md5]["set"];
            //r($GLOBALS['ss'][$md5]);
            if($e)$js=$js.target($e,$md5,$ee,$qq,false,$rot,$noi,$prompt,$set);//.$tmpxx
            if($ref)$js=$js.target($ref);
            return("javascript: ".($js));//addslashes
        }
    }else{
        return($tmp);
    }
}
//------------------------
function url($tmp){
    echo(urlr($tmp));
}
//------------------------
function urlx($url){
    $url=urlr($url);
    //r('urlx: '.$url);
    if(strpos($url,'javascript:')!==false){
        $url=str_replace('javascript:', '', $url);
        $url=trim($url);
        e('<script>'.$url.'</script>');
        exit2();
    }
}
//------------------------
function js2($js){
	return("js=".x2xx($js));
}
//======================================================================================
/*function file2hex($file){
    $string=file_get_contents($file);
    $hex='';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}*/
//======================================================================================
function logged(){
    if($GLOBALS['ss']["logid"]){
        return(true);
    }else{
        return(false);
    }
}
define("logged",logged());
//===============================================================================================================
function short($text,$len){
    //r($text);
    if(substr($text,0,1)=='{')$text=contentlang($text);
    $text2=substr($text,0,$len-3);
    if($text!=$text2){$text2=$text2."...";}
    return($text2);
}
function shortx($text,$len){
    //r($text);
    if(substr($text,0,1)=='{')$text=contentlang($text);
    $text2=substr($text,0,$len);
    return($text2);
}
//===============================================================================================================
function substr2($input,$a,$b,$i=0,$change=false,$startstop=true){if(rr()){echo("<br/>substr2($input,$a,$b,$i,$change)<br/>");echo($input);}
            if(!$startstop){
                $start=strlen($a);
                $stop=strlen($b); 
            }else{
                $start=0;
                $stop=0;
            }
    //$begin=$a;$end=$b;
    $string=$input;
    $aa=strlen($a);
    $p=0;
    for($ii=0;$ii<$i;$ii++){$pp=strpos($string,$a)+1;$p=$p+$pp;$string=substr($string,$pp);}
    //$inner=$string;
    $a=strpos($string,$a);
    if($a!==false){if(rr())echo("<br/>".$a);
        $string=substr($string,$a+$aa);
        //echo(htmlspecialchars($string));
        $b=strpos($string,$b);
        if(rr())echo("/".$b);
        $string=substr($string,0,$b);
        if(rr())echo("<br/>".$change);
        if($change!=false){
            //$input=substr_replace($input,$change,,1);
            //echo("<br/>substr_replace($input,$change,$a+$aa+$p,$b);");
            if(rr())echo("<br/>input: ".$input);
            $inner=substr($input,$a+$aa+$p,$b);
            $input=substr_replace($input,$change,$a+$aa+$p-$start,$b+$stop+$start);//$b-$a-$aa
            if(rr())echo("<br/>return: ".$input);
        }//průser v akcentu
        //$input=substr($input,$a+$aa+$b);
        if(rr())echo("<br/>return($string)");
        
        $input=str_replace("[]",$inner,$input);
        
        if($change)return($input);
        return($string);
    }else{
        if($change)return($input);
        return(false);
    }
}
//$endshow="radb{x1}ewsdf{ff}erds{x2}ss";
//substr2($endshow,"{","}",2,"_");
//--------------------------------------------
function part3($input,$aa,$bb){
    if(strpos($input,$aa)){
        list($a,$input)=explode($aa,$input);
        list($b,$c)=explode($bb,$input);
        return(array($a,$b,$c));
    }else{
        return(array("",$input,""));
    }
}
//print_r(part3("-sfd6sf8d-","6","8"));
//--------------------------------------------
//define("vals_a",array("*",",",";",":","=","(","[","{","}","]",")","\"","\'","\\"," ",nln));
//define("vals_b",array("[star]","[comma]","[semicolon]","[colon]","[equate]","[aabracket]","[babracket]","[cabracket]","[babracket]","[bbbracket]","[cbbracket]","[doublequote]","[quote]","[slash]","[space]","[nln]"));
$GLOBALS['ss']["vals_a"]=array("*",",",";",":","=","(","[","{","}","]",")","\"","\'","\\"," ",nln);
$GLOBALS['ss']["vals_bb"]=array("[1]","[2]","[3]","[4]","[5]","[6]","[7]","[8]","[9]","[10]","[11]","[12]","[13]","[14]","[15]","[16]");
$GLOBALS['ss']["vals_b"]=array("[star]","[comma]","[semicolon]","[colon]","[equate]","[aabracket]","[babracket]","[cabracket]","[cbbracket]","[bbbracket]","[abbracket]","[doublequote]","[quote]","[slash]","[space]","[nln]");
//r($GLOBALS['ss']["vals_a"]);
//--------------------------------------------
function str_replace2($from,$to,$text){
    $x="nwijofnurelnr";
    $a="a".$x;
    $b="b".$x;
    $between=$from;
    $i=0;while($between[$i]){
        $between[$i]=$a.$i.$b;
    $i++;}
    $text=str_replace($from,$between,$text);
    $text=str_replace($between,$to,$text);
    return($text);
}
//--------------------------------------------
/**
 * @param $text
 * @return mixed
 */
function x2xx($text){//,$vals_a=vals_a,$vals_b=vals_b
    //$ptext=$text;
    //$text=str_replace("*","xxxstarxxx",$text);
    $from=$GLOBALS['ss']["vals_a"];
    $to=$GLOBALS['ss']["vals_bb"];
    $text=str_replace2($from,$to,$text);
    //$text=str_replace("xxxstarxxx","[star]",$text);
    //r($ptext." >> ".$text);
    return($text);
}
//--------------------------------------------
 function xx2x($text){
    //$ptext=$text;
    //$text=str_replace("[star]","xxx*xxx",$text);
    $from=$GLOBALS['ss']["vals_b"];
    $to=$GLOBALS['ss']["vals_a"];
    $text=str_replace2($from,$to,$text);
    $from=$GLOBALS['ss']["vals_bb"];
    $text=str_replace2($from,$to,$text);
    //$text=str_replace("xxx*xxx","*",$text);
    //r($ptext." >> ".$text);
    return($text);
}
//--------------------------------------------
 function smiles($text){
     $stream="";
    $text=str_replace("**","[star]",$text);
    $array=explode("\*",$text);
    $i=-1;
    foreach($array as $part){$i++;
        if($i%2){
            //$stream=$stream.$part;
            list($img,$width)=explode("\[star\]",$part);
            $img=x2xx($img);
            if(!$width){$width="100%";}
            //echo($img."<br>");
            $stream=$stream.imgr("id_".$img,$img,$width);
        }else{
            $stream=$stream.$part;
        }
    } /**/
    $stream=str_replace("[star]","*",$stream);
    return($stream);
}
//r(xx2x("own2=2[comma]hybrid[comma]0.000[comma]0.000[comma][comma]qw[comma][comma]login[equate]1[semicolon]use[equate]1[semicolon]info[equate]1[semicolon]profile_edit[equate]1[semicolon]set_edit[equate]1[comma][comma][comma]realname[equate]Beze JmĂ©na[semicolon]gender[equate]m[semicolon]age[equate][semicolon]mail[equate]@[semicolon]showmail[equate][semicolon]web[equate]www.towns.cz[semicolon]description[equate]asdaszdas[semicolon]join[equate][comma][equate]0[comma]1[comma]0[comma]1314648565[comma]0[comma]0;in=0;in2=41[comma]message[comma]0.000[comma]0.000[comma][comma][comma][comma]login[equate]1[semicolon]use[equate]1[semicolon]info[equate]1[semicolon]profile_edit[equate]1[semicolon]set_edit[equate]1[comma][comma][comma]realname[equate][semicolon]gender[equate][semicolon]age[equate][semicolon]mail[equate]@[semicolon]showmail[equate][semicolon]web[equate][semicolon]description[equate][semicolon]join[equate][semicolon]text[equate][comma][equate]0[comma]0[comma]1[comma]1314613091[comma]0[comma]0[semicolon]40[comma]message[comma]0.000[comma]0.000[comma][comma]subject[comma][comma]login[equate]1[semicolon]use[equate]1[semicolon]info[equate]1[semicolon]profile_edit[equate]1[semicolon]set_edit[equate]1[comma][comma][comma]realname[equate][semicolon]gender[equate][semicolon]age[equate][semicolon]mail[equate]@[semicolon]showmail[equate][semicolon]web[equate][semicolon]description[equate][semicolon]join[equate][semicolon]text[equate]text[comma][equate]0[comma]0[comma]1[comma]1314352818[comma]0[comma]0;t=1313699204;x=15;y=0"),2);
//--------------------------------------------
 function array2csv($array){
     $i=0;
     $array_new=array();
    foreach($array as $row){
        $array_new[$i]=array();
        $ii=0;
        foreach($row as $key=>$a){
            //if(is_int($key)){
            $array_new[$i][$ii]=x2xx($a);
            //r($array_new[$i][$ii]);
            //}
            //r($array2[$i][$ii]);
            $ii++;
        }//echo("<br>");
       $array_new[$i]=join(",",$array_new[$i]);
       $i++;
    }
    $array_new=join(";",$array_new);
    //r($array_new);
    return($array_new);
}
//--------------------------------------------
 function csv2array($string){
    $string=explode(";",$string);
    $i=0;
    foreach($string as $row){
        $string[$i]=explode(",",$string[$i]);
        $ii=0;
        foreach($string[$i] as $tmp){
             $string[$i][$ii]=xx2x($string[$i][$ii]);
             $ii++;
        }
        $i++;
    }
    return($string);
}
//die(xx2x("[babracket]"));
//die(xx2x(x2xx("{abc}")));
//print_r(csv2array(array2csv(array(array("{abc}")))));
//exit;


//==========================================================================================
require(root.core."/func_components.php");
require(root.core."/func_query.php");
//require(root.core."/func_map.php");
//r(astream($str));
?>
