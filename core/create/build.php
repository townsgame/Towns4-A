<?php
require_once(root.core."/func_map.php");
$id=$_GET["id"];
if(!$id and $GLOBALS['ss']["object_build_id"])$id=$GLOBALS['ss']["object_build_id"];
$GLOBALS['ss']["object_build_id"]=$id;

$func=$_GET["func"];
if(!$func and $GLOBALS['ss']["object_build_func"])$func=$GLOBALS['ss']["object_build_func"];
$GLOBALS['ss']["object_build_func"]=$func;

if(!$GLOBALS['ss']["master"] and $_GET["master"])$GLOBALS['ss']["master"]=$_GET["master"];

if($id and $GLOBALS['ss']['master']){//e(1);
    $object_build=new object($id);
    $res=$object_build->res;
    //model($res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore=0)
    //r($res);
    $js="\$.get('?e=map&q=".$GLOBALS['ss']['master'].".".$GLOBALS['ss']["object_build_func"]." $id,'+build_x+','+build_y+','+_rot, function(vystup){\$('#map').html(vystup);})";

    if(substr($res,0,1)!='{' and (substr($res,0,1)!='(' or strpos($res,'1.png'))){$q=true;}else{$q=false;}
    if(strpos($res,'1.png')){$qq=true;}else{$qq=false;}
    $angle=(!$qq)?360:7*15;
?>

<?php /*<div style="position:absolute;"><div style="position:relative;left:-25;top:120;">
<?php icon("e=object_build;rot=".($rot-5).";noi=1","none","{rotate}",25); ?>
</div></div>
<!--==========-->
<div style="position:absolute;"><div style="position:relative;left:80;top:120;">
<?php icon("e=object_build;rot=".($rot+5).";noi=1","none","{rotate}",25); ?>
</div></div>*/ ?>
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
//$img=model($res.':'.$rotx,0.75);
//$modelurl=(rebase(url.base.$GLOBALS['model_file']));
    $modelurl=modelx($res.':'.$rotx);
    list($width, $height) = getimagesize($modelurl);

if($rot==0 and (-$height+157)){e('<img src="'.imageurl('design/blank.png').'" border="0"  width="82" height="'.(-$height+157).'"><br/>');}
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
            _rot=_rot-15;if(_rot<0)x{_rot=_rot+<?php e($angle); ?>;}xbuild_model_rot(_rot);    
        }xelsex{
            _rot=_rot+15;if(_rot>=<?php e($angle); ?>)x{_rot=_rot-<?php e($angle); ?>;}xbuild_model_rot(_rot);    
        }x
    
    
    }x);
    <?php }else{ ?>
    build_model_rot=function(rot)x{}x
    $(document).bind('mousewheel', function(event, delta)x{}x);
    <?php } ?>
</script>
<?php } ?>
