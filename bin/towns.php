<?php
function str_replace_first($search, $replace, $subject) {return implode($replace, explode($search, $subject, 2));}
function parsef($file){
if(defined('root'))$file=str_replace_first(root.core,'',$file);
while(substr($file,0,1)=='/')$file=substr($file,1);
return($file);
}
function require2($file){
$file=parsef($file);
if($file=='attack/attack.php'){
define('20ce8f1492f1c66fc0c018d149a9aa42',true);

 $iconsize=35;
 $iconbrd=3;
 $ns=($GLOBALS['get']['noshit']);

if($GLOBALS['ss']['attack_report']){
 if($GLOBALS['get']['noshit']){
 r('noshit'); 
 w_close('content');
 }else{
 contenu_a(true);
 window('{title_attack_report}');
 te($GLOBALS['ss']['attack_report']);
 contenu_b();
 }
 unset($GLOBALS['ss']['attack_report']);
 e('<script>refreshMap();'.urlxr('e=miniprofile',false).'</script>');
}else{
 
r($GLOBALS['settings']['attack_mafu']);
list($attack_master,$attack_function)=explode('-',$GLOBALS['settings']['attack_mafu']);



$attack_id=$GLOBALS['settings']['attack_id'];
 
if(!$ns)window("{attack_on} ".liner_($attack_id,4,true));
if(!$ns)contenu_a(true);


if(!$ns)
foreach(sql_array('SELECT id,name,func FROM [mpx]objects WHERE own=\''.useid.'\' AND func LIKE \'%attack%\'') as $row){
 list($id,$name,$func)=$row;
 if($id==$attack_master)
 $brd=$iconbrd;
 else
 $brd=0;
 
 $funcs=func2list($func);
 $func=$funcs['attack'];
 $profile=$func["profile"];
 if($profile["icon"]){
 $icon=$profile["icon"];
 }else{
 $icon="f_".$func["class"];
 }
 $xname=$profile["name"];
 if(!$xname){$xname="{f_".$func["class"]."}";}
 ahref(imgr("id_$id"."_icon",$name,$iconsize,$iconsize,NULL,$brd),"e=content;ee=attack-attack;set=attack_mafu,$id-attack-$xname-$icon","none",'x');
}
br();
 
$id=$attack_id;
if(!$id or !$attack_master){error('{attack_wtf}');}
elseif($id==$attack_master){error('{attack_self}');}
else{
$attacker=new object($attack_master);r($attack_master);
$attacked=new object($id);
if(!$attacked->loaded or !$attacker->loaded){error('{attack_wtf}');
 }else{
 $type=$attacked->type;
 
 $funcs=$attacker->func->vals2list();
 $q=0;
 foreach($funcs as $name=>$func){
 if($func["class"]=="attack"){
 $profile=$func["profile"];
 if($profile["icon"]){
 $icon=$profile["icon"];
 }else{
 $icon="f_".$func["class"];
 }
 $xname=$profile["name"];
 if(!$xname){$xname="{f_$class}";}
 $set_key='attack_mafu';$set_value=$attack_master.'-'.$name.'-'.$xname.'-'.$icon;
 
 list($a,$b)=explode('-',$GLOBALS['settings']['attack_mafu']);
 if($a==$attack_master and $b==$name){
 $brd=$iconbrd;
 }else{$brd=0;}
 if(!$ns){ ahref(imgr('icons/'.$icon.'.png',$xname,$iconsize,$iconsize,NULL,$brd),"e=content;ee=attack-attack;set=attack_mafu,$set_value");
 }
 }
 }
 
 
 
 $a_id=$attack_master; $b_id=$id;
 $attack_type=$attack_function; r($attack_id);
 r($attack_master);
 r($attack_function);
 $a_fp=$attacker->getFP();
 $b_fp=$attacked->getFP();
 $a_at=$attacker->supportF($attack_type,"attack");
 $b_at=$attacked->supportF("attack");
 $a_att=$attacker->supportF($attack_type,"total");
 $b_att=$attacked->supportF("attack","total"); $a_cnt=$attacker->supportF($attack_type,"count");
 $b_cnt=$attacked->supportF("attack",'count');
 $a_de=$attacker->supportF("defence");
 $b_de=$attacked->supportF("defence");
 $xeff=$attacker->supportF($attack_type,"xeff");
 $steal=clone $attacked->hold;$steal->multiply($xeff);
 if($b_at)$ns=false;
 if($a_at-$b_de<1)$ns=false;
 

 if($attacked->type=='user'){$noconfirm=1;
 blue("{attack_lock}");
 }
 
 
 if($attacker->ww!=$attacked->ww){$noconfirm=1;
 error(lr('attack_error_ww',$a_dist));
 } 
 
 
 $a_dist=$attacker->supportF($attack_type,"distance");
 
 list($ax,$ay)=$attacker->position();
 list($bx,$by)=$attacked->position();
 $dist=sqrt(pow($ax-$bx,2)+pow($ay-$by,2));
 if($dist>$a_dist){$noconfirm=1;
 error(lr('attack_error_distance',$a_dist));
 }
 
 
 list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
 $price=use_price("attack",array("time"=>$time),$support[$attack_type]["params"],2);
 if(!test_hold($price)){$noconfirm=1;
 blue(lr('attack_error_price'));
 }

 
 if(!isset($noconfirm)){
 $url="e=content;ee=attack-attack;q=$attack_master.$attack_type $b_id";
 if($ns)urlx($url.';noshit=1');
 $confirm=tfontr(ahrefr("{attack_$type}",$url,"none","x"),20);
 br();
 moveby($confirm,360,-35);
 }else{
 $ns=false;
 }
 
 
 hr(contentwidth);
 
 if($a_att)$a_attt="(+)";
 if($b_att)$b_attt="(+)";
 
 tableab_a('left',113);
 
 
 
 vprofile($a_id,array("{life}: "=>round($a_fp), "{attack}$a_attt: "=>$a_at,"{attack_count}: "=>$a_cnt, "{defence}: "=>$a_de, "{distance}: "=>$a_dist));
 tfont('vs.',30);
 vprofile($b_id,array("{life}: "=>round($b_fp), "{attack}$b_attt: "=>$b_at,"{attack_count}: "=>$b_cnt, "{defence}: "=>$b_de));

 
 tableab_b();

 
 $qs=array(4=>0,7=>0,3=>0,6=>0,8=>0,5=>0);
 for($i=0;$i<=100;$i++){
 if($i!=50){
 list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count($i,100-$i,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
 $qs[$q]++;
 }
 }
 textab("{attack_expected}");
 br(2);
 foreach($qs as $q=>$tmp){
 if($tmp)info($tmp."%: ".attack_name($q));
 }
 list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
 if($a_fp2==0)error("{attack_warning_total_kill}");
 elseif($b_att)error("{attack_warning_total}");
 textab("{attack_expected_a}:",$a_fp2);br();
 textab("{attack_expected_b}:",$b_fp2);br();
 
 if($price->fp()){textb('{attack_price}:');
 $price->showimg();}
 if($steal->fp()){textb('{attack_steal}:');
 $steal->showimg();}
 tableab_c();
 
 
}}

if(!$ns)contenu_b();
}

?>
<?php
}elseif($file=='attack/func_core.php'){
define('5f550c7d1ff68ff0f155b6f174580479',true);

define('a_attack_cooldown',true);
function a_attack($id){
 if(!$id){$GLOBALS['ss']["query_output"]->add("error","{attack_noid}");}
 elseif($id==useid){$GLOBALS['ss']["query_output"]->add("error","{attack_self}");}
 else{
 $attacked=new object($id);
 if(!$attacked->loaded){$GLOBALS['ss']["query_output"]->add("error","{attack_unknown}");
 }else{
 
 $attack_type=$GLOBALS['ss']["aac_func"]["name"];
 $attacked=new object($id);
 $type=$attacked->type;
 $a_name=lr($GLOBALS['ss']["aac_object"]->type).' '.$GLOBALS['ss']["aac_object"]->name;
 $a_name_=$GLOBALS['ss']["aac_object"]->name;
 $b_name=lr($type).' '.$attacked->name;
 $b_name_=$attacked->name;
 $b_name4=lr($type,4).' '.$attacked->name;
 $attackname=lr('attack_'.$type.'2');
 $a_fp=$GLOBALS['ss']["aac_object"]->getFP();
 $b_fp=$attacked->getFP();
 $a_at=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"attack");
 $b_at=$attacked->supportF("attack");
 $a_att=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"total");
 $b_att=$attacked->supportF("attack","total"); $a_cnt=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"count");
 $b_cnt=$attacked->supportF("attack","count"); $a_de=$GLOBALS['ss']["aac_object"]->supportF("defence");
 $b_de=$attacked->supportF("defence");
 $xeff=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"xeff");
 $steal=clone $attacked->hold;$steal->multiply($xeff);
 
 $limit=$GLOBALS['ss']["aac_object"]->func->profile($attack_type,'limit');
 if($limit and $limit!=$attacked->type){
 $GLOBALS['ss']["query_output"]->add("error","{attack_limit_$limit}");
 return;
 } 
 
 if($GLOBALS['ss']["aac_object"]->ww!=$attacked->ww){
 $GLOBALS['ss']["query_output"]->add("error","{attack_error_ww}");
 return;
 } 
 
 
 $a_dist=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"distance");
 list($ax,$ay)=$GLOBALS['ss']["aac_object"]->position();
 list($bx,$by)=$attacked->position();
 $dist=sqrt(pow($ax-$bx,2)+pow($ay-$by,2));
 if($dist>$a_dist){
 $GLOBALS['ss']["query_output"]->add("error",lr('attack_error_distance',$a_dist));
 return;
 }
 
 
 list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
 $price=use_price("attack",array("time"=>$a_tah),$support[$attack_type]["params"],2);
 if(!test_hold($price)){
 $GLOBALS['ss']["query_output"]->add("error","{attack_error_price}");
 return;
 }
 
 $a_seed=rand(0,100);
 $b_seed=rand(0,100);
 list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count($a_seed,$b_seed,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
 
 
 
 $GLOBALS['ss']["aac_object"]->fp=$a_fp2;
 $attacked->fp=$b_fp2;
 use_hold($price);
 if(!$b_fp2){
 $attacked->hold->take($steal);
 $steal->multiply(-1);
 use_hold($steal);
 }else{
 $steal->multiply(0);
 }
 
 if($b_fp2==0 and $type!='user' and $type!='unit'){
 $attacked->delete();
 if($attacked->type=='building')
 changemap($bx,$by); else
 changemap($bx,$by,true);
 }
 if($a_fp==0 and $type!='user' and $type!='unit' and (id2name($GLOBALS['config']['register_building'])!=$GLOBALS['ss']["aac_object"]->name)){
 $GLOBALS['ss']["aac_object"]->delete();
 if($GLOBALS['ss']["aac_object"]->type=='building')
 changemap($bx,$by); else
 changemap($bx,$by,true);
 } 
 if($b_fp2==1){
 $attacked->own=$GLOBALS['ss']["aac_object"]->own;
 }
 $attacked->update();
 
 
 
 
 $steal->multiply(-1);
 $price=$price->textr();
 $steal=$steal->textr();
 $info=array('a_name'=>$a_name,'a_name_'=>$a_name_,'b_name'=>$b_name,'b_name_'=>$b_name_,'b_name4'=>$b_name4,'attackname'=>$attackname,'q'=>attack_name($q),'time'=>nn($time),'a_fp2'=>nn($a_fp2),'b_fp2'=>nn($b_fp2),'a_tah'=>nn($a_tah),'b_tah'=>nn($b_tah),'a_atf'=>nn($a_atf),'b_atf'=>nn($b_atf),'a_seed'=>nn($a_seed),'b_seed'=>nn($b_seed),'a_fp'=>nn($a_fp),'b_fp'=>nn($b_fp),'a_at'=>nn($a_at),'b_at'=>nn($b_at),'a_cnt'=>nn($a_cnt),'b_cnt'=>nn($b_cnt),'a_de'=>nn($a_de),'b_de'=>nn($b_de),'a_att'=>nn($a_att),'b_att'=>nn($b_att),'price'=>$price,'steal'=>$steal);
 $info=x2xx(list2str($info));
 
 send_report(useid,$id,lr('attack_report_title_q'.$q,$info),lr('attack_report',$info));
 $GLOBALS['ss']['attack_report']=lr('attack_report',$info);
 $GLOBALS['ss']["query_output"]->add("1",1);
 
 
 }}
}

function attack_count($a_seed,$b_seed,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att){
 $a_min=1;
 $b_min=1;
 if($a_att)$b_min=0;
 if($b_att)$a_min=0;
 $a_atf=($a_at-$b_de)*0.01*$a_seed;
 $b_atf=($b_at-$a_de)*0.01*$b_seed;
 $time=0;
 $a_tah=0;
 $b_tah=0;
 $a_fp2=$a_fp;
 $b_fp2=$b_fp;
 while(($a_fp2!=$a_min and $b_fp2!=$b_min) and (($a_cnt and $a_atf>0) or ($b_cnt and $b_atf>0))){$time++;
 if($a_cnt and $a_fp2>0 and $a_atf>0){$b_fp2=$b_fp2-$a_atf;$a_cnt--;$a_tah++;}
 if($b_cnt and $b_fp2>0 and $b_atf>0){$a_fp2=$a_fp2-$b_atf;$b_cnt--;$b_tah++;}
 if($a_fp2<$a_min)$a_fp2=$a_min;
 if($b_fp2<$b_min)$b_fp2=$b_min;
 
 }
 
 
 
 if($a_fp==$a_fp2 and $b_fp==$b_fp2) {$q=1;}
 elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)<($b_fp-$b_fp2)) {$q=2;}
 elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)>($b_fp-$b_fp2)) {$q=3;} 
 elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)==($b_fp-$b_fp2)){$q=4;}
 elseif($a_fp2!=0 and $b_fp2==0) {$q=5;}
 elseif($a_fp2==0 and $b_fp2!=0 and $b_fp2!=1) {$q=6;}
 elseif($a_fp2==0 and $b_fp2==0) {$q=7;}
 elseif($b_fp2==1) {$q=8;} 
 else {$q=9;} 
 
 
 return(array($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf));
}
 function attack_name($q){
 return(lr("attack_q$q"));
 
 }
?>
<?php
}elseif($file=='create/build.php'){
define('886ef34b1cbb57a3a29fb100197812b7',true);

require2_once(root.core."/func_map.php");
$id=$_GET["id"];
if(!$id and $GLOBALS['ss']["object_build_id"])$id=$GLOBALS['ss']["object_build_id"];
$GLOBALS['ss']["object_build_id"]=$id;

$func=$_GET["func"];
if(!$func and $GLOBALS['ss']["object_build_func"])$func=$GLOBALS['ss']["object_build_func"];
$GLOBALS['ss']["object_build_func"]=$func;

if(!$GLOBALS['ss']["master"] and $_GET["master"])$GLOBALS['ss']["master"]=$_GET["master"];

if($id and $GLOBALS['ss']['master']){?>
<script type="text/javascript">
 _rot=0;
</script>
<?php
 $object_build=new object($id);
 $res=$object_build->res;
 $js="\$.get('?e=map&q=".$GLOBALS['ss']['master'].".".$GLOBALS['ss']["object_build_func"]." $id,'+build_x+','+build_y+','+_rot, function(vystup)x{\$('#map').html(vystup);}x)";

 if(substr($res,0,1)!='{' and (substr($res,0,1)!='(' or strpos($res,'1.png'))){$q=true;}else{$q=false;}
 if(strpos($res,'1.png')){$qq=true;}else{$qq=false;}
 $angle=(!$qq)?360:7*15;
?>


<?php if($q){ ?>
<!--==========-->
<div style="position:absolute;"><div style="position:relative;left:-25;top:95;">
<?php icon(js2('_rot=_rot-15;if(_rot<0)x{_rot=_rot+360;}xbuild_model_rot(_rot);'),"rotate_left","{rotate_left}",25); ?>
</div></div>
<!--==========-->
<div style="position:absolute;"><div style="position:relative;left:80;top:95;">
<?php icon(js2('_rot=_rot+15;if(_rot>=360)x{_rot=_rot-360;}xbuild_model_rot(_rot);'),"rotate_right","{rotate_right}",25); ?>
</div></div>
<!--==========-->
<?php } ?>
<div style="position:absolute;"><div style="position:relative;left:-25;top:145;">
<?php icon(js2($hide="\$('#create-build').css('display','none');\$('#expandarea').css('display','none')"),"cancel","{cancel}",25); ?>
</div></div>
<!--==========-->
<div style="position:absolute;"><div style="position:relative;left:-25;top:70;">
<?php icon(js2(($q?$hide.',':'').$js),"f_create_building_submit","{f_create_building_submit}",25); ?>
</div></div>

<?php
for($rot=0;($q?($rot<$angle):($rot==0));$rot=$rot+15){
$rotx=$rot;
if($qq)$rotx=($rotx/15)+1;
 $modelurl=modelx($res.':'.$rotx);
 list($width, $height) = getimagesize($modelurl);

e('<div class="build_models" id="build_model_'.$rot.'" style="display:'.($rot==0?'block':'none').';"><img src="'.$modelurl.'" width="'.(110*0.75).'"></div>');
}
?>

<script type="text/javascript">
 _rot=0;
 <?php if($q){ ?>
 build_model_rot=function(rot)x{
 $('.build_models').css('display','none');
 $('#build_model_'+rot).css('display','block');
 }x
 $(document).bind('mousewheel', function(event, delta)x{
 
 if(delta > 0) x{
 _rot=_rot-15;if(_rot<0)x{_rot=_rot-(-<?php e($angle); ?>);}xbuild_model_rot(_rot); 
 }xelsex{
 _rot=_rot-(-15);if(_rot>=<?php e($angle); ?>)x{_rot=_rot-<?php e($angle); ?>;}xbuild_model_rot(_rot); 
 }x
 
 
 }x);
 <?php }else{ ?>
 build_model_rot=function(rot)x{}x
 $(document).bind('mousewheel', function(event, delta)x{}x);
 <?php } ?>
</script>
<?php } ?>
<?php
}elseif($file=='create/func_core.php'){
define('7fe4aa8adb8040d2c519ce8bc6a802ef',true);

define('a_create_cooldown',true);
function a_create($id,$x=0,$y=0,$rot=0){
 r("$id,$x=0,$y=0,$rot=0");
 
$res=sql_1data("SELECT res FROM ".mpx."objects WHERE id='$id'");

if(substr($res,0,1)=='{' or strpos($res,'{}')){ 
$x=round($x);
$y=round($y);
}
$rx=round($x);
$ry=round($y); 
 
 if(!floatval(sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `x`=$rx AND `y`=$ry LIMIT 1"))){ 
 
 $hard=hard($rx,$ry);
 if($hard<supportF($id,'resistance','hard')){
 
 if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own!='".useid."'AND `ww`=".$GLOBALS['ss']["ww"]." AND POW($x-x,2)+POW($y-y,2)<=POW(collapse,2)"))==0){
 
 if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."'AND `ww`=".$GLOBALS['ss']["ww"]." AND POW($x-x,2)+POW($y-y,2)<=POW(expand,2)"))>=1){
 

 $fc=new hold(sql_1data("SELECT fc FROM ".mpx."objects WHERE id='$id'"));
 if($GLOBALS['ss']["use_object"]->hold->takehold($fc)){
 
 if($rot and strpos($res,'/1.png'))$res=str_replace('1.png',(($rot/15)+1).'.png',$res);
 
 sql_query("INSERT INTO `".mpx."objects` (`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`, `own`, `in`, `ww`, `x`, `y`, `t`) 
SELECT ".nextid().", `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, CONCAT('$res',':$rot'), `profile`, 'x', `hard`, `expand`,'".useid."', `in`, ".$GLOBALS['ss']["ww"].", $x, $y, ".time()." FROM `".mpx."objects` WHERE id='$id'");
 
 
$res=trim($res);
if(substr($res,0,1)=='{'){
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
}elseif(strpos($res,'{}')){


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

}
changemap($x,$y);
$GLOBALS['ss']["query_output"]->add("1",1);
 
 }else{
 define('object_build',true);
 define('create_error','{create_error_price}');
 $GLOBALS['ss']["query_output"]->add("error","{create_error_price}");
 }
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
 define('create_error','{create_error_resistance}');
 $GLOBALS['ss']["query_output"]->add("error","{create_error_resistance}");
 }}else{
 define('object_build',true);
 define('create_error','{create_error_duplicite}');
 $GLOBALS['ss']["query_output"]->add("error","{create_error_duplicite}");
 }
}

function a_replace($id,$x=0,$y=0,$rot=0){
 r("$id,$x=0,$y=0,$rot=0");
 
$res=sql_1data("SELECT res FROM ".mpx."objects WHERE id='$id'");

$rx=round($x);
$ry=round($y); 
 
 if(!floatval(sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE `ww`=".$GLOBALS['ss']["ww"]." AND `id`!='".$GLOBALS['ss']['aac_object']->id."' AND `x`=$rx AND `y`=$ry LIMIT 1"))){ 
 
 $hard=hard($rx,$ry);
 if($hard<supportF($id,'resistance','hard')){
 
 if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own!='".useid."'AND `ww`=".$GLOBALS['ss']["ww"]." AND `id`!='".$GLOBALS['ss']['aac_object']->id."' AND POW($x-x,2)+POW($y-y,2)<=POW(collapse,2)"))==0){
 
 if(intval(sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE own='".useid."' AND `ww`=".$GLOBALS['ss']["ww"].""))<=1){
 
 $GLOBALS['ss']['aac_object']->x=$x;
 $GLOBALS['ss']['aac_object']->y=$y;
 $GLOBALS['ss']['aac_object']->res=$res.':'.$rot;
 $GLOBALS['ss']['aac_object']->update();
 
 
 $GLOBALS['ss']["query_output"]->add("1",1);
 }else{
 define('object_build',true);
 define('create_error','{replace_error_only}');
 $GLOBALS['ss']["query_output"]->add("error","{replace_error_expand}");
 }}else{
 define('object_build',true);
 define('create_error','{replace_error_collapse}');
 $GLOBALS['ss']["query_output"]->add("error","{replace_error_collapse}");
 }}else{
 define('object_build',true);
 define('create_error','{replace_error_resistance}');
 $GLOBALS['ss']["query_output"]->add("error","{replace_error_resistance}");
 }}else{
 define('object_build',true);
 define('create_error','{replace_error_duplicite}');
 $GLOBALS['ss']["query_output"]->add("error","{replace_error_duplicite}");
 }
}


define('a_repair_cooldown',true);
function a_repair(){

 $price=new hold($GLOBALS['ss']["aac_object"]->fc);
 $price->multiply($GLOBALS['ss']["aac_object"]->fp/$GLOBALS['ss']["aac_object"]->fs);
 if($GLOBALS['ss']["use_object"]->hold->takehold($price)){
 $GLOBALS['ss']["aac_object"]->fp=$GLOBALS['ss']["aac_object"]->fs;
 $GLOBALS['ss']["query_output"]->add("success","{repair_success}");
 $GLOBALS['ss']["query_output"]->add("1",1);
 }else{
 $GLOBALS['ss']["query_output"]->add("error","{repair_error_price}");
 }
 
 
}
 
?>
<?php
}elseif($file=='create/unique.php'){
define('806d2610efeef97e13ff0d5ac176b9a1',true);

window("{title_build}");


if($GLOBALS['get']['master']){
$object=new object($GLOBALS['get']['master']);
$GLOBALS['ss']['master']=$object->id;


infob(lr('unique_from',$object->name));
$maxfs=$object->supportF('create','maxfs');
$func=$object->func->vals2list();
$limit=$func['create']['profile']['limit'];
$limit='(id='.implode(' OR id=',$limit).')';

$GLOBALS['where']="own=0 AND ww=0 AND fs<=".$maxfs.' AND '.$limit;


eval(subpage("stat2"));


}else{
w_close('create-unique');
}

}elseif($file=='create/upgrade.php'){
define('90d28dcf36bec2d2e0db2fb57d0ff45f',true);

$fields="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, (SELECT `name` from ".mpx."objects as x WHERE x.`id`=".mpx."objects.`own`) as `ownname`, `in`, `ww`, `x`, `y`, `t`";
if($_GET["id"]){
 $id=$_GET["id"];
}elseif($GLOBALS['get']["id"]){
 $id=$GLOBALS['get']["id"];
}else{
 $id=$GLOBALS['ss']["use_object"]->set->ifnot('upgradetid',0);
}


if($id?ifobject($id):false){
 $sql="SELECT $fields FROM ".mpx."objects WHERE id=$id";
 $array=sql_array($sql);
 list($id, $name, $type, $dev, $fs, $fp, $fr, $fx, $fc, $func, $hold, $res, $profile, $set, $hard, $own, $ownname, $in, $ww, $x, $y, $t)=$array[0];
 
 if($own==useid or $own==logid){
 $GLOBALS['ss']["use_object"]->set->add('upgradetid',$id);
 if($fs==$fp){
 }else{
 window('Opravit budovu');
 
 
 
 infob(ahrefr('opravit budovu','e=content;ee=create-upgrade;q='.$id.'.repair'));
 contenu_a();
 xreport();
if(xsuccess()){
 ?>
<script>
setTimeout(function()x{
 w_close('content');
}x,3000);
<?php urlx('e=miniprofile',false); ?>
</script>
<?php
}
 $price=new hold($fc);
 $price->multiply($fp/$fs);
 textb('Cena: ');
 $price->showimg();
 hr();
 profile($id);
 contenu_b();
 
 }
 }
}


}elseif($file=='export.php'){
define('9b70a7fc9e97b4c6ec9d3379141420e8',true);

function export(){
$limit='';
if($_GET['limit'])$limit='LIMIT '.$_GET['limit'];
if($limit)$nln='
';else$nln='';
$stream='';
$stream.='<?xml version="1.0" encoding="UTF-8" ?>'.$nln;
$stream.='<world>'.$nln;

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
$stream.="<map>".$nln;
foreach(sql_array('SELECT `x`, `y`, `ww`, `terrain`, `name` FROM `'.mpx.'map` WHERE 1 '.$limit) as $row){
	list($x,$y,$ww,$terrain,$name)=$row;
	$stream.="<field x=\"$x\" y=\"$y\" ww=\"$ww\" terrain=\"$terrain\" name=\"$name\"/>".$nln;	
}
$stream.="</map>".$nln;
$stream.="<text>".$nln;
foreach(sql_array('SELECT `id`, `idle`, `type`, `new`, `from`, `to`, `title`, `text`, `time`, `timestop` FROM `[mpx]text` WHERE 1 '.$limit) as $row){
	list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop)=$row;
	$text=htmlspecialchars($text);
	$stream.="<row id=\"$id\" idle=\"$idle\" type=\"$type\" new=\"$new\" from=\"$from\" to=\"$to\" title=\"$title\" text=\"$text\" time=\"$time\" timestop=\"$timestop\"/>".$nln;

}
$stream.="</text>".$nln;
$stream.="<login>".$nln;
foreach(sql_array('SELECT `id`, `method`, `key`, `text`, `time_create`, `time_change`, `time_use` FROM `[mpx]login` WHERE 1 '.$limit) as $row){
	list($id, $method, $key, $text, $time_create, $time_change, $time_use)=$row;
	$text=htmlspecialchars($text);
	$stream.="<row id=\"$id\" method=\"$method\" key=\"$key\" text=\"$text\" time_create=\"$time_create\" time_change=\"$time_change\" time_use=\"$time_use\"/>".$nln;

}
$stream.="</login>".$nln;
foreach(sql_array('SELECT `id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`, `collapse`, `own`, `in`, `ww`, `x`, `y`, `t` FROM `'.mpx.'objects` WHERE 1 '.$limit) as $row){
	list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$fc,$func,$hold,$res,$profile,$set,$hard,$expand,$collapse,$own,$in,$ww,$x,$y,$t)=$row;
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
	$stream.="<param key=\"expand\" value=\"$expand\"/>".$nln;
	$stream.="<param key=\"collapse\" value=\"$collapse\"/>".$nln;
	$stream.="<param key=\"own\" value=\"$own\"/>".$nln;
	$stream.="<param key=\"in\" value=\"$in\"/>".$nln;
	$stream.="<param key=\"ww\" value=\"$ww\"/>".$nln;
	$stream.="<param key=\"x\" value=\"$x\"/>".$nln;
	$stream.="<param key=\"y\" value=\"$y\"/>".$nln;
	$stream.="<param key=\"t\" value=\"$t\"/>".$nln;

		
	$stream.="</object>".$nln;
}


$stream.='</world>'.$nln;

return($stream);
}
if(defined('password') and $_GET['password']==password){
echo(export());
}
?>
<?php
}elseif($file=='func.php'){
define('0d80d2056b08e4554f4c14b063ceaa52',true);

require2_once(root.core."/func_vals.php");
require2_once(root.core."/func_object.php");
require2_once(root.core."/func_main.php");
require2_once(root.core."/memory.php");
define("notmp", false);
if($_GET["output"]=="js"){
 define("noreport", true);
}else{
 define("noreport", false);
}
define("imgext", "jpg");

if(!defined('mapsize')){
 $mapsize1=sql_1data('SELECT max(x) FROM [mpx]map WHERE ww=\''.$GLOBALS['ss']["ww"].'\'');
 $mapsize2=sql_1data('SELECT max(y) FROM [mpx]map WHERE ww=\''.$GLOBALS['ss']["ww"].'\'');
 $mapsize1=intval($mapsize1)+1;
 $mapsize2=intval($mapsize2)+1;
 if($mapsize1>$mapsize2){
 $mapsize=$mapsize1;
 }else{
 $mapsize=$mapsize2;
 }
 define('mapsize',$mapsize);
}
define('cookietime',time()+60*60*24*30*12);


function changemap($x,$y,$files=false){
 if($files){
 if(!defined("func_map"))require2(root.core."/func_map.php");
 
 
 
 
 $gy=floor((($y-1)/10)+(($x-1)/10)-0.5);
 $gx_=round((($y-1)/-10)+(($x-1)/10));
 $gy_=round((($y-1)/10)+(($x-1)/10)-0.5);
 $gs=array(array($gx,$gy_),array($gx_,$gy_));
 $x=round($x);
 $y=round($y);
 
 foreach($gs as $g){list($gx,$gy)=$g;
 $file=htmlmap($gx,$gy,2,true); 
 unlink2($file);
 }
 }
 }
function hard($rx,$ry,$w=false){
 if(!$w)$w=$GLOBALS['ss']["ww"];
 $hard1=sql_1data("SELECT IF(`terrain`='t1' OR `terrain`='t11',1,0) FROM `".mpx."map` WHERE `".mpx."map`.`ww`=".$w." AND `".mpx."map`.`x`=$rx AND `".mpx."map`.`y`=$ry"); $hard2=sql_1data("SELECT SUM(`".mpx."objects`. `hard`) FROM `".mpx."objects` WHERE `".mpx."objects`.`ww`=".$w." AND ROUND(`".mpx."objects`.`x`)=$rx AND ROUND(`".mpx."objects`.`y`)=$ry"); $hard=floatval($hard1)+floatval($hard2);
 return($hard);
}
 
if($_GET["w"]){
 $GLOBALS['get']=$GLOBALS['ss'][$_GET["w"]];
}
if($GLOBALS['get']){
 $GLOBALS['ss']["get"]=$GLOBALS['get'];
}

function get($key){return($GLOBALS['ss']["get"][$key]);}
$post=$_POST;
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

function md52($text){
 $md5=md5($text);
 $md5=str_split($md5,4);
 $count=0;
 foreach($md5 as $a){
 $count=$count+hexdec($a);
 }
 return($count);
}
function md5t($text){
 $md5=md5($text);
 $md5=str_split($md5,4);
 $i=intval(hexdec($md5[0])/(256*256)*100000);
 $names=explode(",",$GLOBALS['config']["names"]);
 $i1=mod($i,count($names));
 $i=div($i,count($names));
 $i2=mod($i,count($names));
 $i=div($i,count($names));
 $i=$names[$i1].$names[$i2]; return($i);
 }
function target($sub,$w="",$ee="",$q,$only=false,$rot="",$noi=false,$prompt='',$set=''){
 if($q)$q="&q=$q";
 if($w)$w="&w=$w";
 if($rot)$rot="&rot=$rot";
 if(!$ee)$ee=$sub;
 if($set)$set="&set=$set";
 if($prompt)$prompt="pokracovat = confirm('$prompt');if(pokracovat)";
 $apart=("w_open('$sub','$ee','$w$q$set');");
 $vi="\$('#loading').css('visibility','visible');";
 $iv="\$('#loading').css('visibility','hidden');";
 if(!$noi){$inter="&i=$sub,$ee";}else{$inter="";}
 $bpart=("\$(function()x{\$.get('?e=$ee$w$q$rot$inter$set', function(vystup)x{\$('#$sub').html(vystup);$iv}x);$vi}x);");
 if(!$only){
 return($prompt."x{if($('#$sub').html())x{1;$bpart}xelsex{1;$apart}x}x");
 }else{
 return($prompt."x{if($('#$sub').html())x{1;$bpart}x}x");
 }
}
function subpage($sub,$ee=""){
 if(!$ee)$ee=$sub;
 list($dir,$ee)=explode('-',$ee);
 if(!$ee){$ee=$dir;$dir='page';}
 $eval='echo("<span id=\"'.$sub.'\">");
 require2(core."/'.$dir.'/'.$ee.'.php");
 echo("</span>");';
 return($eval);
 }
function subpage_($sub,$ee=""){
 if(!$ee)$ee=$sub;
 list($dir,$ee)=explode('-',$ee);
 if(!$ee){$ee=$dir;$dir='page';}
 $eval='require2(core."/'.$dir.'/'.$ee.'.php");';
 return($eval);
 }
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
function subjs($sub){
 if(!$ee)$ee=$sub;
 list($dir,$ee)=explode('-',$ee);
 if(!$ee){$ee=$dir;$dir='page';}
 ob_start();
 require2(core.'/'.$dir.'/'.$ee.'.php');
 $buffer = ob_get_contents();
 ob_end_clean();
 
 $buffer=contentlang($buffer);
 $bufferx="";
 foreach(str_split($buffer) as $char){
 if(strtr($char,"ěščřžýáíéúůĚŠČŘŽÝÁÍÉÚŮqwertyuiopasdfghjkl","0000000000000000000000000000000000000000000000000000000000")==$char){
 $char=dechex(ord($char));
 if(strlen($char)==1){ $char=("0".$char); }
 $char="%".$char;
 }
 $bufferx=$bufferx.$char;
 } 
 echo('$("#'.$sub.'").html(unescape("'.($bufferx).'"));');
}
function urlr($tmp){ if(str_replace("http://","",$tmp)==$tmp){
 if(logged()){
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
 if(!$e and !$js and !$ref){
 return(url."?w=".$md5.$q.$rot.$i.$set); }else{
 if($e=="s"){$e=$GLOBALS['ss']["page"];}
 if($ee=="s"){$ee=$GLOBALS['ss']["page"];}
 if($js)$js=xx2x($js).";";
 $js=str_replace("[semicolon]",";",$js);
 $rot=$GLOBALS['ss'][$md5]["rot"];
 $noi=$GLOBALS['ss'][$md5]["noi"];
 $prompt=$GLOBALS['ss'][$md5]["prompt"];
 $set=$GLOBALS['ss'][$md5]["set"];
 if($e)$js=$js.target($e,$md5,$ee,$qq,false,$rot,$noi,$prompt,$set); if($ref)$js=$js.target($ref);
 return("javascript: ".($js)); }
 }else{
 return($tmp);
 }
}
function url($tmp){
 echo(urlr($tmp));
}
function urlxr($url,$script=true){
 $url=urlr($url);
 if(strpos($url,'javascript:')!==false){
 $url=str_replace('javascript:', '', $url);
 $url=trim($url);
 if($script){
 return('<script>'.$url.'</script>');
 }else{
 return($url);
 }
 
 }
}
function urlx($url,$script=true){e(urlxr($url,$script));if($script){exit2();}}
function js2($js){
	return("js=".x2xx($js));
}

function logged(){
 if($GLOBALS['ss']["logid"]){
 return(true);
 }else{
 return(false);
 }
}
define("logged",logged());
function short($text,$len){
 if(substr($text,0,1)=='{')$text=contentlang($text);
 $text2=substr($text,0,$len-3);
 if($text!=$text2){$text2=$text2."...";}
 return($text2);
}
function shortx($text,$len){
 if(substr($text,0,1)=='{')$text=contentlang($text);
 $text2=substr($text,0,$len);
 return($text2);
}
function substr2($input,$a,$b,$i=0,$change=false,$startstop=true){if(rr()){echo("<br/>substr2($input,$a,$b,$i,$change)<br/>");echo($input);}
 if(!$startstop){
 $start=strlen($a);
 $stop=strlen($b); 
 }else{
 $start=0;
 $stop=0;
 }
 $string=$input;
 $aa=strlen($a);
 $p=0;
 for($ii=0;$ii<$i;$ii++){$pp=strpos($string,$a)+1;$p=$p+$pp;$string=substr($string,$pp);}
 $a=strpos($string,$a);
 if($a!==false){if(rr())echo("<br/>".$a);
 $string=substr($string,$a+$aa);
 $b=strpos($string,$b);
 if(rr())echo("/".$b);
 $string=substr($string,0,$b);
 if(rr())echo("<br/>".$change);
 if($change!=false){
 if(rr())echo("<br/>input: ".$input);
 $inner=substr($input,$a+$aa+$p,$b);
 $input=substr_replace($input,$change,$a+$aa+$p-$start,$b+$stop+$start); if(rr())echo("<br/>return: ".$input);
 } if(rr())echo("<br/>return($string)");
 
 $input=str_replace("[]",$inner,$input);
 
 if($change)return($input);
 return($string);
 }else{
 if($change)return($input);
 return(false);
 }
}
function part3($input,$aa,$bb){
 if(strpos($input,$aa)){
 list($a,$input)=explode($aa,$input);
 list($b,$c)=explode($bb,$input);
 return(array($a,$b,$c));
 }else{
 return(array("",$input,""));
 }
}
$GLOBALS['ss']["vals_a"]=array("*",",",";",":","=","(","[","{","}","]",")","\"","\'","\\"," ",nln);
$GLOBALS['ss']["vals_bb"]=array("[1]","[2]","[3]","[4]","[5]","[6]","[7]","[8]","[9]","[10]","[11]","[12]","[13]","[14]","[15]","[16]");
$GLOBALS['ss']["vals_b"]=array("[star]","[comma]","[semicolon]","[colon]","[equate]","[aabracket]","[babracket]","[cabracket]","[cbbracket]","[bbbracket]","[abbracket]","[doublequote]","[quote]","[slash]","[space]","[nln]");
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

function x2xx($text){ $from=$GLOBALS['ss']["vals_a"];
 $to=$GLOBALS['ss']["vals_bb"];
 $text=str_replace2($from,$to,$text);
 return($text);
}
 function xx2x($text){
 $from=$GLOBALS['ss']["vals_b"];
 $to=$GLOBALS['ss']["vals_a"];
 $text=str_replace2($from,$to,$text);
 $from=$GLOBALS['ss']["vals_bb"];
 $text=str_replace2($from,$to,$text);
 return($text);
}
 function smiles($text){
 $stream="";
 $text=str_replace("**","[star]",$text);
 $array=explode("\*",$text);
 $i=-1;
 foreach($array as $part){$i++;
 if($i%2){
 list($img,$width)=explode("\[star\]",$part);
 $img=x2xx($img);
 if(!$width){$width="100%";}
 $stream=$stream.imgr("id_".$img,$img,$width);
 }else{
 $stream=$stream.$part;
 }
 } 
 $stream=str_replace("[star]","*",$stream);
 return($stream);
}
 function array2csv($array){
 $i=0;
 $array_new=array();
 foreach($array as $row){
 $array_new[$i]=array();
 $ii=0;
 foreach($row as $key=>$a){
 $array_new[$i][$ii]=x2xx($a);
 $ii++;
 } $array_new[$i]=join(",",$array_new[$i]);
 $i++;
 }
 $array_new=join(";",$array_new);
 return($array_new);
}
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


require2(root.core."/func_components.php");
require2(root.core."/func_query.php");
?>
<?php
}elseif($file=='func_components.php'){
define('7e8f5972692b5121885063eefa49772c',true);


function refresh($url=""){
echo('<script language="javascript">
 window.location.replace("'.urlr($url).'");
 </script>');
}
function reloc(){
 if(!debug or true){
 header("location: ".url);
 }else{
 echo('<a href="'.url.'">location: '.url.'</a>');
 }
 exit2;
}
function click($url,$timeout=0){

 $tmp=urlr($url);
 if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="";}
 if($tmp){refresh($url);}
 if($onclick){
 if($timeout){
 $onclick='setTimeout(function()x{'.$onclick.'}x,'.($timeout*1000).');';
 } 
 js($onclick);
 } 
}
function window($title=0,$width=0,$height=0,$window='content'){
 if($title){
 ?>
 <script>
 
 $("#window_title_<?php echo($window); ?>").html('<?php echo(trim($title)); ?>');

 </script>
 <?php
 }
 if($width){
 
 ?>
 <div style="width:<?php echo($width); ?>;"></div>
 <?php 
 }

 
}

function w_close($w_name){
 r('w_close');
 echo("<script type=\"text/javascript\">
 \$(document).ready(function()x{
 setTimeout(function()x{w_close('window_$w_name');}x,100);
 }x);
 </script>");
}

define('contentwidth',449);

function contenu_a($top17='',$scroll=true){?>
<?php
if($top17){
 if($top17===true)$top17=nbsp;
 infob($top17);
}

$scroll=true;
$top17=true;

if($scroll){
?>
<style type="text/css">
<!--
#contenu x{
	margin:0 auto;
	padding:0px;
}x

#contenu ul lix{
	margin-bottom:0px;
}x

.clearx{clear:both;}x
-->
</style>
<script type="text/javascript">
	$(document).ready(function()x{
		$("#contenu").scrollbar();
	}x);
</script>
<?php } ?>
<div style="width:<?php echo(contentwidth); ?>;"></div>
<div style="width:<?php echo(contentwidth-17); ?>px;overflow:visible;">
<div id="contenu"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="100%" align="left" valign="top">
 <?php
 xreport(); 
}
function contenu_b(){e('</td><td>'.imgr('design/none.png','',1,1000).'</td></tr></table></div></div>');}


function ir($i,$q=2){
 return(round($i,$q));
}
function ie($i,$q=2){echo(ir($i,$q));}

function lr($i,$params){
 return("{".$i.";$params}");
}
function le($i,$params){
 echo("{".$i.";$params}");
}
function tr($i,$nonl2br=false){
 $i=xx2x($i);
 $i=htmlspecialchars($i);
 if(!$nonl2br){
 $i=nl2br($i);
 $i=str_replace(nln,'<br>',$i);
 $i=str_replace(' ',nbsp,$i);
 $i=smiles($i);
 }
 return($i);
}
function te($i,$nonl2br=false){
 echo(tr($i,$nonl2br));
}
function tfontr($text,$size=14,$color=""){
 if($color){
 return("<span style=\"font-size:$size"."px;color: #$color;\">".($text)."</span>");
 }else{
 return("<span style=\"Font-size:$size"."px;\">".($text)."</span>");
 }
}
function tfont($text,$size=14,$color=""){
 echo(tfontr($text,$size,$color));
}
function tfont_a($size=14){
 echo("<span style=\"Font-size:$size"."px;\">");
}
function tfont_b(){
 echo("</span>");
}
function tcolorr($text,$color=""){
 return("<span style=\"color: #$color;\">".($text)."</span>");
}
function tcolor($text,$color=""){
 echo(tcolorr($text,$color));
}

function textabr($a,$b,$width=300,$width2=200){
 return(tableabr("<b>".tr($a)."</b>",tr($b),$width,$width2));
}
function textab($a,$b,$width=300,$width2=200){echo( textabr($a,$b,$width,$width2));}
function textabr_($array,$width=300,$width2=200,$font=false){
 $al=" align=\"left\" valign=\"top\"";
 $stream='<table width=\"$width\" $al border="0" cellpadding="0" cellspacing="0">';
 foreach($array as $tmp){list($a,$b)=$tmp;
 if($b!=''){
 $stream.=("<tr><td width=\"$width2\" $al><b>".($font?tfontr($a,$font):tr($a))."</b></td><td $al>".($font?tfontr($b,$font):tr($b))."</td></tr>");
 }else{
 $stream.=("<tr><td width=\"$width2\" $al colspan=\"2\"><b>".($font?tfontr($a,$font):tr($a))."</b></tr>");
 }
 }
 
 $stream.='</table>';
 return($stream);
}
function textab_($array,$width=300,$width2=200,$font=false){echo( textabr_($array,$width,$width2,$font));}

function movebyr($text,$x=0,$y=0,$id="",$style=""){
 return("<span id=\"$id\" style=\"position:absolute;$style\"><span style=\"position:relative;left:$x;top:$y;\">".$text."</span></span>");
}
function moveby($text,$x=0,$y=0,$id="",$style=""){
 echo(movebyr($text,$x,$y,$id,$style));
}
function borderr($html,$brd=1,$w=10,$id="",$category="",$countdown=0){
 if($id)$id="border_".$category."_".$id;
 if($countdown){
 $md5=md5(rand(0,999999));
 $md5js='<script>
 setInterval(function()x{ 
 /*alert(($("#'.$md5.'").html()));*/
 $("#'.$md5.'").html(parseFloat($("#'.$md5.'").html())-1);
 if(parseFloat($("#'.$md5.'").html())<=0)x{'.urlxr('e=miniprofile',false).'}x
 }x,1000);
 </script>'; 
 }
 return(movebyr($html,0,0,$id,"position:absolute;width:".($w)."px;height:".($w)."px;border: ".$brd."px solid #cccccc;z-index:1000").imgr("design/iconbg.png",'',$w,$w).($countdown?movebyr(textcolorr('<span id="'.$md5.'">'.$countdown.'</span>','dddddd').$md5js,-34+$brd,18+$brd,NULL,'z-index:2001'):''));
}
function border($html,$brd=1,$w=10,$id="",$category="",$countdown=0){echo(borderr($html,$brd,$w,$id,$category,$countdown));}
function borderjs($id,$sendid="",$category="",$brd=1,$q=true){
 $style_a="'".$brd."px solid #cccccc'";
 $style_b="'0px solid #cccccc'";
 return("\$('#border_".$category."_".$id."').css('border',$style_a);$('#border_".$category."_".$id."').css('z-index',z_index);if(typeof border_".$category."!='undefined')if('#border_".$category."_".$id."'!=border_".$category.")$(border_".$category.").css('border',$style_b);border_".$category."='#border_".$category."_".$id."';z_index++;".($q?"$(function()x{\$.get('?e=nonex&set=".$category.",".$sendid."');}x);":''));
}
function borderr2($html,$brd=1){
 return('<span style="border: '.$brd.'px solid #cccccc;z_index:1000">'.$html.'</span>');
}
function border2($html,$brd=1){echo( borderr2($html,$brd));}


function tableabr($a,$b,$width="100%",$width2="50%"){$al=" align=\"left\" valign=\"top\"";
 return("<table width=\"$width\" $al><tr><td width=\"$width2\" $al>".$a."</td><td $al>".$b."</td></tr></table>");
}
function tableab($a,$b,$width="100%",$width2="50%"){echo( tableabr($a,$b,$width,$width2));}
function tableab_a($al='left',$width="100%",$width2="50%"){
 $al=" align=\"$al\" valign=\"top\"";
 if($width)$width="width=\"$width\"";
 if($width2)$width2="width=\"$width2\"";
 echo("<table $width $al border=\"0\" cellpadding=\"0\" cellspacing=\"0\" valign=\"middle\"><tr><td $width2 $al>");
}
function tableab_b($al="left",$val="top"){$al=" align=\"$al\" valign=\"$val\"";echo("</td><td $al>");}
function tableab_c(){echo("</td></tr></table>");}

function tmpfile2($file,$ext=imgext,$cpath="main"){
 if($cpath)$cpath="/".$cpath;
 $ext=".".$ext;
 $md5=md5($file.$ext);
 $md52=md52($file.$ext);
 list($a,$b)=str_split($md5,2);
 $a=hexdec($a);
 $b=hexdec($b);
 mkdir2(root.cache);
 if($cpath)mkdir2(root.cache.$cpath);
 mkdir2(root.cache.$cpath."/$a");
 mkdir2(root.cache.$cpath."/$a/$b");
 $url=root.cache.$cpath."/$a/$b/$md52".$ext;
 return($url);
}
function cleartmp($id){
 
 unlink(tmpfile2("id_$id"));
 unlink(tmpfile2("id_$id"."_icon"));
}
function imageurl($file,$rot=1,$grey=false){
 $file2=tmpfile2($file.','.$rot.','.$grey,imgext,"image");
 $file1="data/image/".$file;
 if(!file_exists($file2) or filemtime($file1)>filemtime($file2) or notmpimg ){
 if(str_replace("id_","",$file)==$file){
 if($rot>1 or $grey){
 $img=imagecreatefromstring(file_get_contents($file1));
 if($rot==2)$img = imagerotate($img, 90, 0);
 if($rot==3)$img = imagerotate($img, 180, 0);
 if($rot==4)$img = imagerotate($img, 270, 0);
 
 if($grey){ 
 imagefilter($img,IMG_FILTER_GRAYSCALE);
 imagefilter($img,IMG_FILTER_CONTRAST,40);
 imagefilter($img,IMG_FILTER_BRIGHTNESS,-70);
 } 
 
 imagesavealpha($img,true);
 imagepng( $img,$file2);
 chmod($file2,0777);
 }else{
 copy($file1,$file2);
 chmod($file2,0777);
 }
 }else{
 $file=str_replace("id_","",$file);
 if(str_replace("_icon","",$file)!=$file){$q=true;}else{$q=false;}
 $file=str_replace("_icon","",$file);
 $contents=root."userdata/image/".$file.".jpg"; if(!file_exists($contents)){
 
 $profile=sql_1data("SELECT profile FROM ".mpx."objects WHERE id='".$file."' OR name='".$file."'");
 $profile=new profile($profile);
 $profile=$profile->vals2list();
 $icon=$profile["image"];
 if($icon and false){ $contents=root."data/image/".$icon.".jpg"; }else{
 $res=sql_1data("SELECT res FROM ".mpx."objects WHERE id='".$file."' OR name='".$file."'");
 if($res){
 $uz=1;
 if(!defined("func_map"))require2(root.core."/func_map.php");
 $img1=model($res,2,20,1.5,0);
 imagesavealpha($img1,true);
 $contents=$GLOBALS['model_file'];
 $contents=file_get_contents($contents);
 }else{
 $type=sql_1data("SELECT type FROM ".mpx."objects WHERE id='".$file."'");
 $contents=("data/image/types/$type.png");
 }
 }
 }
 if(!$uz)$contents=file_get_contents($contents);
 if($q){
 if(!$uz)$img1=imagecreatefromstring($contents);
 $img2=imagecreatetruecolor(50,50);
 $fill = imagecolorallocate($img2, 40, 40, 40);
 imagefill($img2,0,0,$fill);
 
 if(!$uz){
 imagecopyresampled($img2,$img1,1,1,1,1,50,50,imagesx($img1),imagesy($img1));
 }else{
 imagecopyresampled($img2,$img1,1,1,1,imagesy($img1)-imagesx($img1),50,50,imagesx($img1),imagesx($img1));
 }
 imagejpeg( $img2,$file2);
 chmod($file2,0777);
 }else{
 file_put_contents2($file2,$contents);
 }
 }
 }
 $stream=rebase(url.base.$file2); return($stream);
 
}
function imageurle($file){echo(imageurl($file));}
function imgr($file,$alt="",$width="",$height="",$rot=1,$border=0,$grey=0){
 $alt=tr($alt,true);
 if($width){$width="width=\"$width\"";}
 if($height){$height="height=\"$height\"";}
 $stream=imageurl($file,$rot,$grey);
 if($border)
 $border='style="border: '.$border.'px solid #cccccc"';
 else
 $border='border="0"';
 $stream="<img src=\"$stream\" $border alt=\"$alt\" $width $height />";
 $stream=labelr($stream,$alt);
 return($stream);
}
function imge($file,$alt="",$width="",$height="",$rot=1,$border=0,$grey=0){
 echo(imgr($file,$alt,$width,$height,$rot,$border,$grey));
}
function iconr($url,$icon,$name="",$s=22,$rot=1,$grey=0){
 $file="icons/".$icon.".png";
 
 $tmp=urlr($url);
 if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="#";}
 if($url){$url="href=\"".$tmp."\"";}
 if($onclick){$onclick="onclick=\"$onclick\"";} 
 
 $a="<a $url $onclick >";
 $b="</a>";
 return($a.imgr($file,$name,$s,$s,$rot,NULL,$grey).$b);
}
function icon($url,$icon,$name="",$s=22,$rot=1,$grey=0){echo(iconr($url,$icon,$name,$s,$rot,$grey));}
function iconpr($prompt,$url,$icon,$name="",$s=22){
 $file="icons/".$icon.".png";
 return(ahrefpr($prompt,imgr($file,$name,$s,$s),$url,"none","x"));
}
function iconp($prompt,$url,$icon,$name="",$s=22){echo(iconpr($prompt,$url,$icon,$name,$s));}
function objecticonr($id,$name="",$type="",$fs=0,$fp=0,$url=false,$x=0,$y=0,$br=0){$px=$x;
 if($fp>$fs)$fp=$fs;
 if($br){
 $y=$y+intval($x/$br);
 $x=mod($x,$br);
 }
 if($id){
 $stream="<div style=\"position: absolute;\" ><div style=\"position: relative;top: ".($y*60)."px;left: ".($x*55)."px;width:60px; z-index:2;\" id=\"$id\" class=\"itemdrag\">";
 $stream.=imgr("id_$id"."_icon",$name,50,50);
 if($type!='image' and $type!='message'){
 $stream.="<div style=\"position: relative;top: -50px;left: 0px;Font-size:12px;Color:#000000;\">".fs2lvl($fs)."</div>"; 
 $stream.="<div style=\"position: relative;top: -15px;left: 0px;height:4px;width:50px;Background-color:#ff0000;\">";
 $stream.="<div style=\"height:4px;width:".($fp/$fs*50)."px;Background-color:#00ff00;\"></div></div>";}
 $stream.="</div></div>";
 $stream=labelr($stream,$name);
 }else{
 $stream="<div style=\"position: absolute;\" ><div style=\"position: relative;top: ".($y*60)."px;left: ".($x*55)."px;width:50px; height:50px; border: 1px solid #333333; background-color:#222222; z-index:1;\" id=\"$name\" class=\"itemdrop\">";
 $stream.="</div></div>";
 }
 if($url){
 $stream=ahrefr($stream,"e=content;ee=profile;id=$id","none",'x');
 }
 $stream=nln.nln.$stream.nln.nln;
 return($stream);
}
function objecticone($id,$name="",$type="",$fs=0,$fp=0,$url="",$x=0,$y=0,$br=0){echo(objecticonr($id,$name,$type,$fs,$fp,$url,$x,$y,$br));}
function functionholder($name,$inner,$x=0,$y=0,$br=0){$px=$x;
 $s=40;
 if($br){
 $y=$y+intval($x/$br);
 $x=mod($x,$br);
 }
 $stream="<div style=\"position: absolute;\" ><div style=\"position: relative;top: ".($y*($s+5))."px;left: ".($x*($s+5))."px;width:".$s."px; height:".$s."px; border: 1px solid #333333; background-color:#222222; z-index:1;\" id=\"$name\" class=\"functionholder\">";
 $stream.=$inner."</div></div>";
 echo($stream);
}
function iprofile($id,$width=50){ ahref(imgr("id_$id"."_icon","",$width,$width),"e=content;ee=profile;id=$id","none",'x');
}
function vprofile($id,$values=array()){ tableab_a(200,50);
 iprofile($id);
 tableab_b();
 echo("<span height=\"60\">"); foreach($values as $a=>$b)
 if($b){textab($a,$b,150,80);br();}
 echo("</span>");
 tableab_c();
}
function mprofile($id){ list($name,$type,$fs,$fp,$x,$y)=id2info($id,"name,type,fs,fp,x,y");
 objecticone($id,$name,$type,$fs,$fp,"a",0,0);
}
function tprofile($id){
 $name=id2name($id);
 ahref($name,"page=profile;id=".$id,"none",true);
}
function form_a($url="",$id=''){
 echo("<form method=\"POST\" action=\"$url\" ".($id?'id="form_'.$id.'" name="form_'.$id.'" onsubmit="return false"':'').">");
 $GLOBALS['formid']='form_'.$id;
}
function form_b(){
 echo("</form>");
}
function form_send($text="{ok}"){
 echo("<input type=\"submit\" value=\"$text\" />");
}
function form_sb($text="{ok}"){form_send($text);form_b();}
function form_js($sub,$url,$rows){
?>
<script>
$("#<?php e($GLOBALS['formid']); ?>").submit(function() x{
 $.post('<?php e($url); ?>',
 x{
 <?php
 $q=false;
 foreach($rows as $val){
 if($q)echo(',');
 e("$val: $('#$val').val()");
 $q=true;
 }
 ?>
 }x,
 function(vystup)x{$('#<?php e($sub); ?>').html(vystup);}x
 );
 return(false);
}x);
</script>
<?php
}
function input_textr($name,$value=false,$max=100,$cols="",$style='border: 2px solid #000000; background-color: #eeeeee'){
 if(!$value and !xsuccess())$value=$_POST[$name];
 $value=tr($value,true);
 $stream="<input type=\"input\" name=\"$name\" id=\"$name\" value=\"$value\" size=\"$cols\" maxlength=\"$max\" style=\"$style\"/>";
 return($stream);
}
function input_text($name,$value=1,$max=100,$cols="",$style='border: 2px solid #000000; background-color: #eeeeee'){echo(input_textr($name,$value,$max,$cols));}
function input_passr($name,$value=''){
 $stream="<input type=\"password\" name=\"$name\" id=\"$name\" value=\"$value\" />";
 return($stream);
}
function input_pass($name,$value=''){echo(input_passr($name,$value));}
function input_textarear($name,$value='',$cols="",$rows="",$style=''){
 if(!$value and !xsuccess())$value=$_POST[$name];
 $value=tr($value,true);
 if($cols){$cols="cols=\"$cols\"";}
 if($rows){$rows="rows=\"$rows\"";}
 $stream="<textarea name=\"$name\" id=\"$name\" $cols $rows style=\"$style\">$value</textarea>";
 return($stream);
}
function input_textarea($name,$value='',$cols="",$rows="",$style=''){echo(input_textarear($name,$value,$cols,$rows,$style));}
function input_checkboxr($name,$value){
 if(!$value and !xsuccess())$value=$_POST[$name];
 if($value){$ch="checked=\"checked\"";}else{$ch="";}
 $stream="<input type=\"checkbox\" name=\"$name\" $ch />";
 return($stream);
}
function input_checkbox($name,$value){echo(input_checkboxr($name,$value));}
function input_selectr($name,$value,$values){
 if(!$value and !xsuccess())$value=$_POST[$name];
 $stream="<select name=\"$name\" id=\"$name\">";
 foreach($values as $a=>$b){
 if($a==$value){$ch="selected=\"selected\"";}else{$ch="";}
 $stream.="<option value=\"$a\" $ch >$b</option>";
 }
 $stream.="</select>";
 return($stream);
}
function input_select($name,$value,$values){echo(input_selectr($name,$value,$values));}
function s_input($name,$value){
 $input="s_input_".$name;
 if($_POST[$input])$GLOBALS['ss'][$name]=$_POST[$input];
 if($GLOBALS['ss'][$name])$value=$GLOBALS['ss'][$name];
 form_a('?');
 input_text($input,$value);
 form_sb();
 return($GLOBALS['ss'][$name]);
}
function limit($page,$w,$step,$to,$d=0){$to=$to-$step; if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
 $w=md5("limit_".$e."_".$w);
 if(get('limit'))$GLOBALS['ss'][$w]=get($w);
 if(!$GLOBALS['ss'][$w])$GLOBALS['ss'][$w]=$d;
 $d=$GLOBALS['ss'][$w];
 
 if($to+$step>$step){
 $a=$d-$step;if($a<0){$a=0;}
 $b=$d+$step;if($b>$to){$b=$to;}
 $col="222222";
 $font=17;
 e('<div style="background:#'.$col.';" ><table width="100%"><tr align="center"><td>');
 $l=lr("stat_first");tfont($d==0?textcolorr($l,'777777'):ahrefr($l,"e=$e;ee=$ee;noi=1;limit=1;$w=".(0),"none",true),$font);
 e('</td><td>');
 $l=lr("stat_previous");tfont($d==0?textcolorr($l,'777777'):ahrefr($l,"e=$e;ee=$ee;noi=1;limit=1;$w=".($a),"none",true),$font);
 e('</td><td>');
 tfont(lr("stat_page",(ceil($d/$step)+1).";".(ceil($to/$step)+1)),$font);
 e('</td><td>');
 $l=lr("stat_next");tfont($d==$to?textcolorr($l,'777777'):ahrefr($l,"e=$e;ee=$ee;noi=1;limit=1;$w=".($b),"none",true),$font);
 e('</td><td>');
 $l=lr("stat_last");tfont($d==$to?textcolorr($l,'777777'):ahrefr($l,"e=$e;ee=$ee;noi=1;limit=1;$w=".($to),"none",true),$font);
 e('</td></tr></table></div>');
 }
 
 $GLOBALS['ss']['ord']=$GLOBALS['ss'][$w];
 return($d.",".$step);
}
function bhpr($text){
 return("<a onclick=\"$('#hydepark').css('display','block');\">$text</a>");
}
function bhp($text){
 echo(bhpr($text));
}
function hydepark(){
 echo("<div style=\"display: none\" id=\"hydepark\">");
}
function ihydepark(){
 echo("</div>");
}
function echostream($stream,$highlight=""){
 echo("<table width=\"100%\">");
 $stream=astream($stream);
 foreach($stream as $key => $value){
 $key=explode(":",$key);
 $func=$key[2];
 $key=join("&nbsp;&gt;&nbsp;",$key);
 $value=tr($value);
 if($key!=str_replace("func","",$key)){
 eval("\$help=a_".$func."_help;");
 $key=labelr($key,$help); }
 if($highlight and $key!=str_replace($highlight,"",$key)){
 $key="<span style=\"color: #FF0000;\">$key</span>";
 }
 if($bg=="#000000"){$bg="#070707";}else{$bg="#000000";}
 echo("<tr bgcolor=\"$bg\">");
 echo("<td width=\"50%\">$key</td><td width=\"50%\">$value</td>");
 echo("</tr>");
 }
 echo("</table>");
}
function alert($text,$type,$tr=true,$nbsp=true){
 if($tr)$text=tr($text);
 $col=$type;
 if($type==1){$col="367329";}
 if($type==2){$col="992E2E";}
 if($type==3){$col="322E99";}
 if($type==4){$col="333333";}
 echo("<div style=\"background:#$col;\" >".($nbsp?'&nbsp;&nbsp;&nbsp;':'')."$text</div>");
}
function error($text,$tr=true){
 alert($text,2,$tr);
}
function info($text,$tr=true){
 alert($text,4,$tr);
}
function infob($text){
 alert('<table width="100%"><tr align="center"><td>'.$text.'</td></tr></table>',4,false,false);
}

function blue($text,$tr=true){
 alert($text,3,$tr);
}
function xr($text="",$tr=true){
$q=3;
switch (gettype($text)) {
 case "NULL":
 alert("NULL",$q,$tr);
 break;
 case "string":
 if($text){
 if($text!="t"){
 alert($text,$q,$tr);
 }else{
 alert(ir(time()+microtime()-timestart,2),$q,$tr);
 }
 }else{
 alert("-----------------------------------------------------------------",$q,$tr);
 }
 break;
 case "double":
 case "integer":
 alert($text,$q,$tr);
 break;
 case "resource":
 imagesavealpha($text,true);
 ob_start(); 
 imagepng($text); 
 $datastream=ob_get_contents();
 ob_end_clean();
 $datastream='data:image/png;base64,'.base64_encode($datastream);
 
 echo('<img src="'.$datastream.'"/>');
 break;
 case "boolean":
 if($text){
 alert("true",$q,$tr);
 }else{
 alert("false",$q,$tr);
 }
 break;
 case "array":
 if($text!=array()){
 
 $sub=array(0);
 $i=0;
 while(!$sub[-1] and $i<1000){$i++;
 $value=$text;
 foreach($sub as $ii){
 $keys=array_keys($value);
 $key=$keys[$ii];
 $value=$value[$key];
 }
 if(isset($value)){
 if(!is_array($value)){
 $iii=1;$sp="";
 while($iii<sizeof($sub)){$iii++;
 $sp=$sp."_|_";
 }
 alert($sp.$key." => ".$value,$q,$tr);
 $sub[sizeof($sub)-1]++;
 }else{
 $iii=1;$sp="";
 while($iii<sizeof($sub)){$iii++;
 $sp=$sp."_|_";
 }
 alert($sp.$key." =>> ",$q,$tr);
 
 $sub[sizeof($sub)]=0;
 }
 }else{
 array_pop($sub);
 $sub[sizeof($sub)-1]++;
 }
 
 }
 }else{
 alert("empty array",$q,$tr);
 }
 break;
 default:
 alert("neznámý typ",$q,$tr);
}
}
function r($text="",$a,$b,$c,$d,$e,$f){
 if(debug or is_resource($text)){
 xr($text);
 if(isset($a)){xr($a);}
 if(isset($b)){xr($b);}
 if(isset($c)){xr($c);}
 if(isset($d)){xr($d);}
 if(isset($e)){xr($e);}
 if(isset($f)){xr($f);}
 }
}
function rx($text=""){
 r($text);
 exit;
}
function rn($text=""){
 xr($text,false);
}
function textcolorr($text,$color){
 if($color=="M"){$color="ff7766";} if($color=="T"){$color="7799ff";} if($color=="N"){$color="99CC66";} if($color=="X"){$color="cccccc";} if($color){
 return("<span style=\"color: #$color;\">$text</span>");
 }else{
 return($text);
 }
}
function textqqr($text){
 return(nbsp2.textcolorr("(".$text.")","999999"));
}
function textbr($text){
 return("<b>$text</b>");
}
function textb($text){
 echo(textbr($text));
}
function lvlr($a,$b,$a2=false,$b2=false){
 if($a2!==false){
 $q=round(($a+$a2)*($b*$b2),2);
 $a=round($a,2);$b=round($b,2);
 $a2=round($a2,2);$b2=round($b2,2);
 $q=textbr($q);
 $q=$q.textqqr("$a,$b%)($a2,$b2%");
 }else{
 $q=round($a*$b,2);$a=round($a,2);$b=round($b,2);
 $q=textbr($q);
 if($b!=1){$b=$b*100;$q=$q.textqqr("$a,$b%");}
 }
 return($q);
}
function jsr($js){
 $js='<script type="text/javascript">'.$js.'</script>';
 return($js);
}
function js($js){
 echo(jsr($js));
}
function ahrefr($text,$url,$textd="none",$nol=true,$id=false,$data=false,$onclick=""){
 if(!$data){$data=$GLOBALS['ss'];}
 if($nol!="x"){ if(!$nol){$text=lr($text);}else{$text=tr($text);}}
 if($id?(str_replace($id."=".$data[$id],"",$url)==$url):true or !$textd){
 if(!$textd){$textd="none";}
 $add1="<span style=\"text-decoration:$textd;\">";
 $add2="</span>";
 }else{
 $add1="<span style=\"color: #FF7733;text-decoration:$textd;\">";
 $add2="</span>";
 }
 $tmp=urlr($url);
 if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="#";}
 if($url){$url="href=\"".$tmp."\"";}
 if($onclick){$onclick="onclick=\"$onclick\"";}
 return("<a $url $onclick >$add1$text$add2</a>");
}
function ahref($text,$url,$textd="none",$nol=true,$id=false,$data=false,$onclick=""){echo(ahrefr($text,$url,$textd,$nol,$id,$data,$onclick));}
function ahrefpr($prompt,$text,$url,$textd="underline",$nol=false,$id="page",$data=false){
 $tmp=urlr($url);
 if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="#";} 
 
 if($onclick){
 $onclick="pokracovat = confirm('$prompt');if(pokracovat) ".$onclick;
 }else{
 $onclick="pokracovat = confirm('$prompt');if(pokracovat) window.location.replace('".urlr($url)."');";
 }
 $html=ahrefr($text,"",$textd,$nol,$id,$data,$onclick);
 return($html);
}
function ahrefp($prompt,$text,$url,$textd="underline",$nol=false,$id="page",$data=false){echo(ahrefpr($prompt,$text,$url,$textd,$nol,$id,$data));}
function submenu($page,$array,$deafult=1,$session="submenu",$v=false){
 if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
 if(!$GLOBALS['ss'][$session]){$GLOBALS['ss'][$session]=$deafult;}
 if($GLOBALS['ss']["get"][$session]){$GLOBALS['ss'][$session]=$GLOBALS['ss']["get"][$session];}
 $col="111111";
 $percent=round(100/count($array));
 if(!$v)echo("<table width=\"100%\" bgcolor=\"$col\"><tr>");
 $i=0;
 while($array[$i]){
 if(!$v)echo("<td align=\"center\" width=\"$percent%\">");
 ahref($array[$i],"e=$e;ee=$ee;".$session."=".($i+1),"none",false,"submenu");
 if(!$v){echo("</td>");}else{br();}
 $i++;
 }
 if(!$v)echo("</tr></table>");
 return($GLOBALS['ss'][$session]);
}
function submenu_img($page,$label,$images,$names,$session="submenu_img"){
 if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
 echo("<table>");
 echo("<tr><td align=\"left\" valign=\"center\" width=\"100\">");
 tfont($label,17);
 if(!$GLOBALS['ss'][$session]){$GLOBALS['ss'][$session]=1;}
 if($GLOBALS['ss']["get"][$session]){$GLOBALS['ss'][$session]=$GLOBALS['ss']["get"][$session];}
 $col="111111";
 $percent=100/count($array);
 $i=0;
 while($images[$i]){
 echo("</td><td valign=\"top\" align=\"center\" width=\"40\">");
 $icon=iconr("e=$e;ee=$ee;".$session."=".($i+1),$images[$i],$names[$i],40);
 if($GLOBALS['ss'][$session]==($i+1)){
 border($icon,2,40);
 }else{
 e($icon);
 }
 $i++;
 }
 echo("</td></tr>");
 echo("</table>");
 return($GLOBALS['ss'][$session]);
}

function timer($t){$timestamp=$t;
$t=date("Y:m:d:H:i:s",$t);
list($year, $month, $day, $hour, $minute, $second) = explode(':', $t);
$params="timestamp=$timestamp;day=$day;month=$month;year=$year;hour=$hour;minute=$minute;second=$second";
if(date("d:m:Y",time()-86400*2) == "$day:$month:$year"){
return(lr("timex2",$params));
}
if(date("d:m:Y",time()-86400) == "$day:$month:$year"){
return(lr("timex1",$params));
}
if(date("d:m:Y") == "$day:$month:$year"){
return(lr("timex",$params));
}
if(date("d:m:Y",time()+86400) == "$day:$month:$year"){
return(lr("timeq1",$params));
}
if(date("d:m:Y",time()+86400*2) == "$day:$month:$year"){
return(lr("timeq2",$params));
}
return(lr("time",$params));
}
function timee($t){echo(timer($t));}
function timecr($t,$sec=true){
 $t=abs($t-time());
 list($second,$minute,$hour,$day,$month,$year)=divarray($t,array(1,60,3600,3600*24,3600*24*30,3600*24*356));
 if(!$sec)$second=0;
 if($second){if($second==1){$second="{tsecond1}";}elseif($second<5){$second="$second {tsecond2}";}else{$second="$second {tsecond5}";}}
 if($minute){if($minute==1){$minute="{tminute1}";}elseif($minute<5){$minute="$minute {tminute2}";}else{$minute="$minute {tminute5}";}}
 if($hour){if($hour==1){$hour="{thour1}";}elseif($hour<5){$hour="$hour {thour2}";}else{$hour="$hour {thour5}";}}
 if($day){if($day==1){$day="{tday1}";}elseif($day<5){$day="$day {tday2}";}else{$day="$day {tday5}";}}
 if($month){if($month==1){$month="{tmonth1}";}elseif($month<5){$month="$month {tmonth2}";}else{$month="$month {tmonth5}";}}
 if($year){if($year==1){$year="{tyear1}";}elseif($year<5){$year="$year {tyear2}";}else{$year="$year {tyear5}";}}
 $stream="{tleft} ";
 foreach(array($year,$month,$day,$hour,$minute,$second) as $row){
 if($q){if($row){$stream.=" {tjoin} ".$row;}break;}
 if($row){$stream.=$row;$q=true;}
 }
 return($stream);
}
function timece($t,$sec=true){echo(timecr($t,$sec));}
function timesr($t,$sec=true){
 $t=abs($t);
 list($second,$minute,$hour,$day,$month,$year)=divarray($t,array(1,60,3600,3600*24,3600*24*30,3600*24*356));
 if(!$sec)$second=0;
 if($second){if($second==1){$second="{tsecond1}";}elseif($second<5){$second="$second {tsecond2}";}else{$second="$second {tsecond5}";}}
 if($minute){if($minute==1){$minute="{tminute1}";}elseif($minute<5){$minute="$minute {tminute2}";}else{$minute="$minute {tminute5}";}}
 if($hour){if($hour==1){$hour="{thour1}";}elseif($hour<5){$hour="$hour {thour2}";}else{$hour="$hour {thour5}";}}
 if($day){if($day==1){$day="{tday1}";}elseif($day<5){$day="$day {tday2}";}else{$day="$day {tday5}";}}
 if($month){if($month==1){$month="{tmonth1}";}elseif($month<5){$month="$month {tmonth2}";}else{$month="$month {tmonth5}";}}
 if($year){if($year==1){$year="{tyear1}";}elseif($year<5){$year="$year {tyear2}";}else{$year="$year {tyear5}";}}
 foreach(array($year,$month,$day,$hour,$minute,$second) as $row){
 if($q){if($row){$stream.=" {tjoin} ".$row;}break;}
 if($row){$stream.=$row;$q=true;}
 }
 return($stream);
}
function timese($t,$sec=true){echo(timesr($t,$sec));}
function xyr($x,$y,$ww=''){
 if($ww and $ww!=$GLOBALS['ss']['ww']){
 return(tcolorr("[".intval($x).",".intval($y)."]",'777777'));
 }else{
 return("[".intval($x).",".intval($y)."]");
 }
}
function xy($x,$y){echo(xyr($x,$y));}
function labelr($html,$label){
$html="<span title=\"$label\">$html</span>";
return($html);
}
function labele($html,$label){echo(labelr($html,$label));}

function liner_($id="use",$p=1){
 $response=xquery("info",$id);
 $id=$response["id"];
 if($p>1)$p="".$p;
 $hline=lr($response["type"].$p)." ".tr($response["name"],true);
 if($response["in"]){
 $hline=$hline.'('.$response["inname"].')';
 }
 return($hline);
}
function liner($id="use",$p=1){
 $response=xquery("info",$id);
 $id=$response["id"];
 if($p>1)$p="_".$p;
 $hline=textcolorr(lr($response["type"].$p),$response["dev"])." ".tr($response["name"],true);
 if($response["in"]){
 $hline=$hline.textqqr(ahrefr($response["inname"],"page=profile;id=".$response["in"],"none",true));
 }
 $hline=ahrefr($hline,"e=content;ee=profile;page=profile;ref=left;".show.";id=".$id,"none",true);
 return($hline);
}
function line($id="use",$p=1){echo(liner($id,$p));}
function profiler($id="use"){
 $stream="";
 $response=xquery("info",$id);
 $response["func"]=new func($response["func"]);
 $funcs=$response["func"]->vals2list();
 $response["profile"]=new profile($response["profile"]);
 $array=$response["profile"]->vals2list();
 $response["set"]=new set($response["set"]);
 $array2=$response["set"]->vals2list();
 $id=$response["id"];
 if($array["showmail"]){$array["mail"]=$array2["mail"];}
 $array["showmail"]="";
 $in2=xquery("items");
 $in2=$in2["items"];
 $in2=csv2array($in2);
 $stream.=("<table width=\"".(contentwidth-3)."\"><tr><td valign=\"top\"><table>");
 $hline=tfontr(textcolorr(lr($response["type"]),$response["dev"])." ".tr($response["name"],true),18);
 if($response["in"]){
 $hline=$hline.textqqr(ahrefr($response["inname"],"page=profile;id=".$response["in"],"none",true));
 }
 $stream.=("<tr><td colspan=\"2\" width=\"300\"><h3>$hline<hr/></h3></td></tr>");
 $stream.=("<tr><td><b>".lr("id").": </td><td></b>".($response["id"])."</td></tr>");
 
 if($response["type"]=='building'){
 
 $stream.=("<tr><td><b>".lr("level").": </td><td></b>".fs2lvl($response["fs"])."</td></tr>");
 $stream.=("<tr><td><b>".lr("life").": </td><td></b>".round($response["fp"])." / ".round($response["fs"])."</td></tr>");
 
 }elseif($response["type"]=='town'){
 
 $building_count=sql_1data('SELECT count(1) FROM [mpx]objects as x WHERE x.own='.$id.' AND type=\'building\'');
 $lvl=sql_1data('SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own='.$id.' AND type=\'building\'');
 
 $stream.=("<tr><td><b>".lr("level").": </td><td></b>".fs2lvl($lvl)."</td></tr>");
 $stream.=("<tr><td><b>".lr("building_count").": </td><td></b>".$building_count."</td></tr>");

 }elseif($response["type"]=='user'){

 $town_count=sql_1data('SELECT count(1) FROM [mpx]objects as x WHERE x.own='.$id.' AND type=\'town\'');
 $building_count=sql_1data('SELECT count(1) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own='.$id.' LIMIT 1) AND type=\'building\'');
 $lvl=sql_1data('SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own='.$id.' LIMIT 1) AND type=\'building\'');
 

 $stream.=("<tr><td><b>".lr("level").": </td><td></b>".fs2lvl($lvl)."</td></tr>");
 $stream.=("<tr><td><b>".lr("town_count").": </td><td></b>".$town_count."</td></tr>");
 $stream.=("<tr><td><b>".lr("building_count").": </td><td></b>".$building_count."</td></tr>");

 }
 foreach($array as $a=>$b){
 if($a!=''.($a-1+1) and trim($b) and $b!="@" and $a!="text" and $a!="description" and $a!="text" and $a!="image"){
 $pa=$a;
 $a=lr($a);
 $b=tr($b);
 if($pa=="gender"){$b=lr($b);}
 if($pa=="age"){$b=intval((time()-$b)/(3600*24*365.25),0.1);}
 if($pa=="mail"){$b="<a href=\"mailto: $b\">$b</a>";}
 if($pa=="web"){$b="<a href=\"http://$b/\">$b</a>";}
 $stream.=("<tr><td ><b>$a: </b></td><td>$b</td></tr>");
 }
 }
 $stream.=("<tr><td colspan=\"2\"><hr/></td></tr>");

 $support=array();
 $stream3="";
 $stream3=$stream3.("<table width=\"100%\" cellspacing=\"0\">");
 foreach($in2 as $item){
 list($_id,$_type,$_fp,$_fs,$_dev,$_name,$_password,$_func,$_set,$_res,$_profile,$_hold,$_own,$_in,$_t,$_x,$_y)=$item;
 $_x=intval($_x);$_y=intval($_y);
 $i++;
 if(!$_x)$_x="";
 $stream2="";
 foreach($funcs["hold$_x"]["params"] as $param=>$value){
 list($qqe1,$e2)=$value;
 if($param!="q"){
 foreach(func2list($item[7]) as $funci){
 if($funci["class"]==$param){
 $stream2=$stream2.nbspo."<b>".tr($funci["profile"]["name"])."</b> (".($e2*100)."%)".br;
 foreach($funci["params"] as $parami=>$valuei){
 list($e1i,$e2i)=$valuei;
 $e1i=$e1i*$e2;
 $e2i=pow($e2i,$e2); if(!$support[$funci["class"]])$support[$funci["class"]]=array();
 if(!$support[$funci["class"]][$parami])$support[$funci["class"]][$parami]=array(0,1);
 $stream2=$stream2.(nbspo.nbsp3.lr("f_".$funci["class"]."_".$parami)." + ".lvlr($e1i,$e2i).br);
 $support[$funci["class"]][$parami][0]=$support[$funci["class"]][$parami][0]+$e1i;
 $support[$funci["class"]][$parami][1]=$support[$funci["class"]][$parami][1]*$e2i;

 }
 }
 }
 }
 }
 if($stream2){
 $stream3=$stream3.("<tr height=\"55\"><td align=\"left\" valign=\"top\">");
 $stream3=$stream3.objecticonr($_id,$_name,$_type,$_fs,$_fp,"page=profile;id=$_id",0,0);
 $stream3=$stream3.$stream2;
 $stream3=$stream3.("</td></tr>");
 }
 }
 $stream3=$stream3.("</table>");
 $classes=array("move","create","attack","defence");
 foreach($classes as $aclass){
 foreach($funcs as $name=>$func){
 $class=$func["class"];
 if($class==$aclass){
 $params=$func["params"];
 $profile=$func["profile"];
 if($profile["name"]){$tmp=textbr($profile["name"]).textqqr(lr("f_$class"));}else{$tmp=textbr(lr("f_$class"));}
 if(!($class=="image" or $class=="message" or $class=="hold" or $class=="info" or $class=="item" or $class=="items" or $class=="login" or $class=="profile_edit" or $class=="set_edit" or $class=="use")){
 $stream.=("<tr><td colspan=\"2\">$tmp</td></tr>");
 foreach($params as $fname=>$param){
 $e1=$param[0];$e2=$param[1]; $stream.=("<tr><td>");
 $stream.=nbsp3.lr("f_".$class."_".$fname).":";
 $stream.=("</td><td>");
 $support1=$support[$class][$fname];
 if($support1){
 list($se1,$se2)=$support1;
 
 $stream.=lvlr($e1,$e2,$se1,$se2);
 }else{
 $stream.=lvlr($e1,$e2);
 }
 $stream.=("</td></tr>");
 }
 }
 }
 }
 }
 $stream.=("</table>");
 $stream.=$stream3;
 if($response['ww']==$GLOBALS['ss']['ww']){
 $stream.=("<hr/>");
 if(useid==$id or logid==$id){
 
 $stream.=ahrefr("Upravit profil","e=content;ee=profile_edit;id=$id",false);
 $stream.=("<br/>");
 
 if(logid==$id){
 $stream.=ahrefr("Změnit heslo","e=content;ee=password_edit",false);
 $stream.=("<br/>");
 }
 }else{
 if($response["type"]=='building' or $response["type"]=='tree' or $response["type"]=='rock')$stream.=ahrefr("attack_".$response["type"],"e=content;ee=attack-attack;page=attack;set=attack_id,$id",false); 
 }}
 if($GLOBALS['ss']["useid"]==$response["in"]){
 $stream.=ahrefpr("Opravdu chcete odhodit tento předmět?","odhodit předmět","query=item $id drop",false);
 }
 if($response["type"]!="message") {
 $stream.=("</td><td align=\"justify\" valign=\"top\" width=\"147\">");
 $stream.=imgr("id_$id","",147);
 $stream.=br;
 $stream.=tr($array["description"]);
 }else{
 $stream.=("</td><td width=\"200\" align=\"left\" valign=\"top\">");
 $stream.="<b>".tr($array["subject"])."</b>".br;
 $stream.=tr($array["text"]);
 }
 $stream.=("</td></tr></table>");
 return($stream);
}
function profile($id="use"){echo(profiler($id));}

}elseif($file=='func_core.php'){
define('0211e1013c4cd89adce794d4b3962e55',true);

define("a_leave_help","");
function a_leave($id){
 sql_query('UPDATE [mpx]objects SET own=0 WHERE own='.useid.' AND id='.$id);
}


define("a_info_help","[q={use,log,id}]");
function a_info($q="use"){
 if($q!="use" and $q!="log"){
 $GLOBALS['ss']["tmp_object"]= new object($q);
 if(!$GLOBALS['ss']["tmp_object"]->loaded){
 $GLOBALS['ss']["query_output"]->add("error","Neexistující objekt");
 return;
 }
 $q="tmp";
 }
 if($GLOBALS['ss']["use_object"] and $GLOBALS['ss'][$q."_object"]){
 $GLOBALS['ss']["query_output"]->add("1",1);
 $GLOBALS['ss']["query_output"]->add("id",$GLOBALS['ss'][$q."_object"]->id);
 $GLOBALS['ss']["query_output"]->add("type",$GLOBALS['ss'][$q."_object"]->type);
 $GLOBALS['ss']["query_output"]->add("fp",$GLOBALS['ss'][$q."_object"]->fp);
 $GLOBALS['ss']["query_output"]->add("fs",$GLOBALS['ss'][$q."_object"]->fs);
 $GLOBALS['ss']["query_output"]->add("fr",$GLOBALS['ss'][$q."_object"]->fr);
 $GLOBALS['ss']["query_output"]->add("fx",$GLOBALS['ss'][$q."_object"]->fx);
 $GLOBALS['ss']["query_output"]->add("dev",$GLOBALS['ss'][$q."_object"]->dev);
 $GLOBALS['ss']["query_output"]->add("name",$GLOBALS['ss'][$q."_object"]->name);
 $GLOBALS['ss']["query_output"]->add("func",$GLOBALS['ss'][$q."_object"]->func->vals2str());
 $GLOBALS['ss']["query_output"]->add("support",$GLOBALS['ss'][$q."_object"]->support());
 $GLOBALS['ss']["query_output"]->add("profile",$GLOBALS['ss'][$q."_object"]->profile->vals2str());
 $GLOBALS['ss']["query_output"]->add("hold",$GLOBALS['ss'][$q."_object"]->hold->vals2str());
 $GLOBALS['ss']["query_output"]->add("own",$GLOBALS['ss'][$q."_object"]->own);
 $GLOBALS['ss']["query_output"]->add("ownname",$GLOBALS['ss'][$q."_object"]->ownname);
 $GLOBALS['ss']["query_output"]->add("own2",$GLOBALS['ss'][$q."_object"]->own2);
 $GLOBALS['ss']["query_output"]->add("in",$GLOBALS['ss'][$q."_object"]->in);
 $GLOBALS['ss']["query_output"]->add("inname",$GLOBALS['ss'][$q."_object"]->inname);
 $GLOBALS['ss']["query_output"]->add("t",$GLOBALS['ss'][$q."_object"]->t);
 $GLOBALS['ss']["query_output"]->add("tasks",$GLOBALS['ss'][$q."_object"]->tasks);
 list($x,$y)=$GLOBALS['ss'][$q."_object"]->position();
 $GLOBALS['ss']["query_output"]->add("ww",$GLOBALS['ss'][$q."_object"]->ww);
 $GLOBALS['ss']["query_output"]->add("x",$x);
 $GLOBALS['ss']["query_output"]->add("y",$y);
 }
}
define("a_profile_edit_help","id,key,value");
function a_profile_edit($id,$key,$value){
 if($id==useid)$object=$GLOBALS['ss']["use_object"];
 if($id==logid)$object=$GLOBALS['ss']["log_object"];
 if($key!="name"){
 $GLOBALS['ss']["query_output"]->add("1",1);
 $GLOBALS['ss']["query_output"]->add("success","{profile_$key} {editted}");
 $object->profile->add($key,$value);
 }else{
 $q=name_error($value);
 if(!$q){
 $object->name=$value;
 $GLOBALS['ss']["query_output"]->add("success","{profile_name} {editted}");
 }else{
 $GLOBALS['ss']["query_output"]->add("error",$q); 
 }
 }
}
define("a_items_help","");
function a_items(){
 $csv=sql_csv("SELECT `id`,`type`,`fp`,`fs`,`dev`,`name`,NULL,`func`,`set`,NULL,`profile`,`hold`,`own`,`in`,`t`,`x`,`y` FROM ".mpx."objects WHERE `in`='".($GLOBALS['ss']["use_object"]->id)."' ORDER BY t desc");
 $GLOBALS['ss']["query_output"]->add("items",$csv);
}
define("a_item_help","id,action[,param,param2]");
function a_item($id,$action,$param=false,$param2=false){
 $item=new object($id);
 if($action=="drop"){
 $item->delete();
 }elseif($action=="status"){
 $item->profile->add("status",$param);
 }elseif($action=="hold"){
 $itemx=new object("","`in`='".($GLOBALS['ss']["use_object"]->id)."' and x='$param' and y='$param2'");
 if($itemx->loaded){
 $itemx->x=$item->x;
 $itemx->y=$item->y;
 }
 $item->x=$param;
 $item->y=$param2;
 }
}



?>
<?php
}elseif($file=='func_main.php'){
define('d8673a6d80ef9f94b0f48ddf90319765',true);

define('gr',1.618033);
define('e',2.71828);

define("nln", "
");
define("br", "<br/>");
define("hr", "<hr/>");
define("nbsp", "&nbsp;");
define("nbsp2", "&nbsp;&nbsp;");
define("nbsp3", "&nbsp;&nbsp;&nbsp;");
define("nbspo", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
function br($q=1){for($i=1;$i<=$q;$i++)echo(br);}
function hr($width=''){if(!$width){echo(hr);}else{echo('<hr width="'.$width.'">');}}
function tab($q=50){for($i=1; $i<=$q; $i++)echo(nbsp);}
function e($a){echo($a);}


function s($key,$value=""){
	if(is_array($key))$key=join('_',$key);
if($value){
	$GLOBALS['ss'][$key]=$value;
}else{
	return($GLOBALS['ss'][$key]);
}
}
function ss($key,$value="",$deafult=""){
 if($value)s($key,$value);
 if(!s($key))s($key,$deafult);
 return(s($key));
}
function backup(&$value,$deafult=""){
 $key=$deafult;
 if($value){
 s("backup_$key",$value);
 }else{
 if(s("backup_$key")){
 $value=s("backup_$key");
 }else{
 $value=$deafult;
 }
 }
 return($key);
}

function rr(){return(false);}
function mod($a,$b){return(round((($a/$b)-intval($a/$b))*$b));}
function div($a,$b){return(intval($a/$b));}
function diff($a,$b){return(mod($a,$b));}
function divarray($q,$array){
 $array=array_reverse($array);
 foreach($array as &$div){
 $tmp=$div;
 $div=div($q,$tmp);
 $q=$q-($div*$tmp);
 }
 $array=array_reverse($array);
 return($array);
}
function multi5($a1,$b1,$c1,$a2,$c2){
 if($b1<=$a1){return($a2);}
 if($b1>=$c1){return($c2);}
 $p1=($b1-$a1)/($c1-$a1);
 $b2=(($c2-$a2)*$p1)+$a2;
 return($b2);
}
function time5($a1,$c1,$a2,$c2){
 return(multi5($a1,time(),$c1,$a2,$c2));
}
function fs2lvl($fs,$decimal=0){
 $decimal=pow(10,$decimal);
 $lvl=ceil(sqrt($fs)*$decimal)/$decimal;
 return($lvl); 
}
function nn($tmp){
 if($tmp){
 return($tmp); 
 }else{
 return("{null}");
 }
}
function rebase($url){ return(preg_replace('(\/[^\/]*\/\.\.\/)', '/', $url));}
function file_put_contents2($file,$contents){
 $fh = fopen($file, 'w');
 fwrite($fh, $contents);
 fclose($fh);
 chmod($file,0777);
}
function mkdir2($dir){
 if(substr($dir,0,1)=='/')$dir=substr($dir,1);
 if(!file_exists($dir)){mkdir($dir);chmod($dir,0777);}
 }
function mkdir3($dirs){$dirx='';foreach(explode('/',$dirs) as $dir){$dirx.='/'.$dir;mkdir2($dirx);}}
function unlink2($file){
 if(!unlink($file)){r($file." not deleted");}
}

function emptydir($dir,$delete=false){
 if(substr($dir,-1,1)!='/')$dir=$dir.'/';
 if ($handle = opendir($dir)){
 $array = array();
 
 while (false !== ($file = readdir($handle))) {
 if ($file != "." && $file != "..") {
 
 if(is_dir($dir.$file)){
 if(!@rmdir($dir.$file)){ emptydir($dir.$file.'/',true); }
 }else{
 @unlink($dir.$file);
 }
 }
 }
 closedir($handle);
 
 if($delete)@rmdir($dir);
 }
} 
function astream($stream,$multi=true){ $array=array();
 $arraytmp=array();
 $br=array("\n","\r");
 $br2="
 ";
 $stream=" $stream ";
 while(strpos($stream,"/*")){
 $a=strpos($stream,"/*");
 $b=strpos(substr($stream,$a),"*/");
 $stream=substr_replace($stream,"",$a,$b+2);
 }
 while(strpos($stream,"//")){
 $a=strpos($stream,"//");
 $b=strpos(substr($stream,$a),nln);
 $stream=substr_replace($stream,"",$a,$b+1);
 }
 $stream=str_replace($br," ",$stream);
 $arraytmp=explode("; ",$stream);
 foreach($arraytmp as $tmp){
 list($a,$b)=explode("=",$tmp,2);
 $a=trim($a);
 $b=trim($b);
	$b=str_replace('\\','',$b);
 if($a){
 if($multi)$a=str_replace(":","']['",$a);
 $a="\$array['$a']";
 $a=$a."=\$b;";
 eval($a);
 
 }
 }
 return($array);
}

function estream($e){
 $stream="";
 foreach($e as $key => $value){
 $stream=$stream."$key=$value;\n";
 }
 return($stream);
}

define('w',$GLOBALS['inc']['world']);


$file=(root."world/".w.".txt");
if(!file_exists($file)){
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>World Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested world '<?php echo(w); ?>' was not found on this server.</p>
<hr>
<?php echo($_SERVER["SERVER_SIGNATURE"]); ?>
</body></html>

<?php
exit2(); 
} 
 
$stream=file_get_contents($file);
$stream=astream($stream);
foreach($stream as $key=>$value){
 if(!defined($key))define($key,$value);
 $GLOBALS['config'][$key]=$value;
}



if(!defined('url'))define('url',$GLOBALS['inc']['url']);
if(!defined('cache'))define('cache',str_replace('[world]',w,$GLOBALS['inc']['cache']));
if(!defined('mysql_host'))define('mysql_host',$GLOBALS['inc']['mysql_host']);
if(!defined('mysql_user'))define('mysql_user',$GLOBALS['inc']['mysql_user']);
if(!defined('mysql_password'))define('mysql_password',$GLOBALS['inc']['mysql_password']);
if(!defined('mysql_db'))define('mysql_db',str_replace('[world]',w,$GLOBALS['inc']['mysql_db']));
if(!defined('mysql_prefix'))define('mysql_prefix',str_replace('[world]',w,$GLOBALS['inc']['mysql_prefix']));
if(!defined('lang'))define('lang',$GLOBALS['inc']['lang']);
if(!defined('debug') and $GLOBALS['inc']['debug'])define('debug',1);
if(!defined('fb_appid') and $GLOBALS['inc']['fb_appid'])define('fb_appid',$GLOBALS['inc']['fb_appid']);
if(!defined('fb_secret') and $GLOBALS['inc']['fb_secret'])define('fb_secret',$GLOBALS['inc']['fb_secret']);
if(!defined('analytics') and $GLOBALS['inc']['analytics'])define('analytics',$GLOBALS['inc']['analytics']);

if(!defined('debug'))define('debug',0);
if(!defined('notmpimg'))define('notmpimg',0);
if(!defined('timeplan'))define('timeplan',0);
if(!defined('lem'))define('lem',0);


define("mpx",mysql_prefix);


if(!debug)error_reporting(0);


mkdir3(root.cache);
mkdir2(root.'userdata');
mkdir2(root.'world');



try {
$GLOBALS['pdo'] = new PDO('mysql:host='.mysql_host.';dbname='.mysql_db, mysql_user, mysql_password, array(PDO::ATTR_PERSISTENT => true));
$GLOBALS['pdo']->exec("set names utf8");
} catch (PDOException $e) {
 if(!defined('nodie'))exit2('Could not connect: ' . $e->getMessage());
}

function sql($text){return(addslashes($text));}
function sql_mpx($text){return(str_replace('[mpx]',mpx,$text));}
function sql_query($q,$w=false){
 $q=sql_mpx($q);
 if($w==1){r($q);}
 if($w==2){echo($q);}
 $response=$GLOBALS['pdo']->exec($q);
 
 return($response);
}
function sql_1data($q,$w=false){
 $q=sql_mpx($q);
 if($w==1){r($q);}
 if($w==2){echo($q);}
 $response= $GLOBALS['pdo']->prepare($q);
 $response->execute();
 $err=($response->errorInfo());if($err=$err[2] and debug)e($err);
 $response = $response->fetchAll();
 while(is_array($response))$response=$response[0];
 return($response);
}
function sql_array($q,$w=false){
 $q=sql_mpx($q);
 if($w==1){r($q);}
 if($w==2){echo($q);}
 $array= $GLOBALS['pdo']->prepare($q);
 $array->execute();
 $err=($array->errorInfo());if($err=$err[2] and debug)e($err);
 $array = $array->fetchAll();
 return($array);
}
function sql_csv($q,$w=false){
 $q=sql_mpx($q);
 if($w==1){r($q);}
 if($w==2){echo($q);}
 $array= $GLOBALS['pdo']->prepare($q);
 $array->execute();
 $err=($array->errorInfo());if($err=$err[2] and debug)e($err);
 $array = $array->fetchAll();
 $array=array2csv($array);
 return($array);
}
define('dnln',debug?nln:'');
?>
<?php
}elseif($file=='func_map.php'){
define('27fad00ead3ebd9a59c5144f0b07a3a0',true);

ini_set("max_execution_time","1000");
define("func_map",true);
define("height",212);define("grid",0);
define("t_brdcc",0.3);define("t_brdca",2);define("t_brdcb",10);define("t_brdcr",1.62);define("t_pofb",1);define("t_sofb",100);
define("height2",212*1.3);
define("size2",0.75*(height2/375));
define("size",height/212);
define("zoom",5);

define("nob",true);
define("t_",implode(',',array(height,t_brdcc,t_brdcc,t_brdca,t_brdcb,t_pofb,t_sofb,size,zoom,grid)));
function imgresizeh($img,$height) {
 $ratio = $height / imagesy($img);
 $width = imagesx($img)* $ratio;
 return(imgresize($img,$width,$height));
 }
 
 function imgresizew($img,$width) {
 $ratio = $width / imagesx($img);
 $height = imagesy($img) * $ratio;
 return(imgresize($img,$width,$height));
 }
 
 
 function imgresize($img,$width,$height) {
 $new_image = imagecreatetruecolor($width, $height);
 imagealphablending($new_image,false);
 imagecopyresampled($new_image, $img, 0, 0, 0, 0, $width, $height, imagesx($img), imagesy($img));
 return($new_image);
 } 

 function imgresizecrop($img,$width,$height,$x,$y,$w,$h) {
 $new_image = imagecreatetruecolor($width, $height);
 imagealphablending($new_image,false);
 imagecopyresampled($new_image, $img, 0, 0, $x,$y, $width, $height, $w,$h);
 return($new_image);
 } 

function map1($param,$xc=false,$yc=false){
 if(!$param){$param='t1';}
 if($xc===false or $yc===false){
 $rand=rand(1,7);
 }else{
 $rand=((pow($xc,2)+pow($yc,3))%7)+1;
 }
 
 $t_size=size*424/5;
 $t_sofb=t_sofb;
 $t_pofb=t_pofb;
 $t_brdcc=t_brdcc; $t_brdca=t_brdca; $t_brdcb=t_brdcb; $file=tmpfile2("$rand,$param,".t_,"png","map");
 if(file_exists($file) and !notmp ){
 $terrain=imagecreatefrompng($file);
 }else{
 $tmp=imagecreatefrompng(root."data/image/terrain/$param.png");
 $tmpb=(1+(2*$t_pofb));
 $maxx=imagesx($tmp)-($t_sofb*$tmpb);
 $maxy=imagesy($tmp)-($t_sofb*$tmpb);
 $xt=rand(0,$maxx);
 $yt=rand(0,$maxy);
 $terrain=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb/2);
 $terrain2=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb);
 imagealphablending($terrain,false);
 $alpha = imagecolorallocatealpha($terrain, 0, 0, 0,127);
 imagefill($terrain,0,0,$alpha);
 imagecopy($terrain2,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb);
 $tmps=imagesx($terrain2);$tmps2=$tmps/2;
 for ($i=1; $t_brdcc*$tmps*$tmps>$i; $i++){
 $ytmp=rand(0,$tmps-1);
 $xtmp=rand(0,$tmps-1);
 $dist=sqrt(pow($tmps2-$ytmp,2)+pow($tmps2-$xtmp,2));
 $alpha=$dist/($tmps2*1);
 if($alpha>1){$alpha=1;}
 $radiusx=rand($t_brdca,$t_brdcb);
 $radiusy=rand($t_brdca,$t_brdcb);
 $rgb = imagecolorat($terrain2, round($xtmp),round($ytmp));
 $r = ($rgb >> 16) & 0xFF;
 $g = ($rgb >> 8) & 0xFF;
 $b = $rgb & 0xFF;
 $alpha = imagecolorallocatealpha($terrain, $r, $g, $b,$alpha*127);
 imagefilledellipse($terrain,$xtmp,$ytmp/2,$radiusx,$radiusy/t_brdcr,$alpha);
 
 }
 if(grid){
 $black = imagecolorallocate($terrain, 0, 0, 0);
 
 $offsetx=imagesx($terrain)/(1+(2*$t_pofb))*$t_pofb;
 $offsety=imagesy($terrain)/(1+(2*$t_pofb))*$t_pofb;
 imageline($terrain,imagesx($terrain)/2,$offsety,$offsetx,imagesy($terrain)/2,$black);
 imageline($terrain,$offsetx,imagesy($terrain)/2,imagesx($terrain)/2,imagesy($terrain)-$offsety,$black);
 imageline($terrain,imagesx($terrain)/2,$offsety,imagesx($terrain)-$offsetx,imagesy($terrain)/2,$black);
 imageline($terrain,imagesx($terrain)-$offsetx,imagesy($terrain)/2,imagesx($terrain)/2,imagesy($terrain)-$offsety,$black);
 }
 
 imagedestroy($terrain2);
 imagedestroy($tmp);
 imagesavealpha($terrain,true);
 imagepng($terrain,$file);
	 chmod($file,0777);
 }
 return($terrain);
}


function paint($im){ 
 $im2 = imagecreate(imagesx($im),imagesy($im));
 if(function_exists('imageantialias'))imageantialias($im2, true);
 $paleta=array(); $rand=array();
 $bg= imagecolorallocatealpha($im2,0,0,0,127);
 $brd= imagecolorallocate($im2,0,0,0);
 ImageFill($im2,0,0,$bg);
 for($y = 1; $y!=imagesy($im); $y++){
 for($x = 1; $x!=imagesx($im); $x++){
 $rgb=imagecolorsforindex($im,imagecolorat($im, $x,$y));
 $r=$rgb["red"];
 $g=$rgb["green"];
 $b=$rgb["blue"];
 $al=$rgb["alpha"];
 if($al==0){
 $i=md5($r."x".$g."x".$b);
 if(!$rand[$i]){
 if($r+$g+$b!=0){
 $rand[$i]["a"]=rand(0,10);
 $rand[$i]["h"]=rand(2,4);
 $rand[$i]["w"]=rand(2,4);
 }else{
 $rand[$i]["a"]=intval(0.85*127);
 $rand[$i]["h"]=5;
 $rand[$i]["w"]=5;
 }
 }
 if(!$paleta[$i])$paleta[$i]=imagecolorallocatealpha($im2,$r, $g, $b,$rand[$i]["a"]);
 imagefilledellipse($im2,$x,$y,$rand[$i]["h"],$rand[$i]["w"],$paleta[$i]);
 }
 }
 }
 return($im2);
}





function modelx($res){
 $GLOBALS['model_noimg']=true;
 $GLOBALS['model_resize']=0.75/(0.75*gr);
 model($res,0.75*gr); $GLOBALS['model_noimg']=false;
 return(rebase(url.base.$GLOBALS['model_file']));
}
function model($res,$s=1,$rot=0,$slnko=1.5,$ciary=0,$zburane=0,$hore=0){$pres=$res;
 if(substr($res,0,1)=='{'){ 
 $res=substr($res,1);
 $res=explode('}',$res,1);
 $res=$res[0];
 }
 if(substr($res,0,1)=='('){
 $res=str_replace(array('(',')'),'',$res);
 list($res,$rot)=explode(':',$res);
 if(substr($res,0,1)=='_'){
 $res=substr($res,1);
 $file0=root.'data/image/res/'.$res;
 }else{
 $file0=root.'userdata/res/'.$res;
 }
 $file0=trim(str_replace('{}','16',$file0));
 $file0_=str_replace('/1.png','/'.$rot.'.png',$file0);
 if(file_exists($file0_))$file0=$file0_;
 $file=tmpfile2($pres,"png","nores");
 $GLOBALS['model_file']=$file;
 if(!$GLOBALS['model_noimg'])$GLOBALS['ss']["im"]=imagecreatefrompng($file0);
 if(!file_exists($file)){
 copy($file0,$file);
 chmod($file,0777);
 }
 $GLOBALS['model_resize']=1;
 if(!$GLOBALS['model_noimg'])return($GLOBALS['ss']["im"]); 
 else return;
 }
 $s=$s*height2/500;
 $file=tmpfile2("model,aa,$res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore","png","model"); $GLOBALS['model_file']=$file;
 if(file_exists($file)){
 $img=imagecreatefrompng($file);
 imagealphablending($img,true);
 imagesavealpha($img,true);
 return($img);
 }else{
 $res=str_replace("::",":1,1,1:",$res);
 $tmp=explode(":",$res);
 
 $points=$tmp[0];
 $polygons=$tmp[1];
 $colors=$tmp[2];
 $rot=$tmp[3];
 $colors=explode(",",$colors);
 $points=substr($points,1,strlen($points)-2); 
 $points=explode("]",$points); 
 $i=-1;
 foreach($points as $tmp){
 $i=$i+1; 
 $points[$i]=str_replace("[","",$points[$i]);
 $points[$i]=explode(",",$points[$i]);
 }
 $i=-1;
 foreach($points as $ii){
 $i=$i+1;
 $x=$points[$i][0];
 $y=$points[$i][1];
 $z=$points[$i][2];
 $z=$z-((($points[$i-1][2]+$points[$i-2][2])*$zburane)/100);
 if($z<0){$z=0;}
 $points[$i][0]=$x;
 $points[$i][1]=$y;
 $points[$i][2]=$z;
 }
 $i=-1;
 foreach($points as $ii){
 $i=$i+1;
 $x=$points[$i][0];
 $y=$points[$i][1];
 $x=$x+0.1;
 $y=$y+0.1;
 $vzdalenost=sqrt(pow(($x-50),2)+pow(($y-50),2));
 $uhel=acos(($x-50)/$vzdalenost);
 $uhel=($uhel/pi())*180;
 if($y<50){$uhel=$uhel+$rot;}else{$uhel=$uhel-$rot;}
 if((50-$y)<0){$uhel=180+(180-$uhel);}
 $x=50+(cos(($uhel/180)*pi())*$vzdalenost);
 $y=50-(sin(($uhel/180)*pi())*$vzdalenost);
 $x=intval($x);
 $y=intval($y);
 $points[$i][0]=$x;
 $points[$i][1]=$y;
 }
 $polygons=explode(";",$polygons);
 $i=-1;
 foreach($polygons as $tmp){
 $i=$i+1;
 $polygons[$i]=explode(",",$polygons[$i]);
 if($polygons[$i]==array("")){$polygons[$i][0]=1;$polygons[$i][1]=1;$polygons[$i][2]=1;}
 $polygons[$i][count($polygons[$i])]=$colors[$i];
 
 }
 
 $x=-1;
 $polygonsord=array();
 $polygonsord2=array();
 foreach($polygons as $tmp){
 $x=$x+1;
 $y=-1;
 foreach($tmp as $ii){
 if($tmp[count($tmp)-1]!=$ii){
 $y=$y+1;
 if($hore!=1){
 $polygonsord2[$x][$y]=($points[$ii-1][0]*0.5)+($points[$ii-1][1]*0.5)+($points[$ii-1][2]*1.11);
 }else{
 $polygonsord2[$x][$y]=$points[$ii-1][2];
 }
 }
 }
 $count=0;$count3=0;foreach($polygonsord2[$x] as $count2){$count=$count+$count2;$count3=$count3+1;}
 $count=intval($count/$count3)."";
 if(strlen($count)==1){$count="00".$count;}
 if(strlen($count)==2){$count="0".$count;}
 $polygons[$x]=$count."_".join(",",$polygons[$x]);
 }
 sort($polygons);
 $x=-1;
 foreach($polygons as $ii){
 $x=$x+1;
 $polygons[$x]=explode("_",$polygons[$x]);
 $polygons[$x]=explode(",",($polygons[$x][1]));
 }
 if($hore!=1){
 $GLOBALS['ss']["im"] = imagecreate($s*200,$s*380);
 }else{
 $GLOBALS['ss']["im"] = imagecreate($s*150,$s*150);
 }
 $GLOBALS['ss']["bg"] = imagecolorallocatealpha($GLOBALS['ss']["im"],0,0,0,127);
 $cierne = imagecolorallocate($GLOBALS['ss']["im"],10,10,10);
 ImageFill($GLOBALS['ss']["im"],0,0,$GLOBALS['ss']["bg"]);
 $shadow = imagecolorallocate($GLOBALS['ss']["im"],0,0,0);
 $i2=-1;
 foreach($polygons as $tmp){
 $i2=$i2+1;
 $tmppoints=array();
 $i=-1;
 
 foreach($tmp as $ii){
 if($tmp[count($tmp)-1]!=$ii){
 $x=$points[$ii-1][0];
 $y=$points[$ii-1][1];
 $z=$points[$ii-1][2];
 if($hore!=1){
 $px=0.45;$py=0.1;
 $xx=100+($x*1)-($y*1)+($z*$px);
 $yy=279+($x*0.5)+($y*0.5)+($z*$py);
 }else{
 $xx=$x+25;
 $yy=$y+25;
 }
 $i=$i+1;
 $tmppoints[$i]=$s*$xx;
 $i=$i+1;
 $tmppoints[$i]=$s*$yy;
 }
 }
 if(!$tmppoints[4]){$tmppoints[0]=0;$tmppoints[1]=0;$tmppoints[2]=0;$tmppoints[3]=0;$tmppoints[4]=0;$tmppoints[5]=0;}
 
 imagefilledpolygon($GLOBALS['ss']["im"],$tmppoints,count($tmppoints)/2,$shadow);
 }
 
 $i2=-1;
 foreach($polygons as $tmp){
 $i2=$i2+1;
 $tmppoints=array();
 $i=-1;
 
 foreach($tmp as $ii){
 if($tmp[count($tmp)-1]!=$ii){
 $x=$points[$ii-1][0];
 $y=$points[$ii-1][1];
 $z=$points[$ii-1][2];
 if($hore!=1){
 $xx=100+($x*1)-($y*1);
 $yy=279+($x*0.5)+($y*0.5)-($z*1.11);
 $xxx=100+($x*1)-($y*1);
 $yyy=279+($x*0.5)+($y*0.5)-($z*1.11);
 }else{
 $xx=$x+25;
 $yy=$y+25;
 }
 $i=$i+1;
 $tmppoints[$i]=$s*$xx;
 $i=$i+1;
 $tmppoints[$i]=$s*$yy;
 }
 }
 if(!$tmppoints[4]){$tmppoints[0]=0;$tmppoints[1]=0;$tmppoints[2]=0;$tmppoints[3]=0;$tmppoints[4]=0;$tmppoints[5]=0;}
 
 
 $color=$tmp[count($tmp)-1];
 $x1=$points[$tmp[0]-1][0];
 $y1=$points[$tmp[0]-1][1];
 $x2=$points[$tmp[2]-1][0];
 $y2=$points[$tmp[2]-1][1];
 $x=abs($x1-$x2)+1;
 $y=abs($y1-$y2)+1;
 $rand=pow($x/$y,1/2);
 if($rand>1.5){$rand=1.5;}
 $rand=($rand*30*$slnko)-(25*$slnko);
 
 $red=hexdec(substr($color,0,2))+$rand;
 $green=hexdec(substr($color,2,2))+$rand;
 $blue=hexdec(substr($color,4,2))+$rand;
 if($red>255){$red=255;}if($red<1){$red=1;}
 if($green>255){$green=255;}if($green<1){$green=1;}
 if($blue>255){$blue=255;}if($blue<1){$blue=1;}
 $nejmcolor="color".rand(1000,9999);
 $$nejmcolor = imagecolorallocate($GLOBALS['ss']["im"],$red,$green,$blue);
 imagefilledpolygon($GLOBALS['ss']["im"],$tmppoints,count($tmppoints)/2,$$nejmcolor);
 if($ciary==1){imagepolygon($GLOBALS['ss']["im"],$tmppoints,count($tmppoints)/2,$cierne);}
 }
 $GLOBALS['ss']["im"]=paint($GLOBALS['ss']["im"]);
 ImagePng($GLOBALS['ss']["im"],$file);
 chmod($file,0777);
 chmod($file);
 
 
 
 return($GLOBALS['ss']["im"]);
 
 }
}
function mapbg($xc,$yc){
 define("xx",0);
 define("yy",0);
 $t_pofb=t_pofb;
 $size=1;
 $width=height*2; $height=height; $img=imagecreatetruecolor($width,$height);
 $white=imagecolorallocate($img, 255, 255, 255);
 imagefill($img,0,0,$white);
 
 
 $zoom=5;
 $exp=4;
 $pos=4.5;
 
 $data=array();
 for($y=0;$y<($yc+$zoom+$exp+$pos)-($yc-$exp-$pos);$y++){
 $data[$y]=array();
 for($x=0;$x<($xc+$zoom+$exp+$pos)-($xc-$exp-$pos);$x++){
 $data[$y][$x]='t1'; 
 } 
 } 
 
 $array=sql_array("SELECT x,y,terrain from `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]." AND `x`>=".round($xc-$exp-$pos)." AND `y`>=".round($yc-$exp-$pos)." AND `x`<".round($xc+$zoom+$exp+$pos)." AND `y`<".round($yc+$zoom+$exp+$pos)." ORDER by `y`,`x`");
 
 
 foreach($array as $row){
 list($x,$y,$terrain)=$row;
 $data[$y-($yc-$exp-$pos)][$x-($xc-$exp-$pos)]=$terrain; 
 } 
 
 $y=-$exp-$pos-$pos-1;
 foreach($data as $row){$y++;
 $x=-$exp-$pos-$pos-1;
 foreach($row as $terrain){$x++;
 $cast=map1($terrain,$x+$xc+$pos,$y+$yc+$pos);
 
 $rx=(($x-$y)*$width/10)+($width/2)-($width/10)-(imagesx($cast)/(1+(2*$t_pofb)));
 $ry=(($x+$y)*$height/10)+($width/10)-(imagesx($cast)/(1+(2*$t_pofb))); 
 
 $rxx=($rx+imagesx($cast));
 $ryy=($ry+imagesy($cast));
 $q=true; 
 if($rxx<0)$q=false;
 if($ryy<0)$q=false;
 if($rx>$width)$q=false; 
 if($ry>$height)$q=false;
 if($q)imagecopy($img,$cast,$rx,$ry,0,0,imagesx($cast),imagesy($cast)); 
 imagedestroy($cast);
 }}
 
 return($img);
}
function mapunits($gx,$gy,$xy){
 define("xx",0);
 define("yy",0);
 define("height2",height*1.3);
 define("top",200*(height2/375));
 $size=1;
 $width=150*5*(height2/375);
 $height=75*5*(height2/375);
 $img=imagecreatetruecolor($width,$height); $fill=imagecolorallocatealpha($img, 0, 0, 0, 127);
 imagefill($img, 0, 0, $fill);
 $z=3;
 $zoom=$z*5;
 $zzoom=1+(($z-1)*5);
 $top=250*(height2/375); $x=$gx-5;
 $y=$gy-5;
 $top=408*(height2/375); $q=false;
 foreach(sql_array("SELECT x,y,res,name,id FROM `".mpx."objects` WHERE res!='' AND ww=".$GLOBALS['ss']["ww"]." "."AND `type`!='building'"." AND x>=$x AND y>=$y AND x<=$x+$zoom AND y<=$y+$zoom ORDER BY x,y") as $row){
 $q=true; 
 $model=model($row[2],1,20,1.5,0); 
						 $xx=$row[0]-$x;
 $yy=$row[1]-$y;
 $rxp=(imagesx($img)-imagesx($model))*0.5; $ryp=-top*$size-$top;
 $p=(200*size2);
 $ix2rx=0.5*$p;$ix2ry=0.25*$p;
 $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
 $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
 $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;
 $s=height2/500;
 imagecopyresized($img,$model,$rx,$ry,0,0,$s*200*(imagesx($model)/110),$s*380*(imagesy($model)/209),imagesx($model),imagesy($model));
 }
 
 
 if($q){	
	 imagesavealpha($img,true);
 return($img);
 }else{
 return(false); 
 }
}
function htmlmap($gx=false,$gy=false,$w=0,$only=false){
 $width=424;
 
 $ym=ceil(mapsize/5); $xm=ceil((mapsize/5-1)/2);
 $x=($gy+$gx)*5+1;
 $y=($gy-$gx)*5+1; 
 
 $t=11;
 if(is_bool($gx) or is_bool($gy) or ($x<-$t) or ($y<-$t) or ($x>mapsize+$t) or ($x>mapsize+$t)){$gx=-$xm-1;$gy=-1;} if($w!=2)$outimg=tmpfile2("outimgbg,".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,"jpg","map");
			if($w!=1)$outimgunits=tmpfile2("outimgunits".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,"png","map");

 if($w==1 and $only)return($outimg);
 if($w==2 and $only)return($outimgunits);
 
 $border=0;
 $html='';
 if($w!=2){
 if(!file_exists($outimg)){if(debug)$border=3;
 $x=($gy+$gx)*5+1-5;
 $y=($gy-$gx)*5+1-5;
 $img=mapbg($x,$y);
 imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
 imagefilter($img, IMG_FILTER_CONTRAST,-10);
 $emboss = array(array(0, 0.05, 0), array(0.05, 0.8,0.05), array(0, 0.05, 0));
 imageconvolution($img, $emboss, 1, 0);
 
 imagejpeg($img,$outimg,95);
 chmod($outimg,0777);
 ImageDestroy($img);
 }
 $datastream=rebase(url.base.str_replace('../','',$outimg).'?'.filemtime($outimg));
 if($w==0)$html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" style="z-index:1;" height="'.(round($width/424*211)).'" "/>'; else $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" />'; 
 }
 if($w!=1){
 if(!file_exists($outimgunits)){if(debug)$border=3;
 $x=($gy+$gx)*5+1;
 $y=($gy-$gx)*5+1;
 if($img=mapunits($x,$y)){
 imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
 imagefilter($img, IMG_FILTER_CONTRAST,-5);
 
 imagepng($img,$outimgunits);
 chmod($outimgunits,0777);
 ImageDestroy($img);
 }else{
 file_put_contents2($img,''); 
 }
 }
 if(filesize($outimgunits)>1){
 $datastream=rebase(url.base.str_replace('../','',$outimgunits).'?'.filemtime($outimgunits));
 if($w==0)$html.='<span style="position:absolute;width:0px;z-index:2;"><img src="'.$datastream.'" style="position:relative;left:-'.$width.'px;z-index:2;" class="clickmap" width="'.$width.'" height="'.(round($width/424*212)).'" border="'.$border.'"/></span>'; else $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" class="clickmap" border="'.$border.'"/>';
 }elseif($w!=0){
 $html.='<table width="'.$width.'" height="'.($width/2).'" border="0" cellpadding="0" cellspacing="0" class="clickmap" ><tr><td></td></tr></table>';

 }
 }
 if(!$w)echo($html);
 else return($html);
}

function terraincolor($terrain){
 $tmp=imagecreatefrompng(root."data/image/terrain/$terrain.png");
 $rgb = imagecolorat($tmp,round(imagesx($tmp)/2),round(imagesy($tmp)/2));
 $r = (($rgb >> 16) & 0xFF);
 $g = (($rgb >> 8) & 0xFF);
 $b = ($rgb & 0xFF);
 imagedestroy($tmp);
 return(array($r,$g,$b));
}
function worldmap($width=500,$minsize=0,$w=false,$top=false,$worldmap_red=false){
 if(!$w){
 $w=$GLOBALS['ss']["ww"];
 $mapsize=mapsize;
 }else{
 $mapsize1=sql_1data('SELECT max(x) FROM [mpx]map WHERE ww=\''.$w.'\'');
 $mapsize2=sql_1data('SELECT max(y) FROM [mpx]map WHERE ww=\''.$w.'\'');
 $mapsize1=intval($mapsize1)+1;
 $mapsize2=intval($mapsize2)+1;
 if($mapsize1>$mapsize2){
 $mapsize=$mapsize1;
 }else{
 $mapsize=$mapsize2;
 } 
 }
 
 
 $outimg=tmpfile2("worldmap,$width,$w,$minsize".($worldmap_red?serialize($worldmap_red):'').t_,"png","map");
 if(!file_exists($outimg)){
 
 if($mapsize<$minsize){ 
 $kk=$minsize/$mapsize; 
 }else{
 $kk=1; 
 } 
 
 $colors=array();
 
 $s=$width/(sqrt(2*pow($mapsize,2))*$kk); 
 $height=$width/2;
 
 $img=imagecreatetruecolor($width, $height);
 imagealphablending($img, false);
 list($r,$g,$b)=terraincolor('t1');
 $y=gr;$yy=5; $colors[0]=imagecolorallocatealpha($img, ((($y*$r)+$g+$b)/(2+$y))/$yy,(($r+($y*$g)+$b)/(2+$y))/$yy,(($r+$g+($y*$b))/(2+$y))/$yy,90); 
 imagefill($img,0,0,$colors[0]);
 
 $limit=0;$q=true;
 while($q){$q=false;
 foreach(sql_array('SELECT x,y,terrain FROM [mpx]map WHERE terrain!=\'t1\' AND ww=\''.$w.'\' LIMIT '.$limit.',500') as $row){
 $q=true;
 list($x,$y,$terrain)=$row;
 $xx=($x-$y)/($mapsize*2)*($width/$kk)+($width/2);
 $yy=($x+$y)/($mapsize*2)*($height/$kk)+(($height-($height/$kk))/2);
 $radius=ceil($s*sqrt(2));
 
 if($terrain and $terrain!='t1'){
 if(!$colors[$terrain]){
 list($r,$g,$b)=terraincolor($terrain);
 $colors[$terrain]=imagecolorallocate($img, $r, $g, $b); 
 }
 imagefilledellipse($img, round($xx), round($yy), $radius, ceil($radius/gr), $colors[$terrain]);
 }
 
 }
 $limit+=500;
 }
 if($worldmap_red){
 $red=imagecolorallocate($img, 255,0,0); 
 foreach($worldmap_red as $row){
 list($x,$y)=$row;
 $xx=($x-$y)/($mapsize*2)*($width/$kk)+($width/2);
 $yy=($x+$y)/($mapsize*2)*($height/$kk)+(($height-($height/$kk))/2);
 imagefilledellipse($img, round($xx), round($yy), $radius, ceil($radius/gr), $red);
 }
 }
 imagefilter($img, IMG_FILTER_CONTRAST,-5);
 imagesavealpha($img, true);
 imagepng($img,$outimg);
 }
 return($outimg);
}
?>
<?php
}elseif($file=='func_object.php'){
define('34e86b6373674ca459a3e9a7ca8c73c6',true);


class object{
 
 function __construct($id,$where=""){
 $this->noupdate=false;
 $id=sql($id);
 if(!$where){$where="id='$id' OR name='$id'";}
 if($id!="create"){
 $sql_ownname="(SELECT name FROM ".mpx."objects as tmp WHERE tmp.id=".mpx."objects.own) AS ownname";
 $sql_inname="(SELECT name FROM ".mpx."objects as tmp WHERE tmp.id=".mpx."objects.in) AS inname";
 $result = sql_array("SELECT *,$sql_ownname,$sql_inname FROM ".mpx."objects WHERE $where LIMIT 1",0);
 $row = $result[0];
 if($row){
 
 
 $this->own2=sql_csv("SELECT id,name FROM ".mpx."objects WHERE (`type`='user' OR `type`='unit') AND own='".$row["id"]."' ORDER BY name");
 $this->loaded=true;
 $this->id=$row["id"];
 $this->type=$row["type"];
 $this->fp=$row["fp"];
 $this->fs=$row["fs"];
 $this->fr=$row["fr"];
 $this->fx=$row["fx"];
 $this->fc=$row["fc"];
 $this->dev=$row["dev"];
 $this->name=$row["name"];
 $this->func=new func($row["func"]);
 $this->set=new set($row["set"]);
 $this->res=($row["res"]);
 $this->profile=new profile($row["profile"]);
 $this->hold=new hold($row["hold"]);
 $this->hard=$row["hard"];
 $this->expand_=$row["expand"];
 $this->collapse_=$row["collapse"];
 $this->own=$row["own"];
 $this->ownname=$row["ownname"];
 $this->in=$row["in"];
 $this->inname=$row["inname"];
 $this->ww=$row["ww"];
 $this->t=$row["t"];
 $this->x=$row["x"];
 $this->y=$row["y"];
 $this->orig_sum=$this->sum();
 $this->orig_sum_=$this->sum_();
 $this->orig_sum2=$this->sum(true);
 if(!$this->x){$this->x=0;}
 if(!$this->y){$this->y=0;}
 
 $this->type();
 return(true);
 }else{
 r('not loaded '.$id);
 $this->loaded=false;
 return(false);
 }
 }else{
 $id=nextid();
 $name='object '.$id;
 sql_query("INSERT INTO `".mpx."objects` (`id`,`name`, `type`, `fp`, `fs`, `dev`, `func`, `set`, `res`, `profile`, `hold`, `own`, `hard`, `expand`, `collapse`, `ww`,`in`, `t`, `x`, `y`) VALUES ('$id','$name', 'hybrid', '', '', NULL, NULL, NULL,NULL, NULL, NULL, NULL, 0, 0, 0,'1', NULL, NULL, '0', '0')",1);
 $this->id=$id;
 $this->name=$name;
 r("creating ".$this->id);
 $this->loaded=true;
 $this->type="";
 $this->fp="";
 $this->fs="";
 $this->dev="";
 $this->func=new func();
 $this->set=new set();
 $this->res="";
 $this->profile=new profile();
 $this->hold=new hold();
 $this->hard="";
 $this->expand_="";
 $this->collapse_="";
 $this->own="";
 $this->ownname="";
 $this->ww="1";
 $this->in="";
 $this->t="";
 $this->x="";
 $this->y="";
 $this->orig_sum="update";
 }
 }
 
 function sum($image=false){
 $stream="";
 if(!$image){
 $stream.=",".$this->id;
 $stream.=",".$this->type;
 $stream.=",".$this->fp;
 $stream.=",".$this->dev;
 $stream.=",".$this->name;
 $stream.=",".$this->func->vals2str();
 $stream.=",".$this->set->vals2str();
 $stream.=",".$this->res;
 $stream.=",".$this->profile->vals2str();
 $stream.=",".$this->hold->vals2str();
 $stream.=",".$this->hard;
 $stream.=",".$this->expand_;
 $stream.=",".$this->collapse_;
 $stream.=",".$this->own;
 $stream.=",".$this->in;
 $stream.=",".$this->ww;
 $stream.=",".$this->x;
 $stream.=",".$this->y;
 }else{
 $stream.=",".$this->res;
 $stream.=",".$this->profile->vals2str();
 }
 $stream=md5($stream);
 return($stream);
 }
 function sum_($image=false){
 $stream="";
 $stream.=",".$this->type;
 $stream.=",".$this->fp;
 $stream.=",".$this->dev;
 $stream.=",".$this->func->vals2str();
 $stream.=",".$this->res;
 $stream.=",".$this->hold->vals2str();
 $stream.=",".$this->own;
 $stream=md5($stream);
 return($stream);
 }
 
 function __destruct(){} 
 function update(){
 if($this->loaded){
 
 if($this->orig_sum!=$this->sum()){$this->loaded=false;
 if($this->orig_sum2!=$this->sum(true)){cleartmp($this->id);}
 if($this->orig_sum_!=$this->sum_() and !$this->noupdate){
 r("updating sumaries - ".$this->id." + FS/FP");
 $fc= new hold("");
 $funcs=$this->func->vals2list();
 foreach($funcs as $name=>$func){
 $class=$func["class"];
 if($c1=$GLOBALS['config']["f"][$class]["create"]["q"] and $c2=$GLOBALS['config']["f"][$class]["create"]["w"]){ $constants=$func["params"];
 foreach($constants as &$value_c)$value_c=$value_c[0]*$value_c[1];
 foreach($GLOBALS['config']["f"]["constant"] as $key=>$value){
 if(!$constants[$key]){
 $constants[$key]=$value;
 }
 }
 foreach($GLOBALS['config']["f"]["global"]["create"] as $key=>$value){$key="_".$key;
 if(!defined($key))define($key,$value);
 }
 foreach($constants as $key=>$value)eval('$_'.$key.'=$value;');
 
 eval('$price='.$c1.";");
 $count=0;
 $c2=explode("+",$c2);
 foreach($c2 as &$value){
 $value=explode("*",$value);
 if(!$value[1]){$value[1]=$value[0];$value[0]=1;}
 $count=$count+$value[0];
 }
 foreach($c2 as &$value){
 $resource=$value[1];
 $hold=ceil($price*$value[0]/$count);
 $fc->add($resource,$hold);
 }
 }
 }
 $this->fs=ceil($fc->fp());
 $this->fc=($fc->vals2str());
 $this->fr=$this->hold->fp(); 
 $this->fx=$this->fp+$this->fr;
 $tmp=$funcs["hard"]["params"]["hard"];$this->hard=$tmp[0]*$tmp[1];					$tmp=$funcs["expand"]["params"]["distance"];$this->expand_=$tmp[0]*$tmp[1]; 
					$tmp=$funcs["collapse"]["params"]["distance"];$this->collapse_=$tmp[0]*$tmp[1]; 
 
 }else{
 r("updating sumaries -".$this->id);
 }
 $query=("UPDATE ".mpx."objects SET 
 `type` = '".($this->type)."',
 `fp` = '".($this->fp)."',
 `fs` = '".($this->fs)."',
 `fr` = '".($this->fr)."',
 `fx` = '".($this->fx)."',
 `fc` = '".($this->fc)."',
 ". "`dev` = '".($this->dev)."',
 `name` = '".($this->name)."',
 `func` = '".($this->func->vals2str())."',
 `set` = '".($this->set->vals2str())."',
 `res` = '".$this->res."',
 `profile` = '".($this->profile->vals2str())."',
 `hold` = '".($this->hold->vals2str())."',
 `hard` = '".(($this->hard))."',
 `expand` = '".(($this->expand_))."',
 `collapse` = '".(($this->collapse_))."',
 `own` = '".(($this->own))."',
 `in` = '".(($this->in))."',
 `ww` = '".(($this->ww))."',
 `t`= '".(time())."',
 `x` = '".($this->x)."',
 `y` = '".($this->y)."'
 WHERE id ='".($this->id)."'");
 r($query);
 sql_query($query);
 }
 }
 }
 
 function xxx(){
 r($this->id);
 if($this->loaded){
 r($this->name);
 r($this->profile->vals2str());
 }else{r("not loaded");}
 }
 
 function delete(){
 sql_query("DELETE FROM `".mpx."objects` WHERE `id` = '".$this->id."'");
 $this->loaded=false;
 }
 
 
 
 
 function tostring(){
 $head=$this->name;
 $return=
"$head:type = ".($this->type).";
$head:fp = ".($this->fp).";
$head:fs = ".($this->fs).";
$head:fr = ".($this->fr).";
$head:fx = ".($this->fx).";
$head:fc = ".($this->fc).";
$head:dev = ".($this->dev).";
$head:name = ".($this->name).";
".($this->func->vals2strobj("$head:func"))."
".($this->set->vals2strobj("$head:set"))."
$res:dev = ".($this->res).";
".($this->profile->vals2strobj("$head:profile"))."
".($this->hold->vals2strobj("$head:hold"))."
$head:hard = ".(($this->hard)).";
$head:expand = ".(($this->expand_)).";
$head:collapse = ".(($this->collapse_)).";
$head:own = ".(($this->own)).";
$head:in = ".(($this->in)).";
$head:ww = ".(($this->ww)).";
$head:t= ".(time()).";
$head:x = ".($this->x).";
$head:y = ".($this->y).";";
 $return=str_replace(nln.nln,nln,$return);
 return($return);
 }
 function type(){
 
 }
 function getName(){return($this->name);}
 function setName($value){$this->name=$value;}
 function getFS(){return($this->fs);}
 function getFP(){return($this->fp);}
 function setFP($value){$this->fp=$value;}
 function position(){
 list(list($id,$name,$object,$timestart,$time,$func,$params))=csv2array($this->tasks);
 if($func=="move"){
 $params=str2list($params);
 $x=time5($timestart,$time,$this->x,$params["x"]);
 $y=time5($timestart,$time,$this->y,$params["y"]);
 }else{
 $x=$this->x;
 $y=$this->y;
 }
 return(array($x,$y));
 }
 function support(){
 if($this->loaded){
 $funcs=$this->func->vals2list();
 $newfuncs=$funcs;
 $support=array();
 $in2=sql_array("SELECT `id`,`type`,`fp`,`fs`,`dev`,`name`,NULL,`func`,`set`,NULL,`profile`,`hold`,`hard`,`expand`,`collapse`,`own`,`in`,`t`,`x`,`y` FROM ".mpx."objects WHERE `in`='".($this->id)."' ORDER BY t desc");
 foreach($in2 as $item){
 list($_id,$_type,$_fp,$_fs,$_dev,$_name,$_password,$_func,$_set,$_res,$_profile,$_hold,$_hard,$_expand,$_collapse,$_own,$_in,$_t,$_x,$_y)=$item;
 $_x=intval($_x);$_y=intval($_y);
 if(!$_x)$_x="";
 foreach($funcs["hold$_x"]["params"] as $param=>$value){
 list($qqe1,$e2)=$value;
 if($param!="q"){
 foreach(func2list($item[7]) as $funci){
 if($funci["class"]==$param){
 foreach($funci["params"] as $parami=>$valuei){
 list($e1i,$e2i)=$valuei;
 $e1i=$e1i*$e2;
 $e2i=pow($e2i,$e2); if(!$support[$funci["class"]])$support[$funci["class"]]=array();
 if(!$support[$funci["class"]][$parami])$support[$funci["class"]][$parami]=array(0,1);
 $support[$funci["class"]][$parami][0]=$support[$funci["class"]][$parami][0]+$e1i;
 $support[$funci["class"]][$parami][1]=$support[$funci["class"]][$parami][1]*$e2i;
 
 }
 }
 }
 }
 }
 }
 foreach($newfuncs as $name=>$func){
 $class=$func["class"];
 $params=$func["params"];
 $profile=$func["profile"];
 foreach($params as $fname=>$param){
 $e1=$param[0];$e2=$param[1];
 $support1=$support[$class][$fname];
 if($support1){
 list($se1,$se2)=$support1;
 $q=($se1+$e1)*($se2*$e2);
 $newfuncs[$name]["params"][$fname][0]=$q;
 $newfuncs[$name]["params"][$fname][1]=1;
 }
 }
 }
 return($newfuncs);
 }else{return(array());}
 }
 function supportF($function,$value=""){
 if(!$value)$value=$function;
 $funcs=$this->support();
 $func=$funcs[$function];
 if(!$func["params"][$value] and $GLOBALS['config']['f']['default'][$value]){
 return($GLOBALS['config']['f']['default'][$value]);
 }
 if($func){
 list($a,$b)=$func["params"][$value];
 return($a*$b);
 }else{
 return(0);
 }
 }
}
function supportF($id,$function,$value=""){
 $object=new object($id);
 return($object->supportF($function,$value));
}


function nextid($id){
 $id=sql_1data("SELECT max(id) FROM ".mpx."objects")-(-1);
 return($id);
}

function id2name($id){
 $name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
 return($name);
}

function id2unique($id){
 if(!$id)return('');
 $name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
 $count=sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE name='$name'")-1+1;
 if($count>1)$name.="($id)";
 return($name);
}

function unique2id($unique){
 $unique=trim($unique);
 list($name,$id)=explode('(',$unique);
 $name=trim($name);
 if($id){
 $id=trim(str_replace(')','',$id));
 }else{
 $id=sql_1data("SELECT id FROM ".mpx."objects WHERE name='$name'");
 }
 return($id);
 
}



function id2info($id,$rows){
 $info=sql_array("SELECT $rows FROM ".mpx."objects WHERE id='$id'");
 foreach ($info as &$value) {
 $info = $info[0];
 }
 return($info);
}



function objects($where="",$order="",$limit=""){
 if($where){$where="WHERE ".$where;}
 if($order){$order="ORDER BY ".$order;}
 if($limit){$limit="LIMIT ".$limit;}
 $result = sql_query("SELECT * FROM ".mpx."objects $where $order $limit");
 $objects=array();
 while($object = mysql_fetch_array ($result)){
 $objects=array_merge($objects,array($object));
 }
 mysql_free_result($result);
 return($objects);
}

function ifobject($id){
 $result = sql_1data("SELECT id FROM ".mpx."objects WHERE id='$id' OR name='$id'");
 if($result){
 return($result);
 }else{
 return(0);
 }
}
function topobject($id){
 $result = sql_1data("SELECT own FROM ".mpx."objects WHERE id='$id' OR name='$id' LIMIT 1");
 if($result){
 return(topobject($result));
 }else{
 return($id);
 }
}

function name_error($id){
 $id=xx2x($id);
 if($GLOBALS['ss']["use_object"]->name==$id){
 return('{name_error_same}'); }
 if($id!=trim($id)){
 return('{name_error_space}'); }
 if(!$id){
 return('{name_error_noname}'); }
 if(strlen($id)<4){
 return('{name_error_minchars;4}'); }
 if(strlen($id)>37){
 return('{name_error_maxchars;37}'); }
 if(str_replace(str_split('`!@#$%^&*()+{}[]=:"|<>?;\'¨\\,/;=´§,'),'',$id)!=$id){
 return('{name_error_specialchars}'); }
 if(ifobject($id)){
 return('{name_error_used}'); }
 if(($id-1+1).""==$id){
 return('{name_error_number}'); }
 
 return(false);
}

}elseif($file=='func_query.php'){
define('ea8405b3d31ca6ad86fcdfca5622c299',true);

unset($GLOBALS['ss']["use_object"]);
unset($GLOBALS['ss']["log_object"]);
function townsfunction($query,$q){$queryp=$query;
 $query=str_replace(' ',',',$query);
 $query=explode(",",$query,2);
 
 $GLOBALS['ss']["query_output"]= new vals();
 list($func,$params)=$query;
 if(strstr($func,'.')){list($remoteobject,$func)=explode('.',$func,2);}else{$remoteobject=false;}
 
 if($GLOBALS['ss']["useid"] and $GLOBALS['ss']["logid"]){
 if($remoteobject){
 $aid=$remoteobject;
 }else{
 $aid=$GLOBALS['ss']["useid"];
 }
 }
 if($func=="login"){
 list($aid)=explode(",",$params);
 if(!ifobject($aid)){
 $aid=false;
 $GLOBALS['ss']["query_output"]->add("error","Tento uživatel neexistuje.");
 }
 }
 if($func=="register"){
 list($aid)=explode(",",$params);
 $funcname='register';
 $noregister=false;
 }else{
 $noregister=true;
 }
 
 
 if($aid){ if($noregister){
 t("obj>>");
 if(!$GLOBALS['ss']["aac_object"] and $remoteobject){$GLOBALS['ss']["aac_object"]= new object($remoteobject);} 
 if(!$GLOBALS['ss']["use_object"] and $GLOBALS['ss']["useid"]){$GLOBALS['ss']["use_object"]= new object($GLOBALS['ss']["useid"]);} 
 if(!$GLOBALS['ss']["log_object"] and $GLOBALS['ss']["logid"]){;$GLOBALS['ss']["log_object"]= new object($GLOBALS['ss']["logid"]);}
 if(!$GLOBALS['ss']["aac_object"])$GLOBALS['ss']["aac_object"]=$GLOBALS['ss']["use_object"];
 t("<<obj");
 if($aid==$remoteobject)$aid_object=$GLOBALS['ss']["aac_object"];
 if($aid==useid)$aid_object=$GLOBALS['ss']["use_object"];
 if(!$aid_object)$aid_object=new object($aid);
 
 
 
 $GLOBALS['ss']["aac_func"]=$aid_object->support(); $GLOBALS['ss']["aac_func"]=$GLOBALS['ss']["aac_func"][$func];
 $GLOBALS['ss']["aac_func"]["name"]=$func;
 
 $funcname=$GLOBALS['ss']['aac_func']['class'];
 
 if(defined("a_".$funcname.'_cooldown')){
 $cooldown=$GLOBALS['ss']['aac_func']['params']['cooldown'][0]*$GLOBALS['ss']['aac_func']['params']['cooldown'][1];
 if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
 $lastused=$GLOBALS['ss']['aac_object']->set->ifnot("lastused_$func",1);
 
 }
 
 
 
 }
 
 
 $funcname_=$funcname;
 $funcname=$q."_".($funcname);
 
 if($GLOBALS['ss']["aac_func"] or !$noregister){
 if(function_exists($funcname)){
 
 
 if(!defined("a_".$funcname_.'_cooldown') or $cooldown<=(time()-$lastused)){
 
 
 
 
 
 
 
 $params=str_replace(",","\",\"",$params);
 $params="\"$params\"";
 $params=str_replace(",\"\"","",$params); $params=str_replace("\"\",","",$params);
 if($params=="\"\""){$params="";}
 $funceval="$funcname($params);";
 eval($funceval);
 
 if($GLOBALS['ss']["query_output"]->val("1")){
 if(defined("a_".$funcname_.'_cooldown')){
 $GLOBALS['ss']['aac_object']->set->add("lastused_".$func,time());
 }
 }
 
 
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'Tuto funkci lze použít za '.timesr($cooldown-time()+$lastused).'.');
 }
 
 }else{
 if($funcname!='a_')$GLOBALS['ss']["query_output"]->add("error","tato funkce je pasivní - $funcname");
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error","$queryp: neexistující funkce u tohoto objektu($aid) $func");
 }
 }else{
 if($func!="login"){
 $GLOBALS['ss']["query_output"]->add("error","nepřihlášený uživatel");
 }
 }
 return($GLOBALS['ss']["query_output"]);
}
function use_param($p){ return($GLOBALS['ss']["aac_func"]["params"][$p][0]);
}

function query($query){
 return(townsfunction($query,"a"));
}
function use_price($func,$params,$constants=false,$mode=0){ if(!$constants)$constants=$GLOBALS['ss']["aac_func"]["params"];
 foreach($constants as &$value_c)$value_c=$value_c[0]*$value_c[1];
 foreach($GLOBALS['config']["f"]["default"] as $key=>$value){
 if(!$constants[$key]){
 $constants[$key]=$value;
 }
 }
 foreach($GLOBALS['config']["f"]["global"]["use"] as $key=>$value){$key="_".$key;
 if(!defined($key))define($key,$value);
 }
 foreach($constants as $key=>$value)eval('$_'.$key.'=$value;');
 foreach($params as $key=>$value)eval('$'.$key.'=$value;');
 $c1=$GLOBALS['config']["f"][$func]["use"]["q"];
 eval('$price='.$c1.";");
 $c2=$GLOBALS['config']["f"][$func]["use"]["w"];
 $count=0;
 $c2=explode("+",$c2);
 foreach($c2 as &$value){
 $value=explode("*",$value);
 if(!$value[1]){$value[1]=$value[0];$value[0]=1;}
 $count=$count+$value[0];
 }
 
 $q=true;
 foreach($c2 as &$value){
 $resource=$value[1];
 $hold=ceil($price*$value[0]/$count);
 if(!$GLOBALS['ss']["use_object"]->hold->test($resource,$hold)){
 $q=false;
 $GLOBALS['ss']["query_output"]->add("error","Potřebujete alespoň {q_".$resource.";$hold}.");
 }
 }
 if($mode==2){
 $return=new hold('');
 foreach($c2 as &$value){
 $resource=$value[1];
 $hold=ceil($price*$value[0]/$count);
 $return->add($resource,$hold);
 }
 return($return);
 }
 if($q){
 if($mode==0){
 foreach($c2 as &$value){
 $resource=$value[1];
 $hold=ceil($price*$value[0]/$count);
 $GLOBALS['ss']["use_object"]->hold->take($resource,$hold);
 }
 }
 return(true);
 }else{
 return(false);
 }
 
 
}
function use_hold($hold){
return($GLOBALS['ss']["use_object"]->hold->takehold($hold));
}
function test_hold($hold){
return($GLOBALS['ss']["use_object"]->hold->testhold($hold)); 
}
$GLOBALS['ss']["xresponse"]='';
function xquery($a,$b="",$c="",$d="",$e="",$f="",$g="",$h="",$i=""){
 xreport();
 $b=x2xx($b);$c=x2xx($c);$d=x2xx($d);$e=x2xx($e);$f=x2xx($f);$g=x2xx($g);$h=x2xx($h);$i=x2xx($i);
 
 $query=("$a $b,$c,$d,$e,$f,$g,$h,$i"); 
 $response=query($query);

 if($response->val("1")=='1')
 $GLOBALS['ss']["xsuccess"]=($response->val("1"));
 $response=$response->vals2list();
 if($GLOBALS['ss']["xresponse"]=='')$GLOBALS['ss']["xresponse"]=$response;
 return($response);
 
}
$GLOBALS['ss']["xsuccess"]=0;
$GLOBALS['ss']["xresponse"]=array();
function xreport(){
 
 $response=$GLOBALS['ss']["xresponse"];
 $GLOBALS['ss']["xresponse"]='';
 if($response!=''){ $error=$response['error'];
 if($error){
 if(!is_array($error)){ alert($error,2);
 }else{ foreach($error as $tmp){
 alert($tmp,2);
 }
 }
 }

 $success=$response['success'];
 if($success){
 if(!is_array($success)){
 alert($success,1);
 }else{
 foreach($success as $tmp){
 alert($tmp,1);
 }
 }
 }
 }
}

function xerror($text){ if(!$GLOBALS['ss']["xresponse"]){$GLOBALS['ss']["xresponse"]=array();}
 if(!$GLOBALS['ss']["xresponse"]['error']){$GLOBALS['ss']["xresponse"]['error']=array();}
 $GLOBALS['ss']["xresponse"]['error'][count($GLOBALS['ss']["xresponse"]['error'])]=$text;
}
function xsuccess(){
 return($GLOBALS['ss']["xsuccess"]);
}
function xsuccessalert($text){
if(xsuccess()){alert($text,1);}
}

}elseif($file=='func_vals.php'){
define('b913f1b1d2c354a76ed2061b36105efc',true);

class vals{
 var $vals=array();
 var $numberindex=0;
 function __construct($str="",$q=false){
 if(is_array($str)){
 $this->vals=$str;
 }else{
 $tmp=str_replace(";\r\n",";",$str);
 $tmp=explode(";",$tmp);
 foreach($tmp as $row){
 list($a,$b)=explode("=",$row);
 $b=explode(",",$b);
 foreach($b as $bb){
 $this->add($a,$bb,true);
 }}
 }
 }
 function r(){r($this->vals);}
 function add($a,$b,$unserialize=false){
 if($a and !$b){
 $q=true;
 $b=$a;
 $a=$this->numberindex;
 $this->numberindex++;
 }
 if($a or $q){
 if($unserialize){$b=xx2x($b);}
 if(!$this->vals[$a] or ($this->nojoin and $a!="join")){
 if($this->nojoin==="plus"){
 $this->vals[$a]=$this->vals[$a]+$b;
 }else{
 $this->vals[$a]=$b;
 }
 }else{
 if(!is_array($this->vals[$a])){
 $x=$this->vals[$a];
 $this->vals[$a]=array();
 $this->vals[$a][0]=$x;
 $this->vals[$a][1]=$b;
 }else{
 $this->vals[$a][count($this->vals[$a])]=$b;
 }
 }
 }
 }
 function delete($a){
 unset($this->vals[$a]);
 }
 function vals2str($conf=false){
 $tmp=array();$i=0;
 foreach($this->vals as $a=>$b){
 if(is_object($b))$b=$b->vals2str();
 if(is_array($b)){
 $ii=0;while($b[$ii]){$b[$ii]=x2xx($b[$ii]);$ii=$ii+1;}
 $b=join(",",$b);
 }else{
 $b=x2xx($b);
 }
 $tmp[$i]="$a=$b";
 $i=$i+1;
 }
 if($conf){$sch=";".nln;$bch=";";}else{$sch=";";$bch="";}
 $tmp=join($sch,$tmp);
 $tmp=$tmp.$bch;
 return($tmp);
 }
 function vals2list(){
 return($this->vals);
 }
 function val($val){
 $val=($this->vals[$val]);
 if($val){
 return($val);
 }else{
 return(false);
 }
 }
 function ifnot($key,$default){
 $val=($this->vals[$key]);
 if(!$val){
 return($default);
 }
 return($val);
 }
 function sort(){ksort($this->vals);}
 function vals2strobj($head){
 $tmp=array();$i=0;
 foreach($this->vals as $a=>$b){
 if(is_array($b)){
 $i=0;while($b[$i]){$b[$i]=x2xx($b[$i]);$i=$i+1;}
 $b=join(",",$b);
 }else{
 $b=x2xx($b);
 }
 $tmp[$i]="$head:$a=$b;";
 $i=$i+1;
 }
 $tmp=join(nln,$tmp);
 return($tmp);
 }
}

function str2list($tmp){
 if(!is_object($tmp))$tmp=new vals($tmp);
 $tmp=$tmp->vals2list();
 return($tmp);
}
function list2str($tmp){
 if(!is_object($tmp))$tmp=new vals($tmp);
 $tmp=$tmp->vals2str();
 return($tmp);
}
function valsintext($text,$vals,$x2xx=false){
 $list=str2list($vals);
 foreach($list as $key=>$value){
 if($x2xx)$value=x2xx($value);
 $text=str_replace("[$key]",$value,$text);
 }
 return($text);
}
function xxx2conf($tmp){
 $tmp=new vals($tmp);
 $tmp=$tmp->vals2str(true);
 return($tmp);
}


class func{
 function __construct($str=""){
 $this->funcs=new vals($str);
 $this->funcs->nojoin=true;
 $this->funcs->sort();
 $tmp=$this->funcs->vals2list();
 if(!isset($tmp['chat']))$this->add('chat','chat');
 if(!isset($tmp['info']))$this->add('info','info');
 if(!isset($tmp['logout']))$this->add('logout','logout');
 if(!isset($tmp['profile_edit']))$this->add('','');
 if(!isset($tmp['set_edit']))$this->add('profile_edit','profile_edit');
 if(!isset($tmp['stat']))$this->add('stat','stat');
 if(!isset($tmp['text']))$this->add('text','text');
 if(!isset($tmp['use']))$this->add('use','use');
 if(!isset($tmp['leave']))$this->add('leave','leave');
 if(!isset($tmp['repair']))$this->add('repair','repair');
 }
 function add($name,$class,$params="",$profile=""){
 $func=new vals();
 if($params){$params=$params->vals2str();}else{$params='';}
 if($profile){$profile=$profile->vals2str();}else{$profile='';}
 $func->add("class",$class);
 $func->add("params",$params);
 $func->add("profile",$profile);
 $func=$func->vals2str();
 $this->funcs->add($name,$func);
 $this->funcs->sort();
 }
 function addF($name,$key,$value,$wtf='params'){
 $func=$this->funcs->val($name); 
 if(!$func){
 $class=str_replace(array(0,1,2,3,4,5,6,7,8,9),'',$name);
 $this->add($name,$class);
 $func=$this->funcs->val($name);
 $func=new vals($func); 
 }
 
 $params=new vals($func->val($wtf));
 if($wtf=='params')$value=array(floatval($value),1);
 $params->add($key,$value);
 $params=$params->vals2str();
 if($wtf=='profile')$params=str_replace('[2]',',',$params); 
 
 $func->delete($wtf);
 $func->add($wtf,$params);
 
 
 $this->funcs->delete($name);
 $this->funcs->add($name,$func);
 }
 function delete($func){$this->funcs->delete($func);}
 function vals2str(){
 $return=$this->funcs->vals2str();
 return($return);
 }
 function vals2strobj($head){
 $return=$this->funcs->vals2strobj($head);
 return($return);
 }
 function vals2list(){
 $return=$this->funcs->vals2list();
 foreach($return as $i=>$tmp){
 $return[$i]=str2list($return[$i]); 
 $return[$i]["params"]=str2list($return[$i]["params"]); foreach($return[$i]["params"] as $key=>$value){
 if(!$return[$i]["params"][$key][0]){$return[$i]["params"][$key][0]=0;}
 if(!$return[$i]["params"][$key][1]){$return[$i]["params"][$key][1]=1;}
 }
 $return[$i]["profile"]=str2list($return[$i]["profile"]); 
 }
 return($return);
 }
 function func($func){
 $return=$this->vals2list();
 $return=$return[$func];
 if($return){
 $return=$return["params"];
 foreach($return as $i=>$param){
 $exp1=$param[0]; $exp2=$param[1]; if(!$exp1){$exp1=0;}
 if(!$exp2){$exp2=1;}
 $value=($exp1*$exp2);
 $return[$i]=$value;
 }
 return($return);
 }else{
 return(false);
 }
 }
 function profile($func,$param){
 $return=$this->vals2list();
 $return=$return[$func]["profile"][$param];
 return($return);
 }
 function fs(){
 $fs=0;
 foreach($this->vals2list() as $func){
 $f=$func["class"];
 $tmp=($GLOBALS['config']["fs"][$f]);
 if($tmp){
 foreach($func["params"] as $key=>$v){
 list($e1,$e2)=$v;
 if($e2<1){$e2=1/$e2;}
 $v=$e1*($e2*$e2);
 $tmp=str_replace($key,$v,$tmp);
 }
 $tmp="\$tmp=".$tmp.";";
 eval($tmp);
 $fs=$fs+$tmp;
 }
 }
 return($fs);
 }
 }
function level($list){
 list($exp1,$exp2)=$list;
 if(!$exp2){$exp2=1;}
 $value=($exp1*$exp2);
 return($value);
}
function func2list($tmp){
 $tmp=new func($tmp);
 $tmp=$tmp->vals2list();
 return($tmp);
}
class set extends vals{
 var $nojoin=true;
 var $vals=array(
 );
}
class windows extends vals{
 var $nojoin=true;
 var $vals=array(
 );
}
class profile extends vals{
 var $nojoin=true;
 var $vals=array(
 realname=>"",
 gender=>"",
 age=>"",
 mail=>"@",
 showmail=>"",
 web=>"",
 description=>"",
 join=>""
 );
}
class hold extends vals{
 var $nojoin="plus";
 var $vals=array(
 fp=>0
 );
 function textr(){
 $stream="";
 foreach($this->vals as $key=>$value){ if($key and $value)$stream=$stream.("{res_".$key."}: ".ir($value).' ');
 }
 if(!$stream)$stream="{res_no}";
 return($stream);
 }
 function show(){
 foreach($this->vals as $key=>$value){ echo(textbr("{res_".$key."}: ").ir($value).br);
 }
 }
 function showjs(){
 foreach($this->vals as $key=>$value){ echo("countdownto('res_$key',$value); ");
 }
 }
 function showimg($q=false,$notable=false){
 if(!$notable)echo("<table width=\"0\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>");
 foreach($this->vals as $key=>$value){ if($key and $value)echo((!$notable?'<td>':'').imgr("icons/res_$key.png","{res_$key}",15,15)."<span id=\"res_".($q?$key:'no')."\">".ir($value)."</span>".(!$notable?nbsp3.'</td>':' '));
 }
 if(!$notable)echo("</tr></table>");
 }
 function test($a,$b){
 $b=round($b);
 if($this->vals[$a]<$b){
 return(false);
 }else{
 return(true);
 }
 }
 function take($a,$b){
 $b=round($b);
 if($this->vals[$a]<$b){
 return(false);
 }else{
 $this->vals[$a]=$this->vals[$a]-$b;
 return(true);
 }
 }
 function fp(){
 $fp=0;
 foreach($this->vals as $key=>$value){
 $fp=$fp+$value;
 }
 return($fp);
 }
 function testhold($hold){
 $hold=$hold->vals2list();
 foreach($hold as $key=>$value){
 if(!$this->test($key,$value))return(false);
 }
 return(true);
 }
 function takehold($hold){
 if(!$this->testhold($hold))return(false);
 $hold=$hold->vals2list();
 foreach($hold as $key=>$value)$this->take($key,$value);
 return(true);
 }
 function multiply($q){
 foreach($this->vals as $key=>&$value)$value=round($value*$q);
 }
}
 
function showhold($hold,$cols=false){
 $hold=new hold($hold);
 $hold->showimg(NULL,$cols);
 unset($hold);
}




}elseif($file=='hold/change.php'){
define('a9d010ddc06fa4f02f4702fa521c28d2',true);

r($GLOBALS['get']["id"]);
if($_GET["id"]){
 $id=$_GET["id"];
}elseif($GLOBALS['get']["id"]){
 $id=$GLOBALS['get']["id"];
}else{
 $id=$GLOBALS['ss']["use_object"]->set->ifnot('changeid',0);
}


if(ifobject($id)){
 $GLOBALS['ss']["use_object"]->set->add('changeid',$id); 
 
$object= new object($id);
$eff=$object->supportF('change','eff');
$surkey=array('fuel'=>'Palivo',
 'wood'=>'Dřevo',
 'stone'=>'Kámen',
 'iron'=>'Železo'
);
window('{change_title}');
infob($object->name." (efektivita: ".round(100*$eff)."%)");
contenu_a();
 
 $url=("q=$id.change [change_from],[change_to],[change_count]");
 form_a(urlr($url),'change');
 
 input_select('change_from',NULL,$surkey);
 textb(nbsp3.'{change_fromto}'.nbsp3);
 input_select('change_to',NULL,$surkey);br();
 textb('{change_count}: ');
 input_text('change_count',100,15,7);br();
 
 
 form_sb();
 form_js('content','?e=hold-change&'.$url,array('change_to','change_from','change_count'));

contenu_b();
}

}elseif($file=='hold/func_core.php'){
define('cecf8a4a76240ab4ef08d8bdfb3151a9',true);

function a_change($from,$to,$count){ $count=intval($count);
 if(!$count or $count<2){
 $GLOBALS['ss']["query_output"]->add("error","{change_error_nocount}");
 return;
 }
 if($from==$to){
 $GLOBALS['ss']["query_output"]->add("error","{change_error_same}");
 return;
 }
 
 $eff=$GLOBALS['ss']["aac_object"]->supportF('change','eff');

 $price=new hold($from.'='.$count);
 if(!use_hold($price)){
 $GLOBALS['ss']["query_output"]->add("error","{change_error_price}");
 return;
 }
 
 $GLOBALS['ss']["use_object"]->hold->add($to,floor($count*$eff));
 
 $GLOBALS['ss']["query_output"]->add("success","{change_success;$from;$to;$count;".floor($count*$eff)."}");
 $GLOBALS['ss']["query_output"]->add("1",1);
}
 
?>
<?php
}elseif($file=='html.php'){
define('86d3ab5d343827998b44d7b9616ec817',true);
?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Towns 4</title>
<meta name="author" content="Pavel Hejný" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="shortcut icon" href="<?php e(rebase(root.base)); ?>favicon.ico">
<style type="text/css">
<!--
body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
color: #cccccc;
font-size: 14px;
font-family: "trebuchet ms";
}
h1{
font-size: 25px;
}
h3{
font-size: 15px;
}
hr {
border-color: #cccccc;
height: 0.5px;
}
a{color: #cccccc;text-decoration: none;}
-->
</style>

<?php
function script_($script){
 e('<script type="text/javascript" src="'.rebase(url.base.$script).'"></script>');
}
script_('lib/jquery/js/jquery-1.6.2.min.js');
script_('lib/jquery/js/jquery-ui-1.8.16.custom.min.js');
script_('lib/jquery/jquery.fullscreen-min.js');
script_('lib/jquery/jquery.mousewheel.js');
script_('lib/jquery/jquery.scrollbar.js');
?>

 <script type="text/javascript"> fps=30;</script>
<?php
if(defined('analytics')){
?>
<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', '<?php echo(analytics); ?>']);
 _gaq.push(['_trackPageview']);

 (function() {
 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();
</script>
<?php 
}
?>
</head>
<body>
<script type="text/javascript">
 z_index=1000;
 <?php if(!debug){ ?>
 $(document).ready(function()x{
 $(document).bind("contextmenu",function(e)x{
 return false;
 }x);
 }x);
 <?php } ?>
 connectfps=2;
 fps=37;
 
</script>
<?php
if(logged()){
?>
<div id="html_fullscreen">
<table width="100%" height="100%"><tr>
<td align="center" valign="center"><?php require2(root.core."/page/loading.php"); ?></td>
</tr></table>


</div>
<script type="text/javascript">
$(function()x{$.get('?s=<?php e(ssid); ?>&e=-html_fullscreen', function(vystup)x{$('#html_fullscreen').html(vystup);}x);}x);
</script>
<?php
}else{
require2(root.core.'/html_fullscreen.php');
}
?>

</body>
</html>
<?php
}elseif($file=='html_fullscreen.php'){
define('a0ffe5103d38e03f3f44eaa8dc50e02d',true);
?><div style="width: 100%; height: 100%;background-color:#43a1f7;overflow: hidden;">


<div id="windows" style="position:relative;top:0px;left:0px;width:100%;height:100%;">
<?php
if(logged()){
 $windows=array(
 'topinfo'=>false,
 'chat'=>false,
 'tabs'=>false,
 'miniprofile'=>false,
 'surkey'=>false,
 'topcontrol'=>false
 );
 
 $interface=str2list(xx2x($GLOBALS['ss']["log_object"]->set->val("interface")));
 foreach($interface as $w_name=>$tmp){
 list($w_content,$w_x,$w_y)=explode(",",$tmp);
 $windows[$w_name][0]=$w_content;
 $windows[$w_name][1]=$w_x;
 $windows[$w_name][2]=$w_y;
 $windows[$w_name][5]=array(1,1,1,1);
 }
 $windows['chat']=array("chat",0,-107,"103%",130,array(0,1,1,1),2);
 $windows['tabs']=array("tabs","%%",-141+13,"103%",0,array(0,1,1,1),1);
 $windows['miniprofile']=array("miniprofile","%%",-107,"103%",130,array(0,1,1,1),1);
 $windows['surkey']=array("surkey","%%",-25,0,0,array(0,1,1,1),1);

 if($windows['topcontrol']){
 $x=$windows['topcontrol'][1];
 $y=$windows['topcontrol'][2];
 }else{
 $x=-200;
 $y=1; }
 $windows['topcontrol']=array("topcontrol",$x,$y,204,0,array(0,0,1,1),4);
 
 
 

 if($GLOBALS['ss']["log_object"]->set->val("tutorial") and !$windows['help']){
 $GLOBALS['ss']["page"]='tutorial1';
 $windows=array_merge($windows,array('content'=>array("help",1,1,contentwidth,0,array(1,1,1,1),0)));
 $GLOBALS['ss']["log_object"]->set->delete("tutorial");
 }
 if(nopass and nofb){
 $GLOBALS['topinfo']='{register_nopassword}';
 $GLOBALS['topinfo_url']='e=content;ee=password_edit;'.js2('$(\'#topinfo\').css(\'display\',\'none\');');
 $windows=array_merge(
 $windows,
 array(
 "topinfo"=>array("topinfo",'%%',-161+13,'103%',0,array(0,1,1,1),1),
 ));
 }
 
 
}else{
 if(!$GLOBALS['ss']['bg']){
 $bgs=explode(',',$GLOBALS['config']['bg']);
 shuffle($bgs);
 $GLOBALS['ss']['bg']=$bgs[0];
 if(!$GLOBALS['ss']['bg'])$GLOBALS['ss']['bg']='_';
 }
 if(substr($GLOBALS['ss']['bg'],0,1)=='_'){
 $windows=array(
 "login-login"=>array("login-login",-350,-450,300,400,array(0,1,1,1),3)
 );
 }else{
 $windows=array(
 "login-login"=>array("login-login",50,-450,300,400,array(0,1,1,1),3)
 );
 } 
if($GLOBALS['ss']['fb_select_ids'] and $GLOBALS['ss']['fb_select_key']){
 $windows=array_merge(
 $windows,
 array(
 "login-fb_select"=>array("login-fb_select",'%','%',0,0,array(1,1,1,1),0),
 )); 
}
}
 $windows=array_merge(
 $windows,
 array(
 "copy"=>array("copy",logged?-50:-143,-25,500,0,array(0,1,1,1),1),
 "name"=>array("none",'[xx]','[yy]','[ww]','[hh]',array(1,1,1,1),0)
 ));
 if(debug){
 $windows=array_merge(
 $windows,
 array(
 "debug"=>array("debug",10,10,70,0,array(0,1,1,1),1)
 ));
 }
 
foreach($windows as $w_name=>$window){
$w_content=$window[0];
$w_x=$window[1];if(!$w_x)$w_x=0;
$w_y=$window[2];if(!$w_y)$w_y=0;
$w_w=$window[3];if(!$w_w)$w_w=0;
$w_h=$window[4];if(!$w_h)$w_h=0;
$w_rights=$window[5];$w_noborders=$window[6];
if($w_content and $w_name){
if($w_name=="name")echo("<div id=\"window\" style=\"display:none;\">");
t("window_$w_name>>");
?>
<div id="window_<?php echo($w_name); ?>" style="position:relative; <?php if($w_x==="%"){$w_x=0;echo("left:40%;");}if($w_y==="%"){$w_y=0;echo("top:40%;");}if($w_x==="%%"){$w_x=0;echo("left:50%;");}if($w_y==="%%"){$w_y=0;echo("top:50%;");}if($w_x<0){echo("left:100%; ");}if($w_y<0){echo("top:100%; ");} ?>width:100%; height:0px; overflow:visible;z-index:1000;">
<div id="window_sub_<?php echo($w_name); ?>" <?php if($w_rights[0]){ ?>class="window"<?php } ?> style="position:relative; left:<?php echo(is_numeric($w_x)?$w_x-2:$w_x); ?>px; top:<?php echo(is_numeric($w_y)?$w_y-2:$w_y); ?>px; width:<?php echo($w_w); ?>;">
 <table id="window_table_<?php echo($w_name); ?>" width="<?php echo($w_w); ?>" height="<?php echo($w_h); ?>" <?php if(!$w_noborders or $w_noborders==3){ ?> style="border: 2px solid #222222;border-radius: 5px; " cellpadding="3" cellspacing="0" <?php }elseif($w_noborders==4){ ?> style="border: 2px solid #222222;border-radius: 5px; " cellpadding="0" cellspacing="0" <?php } ?> >
 	<?php
 	 if(!$w_noborders){
 	?>
 <tr>
 <td height="19" bgcolor="#444444" class="dragbar" valign="center">
		 <?php
		 $js="w_close('window_$w_name')";
 		 if($w_rights[1])icon(js2($js),"close","{close}",18);
		 ?>
 <span id="window_title_<?php echo($w_name); ?>" style="font-size: 17 px;"><?php echo($w_title); ?></span>
	 </td>
 </tr>
	<?php } ?>
 <tr>
 <td  align="left" valign="top" <?php if(!$w_noborders or $w_noborders==2 or $w_noborders==3 or $w_noborders==4){e('style="background: rgba(7,7,7,0.88);"');} ?>>
 
 
	
 
 <?php
 		if($w_content!="none"){
 if($w_name=="content")xreport();
		eval(subpage($w_name,$w_content));
		}else{
		echo("innercontent");
		}
		 		?>
	</td>
 </tr>
 </table>

</div></div>
<?php
t("<<window_$w_name");
if($w_name=="name")echo("</div>");
}}
?>



<script type="text/javascript">
 
 $('#window_table_content').height($(window).height()-118);
 $(window).resize(function()x{
 $('#window_table_content').height($(window).height()-118);
 }x);

	function w_close(w_name)x{
 if(w_name.substring(0,7)!='window_')x{ 
 w_name='window_'+w_name;
 }x 
	 
 $('#'+w_name).remove();
 w_name=w_name.split("window_").join("");
 windows=windows+w_name+',none,,;';
 }x
	
 zi=1001;
	function w_drag()x{
		$(".window").draggable(x{ handle: ".dragbar" }x);
 $(".window").bind( "dragstart", function(event, ui)x{
			$(this).parent().css("z-index",zi);
 zi=zi+1;
 
		}x);
 $(".window").bind( "dragstop", function(event, ui)x{
			x=parseInt($(this).css("left"))+2;
 y=parseInt($(this).css("top"))+2;
			name= $(this).context.id.split('window_sub_').join('');
			
			windows=windows+name+',,'+x+','+y+';';
		}x);
	}x
	w_drag();
	
	function w_open(w_name,w_content,w_urlpart,xx,yy,ww,hh)x{
 
 if(!w_urlpart)w_urlpart="";
 
 if(w_name!='content')x{
 if(!xx)xx=50;
 if(!yy)yy=50;
 if(!ww)ww=<?php e(contentwidth); ?>;
 if(!hh)hh=$(document).height()-118;
 }xelsex{
 if(!xx)xx=1;
 if(!yy)yy=1;
 }x
 if(!ww)ww=0;
 if(!hh)hh=0;
 
		url="?e="+w_content+w_urlpart+"&i="+w_name+","+w_content+","+xx+","+yy;
		
			stream=$('#window').html();
			stream=stream.split("window_name").join("window_"+w_name);
			stream=stream.split("window_sub_name").join("window_sub_"+w_name);
			stream=(stream.split("window_title_name")).join("window_title_"+w_name);
			 stream=(stream.split("[xx]")).join(xx-2);
 stream=(stream.split("[yy]")).join(yy-2);
 stream=(stream.split("[ww]")).join(ww);
 stream=(stream.split("[hh]")).join(hh);
 
			
			loadingstream='<?php require2(root.core."/page/loading.php"); ?>';
 stream=stream.split("innercontent").join('<div id="'+w_name+'">'+loadingstream+"</div>");
 stream=$('#windows').html()+stream;
			$('#windows').html(stream);
			w_drag();
		
		$.get(url, function(vystup)x{
			$('#'+w_name).html(vystup);
		}x);
	}x
	
		w_drag();
 
 function r(text)x{
 contents=$("#output").html();
 
 if(contents)x{
 $("#output").html(text+'<br>'+contents);
 }x
 }x
 
</script>
</div>
<div style="position:relative;top:-100%;left:0px;width:100%;height:100%;z-index:2;">
<?php
if(logged()){
 eval(subpage("map"));
 eval(subpage("javascript"));
 ?><script type="text/javascript">parseMap();</script><?php
}else{
if($GLOBALS['ss']['bg']=='_'){



eval(subpage("map")); 


 }else{
 $imageurl=imageurl('bg/'.$GLOBALS['ss']['bg']); if(substr($GLOBALS['ss']['bg'],0,1)=='_'){
 $bgpos=0; 
 }else{
 $bgpos=100; 
 }
?>
<div style="top:0px;left:0px;width:100%;height:100%;background-color: rgb(0,0,0);background-image: url('<?php e($imageurl); ?>');Background-position: <?php echo($bgpos); ?>% 80%; Background-repeat:no-repeat	;Background-attachment:fixed; Background-size: auto 100%;"></div>
<?php
 
 }
?>
<?php } ?>
</div>
</div><?php
}elseif($file=='index.php'){
define('828e0013b8f3bc1bb22b4f57172b019d',true);

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
ini_set("register_globals","off");


$tmp=$_SERVER["REQUEST_URI"];



if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
$uri=explode('/',$tmp);
$admin=false;$debug=false;$speciale=false;
foreach($uri as $x){if($x){if($x!='admin' AND $x!='debug' AND substr($x,0,1)!='-'){$world=$x;}elseif($x=='admin'){$admin=true;}elseif($x=='debug'){$debug=true;}else{$speciale=true;$GLOBALS['url_param']=substr($x,1);}}}


$GLOBALS['inc']['urld']=str_replace('[world]',$GLOBALS['inc']['world'],$GLOBALS['inc']['url']);
$GLOBALS['inc']['url']=str_replace('[world]',$world,$GLOBALS['inc']['url']);
if(!$world or str_replace(array('.','?'),'',$world)!=$world){header('Location: '.$GLOBALS['inc']['urld']);exit;}

$gooduri=str_replace('/'.'/','',$GLOBALS['inc']['url']);
$gooduri=substr($gooduri,strpos($gooduri,'/'));
if(!$admin and !$debug and !$speciale)if($tmp!=$gooduri){header('Location: '.$GLOBALS['inc']['url']);exit;}

$GLOBALS['inc']['world']=$world;
define('core',$GLOBALS['inc']['core']);
define('base',$GLOBALS['inc']['base']);

if(!$debug)define('debug',0);

if(!$admin){
		
}else{
 eval("r"."equire(\$GLOBALS['inc']['app'].'/admin/index.php');");
 exit;
}
list($GLOBALS['url_param'])=explode('#',$GLOBALS['url_param']);

define("timeplan",false);
define("timestart", time()+microtime());
function t($text=""){if(timeplan){
$text=htmlspecialchars(round(time()+microtime()-timestart,2)." - ".$text);
echo("$text<br/>");}}
t('start');
define("root", "");
require2(root.core."/func_vals.php");
require2(root.core."/func_object.php");
require2(root.core."/func_main.php");
require2(root.core."/memory.php");

if(!$GLOBALS['ss']["ww"])$GLOBALS['ss']["ww"]=1;

if($_GET['e']!='-export')require2(root.core."/output.php");

require2(root.core."/func.php");
require2(root.core."/func_core.php");


require2(root.core."/login/func_core.php");
require2(root.core."/create/func_core.php");
require2(root.core."/attack/func_core.php");
require2(root.core."/text/func_core.php");
require2(root.core."/hold/func_core.php");
define("single", true);
$GLOBALS['ss']["url"]=url;
t("start");
if(!$GLOBALS['ss']["useid"])$GLOBALS['ss']["useid"]=$GLOBALS['ss']["logid"];
define("useid", $GLOBALS['ss']["useid"]);
define("logid", $GLOBALS['ss']["logid"]);
if($_GET["q"]){$q=($_GET["q"]);}
if($q){
 $q=valsintext($q,$_POST,true);
 $q=valsintext($q,$_GET,true);
 if(!$post["login_permanent"])r($q);
 xquery($q);
 
 }
if($GLOBALS['url_param']=='fblogin'){
 eval(subpage_('login-fb_redirect'));
 }
if($GLOBALS['ss']['fbid']){
 eval(subpage_('login-fb_process'));
}
if($GLOBALS['get']['fb_select_id'] and $GLOBALS['get']['fb_select_key']){
 xquery('login',$GLOBALS['get']['fb_select_id'],'facebook',$GLOBALS['get']['fb_select_key']);
}
if(!logged() and $_COOKIE["towns_login_username"] and !$GLOBALS['get']["logout"]){
 xquery("login",$_COOKIE["towns_login_username"],$_COOKIE["towns_login_password"]);
}
if(logged() and !useid){ if($post["login_permanent"]){ setcookie('towns_login_username',$post["login_username"],cookietime);
 setcookie('towns_login_password',$post["login_password"],cookietime);
 }
 reloc();
 }
if(logged() and $_GET['e']!="none"){ t("xxx");
 $info=xquery("info"); t("xxx");
 $info["func"]=new func($info["func"]);
 $funcs=$info["func"]->vals2list();
 $support=$info["support"];
 $tasks=csv2array($info["tasks"]);
 $info["set"]=new set($info["set"]);
 $info["profile"]=new profile($info["profile"]);
 $info["hold"]=new hold($info["hold"]);

 $info2=xquery("info","log"); $info2["func"]=new func($info2["func"]);
 $info2["set"]=new set($info2["set"]);
 $info2["profile"]=new profile($info2["profile"]);
 $info2["hold"]=new hold($info2["hold"]);
 $in2=xquery("items");
 $in2=$in2["items"];
 $in2=csv2array($in2);
 $own2=csv2array($info2["own2"]);
 if(!$GLOBALS['ss']["useid"]){$GLOBALS['ss']["useid"]=$info["id"];}
 if(!$GLOBALS['ss']["logid"]){$GLOBALS['ss']["logid"]=$info2["id"];}
}
if($_GET["resetwindow"]){
 $GLOBALS['ss']["log_object"]->set->delete("interface");
 reloc();
}
if($_GET["resetmemory"]){
 sql_query('DROP TABLE [mpx]memory');
 reloc();
}
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
$nwindows=$_GET["i"];
if(logged() and $nwindows){
 	$nwindows=explode(";",$nwindows);
	foreach($nwindows as $nwindow){if($nwindow){
		list($w_name,$w_content,$w_x,$w_y)=explode(",",$nwindow);
				$interface=xx2x($GLOBALS['ss']["log_object"]->set->val("interface"));
 $interface=new windows($interface);
 list($ow_content,$ow_x,$ow_y)=explode(",",$interface->val($w_name));
 if(!$w_content)$w_content=$ow_content;
 if(!$w_x)$w_x=$ow_x;
 if(!$w_y)$w_y=$ow_y;
 $nwindow="$w_content,$w_x,$w_y";
 if($w_content!="none"){
 $interface->add($w_name,$nwindow);
 }else{
 $interface->delete($w_name);
 }
 $interface=$interface->vals2str($interface);
 $interface=str_replace(nln,"",$interface);
 $GLOBALS['ss']["log_object"]->set->add("interface",x2xx($interface));
	}}
}
$nsets=$_GET["set"];
if(logged() and $nsets){
 	$nsets=explode(";",$nsets);
	foreach($nsets as $nset){if($nset){
		list($s_key,$s_value)=explode(",",$nset);
				$set=xx2x($GLOBALS['ss']["use_object"]->set->val("set"));
 $set=new windows($set);
 $ss_value=$set->val($s_key);
 if(!$s_value)$s_value=$ss_value;
 $nset=$s_value;
 if($s_value!="none"){
 $set->add($s_key,$nset);
 }else{
 $set->delete($s_key);
 }
 $set=$set->vals2str(); $set=str_replace(nln,"",$set);
 $GLOBALS['ss']["use_object"]->set->add("set",x2xx($set));
	}}
}
if(logged() and $_GET['e']!="none"){$settings=str2list(xx2x($GLOBALS['ss']["use_object"]->set->val("set")));
$GLOBALS['settings']=$settings;}
$lang=$GLOBALS['ss']["lang"];
	if(!$lang){$lang=lang;}
	if($GLOBALS['get']["lang"]){$lang=$GLOBALS['get']["lang"];}
	$GLOBALS['ss']["lang"]=$lang; 
t("before content");
if($_GET['e']){
	if(logged() or substr($_GET['e'],0,6)=='login-' or $_GET['e']=='help'){
	 	 $e=$_GET['e'];
	 define("subpage", $e);
	
	 list($dir,$e)=explode('-',$e);
	 if(!$e){$e=$dir;$dir='page';}
	 if($e!="none")require2(core."/$dir/".$e.".php");
 }else{
 	refresh();
 }
}else{
 define("subpage", false);
 require2(core."/html.php");
}


if(logged() and $_GET['e']!="none"){
$GLOBALS['ss']["log_object"]->update();
$GLOBALS['ss']["use_object"]->update();
$GLOBALS['ss']["aac_object"]->update();

unset($GLOBALS['ss']["log_object"]);
unset($GLOBALS['ss']["use_object"]);
unset($GLOBALS['ss']["aac_object"]);
}
if($endshow){echo($endshow);}

t("end");
exit2();

?>
<?php
}elseif($file=='login/fb_login.php'){
define('20981b6534ba6c327fc5516d60de8e46',true);
?>
<?php
 eval('req'.'uire_once(root."lib/facebook_sdk/base_facebook.php");');
 eval('req'.'uire_once(root."lib/facebook_sdk/facebook.php");');

 $fb_config = array();
 $fb_config['appId'] = fb_appid;
 $fb_config['secret'] = fb_secret;

 $facebook = new Facebook($fb_config);
 
 $params = array(
 'redirect_uri' => url.('-fblogin')
 );
 $loginUrl = $facebook->getLoginUrl($params);

?>

<a href="<?php echo($loginUrl) ?>">{fb_login_button}</a>
	
<?php
}elseif($file=='login/fb_process.php'){
define('7d292a202365c6371e4dff23fb3fe4d0',true);

if($GLOBALS['ss']['fbid']!=-1){
 $fbid=$GLOBALS['ss']['fbid'];
	
	$tmpids=sql_array('SELECT `id` FROM `[mpx]login` WHERE `key`=\''.$fbid.'\' AND `method`=\'facebook\'');
	if(count($tmpids)==0){
		echo('createuser');
	}elseif(count($tmpids)==1){
		$$tmpid=$tmpids[0][0];
		xquery('login',$tmpid,'facebook',$fbid);
	}else{
		$GLOBALS['ss']['fb_select_ids']=array();
		$GLOBALS['ss']['fb_select_key']=$fbid;
		foreach($tmpids as $tmpid){
			$tmpid=$tmpid[0];
			$GLOBALS['ss']['fb_select_ids'][count($GLOBALS['ss']['fb_select_ids'])]=$tmpid;
					}
	}
	
}else{
 xerror("{f_login_nofblogin}");
 }
$GLOBALS['ss']['fbid']=false;
?>

<?php
}elseif($file=='login/fb_redirect.php'){
define('4d012bfb447799f1866c2a94fcd6edb4',true);

	 eval('req'.'uire_once(root."lib/facebook_sdk/base_facebook.php");');
 eval('req'.'uire_once(root."lib/facebook_sdk/facebook.php");');

 $fb_config = array();
 $fb_config['appId'] = fb_appid;
 $fb_config['secret'] = fb_secret;
 
 $facebook = new Facebook($fb_config);
 
 $uid = $facebook->getSignedRequest();
 
 try{
 $user_profile = $facebook->api('/me','GET');
 
 	$GLOBALS['user_profile']=$user_profile;
	$fbid=$user_profile['id'];
	
 
	
 $GLOBALS['ss']['fbid']=$fbid;
	
	}catch(Exception $e){
 $GLOBALS['ss']['fbid']=-1;
	}

 	?>

<?php
}elseif($file=='login/fb_select.php'){
define('f9cae010c2b87ce9adace52b7998a27e',true);

if(!$GLOBALS['ss']['fb_select_ids'] or !$GLOBALS['ss']['fb_select_key']){
	w_close('login-fb_select');
}else{
	window("{fb_select} ",100,300);

	le('fb_select_question');
	foreach($GLOBALS['ss']['fb_select_ids'] as $tmpid){
		br();
		ahref(id2name($tmpid),'fb_select_id='.$tmpid.';fb_select_key='.$GLOBALS['ss']['fb_select_key'],"none",false);		
	}
	
	$GLOBALS['ss']['fb_select_ids']=false;
 $GLOBALS['ss']['fb_select_key']=false;
}
?>
<?php
}elseif($file=='login/func_core.php'){
define('c0cbbba873d76fdaf3cc747407dc3fae',true);

define("a_register_help","user");
function a_register($param1){
 if(defined('countdown') and countdown-time()>0){return;}
 if(!defined('register_block')){
 if(!($error=name_error($param1))){
 if(defined('register_user') and defined('register_building') and ifobject(register_user) and ifobject(register_building)){
 $q=false; 
 
 $file=tmpfile2("register_list","txt","text");
 if(!file_exists($file) or unserialize(file_get_contents($file))==array()){
 $array=sql_array("
 SELECT `x`,`y` FROM [mpx]map where `ww`='".$GLOBALS['ss']["ww"]."' AND 
 (`terrain`='t8' OR `terrain`='t9' OR `terrain`='t12' OR `terrain`='t13') AND 
 9=(SELECT COUNT(1) FROM [mpx]map AS Y where Y.`ww`='".$GLOBALS['ss']["ww"]."' AND (Y.`terrain`='t8' OR Y.`terrain`='t9' OR Y.`terrain`='t12' OR Y.`terrain`='t13') AND (Y.`x`+1>=[mpx]map.`x` AND Y.`y`+1>=[mpx]map.`y` AND Y.`x`-1<=[mpx]map.`x` AND Y.`y`-1<=[mpx]map.`y`))
 ORDER BY
 (SELECT COUNT(1) FROM [mpx]objects AS X where X.`ww`='".$GLOBALS['ss']["ww"]."' AND X.`own`!='0' AND (X.`x`+5>[mpx]map.`x` AND X.`y`+5>[mpx]map.`y` AND X.`x`-5<[mpx]map.`x` AND X.`y`-5<[mpx]map.`y`))
 ,RAND()");
 
 }else{
 $array=unserialize(file_get_contents($file)); 
 }
 if($array){ 
 $q=true; 
 list($x,$y)=$array[0];
 array_splice($array,0,1);
 }
 file_put_contents2($file,serialize($array));
 if($q){
 $set='tutorial=1';
 $id=nextid(); 
 $rows='`type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `hard`, `expand`'; 
 sql_query("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id','$param1',$rows,'$set', '0', '0', '".$GLOBALS['ss']["ww"]."', '0', '0', '".time()."' FROM ".mpx."objects WHERE id='".register_user."';");
 $id2=nextid(); 
 sql_query("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id2','$param1',$rows,`set`, '$id', '0', '".$GLOBALS['ss']["ww"]."', '$x', '$y', '".time()."' FROM ".mpx."objects WHERE id='".register_town."';");
 $id3=nextid(); 
 sql_query("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id3',`name`,$rows,`set`, '$id2', '0', '".$GLOBALS['ss']["ww"]."', '$x', '$y', '".time()."' FROM ".mpx."objects WHERE id='".register_building."';");
 
 $GLOBALS['ss']["query_output"]->add("1",1);
 $GLOBALS['ss']["log_object"]=new object($id);
 $GLOBALS['ss']["log_object"]->func->delete('login');
 $GLOBALS['ss']["log_object"]->func->add('login','login');
 $GLOBALS['ss']["log_object"]->update(); 
 $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
 a_use($id2);
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{register_error_nospace}'); 
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{config_error}'); 
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",$error);
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{register_block_error}');
 }
 
}
define("a_login_help","user,method,password[,newpassword,newpassword2]");
function a_login($param1,$param2,$param3,$param4="",$param5=""){
 if($param2=='towns'){
 $GLOBALS['ss']["log_object"] = new object($param1);
 $pass=sql_1data('SELECT `key` FROM `[mpx]login` WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\' LIMIT 1');
 if($pass==md5($param3) or !$pass){
 if(!$param4 and !$param5 and !$param6)$GLOBALS['ss']["query_output"]->add("1",1);
 if(!$pass and $param4){
 if($param4==$param5){
 sql_query("INSERT INTO `[mpx]login` (`id`,`method`,`key`,`text`,`time_create`,`time_change`,`time_use`) VALUES ('".($GLOBALS['ss']["log_object"]->id)."','towns','".md5($param4)."','','".time()."','".time()."','".time()."')");
 $GLOBALS['ss']["query_output"]->add("success","{f_login_createpass}");
 $GLOBALS['ss']["query_output"]->add("1",1); 
 }else{
 $GLOBALS['ss']["query_output"]->add("error","{f_login_nochangepass}");
 }
 
 $param4=false;$param5=false;
 } 
 sql_query('UPDATE `[mpx]login` SET `time_use`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\'');
 if($param4){
 if($param4==$param5){
 sql_query('UPDATE `[mpx]login` SET `key`=\''.md5($param4).'\', `time_change`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\'');

 $GLOBALS['ss']["query_output"]->add("success","{f_login_changepass}");
 $GLOBALS['ss']["query_output"]->add("1",1);
 }else{
 $GLOBALS['ss']["query_output"]->add("error","{f_login_nochangepass}");
 }
 }
 
 
 $use=sql_1data('SELECT `id` FROM [mpx]objects WHERE `own`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `type`=\'town\'');
 if($use){
 
 $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
 a_use($use);
 }else{
 $GLOBALS['ss']["query_output"]->add("error","{f_login_notown}");
 }
 
 }else{
 xerror("{f_login_nologin}");
 }
 }elseif($param2=='facebook'){
 
 $pass=sql_1data('SELECT `key` FROM `[mpx]login` WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'facebook\' LIMIT 1');
 if(!$pass and $param4){
 if($param4){
 sql_query("INSERT INTO `[mpx]login` (`id`,`method`,`key`,`text`,`time_create`,`time_change`,`time_use`) VALUES ('".($GLOBALS['ss']["log_object"]->id)."','towns','".md5($param4)."','','".time()."','".time()."','".time()."')");
 }
 $GLOBALS['ss']["query_output"]->add("success","{f_login_createfb}");
 $param4=false;$param5=false;
 } 
 
 if(1==sql_query('UPDATE [mpx]login SET time_use = \''.time().'\' WHERE `id`=\''.($param1).'\' AND `method`=\'facebook\' AND `key`=\''.($param3).'\' ')){ 
 if($param4){
 sql_query('UPDATE `[mpx]login` SET `key`=\''.($param4).'\', `time_change`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'facebook\'');
 $GLOBALS['ss']["query_output"]->add("success","{f_login_changefb}");
 $GLOBALS['ss']["query_output"]->add("1",1); 
 } 
 
 $GLOBALS['ss']["log_object"] = new object($param1);
 $GLOBALS['ss']["query_output"]->add("1",1); 
 $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
 a_use($param1);
 }else{
 $GLOBALS['ss']["query_output"]->add("error","{f_login_nofblogin}");
 } 
 }
}
define("a_logout_help","");
function a_logout(){
 $GLOBALS['ss']=array(); 
 setcookie('towns_login_username','',1);
 setcookie('towns_login_password','',1);
 reloc();
 exit2();
}
define("a_use_help","user");
function a_use($param1){
 $GLOBALS['ss']["use_object"] = new object($param1);
 $GLOBALS['ss']["useid"]=$GLOBALS['ss']["use_object"]->id;
 if($GLOBALS['ss']["use_object"]->own!=$GLOBALS['ss']["logid"] and $GLOBALS['ss']["logid"]!=$GLOBALS['ss']["useid"]){
 $GLOBALS['ss']["query_output"]->add("error","Tento objekt vám nepatří!");
 $GLOBALS['ss']["useid"]=$GLOBALS['ss']["logid"];
 unset($GLOBALS['ss']["use_object"]);
 
 }
}
?>
<?php
}elseif($file=='login/log_form.php'){
define('e3e5ccce584caef4131b14b26ad284a5',true);
?><form id="login" name="login" method="POST" action="<?php url("q=login [login_username],towns,[login_password];login_try=1"); ?>">
<table width="100%">
<tr>
<td width="10"><b>{login_username}:</b></td>
<td align="left"><input type="input" name="login_username" id="login_username" value="<?php echo($_POST["login_username"]) ?>" size="17" style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr><tr>
<td><b>{login_password}:</b></td><td align="left"><input type="password" name="login_password" value="" size="17" style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr>
<!--
<tr>
<td colspan="2"><?php input_checkbox("login_permanent",$post["login_permanent"]); ?> {login_permanent}</td></tr>-->
<tr>
<td colspan="2"><input type="submit" value="{login_ok}" /></td></tr>
</tr>

</table></form>

<?php
if(defined('fb_appid') and defined('fb_secret'))
eval(subpage('login-fb_login'));
?>

<script type="text/javascript">
document.login.login_username.focus();
</script><?php
}elseif($file=='login/login.php'){
define('b27bf153620f0fa7e8651d79cdab5754',true);

window('',0,0,'login');




?>
<div style="width:100%; height: 100%; background-color:rgba(17,17,17,0.7);">
<table border="0" cellspacing="0" cellpadding="0">
 <tr>
 <td width="45" height="45"><?php imge('logo/fract3.png','',73); ?></td>
 <td width="0" height="0"><span style="font-size:25px;" >&nbsp;Towns&nbsp;-&nbsp;Města</span></td>
 </tr>
</table>
<br/>
<div style="background:#111111;" >
Vítejte na stránkách nové online hry.
<br/>

</div>

<?php
if(defined('countdown') and countdown-time()>0){$disabled='disabled';
?>
<div style="background:#222222;" >{countdown} <?php timese(countdown-time()); ?></div>
<?php
}else{
 $disabled='';
}
?>


<br/>


<?php xreport(); ?>

<?php

$q=submenu('login-login',array('login','register','about'),1);
if($q==1){
 eval(subpage('login-log_form'));
}elseif($q==2){
 eval(subpage('login-reg_form'));
}elseif($q==3){
 $GLOBALS['ss']["page"]='about';
 $GLOBALS['nowidth']=true;
 eval(subpage('help'));
}

?>

<div style="background:#222222;" >{info}</div>
</div>

<?php
}elseif($file=='login/reg_form.php'){
define('6fdf16550e867252a5cf5d691d0efb7d',true);
 if(defined('countdown') and countdown-time()>0){}else{ ?>

<form id="register" name="register" method="POST" action="<?php url("q=register [register_username];login_try=1"); ?>">
<table width="100%">
<tr>
<td width="10"><b>{register_username}:</b></td>
<td align="left"><input <?php e($disabled); ?> type="input" name="register_username" id="register_username" value="<?php echo($_POST["register_username"]) ?>" size="17" style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr>
<td colspan="2"><input type="submit" value="{register_ok}" /></td></tr>
</tr></table></form>

<div style="background:#222222;" >{register_info}</div><br/>
<?php

if(defined('fb_appid') and defined('fb_secret'))
eval(subpage('login-fb_login'));
?>

<script type="text/javascript">
document.register.register_username.focus();
</script>

<?php } 
}elseif($file=='memory.php'){
define('0771de71faecdd8dcf91d13520e9b79a',true);

define('memory_time',3600*5);

if($_COOKIE['TOWNSSESSID']){$ssid=$_COOKIE['TOWNSSESSID'];}else{$ssid=rand(10000,99999);setcookie("TOWNSSESSID", $ssid);}
define('ssid',$ssid);
$GLOBALS['ss']=array();
foreach(sql_array('SELECT `key`, `value` FROM [mpx]memory WHERE id=\''.ssid.'\'') as $row){
 list($key,$value)=$row;
 $GLOBALS['ss'][$key]=unserialize($value);
}
t("memory_load");
$GLOBALS['ss_']=$GLOBALS['ss'];
function exit2($e=false){
		if($e)echo($e);
		$values='';$tmp='';
	foreach($GLOBALS['ss'] as $key=>$value){
	 
	 if($GLOBALS['ss_'][$key]!=$value){
	 if(!is_object($value)){
 $value=addslashes(serialize($value));
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
			t("memory_save");
	exit;
}
?>
<?php
}elseif($file=='output.php'){
define('ff0b7e6a58c943482d6c2c3607027401',true);


function contentantisvin($buffer){
 $kde=strpos($buffer,"<body>")+6;
 $kde2=strpos($buffer,"</body>");
 $zac=(substr($buffer,0,$kde));
 $kon=(substr($buffer,$kde2));
 $buffer=(substr($buffer,$kde,$kde2-$kde));
 $bufferx="";
 foreach(str_split($buffer) as $char){
 if(strtr($char,"ěščřžýáíéúůĚŠČŘŽÝÁÍÉÚŮqwertyuiopasdfghjkl","0000000000000000000000000000000000000000000000000000000000")==$char){
 $char=dechex(ord($char));
 if(strlen($char)==1){ $char=("0".$char); }
 $char="%".$char;
 }
 $bufferx=$bufferx.$char;
 }
 $buffer='<script language="javascript">
 document.write(unescape("'.$bufferx.'"));
 </script>'; 
 $nln="
 ";
 $buffer=$zac.$buffer.$kon;
 $buffer=str_replace($nln,"",$buffer);
 return($buffer);
}
function contentlang($buffer){ if(1){
 $file=("data/lang/".$GLOBALS['ss']["lang"].".txt");
 $stream=file_get_contents($file);
 $GLOBALS['ss']["langdata"]=(astream($stream));
 $buffer=str_replace(array("{0}","{}"),"",$buffer);
 $buffer=str_replace("x{","languageprotectiona",$buffer);
 $buffer=str_replace("}x","languageprotectionb",$buffer);
 $addtoend='';
 for($i=0;$tmp=substr2($buffer,"{","}",$i);$i++){
 if(rr())r($tmp);
 list($key,$params)=explode(";",$tmp,2);
 if($GLOBALS['ss']["langdata"][$key]){
 $text=valsintext($GLOBALS['ss']["langdata"][$key],$params);
 $size=strlen($text);
 $text=$text; if(rr())r($text);
 if(rr())r($buffer);
 if(rr())r();
 }else{
 $size=5;
 $text="languageprotectiona".$key.$params."languageprotectionb";
 
 $add='//'.$key.'=;';
 if(!strpos($stream,$add) and !strpos($addtoend,$add))$addtoend.=nln.$add;
 
 }
 if(lem){
 $text='<a href="lem.php" target="_blank">#</a>'.$text;
 }
 $buffer=substr2($buffer,"{","}",$i,$text);
 }
 $buffer=str_replace(array("{",";}","}"),"",$buffer);
 $buffer=str_replace("languageprotectiona","{",$buffer);
 $buffer=str_replace("languageprotectionb","}",$buffer);


 if($addtoend)file_put_contents2($file,file_get_contents($file).$addtoend);
 }else{
 $buffer=str_replace("x{","{",$buffer);
 $buffer=str_replace("}x","}",$buffer);
 }
 return($buffer);
}

function contentzprac($buffer){
 chdir(dirname($_SERVER['SCRIPT_FILENAME']));
 if(!$_GET["e"]){
 list($start,$buffer,$end)=part3($buffer,"<body>","</body>");
 $buffer=contentlang($buffer);
 $buffer=$start."<body>".$buffer."</body>".$end;
 }else{
 $buffer=contentlang($buffer);
 }
 
 return($buffer);
}
ob_start("contentzprac");
?>
<?php
}elseif($file=='page/aac.php'){
define('2ce2a494fa19ae4f715b45355cf5d216',true);

 	if(!logged()){
		e('window.location.replace(\'?q=logout\');');
	}else{
?>
if(!document.nochatref)x{<?php subjs('chat_text'); ?>;$("#chatscroll").scrollTop(10000);}x
<?php subjs('surkey'); ?>
<?php subjs('chat_aac'); ?>

<?php } 
}elseif($file=='page/chat.php'){
define('cb29fbdf22331192e378dbb50c9032ff',true);
?><div style="width:100%;height:2px;background-color:rgb(0,0,0);"></div>
<div style="width:100%;height:2px;background-color:rgba(0,0,0,0);"></div>

<div style="width:40%;height:86px;overflow:hidden;">
<div style="width:110%;height:101px;overflow:scroll;" id="chatscroll">
<?php eval(subpage("chat_text")); ?>
</div>
</div>


<span style="position:absolute;width:100%;"><span style="position:relative;left:45%;top:-77px;">
<?php
eval(subpage("chat_aac"));
 ?>
</span></span>

<?php 

}elseif($file=='page/chat_aac.php'){
define('2c72b5a795c9c57a812094e5b56dfb27',true);

 $iconsize=30;
 $url="e=content;ee=text-messages;ref=chat;id=".useid;
 $stream='';


 $add1='`to`='.useid.''; $add2="`type`='message' OR `type`='report' ";
 $q=sql_1data("SELECT COUNT(1) FROM `".mpx."text` WHERE `new`=1 AND ($add1) AND ($add2)");
 
 if($q){
 $stream.=imgr("icons/f_text_new.png",'{f_text_new;'.$q.'}',$iconsize);
 echo($q);
 }else{
 $stream.=imgr("icons/f_text.png",'{f_text}',$iconsize);
 }
 
 ahref($stream,$url);
if(debug)echo(rand(1111,9999));
 
}elseif($file=='page/chat_text.php'){
define('f2f84c634311cde905e8f5701118e095',true);

if(logged()){
 $stream='';
 $sql="SELECT `id`,`type`,`from`,`to`,`title`,`text`,`time` FROM `".mpx."text` WHERE (`to`='' OR `to`='".useid."' OR `from`='".useid."' OR `to`='".logid."' OR `from`='".logid."') AND (`type`='report') ORDER BY time DESC LIMIT 7";
 $array=sql_array($sql);
 if(count($array)<5)br(5-count($array));
 foreach($array as $row){
 list($id,$type,$from,$to,$title,$text,$time)=$row;
 if($type=='chat'){
 $stream="[".timer($time)."][".liner($from)."]:".nbsp.tr($text).br.$stream;
 }elseif($type=='report'){
 $stream="[".timer($time)."][".liner($from)."]:".nbsp.tr($title).br.$stream;
 }
 }
 echo($stream);
 }else{
 refresh();
}
?>
<?php
}elseif($file=='page/copy.php'){
define('0441f7373d56e0dda7a29a4f93c2c2f6',true);

if(logged){
ahref("{copy2}","e=content;ee=help;page=copy","none","x");
}else{
ahref(tcolorr("{copy}",'777777'),"e=content;ee=help;page=copy","none","x");
}
?>

<?php
}elseif($file=='page/ctable.php'){
define('272bb81660e7b51379b664e5b745e8dd',true);
 window("{items}",10); ?>
<div id="ctable_content">
</div>
<script>
function dechex (number) x{
 if (number < 0) x{
 number = 0xFFFFFFFF + number + 1;
 }x
 return parseInt(number, 10).toString(16);
}x
$(function()x{
 setInterval(function()x{
 s=0;
 stream='<table border="0" cellpadding="3" cellspacing="0">';
 for (var y=0; y<area.length;y++)x{
 stream=stream+'<tr>';
 for (var x=0; x<area[y].length;x++)x{
 
 bg=dechex(area[y][x]*255);
 bg=bg+bg+bg;
 if(Math.round(_xc-area_x)==x && Math.round(_yc-area_y)==y)x{
 bg='ff0000';
 }x
 stream=stream+'<td width="'+s+'" height="'+s+'" bgcolor="#'+bg+'"></td>';
 }x
 stream=stream+'</tr>';
 }x
 stream=stream+'</table>';
 $("#ctable_content").html(stream);
 }x,500);
}x);
</script>
<?php
}elseif($file=='page/debug.php'){
define('3ebc994fc03a20fcc6d0c758a63527bb',true);


if(useid==1){
 br();
	 }
if(debug){
 

?>
<a href="?">Refresh</a>
<?php

br();
?>
<a href="?resetwindow=1">ResetW</a>
<?php
br();
?>
<a href="?resetmemory=1">ResetM</a>
<?php
br();
ahref("CTable","e=ctable","none","x");


br();
ahref("Output","e=output","none","x");
br();

$tmp=$_SERVER["REQUEST_URI"];
if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
?>
<a href="<?php e($tmp); ?>/admin">Admin</a><br>
<a href="<?php e(url); ?>/compile.php?return=1">Compile</a>
<a href="<?php e(url); ?>/compile.php?return=1&amp;push=1">Push</a>



<?php } ?>
<?php
}elseif($file=='page/help.php'){
define('6ce5fc3c8c8ed09cba0dc89cf30945fe',true);

if(!$GLOBALS['nowidth']){
window("{title_help}");
?>
<!--<div style="width:400;"></div>-->
<?php
}

if(!$GLOBALS['ss']["page"]){$GLOBALS['ss']["page"]="index";}

if($GLOBALS['get']["page"]){
 $GLOBALS['ss']["page"]=$GLOBALS['get']["page"];
}


if(!file_exists(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["page"].'.html')){
 $GLOBALS['ss']["page"]="index";
}


$stream=file_get_contents(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["page"].'.html');

$stream=substr2($stream,'<title>','</title>',0,'<script>$("#window_title_content").html("[]");</script>',false);

$i=0;
while($tmp=substr2($stream,'src="','"',$i)){
 $stream=substr2($stream,'src="','"',$i,imageurl('../help/image/'.$tmp));
 $i++;
}

$i=0;
while($tmp=substr2($stream,'href="','"',$i)){
 $stream=substr2($stream,'href="','"',$i,urlr('e=content;ee=help;page='.$tmp));
 $i++;
}
$stream=str_replace('href="javascript:','href="#" onclick="',$stream);


if(!$GLOBALS['nowidth']){
 infob(ahrefr('{help_list}','e=content;ee=help;page=list'));
 contenu_a();
 e($stream);
 contenu_b();
}else{
 e($stream);
}

}elseif($file=='page/hold.php'){
define('93882d30bfddb2f03c05b9d78441243f',true);

 $info["hold"]->show();

}elseif($file=='page/javascript.php'){
define('0a3815f83fdbee016668aaeb58b65b73',true);
?><script type="text/javascript">



 

 xc=<?php echo($GLOBALS['xc']); ?>;
 yc=<?php echo($GLOBALS['yc']); ?>;
 function parseMapF(fff) x{
 parseMapx(false,fff);
 }x
 function parseMap() x{
 parseMapx(false,function()x{1;}x);
 }x
 function refreshMap() x{
 parseMapx(true,function()x{1;}x);
 }x
 function parseMapx(refresh,fff) x{
 
 xl=424;xp=424;
 yl=211;yp=211;
 tt=0.5;ppp=0;
 xxcc=00;
 yycc=00;

 xx=parseFloat($('#draglayer').css("left"));
 yy=parseFloat($('#draglayer').css("top"));
 
 
 if(typeof inloading=="undefined")inloading=0;
 q=1;w=0;
 while(q==1)x{
 q=0;
 if(xx-xxcc<-xp-xl*tt)x{xx=xx+xl;xc=xc+1;q=1;w=1;}x
 if(xx-xxcc>-xp+xl*tt)x{xx=xx-xl;xc=xc-1;q=1;w=1;}x
 if(yy-yycc<-yp-yl*tt+ppp)x{yy=yy+yl;yc=yc+1;q=1;w=1;}x
 if(yy-yycc>-yp+yl*tt+ppp)x{yy=yy-yl;yc=yc-1;q=1;w=1;}x
 }x
 if(refresh)w=1;
 if(w==1 && inloading==0)x{
 
 freeze=1;
 inloading=1;
 window.stop();
 
 $(function()x{$.get('?e=map&xc='+xc+'&yc='+yc+'&xx='+xx+'&yy='+yy+'&i='+windows, function(vystup)x{
 inloading=0;freeze=0;
 
 
 
 zaloha_a=$('#create-build').css('display');
 zaloha_e=$('#expandarea').css('display');
 $('#map').html(vystup);
 if(zaloha_a=='block')build(window.build_master,window.build_id,window.build_func);
 							$('#expandarea').css('display',zaloha_e);
 fff();
 }x);
 }x);
 }xelsex{
					fff(); 
 }x
 }x

 $(document).ready(function()x{
 
 function countdownto(id,x2)x{
 q=0;
 x1=parseFloat($("#"+id).html());
 
 x2=Math.round(x2);
 
 countdowns[countdowns.length]=[id,q,x1,x2];
 }x
 setInterval(function()x{
 if(typeof countdowns!='undefined')x{
 for (var i = 0; i <= countdowns.length; i++)x{
 
 countdown=countdowns[i];
 if(countdown)x{
 id=countdown[0];q=countdown[1];x1=countdown[2];x2=countdown[3];
 
 
 x=Math.round(x1+((x2-x1)*q));
 q=q+(1/fps);
 if(q>1)q=1;
 countdowns[i][1]=q;
 $("#"+id).html(x);
 }xelsex{
 
 }x
 }x}x
 }x,(connectfps*1000)/fps);
 
 
 rvrao=false;
 setInterval(function()x{
 if(!rvrao)x{
 
 urlpart='?e=aac&i='+windows;
 windows="";
 rvrao=true;$.get(urlpart, function(vystup)x{rvrao=false;eval(vystup);}x);
 
 }xelsex{
 rvrao=false;
 }x
 }x,(connectfps*1000));
 
 
 chating=false;
 
 
 
 key_up=false;
 key_down=false;
 key_left=false;
 key_right=false;
 key_count=0;
 
 $(document).keydown(function(e) x{
 
 if(chating==false)x{
 if ( e.which ==82) x{parseMap()}x
 
 if ( e.which ==87) x{key_up=true;}x
 if ( e.which ==83) x{key_down=true;}x
 if ( e.which ==65) x{key_left=true;}x
 if ( e.which ==68) x{key_right=true;}x
 
 if ( e.which ==38) x{key_up=true;}x
 if ( e.which ==40) x{key_down=true;}x
 if ( e.which ==37) x{key_left=true;}x
 if ( e.which ==39) x{key_right=true;}x 
 
 }x
 
 }x); 
 $(document).keyup(function(e) x{
 
 key_up=false;
 key_down=false;
 key_left=false;
 key_right=false;
 
 
 }x);

 
		accux=0;
 accuy=0;
 
 act_tmp=0;
 setInterval(function() x{
 if(document.activeElement.tagName=='BODY')x{
 
 act_tmpp=act_tmp;
 act_tmp = new Date();
 act_tmp = act_tmp.getTime();
 
 if(act_tmpp==0)x{
 act=0;
 }xelsex{
 act=(act_tmp-act_tmpp)/1000;
 }x
 
 if(key_count==0)x{
 actx=1;
 }xelsex{
 actx=key_count;
 key_count=key_count/Math.pow(1620,act);
 if(key_count<0.0001)x{
 key_up=false;
 key_down=false;
 key_left=false;
 key_right=false;
 key_count=0; 
 }x
 }x
 
 
 
 xx=parseFloat($('#draglayer').css("left"));
 yy=parseFloat($('#draglayer').css("top"));
 d=207*act*actx;q=false;
 xxp=xx;
 yyp=yy;
 if ( key_up==true ) x{yy=yy+d;q=true;}x
 if ( key_down==true ) x{yy=yy-d;q=true;}x
 if ( key_left==true ) x{xx=xx+d;q=true;}x
 if ( key_right==true ) x{xx=xx-d;q=true;}x
 
				if(typeof freeze=="undefined")freeze=0; 
 
				if((accux!=0 || accuy!=0) && !freeze)x{
					
					xx=xx-(-accux);
 	yy=yy-(-accuy);
 	accux=0;
 	accuy=0; 
 	q=true; 		
 }x
 
 
 if(q==true)x{
 
 $('#map_context').css('display','none');
 $('#draglayer').css("left",xx+'px');
 $('#draglayer').css("top",yy+'px');
 if(!freeze)x{
 	
 	parseMap();
 }xelsex{
 	accux=accux-(xxp-xx);
 	accuy=accuy-(yyp-yy);	
 }x
 }x
 
 }x
 }x,10);
 
 }x);
</script>
<?php
}elseif($file=='page/loading.php'){
define('288eb612bd7dc34fbca38e9c1f8308fa',true);
?>načítání...<?php
}elseif($file=='page/map.php'){
define('9735a5282cf83f8b929bea9088d0c454',true);

if(!defined("func_map"))require2(root.core."/func_map.php");
?>

<!--<script type="text/javascript" src="jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="jquery/js/jquery-ui-1.8.16.custom.min.js"></script>-->

<?php
 
 if($GLOBALS['get']['ww']){
 $GLOBALS['ss']["ww"]=intval($GLOBALS['get']['ww']);
 }


 if(logged()){
 $xc=$GLOBALS['ss']["use_object"]->set->ifnot("map_xc",1);
 $yc=$GLOBALS['ss']["use_object"]->set->ifnot("map_yc",1);
 $xx=$GLOBALS['ss']["use_object"]->set->ifnot("map_xx",0);
 $yy=$GLOBALS['ss']["use_object"]->set->ifnot("map_yy",0); 
 }else{
 $xc=1;
 $yc=1;
 $xx=0;
 $yy=0; 
 }
 
 if($_GET["xc"]!=""){$xc=$_GET["xc"];}
 if($_GET["yc"]!=""){$yc=$_GET["yc"];}
 if($_GET["xx"]!=""){$xx=$_GET["xx"];}
 if($_GET["yy"]!=""){$yy=$_GET["yy"];}
 if($GLOBALS['get']["xc"]!=""){$xc=$GLOBALS['get']["xc"];}
 if($GLOBALS['get']["yc"]!=""){$yc=$GLOBALS['get']["yc"];}
 if($GLOBALS['get']["xx"]!=""){$xx=$GLOBALS['get']["xx"];}
 if($GLOBALS['get']["yy"]!=""){$yy=$GLOBALS['get']["yy"];}
 $GLOBALS['ss']["map_xc"]=$xc;
 $GLOBALS['ss']["map_yc"]=$yc;
 $GLOBALS['ss']["map_xx"]=$xx;
 $GLOBALS['ss']["map_yy"]=$yy;
 $GLOBALS['xc']=$xc;
 $GLOBALS['yc']=$yc;
 $GLOBALS['xx']=$xx;
 $GLOBALS['yy']=$yy;
 if(logged()){
 $GLOBALS['ss']["use_object"]->set->add("map_xc",$xc);
 $GLOBALS['ss']["use_object"]->set->add("map_yc",$yc);
 $GLOBALS['ss']["use_object"]->set->add("map_xx",$xx);
 $GLOBALS['ss']["use_object"]->set->add("map_yy",$yy);
 }
 
 ?>


<?php
 if(logged()){
?>
<script type="text/javascript">
 
 function pos2pos(xt,yt)x{
 xxt=(yt/212*5)+(xt/424*5);
 yyt=(yt/212*5)-(xt/424*5); 
 xc=<?php echo($xc); ?>;
 yc=<?php echo($yc); ?>;
 
 xxc=(yc*5)+(xc*5)-12.5+xxt; 
 yyc=(yc*5)-(xc*5)+12.5+yyt; 
 return([xxt,yyt]);
 }x
 $(function() x{
 
 drag=0;
 
		$('#draglayer').draggable(x{ disabled: false }x);
 $( "#draglayer" ).bind( "dragstart", function(event, ui)x{
 drag=1;
 $('#map_context').css('display','none');
 }x);
 $( "#draglayer" ).bind( "dragstop", function(event, ui)x{
 
 setTimeout(function()x{drag=0;}x,100);
 parseMap();
 

 

 }x);
 
 $("#map_context").click(function() x{
 $('#map_context').css('display','none');
 }x);
 
 $(".clickmap").click(function(hovno) x{
 if(drag!=1)x{
 
 $('#map_context').css('left',hovno.pageX-10);
 $('#map_context').css('top',hovno.pageY-10);
 $('#map_context').css('display','block');
 offset = $("#tabulkamapy").offset();
 
 xt=(hovno.pageX-offset.left);
 yt=(hovno.pageY-offset.top);
 tmp=pos2pos(xt,yt);
 xxt=tmp[0];
 yyt=tmp[1];
 
 tmp=1;
 title=(Math.round(xxc*tmp)/tmp)+","+Math.round(Math.round(yyc*tmp)/tmp);
 
 $('#map_context').html(title);
 <?php if(logged){ ?>
 $(function()x{$.get('?e=miniprofile&w=&x='+xxc+'&y='+yyc, function(vystup)x{if(vystup.length>30)$('#miniprofile').html(vystup);}x);}x);
 <?php } ?>
 }x
 }x);
 
 $(".unit").click(function(hovno) x{
 if(drag!=1)x{ 
 $('#map_context').css('left',hovno.pageX-10);
 $('#map_context').css('top',hovno.pageY-10);
 $('#map_context').css('display','block');
 title=$(this).attr('title');
 name=$(this).attr('id');
 $('#map_context').html(title);
 <?php if(logged){ ?>
 $(function()x{$.get('?e=miniprofile&w=&contextid='+name+'&contextname='+title, function(vystup)x{$('#miniprofile').html(vystup);}x);}x);
 <?php } ?>
 }x
 }x);
 
 <?php if($GLOBALS['get']['center']){ ?>
 
 
		xc=parseInt($( "#draglayer" ).css('left'));
		yc=parseInt($( "#draglayer" ).css('top')); 
 $( "#draglayer" ).css('left',xc-400);
 $( "#draglayer" ).css('top',yc+200);
		setTimeout(function()x{ 
 parseMapF(
		function()x{ 
 $('#map_context').css('left',645);
 $('#map_context').css('top',195);
 $('#map_context').css('display','block');
 $(function()x{$.get('?e=miniprofile&w=&contextid='+<?php e($GLOBALS['get']['center']); ?>, function(vystup)x{$('#miniprofile').html(vystup);}x);}x);
		}x
		);
 }x,23);
 <?php } ?> 
 
 xc=<?php echo($xc); ?>;
 yc=<?php echo($yc); ?>;
 countdowns=[ ];
 windows="";
}x);
</script>


<div id="map_context" style="position:absolute; top:100; left:100; display:none; background: rgba(0,0,0,0.75); border-radius: 2px; padding: 4px;z-index:30;">
</div>
<!--================BUILD===================-->
<div id="create-build" name="create-build" style="position:absolute;display:none;top:0; left:0;z-index:25;">&nbsp;</div>
<script type="text/javascript">
 
 build_x=0;
 build_y=0;
 //window.build_master=false;
 //window.build_id=false;
 $("#create-build").css("left",(screen.width/2)-55);
 $("#create-build").css("top",(screen.height/2)-154);
 build=function(master,id,func) x{//alert(master+','+id+','+func);
 window.build_master=master;
 window.build_id=id;
 window.build_func=func;
 $("#expandarea").css("display","block");
 $("#create-build").css("display","block");
 $("#create-build").draggable();
 $( "#create-build" ).bind( "dragstop", function(event, ui)x{
 bx=parseFloat($("#create-build").css("left"));
 by=parseFloat($("#create-build").css("top"));
 offset = $("#tabulkamapy").offset();
 xt=(bx-offset.left);
 yt=(by-offset.top);
 tmp=pos2pos(xt,yt);
 xxc=xxc+4.57;
 yyc=yyc+3.67;
 build_x=xxc;
 build_y=yyc;
 //$("#copy").html(xxc+","+yyc);
 
 
 }x);
 
 $.get('?e=create-build&master='+master+'&func='+func+'&id='+id, function(vystup)x{$('#create-build').html(vystup);}x);
 }x
 <?php
 if(defined('object_build')){
 e('build('.$GLOBALS['ss']['master'].','.$GLOBALS['ss']['object_build_id'].',\''.$GLOBALS['ss']['object_build_func'].'\');');
 }
 if(defined('create_error')){
 e('alert("'.create_error.'");');
 }
 ?>
</script>
<?php } ?>

<!--===================================-->


<?php if(logged()){ ?>
<div style="position:absolute;top:0px;left:0px;width:100%;height:27px;z-index:550;">
<a onclick="key_up=true;key_count=key_count+2;">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_up" border="0" alt="<?php le('navigation_up'); ?>" title="<?php le('navigation_up'); ?>" width="100%" height="100%">
</a>
</div>

<div style="position:absolute;top:0px;left:0px;width:27px;height:100%;z-index:550;">
<a onclick="key_left=true;key_count=key_count+2;">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_left" border="0" alt="<?php le('navigation_left'); ?>" title="<?php le('navigation_left'); ?>" width="100%" height="100%">
</a>
</div>

<div style="position:absolute;top:100%;left:0px;width:100%;height:47px;z-index:550;">
<div style="position:relative;top:-163px;left:0px;width:100%;height:100%;">
<a onclick="key_down=true;key_count=key_count+2;">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_down" border="0" alt="<?php le('navigation_down'); ?>" title="<?php le('navigation_down'); ?>" width="100%" height="100%">
</a>
</div></div>

<div style="position:absolute;top:0px;left:100%;width:27px;height:100%;z-index:550;">
<a onclick="key_right=true;key_count=key_count+2;">
<div style="position:relative;top:0px;left:-27px;width:100%;height:100%;">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_right" border="0" alt="<?php le('navigation_right'); ?>" title="<?php le('navigation_right'); ?>" width="100%" height="100%">
</a>
</div></div>




<?php } ?>

<div style="top:<?php echo($yy); ?>;left:<?php echo($xx); ?>;z-index:20;" id="draglayer">
<?php
$stream1='';
$stream2='';
$screen=1270;
$ym=6;$xm=5;$ym=$ym-1;$xm=$xm-1;$xm=$xm/2;
$size=$screen/($xm+$xm+1);
$ad=("<table cellspacing=\"0\" cellpadding=\"0\" width=\"".$screen."\" id=\"tabulkamapy\">");
$stream1.=$ad;$stream2.=$ad;
for($y=$yc; $y<=$ym+$yc; $y++){
 $ad=("<tr>");$stream1.=$ad;$stream2.=$ad;
 for ($x=-$xm+$xc; $x<=$xm+$xc; $x++) {
 $ad=(dnln.'<td width="424" height="211">');$stream1.=$ad;$stream2.=$ad;
 $stream1.=htmlmap($x,$y,1);
 $stream2.=htmlmap($x,$y,2);
 $ad=("</td>");$stream1.=$ad;$stream2.=$ad;
 }
 $ad=("</tr>");$stream1.=$ad;$stream2.=$ad;
}
$ad=("</table>");$stream1.=$ad;$stream2.=$ad;

e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:100;">'.$stream1.'</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:200;">');
eval(subpage('map_units'));
e('</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:300;">'.$stream2.'</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:400;">'.$GLOBALS['units_stream'].'</div></div>');


?>

</div><?php
}elseif($file=='page/map_unitinfo.php'){
define('f7552b49140a878e72f1b9922d19fe61',true);
?><div style="position:absolute;"><div id="objecttext<?php echo($id); ?>" style="position: relative; top:0; left:0;background-color:rgba(22,22,22,0.80);border-radius: 5px; z-index:11;" >
 <?php echo($name.($text?': ':'')); ?>
 <span id="objectchat<?php echo($id); ?>">
 <?php echo(short($text,50)); ?>
 </span>
</div></div><?php
}elseif($file=='page/map_units.php'){
define('cdb511c96454bcbc800534377cdefbfa',true);

require2_once(root.core."/func_map.php");

 $GLOBALS['units_stream']='';
 $areastream='';

 $xcu=0;
 $ycu=0;
 if($GLOBALS['ss']["map_xc"])$xcu=$GLOBALS['ss']["map_xc"];
 if($GLOBALS['ss']["map_yc"])$ycu=$GLOBALS['ss']["map_yc"];
 
 
 $xu=($ycu+$xcu)*5+1;
 $yu=($ycu-$xcu)*5+1;
 
 $rxp=424*2.5;$ryp=0;$px=424/10;$py=$px/2;
$say="''";
$hlname=id2name($GLOBALS['config']['register_building']);
foreach(sql_array("SELECT `x`,`y`,`type`,`res`,`set`,`name`,`id`,`own`,$say,expand,collapse FROM `[mpx]objects` WHERE ww=".$GLOBALS['ss']["ww"]." AND `type`='building'") as $row){ $type=$row[2]; 
 $res=$row[3];
 $set=$row[4];
 $name=trim($row[5]);
 $id=$row[6];
 $own=$row[7];
 $text=xx2x($row[8]);
 $expand=floatval($row[9]);
 $collapse=floatval($row[10]);
 if($id==useid){
 $_xc=$GLOBALS['ss']["use_object"]->x;
 $_yc=$GLOBALS['ss']["use_object"]->y;
 
 }else{
 $_xc=$row[0];
 $_yc=$row[1];
 }
 $xx=$_xc-$xu;
 $yy=$_yc-$yu;
 
 $rx=round(($px*$xx)-($px*$yy)+$rxp);
 $ry=round(($py*$xx)+($py*$yy)+$ryp);
 if($id==useid){
 $built_rx=$rx;
 $built_ry=$ry;
 }
 if($rx>156 and $ry>0 and $rx<424*2.33-10 and $ry<212*3-20){ }{
 if(true){
 
 
 
 $y=gr;
 $brd=3*$y;
 $s=82*$expand*$y;
 if($expand and $own==useid){
 $file=tmpfile2('expand'.$expand,'png',"image");
 
 if(!file_exists($file) or notmpimg or true){
 $img=imagecreatetruecolor($s,$s/2);
 imagealphablending($img,false);
 $outer = imagecolorallocatealpha($img, 0, 0, 0, 127);
 $inner = imagecolorallocatealpha($img, 0, 0, 0, 100);
 $border = imagecolorallocatealpha($img, 0, 0, 0, 50);
 imagefill($img,0,0,$outer);
 imagefilledellipse($img, $s/2, $s/4, $s, $s/2 , $border);
 imagefilledellipse($img, $s/2, $s/4, $s-$brd, ($s/2)-$brd, $inner);
 imagesavealpha($img,true);
 imagepng($img,$file);
 chmod($file,0777);
 }
 
 $src=rebase(url.base.$file); 
 $areastream.='<div style="position:absolute;z-index:150;">
 <div style="position:relative; top:'.($ry-($s/$y/4)).'; left:'.($rx-($s/$y/2)).';" >
 <img src="'.$src.'" widht="'.($s/$y).'" height="'.($s/$y/2).'" class="clickmap" border="0" />
 </div></div>';
 } 
 if($collapse){
 $file=tmpfile2('collapse'.$collapse,'png',"image");
 if(!file_exists($file) or notmpimg or true){ 
 $img=imagecreatetruecolor($s,$s/2);
 imagealphablending($img,false);
 $outer = imagecolorallocatealpha($img, 0, 0, 0, 127);
 $inner = imagecolorallocatealpha($img, 255, 0, 0, 70);
 $border = imagecolorallocatealpha($img, 0, 0, 0, 50);
 imagefill($img,0,0,$outer);
 imagefilledellipse($img, $s/2, $s/4, $s, $s/2 , $border);
 imagefilledellipse($img, $s/2, $s/4, $s-$brd, ($s/2)-$brd, $inner);
 imagesavealpha($img,true);
 imagepng($img,$file);
 chmod($file,0777);
 }
 
 $src=rebase(url.base.$file); 
 $areastream.='<div style="position:absolute;z-index:150;">
 <div style="position:relative; top:'.($ry-($s/$y/4)).'; left:'.($rx-($s/$y/2)).';" >
 <img src="'.$src.'" widht="'.($s/$y).'" height="'.($s/$y/2).'" class="clickmap" border="0" />
 </div></div>';
 } 
 
 
 $modelurl=modelx($res);
 list($width, $height) = getimagesize($modelurl);
 if(!$GLOBALS['model_resize']) $GLOBALS['model_resize']=1; 
 $width=$width*$GLOBALS['model_resize'];
 $height=$height*$GLOBALS['model_resize'];
 ?>
 <?php
 ob_start(); 
 ?>
 <div style="position:absolute;z-index:<?php echo($ry+1000); ?>;" <?php if($id==useid)e('id="jouu"'); ?>>
 <div id="object<?php echo($id); ?>" style="position:relative; top:<?php echo($ry-132-$height+157); ?>; left:<?php echo($rx-43); ?>;">

 <?php if($res){ ?>
 <img src="<?php e($modelurl); ?>" width="82" class="clickmap" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>">
 <?php }else{echo('!res');} ?> 
 </div>
 </div>

 <div style="position:absolute;z-index:<?php echo($ry+2000); ?>;" >
 <div title="<?php e($name); ?>" style="position:relative; top:<?php echo($ry-132-40+157); ?>; left:<?php echo($rx-43+7); ?>;">
 <img src="<?php imageurle('design/blank.png'); ?>" class="unit" id="<?php echo($id); ?>" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>" width="70" height="35">
 </div> 
 </div>

 <?php
 $GLOBALS['units_stream'].=ob_get_contents();
 ob_end_clean();
 ?>

 <?php } ?>
 
 
 <?php }} ?>
 
 
<div id="expandarea" style="display:none;"> 
<?php echo( $areastream); ?>
</div>
<!--usemap="#clickmap"<map name="clickmap" id="clickmap">
<area shape="poly" coords="0,137,41,116,83,137,41,157" href="#" class="unit" />
</map>-->
 <?php
}elseif($file=='page/minimap.php'){
define('d9ae0eb765a723d0784d233d8f3b1c14',true);
?><div style="width: 100px; height: 100px;background-color:#444444;overflow: hidden;">

ahoj
</div><?php
}elseif($file=='page/miniprofile.php'){
define('24012ed9601c68af777e21917d54af59',true);

function centerurl($id,$x='x',$y=0,$ww=1){ if($x=='x'){ $destinationobject=new object($id);
 if(!$destinationobject->loaded)return('');
 $x=$destinationobject->x;
 $y=$destinationobject->y;
 $ww=$destinationobject->ww;
 unset($destinationobject); 
 }
 $tmp=3;
 $xc=(-(($y-1)/10)+(($x-1)/10));
 $yc=((($y-1)/10)+(($x-1)/10));
 $xx=(($xc-intval($xc))*-414);
 $yy=(($yc-intval($yc)+$tmp)*-211);
 $xc=intval($xc);
 $yc=intval($yc)-$tmp;
 $url='e=miniprofile;e=map;xc='.$xc.';yc='.$yc.';xx='.$xx.';yy='.$yy.';ww='.$ww.';center='.$id.';noi=1';
 return($url);
}

if(!$GLOBALS['hl']){
if($GLOBALS['config']['register_building']){
if($hl=sql_1data('SELECT id FROM [mpx]objects WHERE ww='.$GLOBALS['ss']['ww'].' AND own='.useid.' AND type=\'building\' and TRIM(name)=\''.id2name($GLOBALS['config']['register_building']).'\' LIMIT 1')){
 $GLOBALS['hl']=$hl;
}else{
 $GLOBALS['hl']=0; 
}
}else{
 $GLOBALS['hl']=0; 
}
}
$fields="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, (SELECT `name` from ".mpx."objects as x WHERE x.`id`=".mpx."objects.`own`) as `ownname`, `in`, `ww`, `x`, `y`, `t`";
if($_GET["x"] and $_GET["y"]){
 $x_=$_GET["x"]+1;
 $y_=$_GET["y"]+1;
 $sql="SELECT $fields FROM ".mpx."objects WHERE `ww`='".$GLOBALS['ss']['ww']."' AND (`type`='building' OR `type`='tree' OR `type`='rock') ORDER BY ABS(x-$x_)+ABS(y-$y_) LIMIT 1";
}else{
 if($_GET["contextid"]){
 $id=$_GET["contextid"];
 }elseif($GLOBALS['get']["contextid"]){
 $id=$GLOBALS['get']["contextid"];
 }else{
 
 $id=$GLOBALS['ss']["use_object"]->set->ifnot('contextid',$GLOBALS['hl']);
 }
 if(!ifobject($id))$id=$GLOBALS['hl'];
 $sql="SELECT $fields FROM ".mpx."objects WHERE id=$id"; $x_=false;
}
if($sql and $id?ifobject($id):true){
 $array=sql_array($sql);
 list($id, $name, $type, $dev, $fs, $fp, $fr, $fx, $fc, $func, $hold, $res, $profile, $set, $hard, $own, $ownname, $in, $ww, $x, $y, $t)=$array[0];
 if(is_numeric($name))$name=lr($type);
 if($x_){
 $dist=sqrt(pow($x_-$x,2)+pow($y_-$y,2));
 if($dist>1)exit2();
 }
 $GLOBALS['ss']["use_object"]->set->add('contextid',$id);
 
 
 e('<table border="0" width="47%"><tr height="70"><td width="50" align="left" valign="top">'); 
 mprofile($id);br(3);
 
 e('</td><td align="left" valign="top" width="110">');
 
 
 
 if($own==useid){ 
 $own_=('vlastní budova');
 }elseif($own){
 $own_='město '.($ownname);
 }elseif($type=='tree' or $type=='rock'){ 
 $own_=('příroda');
 }else{
 $own_=('opuštěná budova');
 } 
 
 
	labele(textbr(short($name,20)),$name.'(id: '.$id.')');		imge('design/dot.png','','100%',2);
		textab_(array(array('život:',$fp.'/'.$fs),
	 array('pozice:','['.round($x).','.round($y).']'),
	 array($own_)),90,55,13);	e('</td><td align="left" valign="top">');
	e('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="top">'); 
	
	 $iconsize=35;
 $iconbrd=3;
 if($own==useid){
 $functionlist=array('attack','create','teleport','portal','repair','upgrade','replace','change'); 
 }else{
 $functionlist=array('portal'); 
 } 
 
$set=new set($set); 
$set=$set->vals2list(); 
 
$q=1;$yes=0;
$funcs=func2list($func);
foreach($functionlist as $qq_class){
 foreach($funcs as $fname=>$func){
 $class=$func["class"];
 if($class==$qq_class){
 $params=$func["params"];
 $stream="";$ahref='';$yes=0;
 $profile=$func["profile"];
 if($profile["icon"]){
 $icon=$profile["icon"];
 }else{
 $icon="f_$class";
 }
 $xname=$profile["name"];
 if(!$xname){$xname="{f_$class}";}
 switch ($class) {
 
 case 'attack':
 $set_key='attack_mafu';
 $set_value=$id.'-'.$fname;
 $set_value2=$id.'-'.$fname.'-'.$xname.'-'.$icon;
 $stream=($set_key."='$set_value2".'\';'.borderjs($set_value,$set_value2,$set_key,$iconbrd));
 list($a,$b)=explode('-',$GLOBALS['settings'][$set_key]); 
 if($a.'-'.$b==$set_value)$yes=1;
 
 break;
 case 'create':
 if(is_array($func['profile']['limit']) or !$func['profile']['limit']){
 $ahref='e=content;ee=create-unique;type=building;master='.$id.';func='.$fname;
 }else{
 $stream="build($id,".$func['profile']['limit'].",'$fname')";
 } 
 break;
 case 'replace':
 if(intval(sql_1data("SELECT COUNT(1) FROM [mpx]objects WHERE own='".useid."' AND `ww`=".$GLOBALS['ss']["ww"]))<=1){
 $stream="build($id,".$GLOBALS['config']['register_building'].",'$fname')";
 }
 break;
 case 'teleport':
 case 'portal':
 $ahref=centerurl($func['profile']['id']);

 break;
 case 'repair':
 if($fs!=$fp){
 $ahref='e=content;ee=create-upgrade;id='.$id; 
 }
 break;
 case 'change':
 $ahref='e=content;ee=hold-change;id='.$id; 
 break;
 }
 if($stream or $ahref){

 
 if($yes and $stream){echo("<script>$stream</script>");}
 if($yes){$brd=$iconbrd;}else{$brd=0;}
 e(nln);
 
 
 
 if(defined("a_".$class.'_cooldown')){ $cooldown=$params['cooldown'][0]*$params['cooldown'][1];
 if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
 $lastused=$set['lastused_'.$fname];
 $time=($cooldown-time()+$lastused); 
 if($time>0){
 $countdown=$time;
 }
 } 
 
 border(iconr(
 (($countdown and $class!='attack')?'':
 (($ahref?$ahref.';':'').($stream?"js=".x2xx($stream).';':''))),
 $icon,$xname,$iconsize,NULL,$countdown),$brd,$iconsize,$set_value,$set_key,$countdown);
 $countdown=0; 
 
 
 }
 }
 }
} 
 if($own==useid){ 


 
 if(id2name($GLOBALS['config']['register_building'])!=$name){
 border(iconr('e=miniprofile;prompt={f_leave_prompt};q=leave '.$id,'f_leave','{f_leave}',$iconsize),0,$iconsize);
 }else{
 }
 }elseif($own){
 border(iconr("e=content;ee=profile;id=".$own,"profile_town2","{profile_town2}",$iconsize),0,$iconsize);
 
 $ownown=sql_1data('SELECT `own` FROM [mpx]objects WHERE `id`=\''.$own.'\'');
 if($ownown)border(iconr("e=content;ee=profile;id=".$ownown,"profile_user2","{profile_user2}",$iconsize),0,$iconsize);
 }



if($own!=useid){
 if(id2name($GLOBALS['config']['register_building'])!=$name){ 
 if($GLOBALS['settings']['attack_mafu']){
 list($attack_master,$attack_function,$attack_function_name,$attack_function_icon)=explode('-',$GLOBALS['settings']['attack_mafu']);
 if(ifobject($attack_master)){
 
 $set=new set(sql_1data("SELECT `set` FROM [mpx]objects WHERE `id`='$attack_master'"));
 $set=$set->vals2list();
 $func=new func(sql_1data("SELECT `func` FROM [mpx]objects WHERE `id`='$attack_master'")); 
 $func=$func->vals2list(); 
 
 
 
 if(defined('a_attack_cooldown')){ $cooldown=$func[$attack_function]['params']['cooldown'][0]*$func[$attack_function]['params']['cooldown'][1];
 if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
 $lastused=$set['lastused_'.$attack_function]; 
 $time=($cooldown-time()+$lastused);
 if($time>0){
 $countdown=$time;
 }
 
 
 border(iconr($countdown?'':'e=content;ee=attack-attack;set=attack_id,'.$id.';noshit=1',$attack_function_icon,"$attack_function_name (".id2name($attack_master).")",$iconsize,NULL,$countdown),0,$iconsize,NULL,NULL,$countdown);
 $countdown=0;
 }
 
 
 
 }
 
 } 
 border(iconr('e=content;ee=attack-attack;set=attack_id,'.$id,'f_attack_window','{f_attack_window}',$iconsize),0,$iconsize);
 }
}


$url=centerurl($id,$x,$y,$ww);
border(iconr($url,'fx_center','{fx_center}',$iconsize),0,$iconsize); 

$xc_=$GLOBALS['ss']["use_object"]->set->ifnot("map_xc",false);
$yc_=$GLOBALS['ss']["use_object"]->set->ifnot("map_yc",false);
$xx_=$GLOBALS['ss']["use_object"]->set->ifnot("map_xx",false);
$yy_=$GLOBALS['ss']["use_object"]->set->ifnot("map_yy",false);
if($xc_===false and $yc_===false and $xx_===false and $yy_===false and id2name($GLOBALS['config']['register_building'])==$name){
 
 click($url,1);
}

$tabs=$GLOBALS['ss']["use_object"]->set->ifnot('tabs','');
$tabs=explode(',',$tabs);
$q=false;foreach($tabs as $tab){if($tab==$id){$q=true;}}

$set_value='tab_'.$id;
$set_key='1';
$stream=borderjs($set_value,$set_value,$set_key,($q?0:$iconbrd),false);
border(iconr("e=tabs;tab=$id;wtf=".($q?0:1).";js=".x2xx($stream),'fx_tab','{fx_tab}',$iconsize),$q?$iconbrd:0,$iconsize,$set_value,$set_key);
 
 if(debug){
 $tmp=$_SERVER["REQUEST_URI"];
 if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
 ?><br/>
 <a href="<?php e($tmp); ?>/admin?page=object&amp;s_input_admin=<?php e($id); ?>">admin</a>, 
 <?php
 if($GLOBALS['get']['changemap']){ 
 list($tmpx,$tmpy)=explode(',',$GLOBALS['get']['changemap']);
 changemap(floatval($tmpx),floatval($tmpy),true);
 }
 ?>
 <?php ahref('changemap','e=miniprofile;ref=map_units;changemap='.$x.','.$y); ?>
 <?php
 }
 
 e(nbsp2);
 imge('design/dot.png','',2,$iconsize);
 e(nbsp2); icon("e=content;ee=profile;id=".useid,"profile_town","{profile_town}",$iconsize);
 icon("e=content;ee=profile;id=".logid,"profile_user","{profile_user}",$iconsize);
 $iconsize=24;
 

 e('</td><td align="left" valign="top" width="'.$iconsize.'">'); 
 
}
 icon("q=logout","logout","{logout}",$iconsize); 
 br();icon("e=content;ee=help;page=index",'help',"{help}",$iconsize); 
 br();icon(js2('if($(\'#expandarea\').css(\'display\')==\'block\')x{$(\'#expandarea\').css(\'display\',\'none\')}xelsex{$(\'#expandarea\').css(\'display\',\'block\')}x1'),"expand","{expand}",$iconsize);
 if($sql and $id?ifobject($id):true){
 
 e('</td></tr></table>'); 
 e('</td></tr><tr><td colspan="3" align="left" valign="top">');
 e('</td></tr></table>'); 
 
?>
<script type="text/javascript">
$('#map_context').html('<?php e(trim($name)); ?>');
</script>
<?php } ?>
<?php
}elseif($file=='page/nonex.php'){
define('e20412cc06ddc2a1ac84bb82d27f825e',true);

}elseif($file=='page/output.php'){
define('442ab4fe49aee24c2ea98fd9e584e570',true);
 window("{output}",200,200); ?>
&nbsp;<?php
}elseif($file=='page/password_edit.php'){
define('08da52fd88ff2f9d758c717f6db3c021',true);

window('{password_edit}');

infob(ahrefr('{back}','e=content;ee=profile'));
contenu_a();

if($_POST["oldpass"] or $_POST["newpass"] or $_POST["newpass"]){
 if($post["newpass"]){
				 
	 xreport();
 xquery('login',$GLOBALS['ss']["logid"],'towns',$_POST["oldpass"]?$_POST["oldpass"]:$_POST["newpass"],$_POST["newpass"],$_POST["newpass2"]);
 
if(xsuccess()){
 ?> 
<script>
setTimeout(function()x{
 w_close('content');
}x,3000);
</script>
<?php
}
 
 xreport();
 }else{
 alert("{password_change_no_error}",2);
 }
}
if($GLOBALS['ss']["logid"]!=$GLOBALS['ss']["useid"]){
 }
?>
<form id="changepass" name="changepass" method="POST" action="" onsubmit="return false">
<table>

<?php if(!nopass){ ?>
<tr><td><b><?php le("oldpass"); ?>:</b></td><td><?php input_pass("oldpass",$_POST["oldpass"]); ?></td></tr>
<?php } ?>
<tr><td><b><?php le("newpass"); ?>:</b></td><td><?php input_pass("newpass",$_POST["newpass"]); ?></td></tr>
<tr><td><b><?php le("newpass2"); ?>:</b></td><td><?php input_pass("newpass2",$_POST["newpass2"]); ?></td></tr>


</table>
<input type="submit" value="OK" />
</form>
<script>
$("#changepass").submit(function() x{
 //alert(1);
 $.post('?e=password_edit',
 x{ oldpass: $('#oldpass').val(), newpass: $('#newpass').val(), newpass2: $('#newpass2').val() }x,
 function(vystup)x{$('#content').html(vystup);}x
 );
 return(false);
}x);
</script>
<?php
contenu_b();

}elseif($file=='page/profile.php'){
define('0bf49c6adf9920b2ab0023563ec5507f',true);

window("{title_profile}");
$GLOBALS['ss']["profileid"]=0;

$q=submenu(array("content","profile"),array("stat_profile","stat_buildings","stat_towns","stat_users"),1);

if($GLOBALS['get']["id"]){$GLOBALS['ss']["profileid"]=$GLOBALS['get']["id"];$q=1;}

contenu_a();
if($q==1){
 if(!$GLOBALS['ss']["profileid"]){$GLOBALS['ss']["profileid"]=$GLOBALS['ss']["logid"];}
 profile($GLOBALS['ss']["profileid"]);
 
}elseif($q==2){$GLOBALS['stattype']='buildings';eval(subpage("stat"));
}elseif($q==3){$GLOBALS['stattype']='towns';eval(subpage("stat"));
}elseif($q==4){$GLOBALS['stattype']='users';eval(subpage("stat"));
}
contenu_b();

?>
<?php
}elseif($file=='page/profile_edit.php'){
define('08ef9dc9da40c45597c2ff8c7a5d2245',true);

window('{profile_edit}');
infob(ahrefr('{back}','e=content;ee=profile'));

contenu_a();

if($GLOBALS['get']['id'])$GLOBALS['ss']['profile_edit_id']=$GLOBALS['get']['id'];
if(!$GLOBALS['ss']['profile_edit_id'])$GLOBALS['ss']['profile_edit_id']=useid;
$id=$GLOBALS['ss']['profile_edit_id'];

 $info=array();
 $tmpinfo=xquery("info",$id);
 $info["profile"]=new profile($tmpinfo["profile"]);
 $info["name"]=$tmpinfo["name"];
 $p=$info["profile"]->vals2list();

if($_GET["profile_edit"]){
 if($_POST["name"] and $info["name"]!=$_POST["name"]){
 xquery("profile_edit",$id,"name",$_POST["name"]);
 xreport();
 $info["name"]=$_POST["name"];
 }
 if($_POST["description"] and $p["description"]!=$_POST["description"]){xquery("profile_edit",$id,"description",$_POST["description"]);xreport();$p["description"]=$_POST["description"];}
 
 
}

?>

<?php

form_a(urlr('profile_edit=1'),'profile_edit');
?>


<table>


<tr><td><b><?php le("name"); ?>:</b></td><td><?php input_text("name",$info["name"]); ?></td></tr>

<tr><td><b><?php le("description"); ?>:</b></td><td><?php input_textarea("description",$p["description"],44,17); ?></td></tr>



<tr><td colspan="2"><input type="submit" value="OK" /></td>
</tr></table>

<?php
form_b();
form_js('content','?e=profile_edit&profile_edit=1',array('name','description'));



contenu_b();
?>
<?php
}elseif($file=='page/stat.php'){
define('e470e24e0b9689045e17812fc21d689b',true);

backup($GLOBALS['stattype'],"buildings");

if($GLOBALS['stattype']=='buildings'){
 $GLOBALS['where']="type='building' AND ww!=0 AND ww!=-1 ";
}elseif($GLOBALS['stattype']=='towns'){
 $GLOBALS['where']="type='town' AND ww!=0 AND ww!=-1 ";
 $ad1='SELECT count(1) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'building\'';
 $ad2='SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'building\'';
 $order="ad2";
}elseif($GLOBALS['stattype']=='users'){
 $GLOBALS['where']="type='user' AND ww!=0 AND ww!=-1 ";
 $ad3='SELECT count(1) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'town\'';
 $ad1='SELECT count(1) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
 $ad2='SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
 
 $order="ad2";
}
if($ad1)$ad1=',('.$ad1.') as ad1';
if($ad2)$ad2=',('.$ad2.') as ad2';
if($ad3)$ad3=',('.$ad3.') as ad3';
if(!$order)$order="fs";


$max=sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE ".$GLOBALS['where']);
$limit=limit("stat",$GLOBALS['where'],16,$max);


$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`own`,`in`,`x`,`y`,`ww`$ad1$ad2$ad3 FROM `".mpx."objects` WHERE ".$GLOBALS['where']." ORDER BY $order DESC LIMIT $limit");
?>
<table width="100%">
<tr>
<td width="20">#</td>
<td width="50">ID</td>
<td width="150">jméno</td>
<?php if($GLOBALS['stattype']!='users'){ ?>
<td width="80">Poloha</td>
<?php }else{ ?>
<td width="30"><span title="Počet měst">M.</span></td>
<?php } ?>
<?php if($GLOBALS['stattype']=='buildings'){ ?>
<td width="80">Život</td>
<?php }else{ ?>
<td width="30"><span title="Počet budov">B.</span></td>
<?php } ?>
<td width="30"><span title="Level">L.</span></td>
<td>Akce</td>
</tr>

<?php

$i=$GLOBALS['ss']['ord'];
foreach($array as $row){$i++;
 list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$own,$in,$x,$y,$ww,$ad1,$ad2,$ad3)=$row;
 $hline=ahrefr(tr(short($name,20),true),"e=content;ee=profile;id=$id","none","x");
 
 if($GLOBALS['stattype']=='buildings'){
 $in=xyr($x,$y,$ww);
 $lvl=fs2lvl($fs);
 if($fp==$fs){
 $fpfs=round($fs);
 }else{
 $fpfs=round($fp).'/'.round($fs);
 }
 }elseif($GLOBALS['stattype']=='towns'){
 $in=xyr($x,$y,$ww);
 $lvl=fs2lvl($ad2);
 $fpfs=$ad1;
 }elseif($GLOBALS['stattype']=='users'){
 $lvl=fs2lvl($ad2);
 $fpfs=$ad1;
 }

 e("<tr>
 <td>$i</td>
 <td>$id</td>
 <td>$hline</td>");
 if($GLOBALS['stattype']!='users'){
 e("<td>$in</td>");
 }else{
 e("<td>$ad3</td>");
 } 
 
 e("<td>$fpfs</td>
 <td>$lvl</td>
 <td>");
 if($ww==0){
	$js="w_close('window_unique');build('$id');";
 icon(js2($js),"f_create_building_submit","{build_submit}",15);
 }
 e("</td>
 </tr>");
 }

?>

</table>
<?php
}elseif($file=='page/stat2.php'){
define('b2c02c4458b539f15e77afd017eca7c3',true);

require2_once(root.core."/func_map.php");
backup($GLOBALS['where'],"1");
$order="fs";
$max=sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE ".$GLOBALS['where']);
$limit=limit("stat2",$GLOBALS['where'],102,$max);


$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`fc`,`res`,`profile`,`own`,`in`,`x`,`y`,`ww` FROM `".mpx."objects` WHERE ".$GLOBALS['where']." ORDER BY $order DESC LIMIT $limit");

contenu_a();

?>
<table width="<?php e(contentwidth); ?>"><tr>

<?php

$i=$GLOBALS['ss']['ord'];
$onrow=3;
$ii=$onrow;
foreach($array as $row){$i++;$ii--;
 list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$fc,$res,$profile,$own,$in,$x,$y,$ww)=$row;
 $profile=new profile($profile);
 $description=trim($profile->val('description'));
 
 e('<td width="'.intval($contentwidth/$onrow).'">');
 $js="w_close('content');build('".$GLOBALS['ss']['master']."$master','$id','".$GLOBALS['get']['func']."');";
 ahref('<img src="'.modelx($res).'" width="'.(70*0.75).'">',js2($js),'none',true);
 e('</td>');
 e('<td>');
 ahref($name,'e=content;ee=profile;id='.$id,'none',true);
 br();
 showhold($fc,true);
 if($description){
 br();
 e($description); 
 }
 e('</td>');
 if($ii==0){e('</tr><tr>');$ii=$onrow;}
 
 
}
while($ii>0){$ii--;
 e('<td>&nbsp;</td>');
 e('<td>&nbsp;</td>');
}
?>

</tr></table>
<?php
contenu_b();
?>
<?php
}elseif($file=='page/surkey.php'){
define('a37a40038e57a1a928bf4e65a6f8f997',true);

?>
<div style="background: rgba(30,30,30,0.9);width:1000px;" >
<?php
 $GLOBALS['ss']['use_object']->hold->showimg(true);
?>
</div>
<?php
 

}elseif($file=='page/tabs.php'){
define('05713e05574e13adbec91b79ec9fb90e',true);


$tabs=$GLOBALS['ss']["use_object"]->set->ifnot('tabs','');
$tabs="($tabs)";
$tabs=str_replace(array('(,',',)','(',')',',,'),'',$tabs);
$tabs=explode(',',$tabs);


$newtab=$GLOBALS['get']['tab'];
if($newtab){
 $wtf=$GLOBALS['get']['wtf'];
 if($wtf){
 $q=true;
 foreach($tabs as $tab){if($tab==$newtab){$q=false;}}
 if($q)$tabs[count($tabs)]=$newtab;
 }else{
 $tabs2=array();
 foreach($tabs as $tab){if($tab!=$newtab){$tabs2[count($tabs2)]=$tab;}}
 $tabs=$tabs2;
 }
}


if($GLOBALS['config']['register_building']){
if($hl=sql_1data('SELECT id FROM [mpx]objects WHERE ww='.$GLOBALS['ss']['ww'].' AND own='.useid.' AND type=\'building\' and TRIM(name)=\''.id2name($GLOBALS['config']['register_building']).'\' LIMIT 1')){
 $GLOBALS['hl']=$hl;
}else{
 $GLOBALS['hl']=0; 
}
}else{
 $GLOBALS['hl']=0; 
}
if($GLOBALS['hl']){
 $q=false;
 foreach($tabs as $tab){if($tab==$hl){$q=true;}}
 if($q==false){$tabs[count($tabs)]=$hl;
 $newtab=$hl;}
}
$q=false;$stream='';
$stream.=('<table style="background: rgba(30,30,30,0.9);border: 2px solid #222222;border-radius: 7px;" cellpadding="0" cellspacing="0" width="1000"><tr><td>');
$tabs2=array();
foreach($tabs as $tab){
 if($name=id2name($tab)){
 $tabs2[count($tabs2)]=$tab;
 if($q)$stream.=(nbsp2.'|'.nbsp2);
 $stream.=labelr(ahrefr(short($name,20),"e=miniprofile;contextid=$tab","none","x"),$name." ($tab)"); 
 $q=true;
 }
}
$tabs=$tabs2;
$stream.=('</td></tr></table>');
if($q)e($stream);
if($newtab){
 $tabs=implode(',',$tabs);
 $GLOBALS['ss']["use_object"]->set->add("tabs",$tabs);
 subref('miniprofile');
}
 
}elseif($file=='page/topcontrol.php'){
define('b9973b24052339fd4dc3378e89350523',true);


e('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="23" bgcolor="#173440" class="dragbar" valign="center">');

$url=js2('
var offset = $(\'#window_sub_topcontrol\').offset();
tmp=parseFloat($(\'#window_topcontrol\').css(\'top\'));
if($(\'#minimap\').css(\'display\')==\'block\')x{
 if(offset.top>$(window).height()/2)$(\'#window_topcontrol\').css(\'top\',tmp-(-100));
 $(\'#minimap\').css(\'display\',\'none\');
}xelsex{
 if(offset.top>$(window).height()/2)$(\'#window_topcontrol\').css(\'top\',tmp-100);
 /*$(\'#minimap\').css(\'display\',\'block\');*/
 }x1');
$url2='e=content;ee=help;page=copy';

 moveby(ahrefr(imgr('logo/50.png','',27),$url2),0,-5);
 moveby(tfontr(ahrefr('<b>Towns</b>',$url2).'&nbsp;&gt;&nbsp;'.ahrefr('Hlavní&nbsp;ostrov',$url).'',14),27,0);
 
e(nbsp.'</td><td>');





e('</td></tr></table>');




if(!defined("func_map"))require2(root.core."/func_map.php");

 ?>
<!--
<span id="minimap_select" style="position:absolute;"><div style="position:relative;left:-109;top:0;width:25px;height:18px;background-color:#993333;border: 1px solid #ff0000;"></div></span>

<script type="text/javascript" >
 $('#minimap_select').draggable();
</script>
--><?php
}elseif($file=='page/topinfo.php'){
define('0400d5e8a1d246712167bb0d5216bbb6',true);

if($GLOBALS['topinfo']){
 if($GLOBALS['topinfo_url']){$url=$GLOBALS['topinfo_url'];}else{$url='';}
 if($GLOBALS['topinfo_color']){$color=$GLOBALS['topinfo_color'];}else{$color='292929';}
 if($GLOBALS['topinfo_textcolor']){$textcolor=$GLOBALS['topinfo_textcolor'];}else{$textcolor='ffcccc';}


 
e('<table style="background: rgba(30,30,30,0.9);border: 2px solid #222222;border-radius: 7px;" cellpadding="0" cellspacing="0" width="1000" height="20"><tr><td>');

ahref($GLOBALS['topinfo'],$url,'none;color: #'.$textcolor.';');

e('</td></tr></table>');


}

}elseif($file=='text/func_core.php'){
define('13b4d2caa91b7c706b38505a049975ed',true);


define("a_text_help","action{list,send,delete}[idle][idle,to,title,text][,id]");
function a_text($action,$idle,$to="",$title="",$text=""){
 $add1='(`to`='.logid.' OR `from`='.logid.' OR `to`='.useid.' OR `from`='.useid.') AND `to`!=0';
 $add2="`type`='message'";
 if($action=="list"){
 if($idle and $idle!='new' and $idle!='public' and $idle!='report'){
 $add1='`to`='.logid.' OR `from`='.logid.' OR `to`='.useid.' OR `from`='.useid.' OR `to`=0';
 $add2="`type`='message' OR `type`='report' ";
 $array=sql_array("SELECT `id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop` FROM `".mpx."text` WHERE `idle`='$idle' AND ($add1) AND ($add2) ORDER BY `time` DESC ".($GLOBALS['limit']?'LIMIT '.$GLOBALS['limit']:'')."",1);
 if($array[0][3]==1){
 r('notnew');
 $add1='`to`='.logid.' OR `to`='.useid.'';
 sql_query("UPDATE `".mpx."text` SET `new`='0' WHERE `idle`='$idle' AND ($add1) AND ($add2)");
 }
 $GLOBALS['ss']["query_output"]->add("list",$array);
 }else{
 if($idle=='new'){$add3='`new`=1 AND (`from`!='.useid.' AND `from`!='.logid.')';$add2.=" OR `type`='report'";}else{$add3='1';}
 if($idle=='public'){$add1='`to`=0';}
 if($idle=='report'){$add2="`type`='report'";}
 $array=sql_array("SELECT `id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,MAX(`time`) ,`timestop`, COUNT(`idle`) FROM `".mpx."text` WHERE ($add1) AND ($add2) AND ($add3) GROUP BY `idle` ORDER BY `time` DESC ".($GLOBALS['limit']?'LIMIT '.$GLOBALS['limit']:'')."",1);
 $GLOBALS['ss']["query_output"]->add("list",$array);
 }
 }elseif($action=="send"){
 if(!$idle)$idle=sql_1data("SELECT MAX(idle) FROM `".mpx."text`")-(-1);
 if(trim($title) and trim($text)){
 if($to=='0' OR $to=ifobject($to)){
 if(!sql_1data("SELECT 1 FROM `".mpx."text` WHERE `to`='$to' AND `title`='$title' AND `text`='$text'")){
 $no=0;
 if($GLOBALS['ss']['message_limit'][$to]){if($GLOBALS['ss']['message_limit'][$to]+5>time()){$no=1;}}
 $GLOBALS['ss']['message_limit'][$to]=time();
 if(!$no){
 
 $to_=topobject($to);
 
 sql_query("INSERT INTO `".mpx."text`(`id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop`) VALUES(NULL,'$idle','message',1,'".logid."','".$to_."','$title','$text','".(time())."','')");
 if($to_==$to){
 $GLOBALS['ss']["query_output"]->add("success",'{send_success}');
 }else{
 $GLOBALS['ss']["query_output"]->add("success",'{send_success_to;'.id2name($to_).'}'); 
 }
 $GLOBALS['ss']["query_output"]->add('1',1);
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{message_limit}');
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{same_message}');
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{unknown_logr}');
 }
 }else{
 $GLOBALS['ss']["query_output"]->add("error",'{no_message}');
 }
 
 }elseif($action=="delete"){ 
 sql_query("DELETE FROM `".mpx."text` WHERE `id`= '$idle' AND `from`='".logid."'");
 }
}
function send_report($from,$to,$title="",$text=""){
 $idle=sql_1data("SELECT MAX(idle) FROM `".mpx."text`")-(-1);
 $from=topobject($from);
 $to=topobject($to);
 sql_query("INSERT INTO `".mpx."text`(`id` ,`idle` ,`type` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop`) VALUES(NULL,'$idle','report','$from','$to','$title','$text','".(time())."','')");
}
define("a_chat","text");
function a_chat($text){
 if(trim($text)){
 if($text!="."){
 sql_query("INSERT INTO `".mpx."text` (`id`, `from`, `to`, `text`, `time`, `timestop`) VALUES (NULL, '".logid."', '', '$text', '".time()."', '')");
 }else{
 sql_query("UPDATE `".mpx."text` SET timestop='".time()."' WHERE `from`='".logid."' ORDER BY time DESC LIMIT 1");
 }
 }
}
?>
<?php
}elseif($file=='text/messages.php'){
define('ab92e5e15df52ec702c6d08ea9326c4b',true);

window("{title_messages}");
sg("textclass");

if(!$textclass)$q=submenu(array("content","text-messages"),array("messages_public","messages_unread","messages_all","messages_report","messages_new"),1);
$q=$GLOBALS['ss']['submenu'];
r('textclass: '.$textclass);


if($q==1 || $q==2 || $q==3 || $q==4){

if(!$textclass){
 if($q==1){$tmp='public';}elseif($q==2){$tmp='new';}elseif($q==4){$tmp='report';}else{$tmp=$textclass;}
}else{
 $tmp=$textclass;
}

$response=xquery("text","list",$tmp);$texts=$response["list"];
if($textclass){
 $col="222222";
 infob(ahrefr("{message_back}","e=content;ee=text-messages;textclass=0").(nbspo.nbspo).bhpr("{message_reply}"));
 
contenu_a(); 
 
 hydepark();
 $url=("q=text send,$textclass,".($texts[0][5]?$texts[0][4]:0).",[message_title],[message_text]"); form_a(urlr($url),'messages_tc');
 $style='border: 2px solid #222222; background-color: #CCCCCC';
 tableab("{message_subject}:",input_textr("message_title",'',100,26,$style),"100%","30%");
 br();
 input_textarea("message_text",'',45,6,$style);
 br();
 form_sb();
 ihydepark();
 form_js('content','?e=text-messages&'.$url,array('message_title','message_text'));
 
 echo("<table width=\"".(contentwidth)."\" bgcolor=\"$col\" cellspacing=\"0\">");

 

 foreach($texts as $tmp){
 list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop,$count)=$tmp;
 {
 echo("<tr bgcolor=\"#$col\">");
 echo("<td width=\"120\">");
 $authorid=$from;
 $fromto=ifobject($to)?(short(id2name($from),8).nbsp.'&gt;&gt;'.nbsp.short(id2name($to),8)):short(id2name($from),8);
 
 
 echo("<b>".tr($title)."</b>");
 echo("</td><td width=\"60\">");
 ahref($fromto,"e=content;ee=profile;page=profile;id=".$id,"",true);
 echo("</td><td width=\"\" align=\"right\">");
 timee($time);
 echo("</td><td width=\"22\">");
 if((logid==$authorid or useid==$authorid) and $textclass){iconp("{delete_message_prompt}","e=content;ee=text-messages;q=text delete ".$id,"delete","Smazat");}
 echo("</td><td width=\"22\">");
 echo("</td></tr><tr bgcolor=\"#000000\"><td align=\"left\" colspan=\"6\">");
 te($text);
 echo("<br><br></td></tr>");
 }
 }
 echo("</table>");
}else{
contenu_a(); 
 
 e("<table width=\"".(contentwidth-6)."\" cellspacing=\"0\">");
 
 $i=1;foreach($texts as $tmp){$i++;
 list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop,$count)=$tmp;
 $fromto=ifobject($to)?(short(id2name($from),8).nbsp.'&gt;&gt;'.nbsp.short(id2name($to),8)):short(id2name($from),8);
 
 e("<tr bgcolor=\"#".($i%2==1?'222222':'333333')."\"><td width=\"41%\">");
 $title=short(tr($title),30);
 if($new and $q!=1 and $to==useid)$title=tcolorr(textbr($title),'ff7777');
 ahref($title,"e=content;ee=text-messages;textclass=".$idle,'',true);
 if($count!=1)e('('.$count.')');
 e("</td><td width=\"20%\">");
 ahref($fromto,"e=content;ee=profile;page=profile;id=".$from,'',true);
 e("</td><td width=\"30%\" align=\"right\">");
 timee($time);
 e("</td></tr>");
 }
 echo("</table>"); 
}
}elseif($q==5){
 
 contenu_a();

 $url=("q=text send,".($textclass?$textclass:'0').",[message_to],[message_title],[message_text]");
 form_a(urlr($url),'messages');
 $style='border: 2px solid #333333; background-color: #CCCCCC';
 tableab("{message_to}:",input_textr("message_to",'',100,26,$style),"100%","30%");
 br();
 tableab("{message_subject}:",input_textr("message_title",'',100,26,$style),"100%","30%");
 br();
 input_textarea("message_text",'',52,6,$style);
 br();
 form_sb();
 form_js('content','?e=text-messages&'.$url,array('message_to','message_title','message_text'));

 ?>
 <div style="background:#333333;" >{message_to_info}</div>
 <?php


}
contenu_b();
?>
<?php
}else{}
}
function require2_once($file){
if(!defined(md5(parsef($file)))){
require2($file);
}}
require2('index.php');
?>