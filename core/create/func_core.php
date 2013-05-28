<?php
function a_create($id,$x=0,$y=0,$rot=0){
    r("$id,$x=0,$y=0,$rot=0");
    //require(root."control/func_map.php");
    //if(/*sql_1data("SELECT hard FROM ".mpx."map WHERE x=ROUND(".($x).") AND y=ROUND(".($y).") LIMIT 1")-0==0 or */true){

$res=sql_1data("SELECT res FROM ".mpx."objects WHERE id='$id'");

if(substr($res,0,1)=='{' or strpos($res,'{}')){           
$x=round($x);
$y=round($y);
}
$rx=round($x);
$ry=round($y);    
    
    if(!floatval(sql_1data("SELECT COUNT(1) FROM `".mpx."objects`  WHERE `ww`=".$GLOBALS['ss']["ww"]." AND  `x`=$rx AND `y`=$ry LIMIT 1"))){    
    
    //OLDHARD//sql_1data("SELECT hard FROM ".mpx."map WHERE x=ROUND(".($x).") AND y=ROUND(".($y).") LIMIT 1"))
    $hard=hard($rx,$ry);
    if($hard<supportF($id,'resistance','hard')){
    
    if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own!='".useid."'AND `ww`=".$GLOBALS['ss']["ww"]." AND POW($x-x,2)+POW($y-y,2)<=POW(collapse,2)"))==0){
       
    if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."'AND `ww`=".$GLOBALS['ss']["ww"]." AND POW($x-x,2)+POW($y-y,2)<=POW(expand,2)"))>=1){
        

        $fc=new hold(sql_1data("SELECT fc FROM ".mpx."objects WHERE id='$id'"));
        if($GLOBALS['ss']["use_object"]->hold->takehold($fc)){
            
            if($rot and strpos($res,'/1.png'))$res=str_replace('1.png',(($rot/15)+1).'.png',$res);
            
            sql_query("INSERT INTO `".mpx."objects` (`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`, `own`, `in`, `ww`, `x`, `y`, `t`) 
SELECT ".nextid().", `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, CONCAT('$res',':$rot'), `profile`, 'x', `hard`, `expand`,'".useid."', `in`, ".$GLOBALS['ss']["ww"].", $x, $y, ".time()." FROM `".mpx."objects` WHERE id='$id'");
            //POZDEJI//changemap($x,$y);

        
//==============================OPRAVA SPOJů
$res=trim($res);
if(substr($res,0,1)=='{'){
//---------------------------------------------------------------
$res='start'.$res.'stop';
$res=str_replace(array('start{','}stop'),'',$res);
$res=explode('}{',$res);

foreach(array(array($x,$y),array($x+1,$y),array($x,$y-1),array($x-1,$y),array($x,$y+1)) as $tmp){list($xx,$yy)=$tmp;
$name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
     
$near=array();
$near[0]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx+1 AND y=$yy"))>=1?1:0;
$near[1]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy-1"))>=1?1:0;
$near[2]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx-1 AND y=$yy"))>=1?1:0;
$near[3]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy+1"))>=1?1:0;

    if($near==array(0,0,0,0)){$i=0;$rot=0;}
elseif($near==array(1,0,0,0)){$i=1;$rot=0;}
elseif($near==array(0,1,0,0)){$i=1;$rot=90;}
elseif($near==array(0,0,1,0)){$i=1;$rot=180;}
elseif($near==array(0,0,0,1)){$i=1;$rot=270;}
elseif($near==array(1,1,0,0)){$i=2;$rot=0;}
elseif($near==array(1,0,1,0)){$i=3;$rot=0;}
elseif($near==array(1,0,0,1)){$i=2;$rot=270;}
elseif($near==array(0,1,1,0)){$i=2;$rot=90;}
elseif($near==array(0,1,0,1)){$i=3;$rot=90;}
elseif($near==array(0,0,1,1)){$i=2;$rot=270;}
elseif($near==array(1,1,1,0)){$i=4;$rot=0;}
elseif($near==array(1,1,0,1)){$i=4;$rot=270;}
elseif($near==array(1,0,1,1)){$i=4;$rot=180;}
elseif($near==array(0,1,1,1)){$i=4;$rot=90;}
elseif($near==array(1,1,1,1)){$i=5;$rot=0;}

$resx=$res[$i];
$resx=explode(':',$resx);
if(!$resx[3]){$resx[3]=0;}else{$resx[3]=intval($resx[3]);}
$resx[3]=$resx[3]+$rot;
if($resx[3]>=360)$resx[3]=$resx[3]-360;
if($resx[3]<0)$resx[3]=$resx[3]+360;
$resx=implode(':',$resx);


sql_query("UPDATE ".mpx."objects SET res='$resx' WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy");
}
define('object_build',true);
//---------------------------------------------------------------
}elseif(strpos($res,'{}')){
//---------------------------------------------------------------
//$res='start'.$res.'stop';
//$res=str_replace(array('start(',')stop'),'',$res);


foreach(array(array($x,$y),array($x+1,$y),array($x,$y-1),array($x-1,$y),array($x,$y+1)) as $tmp){list($xx,$yy)=$tmp;
$name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
     
$near=array();
$near[0]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx+1 AND y=$yy"))>=1?1:0;
$near[1]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy-1"))>=1?1:0;
$near[2]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx-1 AND y=$yy"))>=1?1:0;
$near[3]=intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy+1"))>=1?1:0;

    if($near==array(1,1,1,1)){$i=1;}
elseif($near==array(1,1,0,1)){$i=2;}
elseif($near==array(1,0,1,1)){$i=3;}
elseif($near==array(1,0,0,1)){$i=4;}
elseif($near==array(1,1,1,0)){$i=5;}
elseif($near==array(1,1,0,0)){$i=6;}
elseif($near==array(1,0,1,0)){$i=7;}
elseif($near==array(1,0,0,0)){$i=8;}
elseif($near==array(0,1,1,1)){$i=9;}
elseif($near==array(0,1,0,1)){$i=10;}
elseif($near==array(0,0,1,1)){$i=11;}
elseif($near==array(0,0,0,1)){$i=12;}
elseif($near==array(0,1,1,0)){$i=13;}
elseif($near==array(0,1,0,0)){$i=14;}
elseif($near==array(0,0,1,0)){$i=15;}
elseif($near==array(0,0,0,0)){$i=16;}

$resx=str_replace('{}',$i,$res);
r($resx);
sql_query("UPDATE ".mpx."objects SET res='$resx' WHERE own='".useid."' AND `name`='$name' AND ww='".$GLOBALS['ss']["ww"]."' AND x=$xx AND y=$yy");
}
define('object_build',true);

//---------------------------------------------------------------  
}
changemap($x,$y);
//==============================


         }else{
            define('object_build',true);
            define('create_error','{create_error_price}');
            $GLOBALS['ss']["query_output"]->add("error","{create_error_price}");
        }/**/
    }else{
        define('object_build',true);
        define('create_error','{create_error_expand}');
        $GLOBALS['ss']["query_output"]->add("error","{create_error_expand}");
    }}else{
        define('object_build',true);
        define('create_error','{create_error_collapse}');
        $GLOBALS['ss']["query_output"]->add("error","{create_error_collapse}");
    }}else{
        define('object_build',true);
        //$sql="SELECT (SELECT IF(`terrain`='t1' OR `terrain`='t11',1,0) FROM `".mpx."map`  WHERE `".mpx."map`.`ww`=".$GLOBALS['ss']["ww"]." AND  `".mpx."map`.`x`=$y AND `".mpx."map`.`y`=$x)+(SELECT SUM(`".mpx."objects`. `hard`) FROM `".mpx."objects` WHERE `".mpx."objects`.`ww`=".$GLOBALS['ss']["ww"]." AND  ROUND(`".mpx."objects`.`x`)=$y AND ROUND(`".mpx."objects`.`y`)=$x)";
        //$hard=sql_1data($sql);// WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `x`=$x AND `y`=$y");
        define('create_error','{create_error_resistance}');
        $GLOBALS['ss']["query_output"]->add("error","{create_error_resistance}");
    }}else{
        define('object_build',true);
        define('create_error','{create_error_duplicite}');
        $GLOBALS['ss']["query_output"]->add("error","{create_error_duplicite}");
    }
}
?>
