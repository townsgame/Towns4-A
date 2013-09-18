<?php
require_once(root.core."/func_map.php");

    $GLOBALS['units_stream']='';
    $areastream='';

    $xcu=0;
    $ycu=0;
    if($GLOBALS['ss']["map_xc"])$xcu=$GLOBALS['ss']["map_xc"];
    if($GLOBALS['ss']["map_yc"])$ycu=$GLOBALS['ss']["map_yc"];
    //echo($xcu.','.$ycu);
    
    $xu=($ycu+$xcu)*5+1;
    $yu=($ycu-$xcu)*5+1;
    
    //echo(tab(150).$xxu);
$rxp=424*2.5;//+$xxu;
$ryp=0;//+$yyu;
//$p=(200*0.75*((212)/375));
$px=424/10;$py=$px/2;
$say="''";//"(SELECT IF((`".mpx."text`.`timestop`=0 OR ".time()."<=`".mpx."text`.`timestop`),`".mpx."text`.`text`,'')  FROM `".mpx."text` WHERE `".mpx."text`.`from`=`".mpx."objects`.id AND `".mpx."text`.`type`='chat' ORDER BY `".mpx."text`.time DESC LIMIT 1)";
//$say="'ahoj'";

/*$arange=-5;
$range=45;
$xpp=5;//5;
$ypp=-5;//-5;
$range="x>$xu-$arange+$xpp AND y>$yu-$arange+$ypp AND x<$xu+$range+$xpp AND y<$yu+$range+$ypp";
$range="(x-y)>($xu-$yu) AND (y-x)>($yu-$xu)-30 AND (x-y)<($xu-$yu)+5 AND (y-x)<($yu-$xu)+20";*/


$range="(x-y)>($xu-$yu)-20 AND (x+y)>($xu+$yu)+5 AND (x-y)<($xu-$yu)+35 AND (x+y)<($xu+$yu)+60";



//$range=1;
//echo($range);
$hlname=id2name($GLOBALS['config']['register_building']);
// OR (`type`='rock' AND RAND()<0.01)
$mapunitstime=intval(file_get_contents(tmpfile2("mapunitstime","txt","text")));

foreach(sql_array("SELECT `x`,`y`,`type`,`res`,`set`,`name`,`id`,`own`,$say,expand,collapse,t FROM `[mpx]objects` WHERE ww=".$GLOBALS['ss']["ww"]." AND ((`own`=".useid." AND `expand`!=0) OR `collapse`!=0 OR `t`>$mapunitstime) AND "/*." AND (`type`='building') AND "*/.$range/*" AND (`name`!='$hlname' OR (SELECT COUNT(1) FROM [mpx]objects AS X WHERE X. `own`= [mpx]objects.`own` AND X. `type`='building')>1 OR `own`='".logid."' OR `own`='".useid."')"/**/) as $row){//WHERE res=''//modelnamape//    
    $type=$row[2];    
    $res=$row[3];
    $set=$row[4];
    //$func=$row[5];
    //$func=func2list($func);
    $name=trim($row[5]);
    //echo($name);br();
    $id=$row[6];
    $own=$row[7];
    //$text=xx2x($row[8]);
    $expand=floatval($row[9]);
    $collapse=floatval($row[10]);
    $time=intval($row[11]);
    
    if(id2name($GLOBALS['config']['register_building'])==$name and logged()){ 
        $say=id2name($own);
        $say=str_replace(' ','&nbsp;',$say);
    }else{
        $say='';
    }
    
    if($id==useid){
        $_xc=$GLOBALS['ss']["use_object"]->x;
        $_yc=$GLOBALS['ss']["use_object"]->y;
        //$text=($_xc.','.$_yc);
        
    }else{
        $_xc=$row[0];
        $_yc=$row[1];
    }
    $xx=$_xc-$xu;
    $yy=$_yc-$yu;
    //if($id!=useid)$xx=$xx+(rand(0,100)/100);
    /*$ix2rx=0.5*$p;$ix2ry=0.25*$p;
    $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
    $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
    $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;*/
    $rx=round(($px*$xx)-($px*$yy)+$rxp);
    $ry=round(($py*$xx)+($py*$yy)+$ryp);
    if($id==useid){
        $built_rx=$rx;
        $built_ry=$ry;
        //r($built_rx);
    }
    //if($rx>156 and $ry>0 and $rx<424*2.33-10 and $ry<212*3-20/* and $id!=useid*/){ }
        //GRM313
        if(/*($res or debug) and ($set=='x' or $set=='0=x') or $set=='x=x'*/true){
        
        /*if($own==useid){
            //echo('aaa');
            $area=$func['expand']['params']['distance'][0]*$func['expand']['params']['distance'][1];
            if($area){
                //echo($area);
            }       
        }*/
        
       $y=gr;
       $brd=3*$y;
       $s=82*$expand*$y;
       //-------------------------------EXPAND
        if($expand and $own==useid){
        $file=tmpfile2('expand'.$expand,'png',"image");
        //e($file);
        
        if(!file_exists($file)  or notmpimg/**/ or true/**/){
                $img=imagecreatetruecolor($s,$s/2);
                imagealphablending($img,false);
                $outer =  imagecolorallocatealpha($img, 0, 0, 0, 127);
                $inner =  imagecolorallocatealpha($img, 0, 0, 0, 100);
                $border = imagecolorallocatealpha($img, 0, 0, 0, 50);
                imagefill($img,0,0,$outer);
                imagefilledellipse($img, $s/2, $s/4, $s,  $s/2   , $border);
                imagefilledellipse($img, $s/2, $s/4, $s-$brd, ($s/2)-$brd, $inner);
                imagesavealpha($img,true);
                imagepng($img,$file);
                chmod($file,0777);
        }
        
        $src=rebase(url.base.$file);        
        $areastream.='<div style="position:absolute;z-index:150;">
        <div style="position:relative; top:'.($ry-($s/$y/4)-htmlbgc).'; left:'.($rx-($s/$y/2)).';" >
        <img src="'.$src.'" widht="'.($s/$y).'" height="'.($s/$y/2).'"  class="clickmap" border="0" />
        </div></div>';
        }   
       //-------------------------------COLLAPSE
        if($collapse){
        $file=tmpfile2('collapse'.$collapse,'png',"image");
        //e($file);
        if(!file_exists($file)  or notmpimg/**/ or true/**/){    
                $img=imagecreatetruecolor($s,$s/2);
                imagealphablending($img,false);
                $outer =  imagecolorallocatealpha($img, 0, 0, 0, 127);
                $inner =  imagecolorallocatealpha($img, 255, 0, 0, 70);
                $border = imagecolorallocatealpha($img, 0, 0, 0, 50);
                imagefill($img,0,0,$outer);
                imagefilledellipse($img, $s/2, $s/4, $s,  $s/2   , $border);
                imagefilledellipse($img, $s/2, $s/4, $s-$brd, ($s/2)-$brd, $inner);
                imagesavealpha($img,true);
                imagepng($img,$file);
                chmod($file,0777);
        }
        
        $src=rebase(url.base.$file);        
        $areastream.='<div style="position:absolute;z-index:150;">
        <div style="position:relative; top:'.($ry-($s/$y/4)-htmlbgc).'; left:'.($rx-($s/$y/2)).';" >
        <img src="'.$src.'" widht="'.($s/$y).'" height="'.($s/$y/2).'"  class="clickmap" border="0" />
        </div></div>';
        }     
        //-------------------------------
        
        $modelurl=modelx($res);
        list($width, $height) = getimagesize($modelurl);
        if(!$GLOBALS['model_resize'])  $GLOBALS['model_resize']=1;      
        $width=$width*$GLOBALS['model_resize'];
        $height=$height*$GLOBALS['model_resize'];
        // width="83"
        
        ?>
        <?php
        ob_start();        
        /**/ ?>
        <div style="position:absolute;z-index:<?php  echo($ry+1000); ?>;" <?php  if($id==useid)e('id="jouu"'); ?>>
        <div id="object<?php  echo($id); ?>" style="position:relative; top:<?php  echo($ry-132-$height+157+4); ?>; left:<?php  echo($rx-43+2); ?>;">

        <?php if($res and (/*$own==useid or */$time>$mapunitstime)){ ?>
        <img src="<?php e($modelurl); ?>" width="82" class="clickmap" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>">
        <?php }else{r('!res');} ?>           
        </div>
        </div>

        
        <div style="position:absolute;z-index:<?php  echo($ry+2000); ?>;" >
        <div title="<?php e($name); ?>" style="position:relative; top:<?php  echo($ry-132-40+157); ?>; left:<?php  echo($rx-43+7); ?>;">
        <img src="<?php imageurle('design/blank.png'); ?>" class="unit" id="<?php  echo($id); ?>" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>" width="70" height="35">
        </div>    
        </div>
        <?php /**/ ?>
        
        <?php
        if($say){
        ?>
        <div style="position:absolute;z-index:<?php  echo($ry+2000); ?>;" >
        <div title="<?php e($name); ?>" style="position:relative; top:<?php  echo($ry-100); ?>; left:<?php  echo($rx-43+7); ?>;background: rgba(0,0,0,0.75); border-radius: 2px; padding: 4px;"><?php e($say); ?></div>    
        </div>
        <?php
        }
        ?>

        <?php
        $GLOBALS['units_stream'].=ob_get_contents();
        ob_end_clean();
        /**/ ?>

        <?php } ?>
        
        
        <?php
        t($name);
        }
        ?>
        
        
<div id="expandarea" style="display:none;">  
<?php echo( $areastream); ?>
</div>
<script>
    /*alert(1);*/
<?php
/*if(logged()){
    $GLOBALS['ss']['units_stream']=$GLOBALS['units_stream'];
}*/
if(!logged()){
    subjs('units_stream',$GLOBALS['units_stream']);
}
?>
//$('#zaloha_u').html('');
//$('#units_stream').css('left',0);
//$('#units_stream').css('top',0);
</script>
<!--usemap="#clickmap"<map name="clickmap" id="clickmap">
<area shape="poly" coords="0,137,41,116,83,137,41,157" href="#" class="unit" />
</map>-->
    
