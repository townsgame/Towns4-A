<?php
require_once(root.core."/func_map.php");

    $GLOBALS['units_stream']='';
    $areastream='';

    $xcu=0;
    $ycu=0;
    if($GLOBALS['ss']["map_xc"])$xcu=$GLOBALS['ss']["map_xc"];
    if($GLOBALS['ss']["map_yc"])$ycu=$GLOBALS['ss']["map_yc"];
    
    
    $xu=($ycu+$xcu)*5+1;
    $yu=($ycu-$xcu)*5+1;
    
    //echo(tab(150).$xxu);
$rxp=424*2.5;//+$xxu;
$ryp=0;//+$yyu;
//$p=(200*0.75*((212)/375));
$px=424/10;$py=$px/2;
$say="(SELECT IF((`".mpx."text`.`timestop`=0 OR ".time()."<=`".mpx."text`.`timestop`),`".mpx."text`.`text`,'')  FROM `".mpx."text` WHERE `".mpx."text`.`from`=`".mpx."objects`.id AND `".mpx."text`.`type`='chat' ORDER BY `".mpx."text`.time DESC LIMIT 1)";
//$say="'ahoj'";
foreach(sql_array("SELECT `x`,`y`,`type`,`res`,`set`,`name`,`id`,`own`,$say,expand FROM `".mpx."objects` WHERE ww=".$GLOBALS['ss']["ww"]." AND `type`='building'"/**/) as $row){//WHERE res=''//modelnamape//    
    $type=$row[2];    
    $res=$row[3];
    $set=$row[4];
    //$func=$row[5];
    //$func=func2list($func);
    $name=trim($row[5]);
    $id=$row[6];
    $own=$row[7];
    $text=xx2x($row[8]);
    $expand=floatval($row[9]);
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
    if($rx>156 and $ry>0 and $rx<424*2.33-10 and $ry<212*3-20/* and $id!=useid*/){ }{
        //GRM313
        if(/*($res or debug) and ($set=='x' or $set=='0=x') or $set=='x=x'*/true){
        
        /*if($own==useid){
            //echo('aaa');
            $area=$func['expand']['params']['distance'][0]*$func['expand']['params']['distance'][1];
            if($area){
                //echo($area);
            }       
        }*/

       //-------------------------------

        if($expand and $own==useid){
        $file=tmpfile2('expand'.$expand,'png',"image");
        //e($file);
        if(!file_exists($file)  or notmpimg or true){
                $s=82*$expand;
                $brd=3;
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
        <div style="position:relative; top:'.($ry-($s/4)).'; left:'.($rx-($s/2)).';" >
        <img src="'.$src.'"  class="clickmap" border="0" />
        </div></div>';
        }        
        //-------------------------------
        
        
        $modelurl=modelx($res);
        list($width, $height) = getimagesize($modelurl);
        
        // width="83"
        ?>
        <?php
        ob_start();        
        /**/ ?>
        <div style="position:absolute;z-index:<?php  echo($ry+1000); ?>;" <?php  if($id==useid)e('id="jouu"'); ?>>
        <div id="object<?php  echo($id); ?>" style="position:relative; top:<?php  echo($ry-132-$height+157); ?>; left:<?php  echo($rx-43); ?>;">

        <?php if($res){ ?>       
        <img src="<?php e($modelurl); ?>" class="clickmap" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>">
        <?php }else{echo('!res');} ?>           
        </div>
        </div>

        <div style="position:absolute;z-index:<?php  echo($ry+2000); ?>;" >
        <div title="<?php e($name); ?>" style="position:relative; top:<?php  echo($ry-132-40+157); ?>; left:<?php  echo($rx-43+7); ?>;">
        <img src="<?php imageurle('design/blank.png'); ?>" class="unit" id="<?php  echo($id); ?>" border="0" alt="<?php e($name); ?>" title="<?php e($name); ?>" width="70" height="35">
        </div>    
        </div>

        <?php
        $GLOBALS['units_stream'].=ob_get_contents();
        ob_end_clean();
        /**/ ?>

        <?php } ?>
        
        
        <?php }} ?>
        
        
<div id="expandarea" style="display:none;">  
<?php echo( $areastream); ?>
</div>
<!--usemap="#clickmap"<map name="clickmap" id="clickmap">
<area shape="poly" coords="0,137,41,116,83,137,41,157" href="#" class="unit" />
</map>-->
    