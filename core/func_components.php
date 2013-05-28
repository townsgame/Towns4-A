<?php

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
//======================================================================================
function window($title=0,$width=0,$height=0,$window='content'){
        if($title){
                ?>
                <script>
            /*aaa*/
            $("#window_title_<?php echo($window); ?>").html('<?php echo(trim($title)); ?>');

                </script>
                <?php
        }
        if($width){
                /*
        <script>
            $("#scrollbar1").css('width','<?php echo($width); ?>');
                </script>
                */
                ?>
                <div style="width:<?php echo($width); ?>;"></div>
                  <?php                
        }

    /*if($enableSelection){
                ?>
        <script type="text/javascript"><!--
            $(document).ready(function()x{
                $("#copy").enableSelection();
            }x);
        --></script>
                <?php
        }*/
}

function w_close($w_name){
    r('w_close');
        echo("<script type=\"text/javascript\">
        \$(document).ready(function()x{
        setTimeout(function()x{w_close('window_$w_name');}x,100);
        }x);
        </script>");
}

//----------------
define('contentwidth',449);

function contenu_a($scroll=true,$top17=true){?>
<?php
if(!$top17){
    infob(nbsp);
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


//======================================================================================
function ir($i,$q=2){
    return(round($i,$q));
}
function ie($i,$q=2){echo(ir($i,$q));}/**/
//--------------------------------------------
/*if(!$GLOBALS['ss']["lang"]){$GLOBALS['ss']["lang"]="cz";}
if($GLOBALS['get']["lang"]){$GLOBALS['ss']["lang"]=$GLOBALS['get']["lang"];}
$file=("lang/".$GLOBALS['ss']["lang"].".txt");
$stream=file_get_contents($file);
$GLOBALS['ss']["langdata"]=(astream($stream));
function lr($i,$q=""){
    if($q){$i=$i."_".$q;}
    if($GLOBALS['ss']["langdata"][$i]){
        return(tr($GLOBALS['ss']["langdata"][$i]));
    }else{
        return(tr($i));
    }
}*/
function lr($i,$params){
    return("{".$i.";$params}");
}
function le($i,$params){
    echo("{".$i.";$params}");
}
//le("hovno");
//======================================================================================
function tr($i,$nonl2br=false){
    $i=xx2x($i);
    $i=htmlspecialchars($i);
    if(!$nonl2br){$i=nl2br($i);
    $i=str_replace(' ',nbsp,$i);
    $i=smiles($i);}
    //$i=str_replace("<br />","<br>",$i);
    //$i=str_replace(" ","&nbsp;",$i);
    return($i);
}
function te($i,$nonl2br=false){
    echo(tr($i,$nonl2br));
}
//--------------------------------------------
function tfontr($text,$size=14,$color=""){
    if($color){
        //r($color);
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
//--------------------------------------------
function textabr_($array,$width=300,$width2=200){
    $al=" align=\"left\"  valign=\"top\"";
    $stream='<table width=\"$width\" $al>';
    foreach($array as $tmp){list($a,$b)=$tmp;
        if($b!=''){
            $stream.=("<tr><td width=\"$width2\" $al><b>".tr($a)."</b></td><td $al>".tr($b)."</td></tr>");
        }else{
            $stream.=("<tr><td width=\"$width2\" $al clospan=\"2\"><b>".tr($a)."</b></tr>");
        }
    }
        
    $stream.='</table>';
    return($stream);
}
function textab_($array,$width=300,$width2=200){echo( textabr_($array,$width,$width2));}
//--------------------------------------------
/*function blockr($w){
    return(imgr("design/none.png",$w,$w));
}*/
function movebyr($text,$x=0,$y=0,$id="",$style=""){
    return("<span id=\"$id\" style=\"position:absolute;$style\"><span style=\"position:relative;left:$x;top:$y;\">".$text."</span></span>");
}
function moveby($text,$x=0,$y=0,$id="",$style=""){
    echo(movebyr($text,$x,$y,$id,$style));
}
function borderr($html,$brd=1,$w=10,$id="",$category=""){
    if($id)$id="border_".$category."_".$id;
    return(movebyr($html,0,0,$id,"position:absolute;width:".($w)."px;height:".($w)."px;border: ".$brd."px solid #cccccc;z_index:1000").imgr("design/iconbg.png","",$w,$w));
}
//<table id=\"\" width=\"$w\" height=\"$w\" style=\"position:absolute;border: ".$brd."px solid #ffffff\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>$html</td></tr></table>
function border($html,$brd=1,$w=10,$id="",$category=""){echo( borderr($html,$brd,$w,$id,$category));}
function borderjs($id,$sendid="",$category="",$brd=1,$q=true){
    //return("border_".$category."='#border_".$category."_".$id."';alert(border_".$category.")");
    $style_a="'".$brd."px solid #cccccc'";
    $style_b="'0px solid #cccccc'";
    return("\$('#border_".$category."_".$id."').css('border',$style_a);$('#border_".$category."_".$id."').css('z-index',z_index);if(typeof border_".$category."!='undefined')if('#border_".$category."_".$id."'!=border_".$category.")$(border_".$category.").css('border',$style_b);border_".$category."='#border_".$category."_".$id."';z_index++;".($q?"$(function()x{\$.get('?e=nonex&set=".$category.",".$sendid."');}x);":''));
}
function borderr2($html,$brd=1){
    return('<span style="border: '.$brd.'px solid #cccccc;z_index:1000">'.$html.'</span>');
}
function border2($html,$brd=1){echo( borderr2($html,$brd));}


function tableabr($a,$b,$width="100%",$width2="50%"){$al=" align=\"left\"  valign=\"top\"";
    return("<table width=\"$width\" $al><tr><td width=\"$width2\" $al>".$a."</td><td $al>".$b."</td></tr></table>");
}
function tableab($a,$b,$width="100%",$width2="50%"){echo( tableabr($a,$b,$width,$width2));}
function tableab_a($al='left',$width="100%",$width2="50%"){
    $al=" align=\"$al\"  valign=\"top\"";
    if($width)$width="width=\"$width\"";
    if($width2)$width2="width=\"$width2\"";
    echo("<table $width $al border=\"0\" cellpadding=\"0\" cellspacing=\"0\" valign=\"middle\"><tr><td $width2 $al>");
}
function tableab_b($al="left",$val="top"){$al=" align=\"$al\"  valign=\"$val\"";echo("</td><td $al>");}
function tableab_c(){echo("</td></tr></table>");}
/*function mover($a,$x,$y){
    return("<div></div>");
}
function move($a,$x,$y){e(mover($a,$x,$y));}*/
//======================================================================================
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
    //echo($url);
    return($url);
}/**/
//--------------------------------------------
function cleartmp($id){
    /*error_reporting(E_ALL );
    $name="id_$id";
    r($name);
    $tmp=url.tmpfile2($name);
    r($tmp);
    //r(imageurl($name));
    //imge($name,"",100,100);
    r(file_exists("http://localhost/4/tmp/32/193/269388.jpg"));
    r(file_exists("tmp/32/193/269388.jpg"));
    r(file_exists("tmp/32/193"));
    r(glob("tmp/32/193/*"));
    r(file_exists($tmp));
    //unlink($tmp);*/
    unlink(tmpfile2("id_$id"));
    unlink(tmpfile2("id_$id"."_icon"));
}
//--------------------------------------------
function imageurl($file,$rot=1){
    $file2=tmpfile2($file.$rot,imgext,"image");
    $file1="data/image/".$file;
    if(!file_exists($file2) or filemtime($file1)>filemtime($file2) or notmpimg){
        if(str_replace("id_","",$file)==$file){
            //r($rot);
            if($rot>1){
                $img=imagecreatefromstring(file_get_contents($file1));
                if($rot==2)$img = imagerotate($img, 90, 0);
                if($rot==3)$img = imagerotate($img, 180, 0);
                if($rot==4)$img = imagerotate($img, 270, 0);
                imagesavealpha($img,true);
                imagepng( $img,$file2);
                chmod($file2,0777);
            }else{
                copy($file1,$file2);
                chmod($file2,0777);
            }
        }else{
            //r($file2);
            $file=str_replace("id_","",$file);
            if(str_replace("_icon","",$file)!=$file){$q=true;}else{$q=false;}
            $file=str_replace("_icon","",$file);
            $contents=root."userdata/image/".$file.".jpg";//sql_1data("SELECT res FROM objects WHERE id='".$file."' OR name='".$file."'");
            //------
            if(/*!$contents*/!file_exists($contents)){
                
                $profile=sql_1data("SELECT profile FROM ".mpx."objects WHERE id='".$file."' OR name='".$file."'");
                $profile=new profile($profile);
                $profile=$profile->vals2list();
                $icon=$profile["image"];
                if($icon and false){//BEZ UžIATELSKýCH PROFILOVEK
                    $contents=root."data/image/".$icon.".jpg";//sql_1data("SELECT res FROM objects WHERE id='".$icon."' OR name='".$icon."'");
                }else{
                //'hybrid','nature','message','hero','unit','building','item','terrain','image'
                    $res=sql_1data("SELECT res FROM ".mpx."objects WHERE id='".$file."' OR name='".$file."'");
                    if($res/* and $q==true*/){
                        //r($res);
                        $uz=1;
                        if(!defined("func_map"))require(root.core."/func_map.php");
                        //$GLOBALS['model_bigimg']=true;
                        $img1=model($res,2,20,1.5,0);
                        //$GLOBALS['model_bigimg']=false;
                        imagesavealpha($img1,true);
                        $contents=$GLOBALS['model_file'];
                        $contents=file_get_contents($contents);
                    }else{
                        $type=sql_1data("SELECT type FROM ".mpx."objects WHERE id='".$file."'");
                        $contents=("data/image/types/$type.png");
                        //r("image/types/$type.png");
                    }
                }
            }
            //------
            if(!$uz)$contents=file_get_contents($contents);
            //r();
            if($q){
                if(!$uz)$img1=imagecreatefromstring($contents);
                $img2=imagecreatetruecolor(50,50);
                $fill = imagecolorallocate($img2, 40, 40, 40);
                imagefill($img2,0,0,$fill);
                
                if(!$uz){
                    imagecopyresampled($img2,$img1,1,1,1,1,50,50,imagesx($img1),imagesy($img1));
                }else{
                    //$bound=80;
                    imagecopyresampled($img2,$img1,1,1,1,imagesy($img1)-imagesx($img1),50,50,imagesx($img1),imagesx($img1));
                }
                imagejpeg( $img2,$file2);
                chmod($file2,0777);
                //$contents="";
            }else{
            //header("Content-Type: image/png");
            //die($contents);
                file_put_contents2($file2,$contents);
            }
        }
        }
        $stream=rebase(url.base.$file2);//=$GLOBALS['ss']["url"].$file2;
        return($stream);
    
}
//--------------------------------------------
function imageurle($file){echo(imageurl($file));}
//--------------------------------------------
function imgr($file,$alt="",$width="",$height="",$rot=1,$border=0){
    $alt=tr($alt,true);
    if($width){$width="width=\"$width\"";}
    if($height){$height="height=\"$height\"";}
    $stream=imageurl($file,$rot);
    if($border)
        $border='style="border: '.$border.'px solid #cccccc"';
    else
        $border='border="0"';
    $stream="<img src=\"$stream\" $border alt=\"$alt\" $width $height />";
    $stream=labelr($stream,$alt);
    return($stream);
}
//--------------------------------------------
function imge($file,$alt="",$width="",$height=""){
    echo(imgr($file,$alt,$width,$height));
}
//imge("id_69");
//--------------------------------------------
function iconr($url,$icon,$name="",$s=22,$rot=1){
    //$s=22;
    $file="icons/".$icon.".png";
    //r($file);
    
    $tmp=urlr($url);
    if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="#";}
    if($url){$url="href=\"".$tmp."\"";}
    if($onclick){$onclick="onclick=\"$onclick\"";}   
    
    $a="<a $url $onclick >";
    $b="</a>";
    return($a.imgr($file,$name,$s,$s,$rot).$b);
}
function icon($url,$icon,$name="",$s=22,$rot=1){echo(iconr($url,$icon,$name,$s,$rot));}
//--------------------------------------------
function iconpr($prompt,$url,$icon,$name="",$s=22){
    //$s=22;
    $file="icons/".$icon.".png";
    //ahrefpr($prompt,$text,$url,$textd="underline",$nol=false,$id="page",$data=false)
    //$a="<a href=\"".urlr($url)."\">";
    //$b="</a>";
    return(ahrefpr($prompt,imgr($file,$name,$s,$s),$url,"none","x"));
}
function iconp($prompt,$url,$icon,$name="",$s=22){echo(iconpr($prompt,$url,$icon,$name,$s));}
//--------------------------------------------
function objecticonr($id,$name="",$type="",$fs=0,$fp=0,$url=false,$x=0,$y=0,$br=0){$px=$x;
    //'hybrid','nature','message','hero','unit','building','item','terrain','image'
    //$name=htmlspecialchars($name);
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
    //$stream.="<table width=\"50\"  border=mprofile\"0\" cellpadding=\"2\" cellspacing=\"0\"><tr><td bgcolor=\"#00ff00\" width=\"50%\"></td><td bgcolor=\"#ff0000\"></td></tr><table/>";
    //$stream.="<table>xxx<table/>";
    //<div style="position: absolute;"><div style="position: relative;top: 60px;left: 0px;width:50px; height:50px; border: 1px solid #FFFFFF; background-color:#222222; z-index:1;">
    $stream.="</div></div>";
    $stream=labelr($stream,$name);
    }else{
        //r("$px,$br($x,$y)");
    $stream="<div style=\"position: absolute;\" ><div style=\"position: relative;top: ".($y*60)."px;left: ".($x*55)."px;width:50px; height:50px; border: 1px solid #333333; background-color:#222222;  z-index:1;\" id=\"$name\"  class=\"itemdrop\">";
    $stream.="</div></div>";
    }
    if($url){
        $stream=ahrefr($stream,"e=content;ee=profile;id=$id","none",'x');
        //$stream="<a href=\"".urlr($url)."\">$stream</a>";
    }
    $stream=nln.nln.$stream.nln.nln;
    return($stream);
}
function objecticone($id,$name="",$type="",$fs=0,$fp=0,$url="",$x=0,$y=0,$br=0){echo(objecticonr($id,$name,$type,$fs,$fp,$url,$x,$y,$br));}
//--------------------------------------------
function functionholder($name,$inner,$x=0,$y=0,$br=0){$px=$x;
    $s=40;
    if($br){
        $y=$y+intval($x/$br);
        $x=mod($x,$br);
    }
    $stream="<div style=\"position: absolute;\" ><div style=\"position: relative;top: ".($y*($s+5))."px;left: ".($x*($s+5))."px;width:".$s."px; height:".$s."px; border: 1px solid #333333; background-color:#222222;  z-index:1;\" id=\"$name\"  class=\"functionholder\">";
    $stream.=$inner."</div></div>";
    echo($stream);
}
//--------------------------------------------
function iprofile($id,$width=50){//r($id);
    ahref(imgr("id_$id"."_icon","",$width,$width),"e=content;ee=profile;id=$id","none",'x');
}
function vprofile($id,$values=array()){//r($id);
    tableab_a(200,50);
    iprofile($id);
    tableab_b();
    echo("<span height=\"60\">");//style=\"background:#333333\"
    foreach($values as $a=>$b)
        if($b){textab($a,$b,150,80/*,200,65*/);br();}
    //br(count($values));
    echo("</span>");
    tableab_c();
}
//--------------------------------------------
function mprofile($id){//r($id);
    list($name,$type,$fs,$fp,$x,$y)=id2info($id,"name,type,fs,fp,x,y");
    //$hint=$name.' '.'['.$x.','.$y.']';
    objecticone($id,$name,$type,$fs,$fp,"a",0,0);
}
//--------------------------------------------
function tprofile($id){
    $name=id2name($id);
    ahref($name,"page=profile;id=".$id,"none",true);
}
//=====================================================================================
function form_a($url="",$id=''){
    echo("<form method=\"POST\" action=\"$url\" ".($id?'id="form_'.$id.'" name="form_'.$id.'" onsubmit="return false"':'').">");
    $GLOBALS['formid']='form_'.$id;
}
//----------
function form_b(){
    echo("</form>");
}
//----------
function form_send($text="{ok}"){
    echo("<input type=\"submit\" value=\"$text\" />");
}
//----------
function form_sb($text="{ok}"){form_send($text);form_b();}
//----------
function form_js($sub,$url,$rows){
//$url=urlr($url);
//$url=str_replace('&amp;','&',$url);
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
        function(vystup)x{/*alert(2);*/$('#<?php e($sub); ?>').html(vystup);}x
    );
    return(false);
}x);
</script>
<?php
}
//--------------------------------------------
function input_textr($name,$value=false,$max=100,$cols="",$style=''){
    //echo(xsuccess());
    if(!$value and !xsuccess())$value=$_POST[$name];
    $value=tr($value,true);
    $stream="<input type=\"input\" name=\"$name\" id=\"$name\" value=\"$value\" size=\"$cols\"  maxlength=\"$max\" style=\"$style\"/>";
    return($stream);
}
function input_text($name,$value=1,$max=100,$cols="",$style=''){echo(input_textr($name,$value,$max,$cols));}
//--------------------------------------------
function input_passr($name,$value=''){
    $stream="<input type=\"password\" name=\"$name\" id=\"$name\" value=\"$value\" />";
    return($stream);
}
function input_pass($name,$value=''){echo(input_passr($name,$value));}
//--------------------------------------------
function input_textarear($name,$value='',$cols="",$rows="",$style=''){
    if(!$value and !xsuccess())$value=$_POST[$name];
    $value=tr($value,true);
    if($cols){$cols="cols=\"$cols\"";}
    if($rows){$rows="rows=\"$rows\"";}
    $stream="<textarea name=\"$name\" id=\"$name\"  $cols $rows style=\"$style\">$value</textarea>";
    return($stream);
}
function input_textarea($name,$value='',$cols="",$rows="",$style=''){echo(input_textarear($name,$value,$cols,$rows,$style));}
//--------------------------------------------
function input_checkboxr($name,$value){
    if($value){$ch="checked=\"checked\"";}else{$ch="";}
    $stream="<input type=\"checkbox\" name=\"$name\" $ch />";
    return($stream);
}
function input_checkbox($name,$value){echo(input_checkboxr($name,$value));}
//--------------------------------------------
function input_selectr($name,$value,$values){
    $stream="<select name=\"$name\">";
    //print_r($values);
    foreach($values as $a=>$b){
        //echo($a);
        if($a==$value){$ch="selected=\"selected\"";}else{$ch="";}
        $stream.="<option value=\"$a\" $ch >$b</option>";
    }
    $stream.="</select>";
    return($stream);
}
function input_select($name,$value,$values){echo(input_selectr($name,$value,$values));}
//----------------------------------------------------------------------------------------
function s_input($name,$value){
    $input="s_input_".$name;
    if($_POST[$input])$GLOBALS['ss'][$name]=$_POST[$input];
    if($GLOBALS['ss'][$name])$value=$GLOBALS['ss'][$name];
    form_a('?');
    input_text($input,$value);
    form_sb();
    return($GLOBALS['ss'][$name]);
}
//----------------------------------------------------------------------------------------
function limit($page,$w,$step,$to,$d=0){$to=$to-$step;//d-deafult
    if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
    $w=md5("limit_".$e."_".$w);
    if(get('limit'))$GLOBALS['ss'][$w]=get($w);
    if(!$GLOBALS['ss'][$w])$GLOBALS['ss'][$w]=$d;
    $d=$GLOBALS['ss'][$w];
    
    //echo("$step,$to");
    if($to+$step>$step){
    $a=$d-$step;if($a<0){$a=0;}
    $b=$d+$step;if($b>$to){$b=$to;}
    //-----
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
//======================================================================================
function bhp($text){
    echo("<a onclick=\"$('#hydepark').css('display','block');\">$text</a>");
}
function hydepark(){
    echo("<div style=\"display: none\" id=\"hydepark\">");
}
function ihydepark(){
    echo("</div>");
}
//======================================================================================
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
            $key=labelr($key,$help);//."<br>".$help;
        }
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
//===============================================================================================================
function alert($text,$type,$tr=true,$nbsp=true){
    //message,error
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
//======================================================================================
//report
function xr($text="",$tr=true){
$q=3;
//alert(gettype($text),$q,$tr);
switch (gettype($text)) {
    case "NULL":
            alert("NULL",$q,$tr);
        break;
    case "string":
            //string, float, int
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
            //image
            imagesavealpha($text,true);
            //define("nob",true);
            //header ("Content-type: image/png");
            ob_start();    
            imagepng($text);            
            $datastream=ob_get_contents();
            ob_end_clean();
            $datastream='data:image/png;base64,'.base64_encode($datastream);
            
            echo('<img src="'.$datastream.'"/>');
            //exit;
        break;
    case "boolean":
            //bool
            if($text){
                alert("true",$q,$tr);
            }else{
                alert("false",$q,$tr);
            }
        break;
    case "array":
                        //array
                        if($text!=array()){
                            //print_r($text);
                            /*foreach($text as $a=>$b){
                                 if(is_array($b)){$b=join(",",$b);}
                                alert("$a => $b",$q);
                            }*/
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
                                        //echo($sp.$value.br);
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
                                //print_r($sub);
                                //echo(br);
                
                            }
                        }else{
                            alert("empty array",$q,$tr);
                        }
        break;
    default:
        alert("neznámý typ",$q,$tr);
}
}
//-----------------------------------------
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
//-----------------------------------------
function rx($text=""){
    r($text);
    exit;
}
//-----------------------------------------
function rn($text=""){
    xr($text,false);
}
//-----------------------------------------
//$array=(array(abc=>0,"hovno",array(array(array(1,2,3,4,5)),8),array(array(2,4)),array(7,abc=>"aaa")));
//r($array);
//echo($array[0][0][0][0]);
//echo($array[array(0,0,0,0)]);
//exit;
//===============================================================================================================
function textcolorr($text,$color){
    if($color=="M"){$color="ff7766";}//ff7766
    if($color=="T"){$color="7799ff";}//7799ff
    if($color=="N"){$color="99CC66";}//99CC66
    if($color=="X"){$color="cccccc";}//cccccc
    if($color){
        return("<span style=\"color: #$color;\">$text</span>");
    }else{
        return($text);
    }
}
//===============================================================================================================
function textqqr($text){
    return(nbsp2.textcolorr("(".$text.")","999999"));
}
//===============================================================================================================
function textbr($text){
    return("<b>$text</b>");
}
function textb($text){
    echo(textbr($text));
}
//======================================================================================
function lvlr($a,$b,$a2=false,$b2=false){
    //r("$a,$b,$a2,$b2");
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
//======================================================================================
function jsr($js){
    $js='<script type="text/javascript">'.$js.'</script>';
    return($js);
}
function js($js){
    echo(jsr($js));
}
//======================================================================================
//ODKAZY
//===============================================================
function ahrefr($text,$url,$textd="none",$nol=true,$id=false,$data=false,$onclick=""){
    if(!$data){$data=$GLOBALS['ss'];}
    if($nol!="x"){ if(!$nol){$text=lr($text);}else{$text=tr($text);}}
    //if(str_replace($data[$id],"",$url)==$url){r();}
    if($id?(str_replace($id."=".$data[$id],"",$url)==$url):true or !$textd){
        if(!$textd){$textd="none";}
        $add1="<span style=\"text-decoration:$textd;\">";
        $add2="</span>";
    }else{
        $add1="<span style=\"color: #FF7733;text-decoration:$textd;\">";
        $add2="</span>";
    }
    //if($textd=="none"){$add1="";$add2="";}
    $tmp=urlr($url);
    if(strpos("x".$tmp,"javascript: ")){$onclick=str_replace("javascript: ","",$tmp);$tmp="#";}
    if($url){$url="href=\"".$tmp."\"";}
    if($onclick){$onclick="onclick=\"$onclick\"";}
    return("<a $url $onclick >$add1$text$add2</a>");
}
function ahref($text,$url,$textd="none",$nol=true,$id=false,$data=false,$onclick=""){echo(ahrefr($text,$url,$textd,$nol,$id,$data,$onclick));}
//==========================================================================================
function ahrefpr($prompt,$text,$url,$textd="underline",$nol=false,$id="page",$data=false){
    $onclick="pokracovat = confirm('$prompt');if(pokracovat) window.location.replace('".urlr($url)."');";
    $html=ahrefr($text,"",$textd,$nol,$id,$data,$onclick);
    return($html);
}
function ahrefp($prompt,$text,$url,$textd="underline",$nol=false,$id="page",$data=false){echo(ahrefpr($prompt,$text,$url,$textd,$nol,$id,$data));}
//==========================================================================================
function submenu($page,$array,$deafult=1,$session="submenu",$v=false){
    //r($GLOBALS['ss']["get"]);
    if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
    if(!$GLOBALS['ss'][$session]){$GLOBALS['ss'][$session]=$deafult;}
    //r($GLOBALS['ss']["get"][$session]);
    if($GLOBALS['ss']["get"][$session]){$GLOBALS['ss'][$session]=$GLOBALS['ss']["get"][$session];}
    $col="111111";
    $percent=round(100/count($array));
    if(!$v)echo("<table width=\"100%\" bgcolor=\"$col\"><tr>");
    $i=0;
    //r($array);
    while($array[$i]){
        if(!$v)echo("<td align=\"center\" width=\"$percent%\">");
        ahref($array[$i],"e=$e;ee=$ee;".$session."=".($i+1),"none",false,"submenu");
        if(!$v){echo("</td>");}else{br();}
        $i++;
    }
    if(!$v)echo("</tr></table>");
    return($GLOBALS['ss'][$session]);
}
//======================================================================================
function submenu_img($page,$label,$images,$names,$session="submenu_img"){
    if(is_array($page)){$e=$page[0];$ee=$page[1];}else{$e=$page;$ee=$page;}
    echo("<table>");
    echo("<tr><td align=\"left\"  valign=\"center\" width=\"100\">");
    tfont($label,17);
    //r($GLOBALS['ss']["get"]);
    if(!$GLOBALS['ss'][$session]){$GLOBALS['ss'][$session]=1;}
    if($GLOBALS['ss']["get"][$session]){$GLOBALS['ss'][$session]=$GLOBALS['ss']["get"][$session];}
    $col="111111";
    $percent=100/count($array);
    $i=0;
    //r($names);
    while($images[$i]){
         echo("</td><td valign=\"top\" align=\"center\" width=\"40\">");
        //icon($url,$icon,$name="",$s=22,$rot=1
        $icon=iconr("e=$e;ee=$ee;".$session."=".($i+1),$images[$i],$names[$i],40);
        //e($icon);
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
//======================================================================================
/*function num2text($n){
    $stream="";
    if(!$n){$stream="0";
    }elseif($n>=1 and $n<=20){$stream="$n";
        list($e1,$e2,$e3,$e4)=divarray($t,array(1,10,100,1000));
        list($e1,$e2,$e3,$e4)=array("$e1 e1",$e2,$e3,$e4);
    }
    return($stream);
}
die(num2text(33));*/
//===============================================================================================================
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
//--------------------------------------------
function timee($t){echo(timer($t));}
//--------------------------------------------------------------------------
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
//--------------------------------------------
function timece($t,$sec=true){echo(timecr($t,$sec));}
//======================================================================================
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
//--------------------------------------------
function timese($t,$sec=true){echo(timesr($t,$sec));}
//======================================================================================
function xyr($x,$y,$ww=''){
    if($ww and $ww!=$GLOBALS['ss']['ww']){
        return(tcolorr("[".intval($x).",".intval($y)."]",'777777'));
    }else{
        return("[".intval($x).",".intval($y)."]");
    }
}
function xy($x,$y){echo(xyr($x,$y));}
//======================================================================================
function labelr($html,$label){
//$label=lr($label);
//return("<span label=\"$label\">$html</span>");
//$label="";//htmlspecialchars($label);
$html="<span title=\"$label\">$html</span>";
return($html);
}
function labele($html,$label){echo(labelr($html,$label));}
//======================================================================================
//tables

//======================================================================================
function liner_($id="use",$p=1){
    $response=xquery("info",$id);
    $id=$response["id"];
    //-----------
    if($p>1)$p="".$p;
    $hline=lr($response["type"].$p)." ".tr($response["name"],true);
    if($response["in"]){
        $hline=$hline.'('.$response["inname"].')';
    }
    return($hline);
}
//--------------------------------------------------------
function liner($id="use",$p=1){
    $response=xquery("info",$id);
    $id=$response["id"];
    //-----------
    if($p>1)$p="_".$p;
    $hline=textcolorr(lr($response["type"].$p),$response["dev"])." ".tr($response["name"],true);
    if($response["in"]){
        $hline=$hline.textqqr(ahrefr($response["inname"],"page=profile;id=".$response["in"],"none",true));
    }
    $hline=ahrefr($hline,"e=content;ee=profile;page=profile;ref=left;".show.";id=".$id,"none",true);
    return($hline);
}
function line($id="use",$p=1){echo(liner($id,$p));}
//======================================================================================
function profiler($id="use"){
    $stream="";
    $response=xquery("info",$id);
    //r($response);
    $response["func"]=new func($response["func"]);
    $funcs=$response["func"]->vals2list();
    $response["profile"]=new profile($response["profile"]);
    $array=$response["profile"]->vals2list();
    $response["set"]=new set($response["set"]);
    $array2=$response["set"]->vals2list();
    $id=$response["id"];
    if($array["showmail"]){$array["mail"]=$array2["mail"];}
    $array["showmail"]="";
    //-----------
    $in2=xquery("items");
    $in2=$in2["items"];
    $in2=csv2array($in2);
    //-----------
    $stream.=("<table width=\"".(contentwidth-3)."\"><tr><td valign=\"top\"><table>");
    //-----------
    $hline=tfontr(textcolorr(lr($response["type"]),$response["dev"])." ".tr($response["name"],true),18);
    if($response["in"]){
        $hline=$hline.textqqr(ahrefr($response["inname"],"page=profile;id=".$response["in"],"none",true));
    }
    $stream.=("<tr><td colspan=\"2\"  width=\"300\"><h3>$hline<hr/></h3></td></tr>");
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
    //-----------
    foreach($array as $a=>$b){
        if($a!=''.($a-1+1) and trim($b) and $b!="@" and $a!="text"  and $a!="description"  and $a!="text" and $a!="image"){
            $pa=$a;
            $a=lr($a);
            $b=tr($b);
            //gender,age,mail,showmail,web
            if($pa=="gender"){$b=lr($b);/*if($b=="m"){$b=lr("Muž");}if($b=="f"){$b=lr("Žena");}*/}
            if($pa=="age"){$b=intval((time()-$b)/(3600*24*365.25),0.1);}
            if($pa=="mail"){$b="<a href=\"mailto: $b\">$b</a>";}
            if($pa=="web"){$b="<a href=\"http://$b/\">$b</a>";}
            //if(!($pa=="description")){
            $stream.=("<tr><td ><b>$a: </b></td><td>$b</td></tr>");
            //}else{
            //    $stream.=("<tr><td colspan=\"2\"><code>$b</code></td></tr>");
            //}
        }
    }
    //-----------
    $stream.=("<tr><td colspan=\"2\"><hr/></td></tr>");

     //-------------------------------------------------------------------%func
    $support=array();
    $stream3="";
    $stream3=$stream3.("<table width=\"100%\" cellspacing=\"0\">");
    foreach($in2 as $item){
        list($_id,$_type,$_fp,$_fs,$_dev,$_name,$_password,$_func,$_set,$_res,$_profile,$_hold,$_own,$_in,$_t,$_x,$_y)=$item;
        $_x=intval($_x);$_y=intval($_y);
        $i++;
        if(!$_x)$_x="";
        $stream2="";
        //r("hold$_x");
        //r($funcs["hold$_x"]["params"]);
        foreach($funcs["hold$_x"]["params"] as $param=>$value){
            list($qqe1,$e2)=$value;
            //r($param);
            if($param!="q"){
                //r($param);
                //$stream2=$stream2.($e2*100)."%";
                foreach(func2list($item[7]) as $funci){
                    if($funci["class"]==$param){
                        $stream2=$stream2.nbspo."<b>".tr($funci["profile"]["name"])."</b> (".($e2*100)."%)".br;
                        foreach($funci["params"] as $parami=>$valuei){
                            //r($parami);
                            list($e1i,$e2i)=$valuei;
                            $e1i=$e1i*$e2;
                            $e2i=pow($e2i,$e2);//2^0.2
                            if(!$support[$funci["class"]])$support[$funci["class"]]=array();
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
            //id        type    fp      fs      dev     name    password        func    set     res     profile hold    own     in      t       x       y
            $stream3=$stream3.objecticonr($_id,$_name,$_type,$_fs,$_fp,"page=profile;id=$_id",0,0);
            $stream3=$stream3.$stream2;
            $stream3=$stream3.("</td></tr>");
        }
    }
    $stream3=$stream3.("</table>");
    //r($support);
    //------------------------------------------------------------------------
    //$stream.=("<b>".lr("f_life").": </b>".$response["fp"]."/".$response["fs"]."");
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
                    //$stream.=lr("f_".$name).": </b>$class".br; 
                    foreach($params as $fname=>$param){
                        $e1=$param[0];$e2=$param[1];//$e3=$param[2];$q=$e1*$e2;
                        //$e1=round($e1,2);$e2=round($e2,2);/*$e3=round($e3,2);*/$q=round($q,2);
                        $stream.=("<tr><td>");
                        $stream.=nbsp3.lr("f_".$class."_".$fname).":";
                        $stream.=("</td><td>");
                        //$q.textqqr("$e1,$e2");
                        //r("$class - $fname");
                        $support1=$support[$class][$fname];
                        if($support1){
                            list($se1,$se2)=$support1;
                            /*$se1=$e1+$se1;
                            $se2=$e2*$se2;*/
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
    //if($funcs["message"]){$stream.=("<tr><td colspan=\"2\">Tento uživatel může odesílat zprávy.</td></tr>");}
    //if($funcs["image"]){$stream.=("<tr><td colspan=\"2\">Tento uživatel může nahrávat obrázky.</td></tr>");}
    //$stream.=("<tr><td colspan=\"2\"><hr/></td></tr>");
    $stream.=("</table>");
    //-----------{""
    $stream.=$stream3;
    //------------------------------------------------------------------------
        //r($response);
        if($response['ww']==$GLOBALS['ss']['ww']){
        $stream.=("<hr/>");
        if(useid==$id or logid==$id){
            
            $stream.=ahrefr("Upravit profil","e=content;ee=profile_edit",false);
            $stream.=("<br/>");
            
            if(logid==$id){
                $stream.=ahrefr("Změnit heslo","e=password_edit",false);
                $stream.=("<br/>");
            }
        }else{
             $stream.=ahrefr("attack_".$response["type"],"e=content;ee=attack-attack;page=attack;set=attack_id,$id",false); 
        }}
        //r($response["in"]);
        if($GLOBALS['ss']["useid"]==$response["in"]){
        $stream.=ahrefpr("Opravdu chcete odhodit tento předmět?","odhodit předmět","query=item $id drop",false);
        }
    //-----------
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
?>