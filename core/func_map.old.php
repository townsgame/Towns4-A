<?php
ini_set("max_execution_time","1000");
define("func_map",true);
//=============================================================MAPCONFIG
//define("distrel",1);
//define("shr",-35);
//define("shq",1.5);
//define("top",100);
define("height",212*1.3);
define("size",0.75*(height/375));
define("zoom",5);
//define("w",2);
//define("xc",$x);
//define("yc",$y);
define("gird",0);
define("t_brdcc",0.3);//počet kuliček
define("t_brdca",2);//6;//min radius hovna
define("t_brdcb",10);//8;//max radius hovna
define("t_pofb",1);//přesah okrajů
define("t_sofb",size*100);//velikost bloku ze zdroje
//r(map3d(11,11));
//imagesavealpha($text,true);
define("nob",true);
//=============================================================
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
//=============================================================
function mapdata($xc=xc,$yc=yc,$wtf="terrain"){
    //$xc=xc;
    //$yc=yc;
    $w=w;
    $zoom=zoom;
    //die("SELECT x,y,$wtf from `map` WHERE `w`=$w AND `x`>=$xc AND `y`>=$yc AND `x`<$xc+$zoom+2 AND `y`< $yc+$zoom+2 ORDER by `y`,`x`");
    $mapd=sql_array("SELECT x,y,$wtf from `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]./*`w`=$w AND*/" AND `x`>=$xc AND `y`>=$yc AND `x`<$xc+$zoom AND `y`< $yc+$zoom ORDER by `y`,`x`");
    $map=array();
    //r($mapd);exit;
    /*$file=tmpfile2("data,$zoom,$xc,$yc,$w","png");
    //------------------------------
    if(file_exists($file) and !notmp){
        $file=imagecreatefrompng($file);
    }else{*/
    foreach($mapd as $row){list($x,$y,$wtf)=$row;
        $x=$x-$xc;
        $y=$y-$yc;
        if(!$map[$y]){$map[$y]=array();}
        $map[$y][$x]=$wtf;
    }
    return($map);
}
//=============================================================
function map1($param){
    //echo($param);
    $rand=rand(1,5);
    $t_size=size*100;
    $t_sofb=t_sofb;
    $t_pofb=t_pofb;
    $t_brdcc=t_brdcc;//počet kuliček
    $t_brdca=t_brdca;//10;//min radius hovna
    $t_brdcb=t_brdcb;//15;//max radius hovna
    $file=tmpfile2("$rand,$param,$t_size,$t_sofb,$t_pofb,$t_brdcc,$t_brdca,$t_brdcb","png","map");
    //------------------------------
    if(file_exists($file) and !notmp){
        $terrain=imagecreatefrompng($file);
    }else{
//echo(root."data/image/terrain/$param.png");
            $tmp=imagecreatefrompng(root."data/image/terrain/$param.png");
            $tmpb=(1+(2*$t_pofb));
            $maxx=imagesx($tmp)-($t_sofb*$tmpb);
            $maxy=imagesy($tmp)-($t_sofb*$tmpb);
            $xt=rand(0,$maxx);
            $yt=rand(0,$maxy);
                $terrain=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb);
                $terrain2=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb);
                imagealphablending($terrain,false);
                //echo("imagecopy($terrain,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb)");
                  $alpha = imagecolorallocatealpha($terrain, 0, 0, 0,127);
                  imagefill($terrain,0,0,$alpha);
                  //imagecopy($terrain,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb);
                imagecopy($terrain2,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb);
                //$black = imagecolorallocate($terrain, 0, 0, 0);
                //imagestring ($terrain , 23 ,  1,  1 ,  "hovno" ,  $alpha );
                $tmps=imagesx($terrain);$tmps2=$tmps/2;
                for ($i=1; $t_brdcc*$tmps*$tmps>$i; $i++){
                    $ytmp=rand(0,$tmps-1);
                    $xtmp=rand(0,$tmps-1);
                    $dist=sqrt(pow($tmps2-$ytmp,2)+pow($tmps2-$xtmp,2));
                    $alpha=$dist/($tmps2*1);
                    if($alpha>1){$alpha=1;}
                    $radiusx=rand($t_brdca,$t_brdcb);
                    $radiusy=rand($t_brdca,$t_brdcb);
                    $rgb = imagecolorat($terrain2, $xtmp,$ytmp);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $alpha = imagecolorallocatealpha($terrain, $r, $g, $b,$alpha*127);
                    //imagesetpixel($terrain,$xtmp,$ytmp,$alpha);
                    imagefilledellipse($terrain,$xtmp,$ytmp,$radiusx,$radiusy,$alpha);
                    //imagefilledellipse($terrain,$xtmp,$ytmp,$radiusx,$radiusy,$alpha); 
    /**/
                }
        imagedestroy($terrain2);
        imagedestroy($tmp);
        imagesavealpha($terrain,true);
        imagepng($terrain,$file);
	//die($file);
        chmod($file,0777);
    }
    return($terrain);
}
//map1('t3');
/*
r(map1('t1'));
header("Content-type: image/png");
imagepng(map1('t1'));
exit;*/
//=============================================================
function map2d($xc=xc,$yc=yc){
    if($xc!=-1)$mapt=mapdata($xc,$yc,"terrain");
    $t_size=size*100;
    $t_zoom=zoom;
    $t_xc=0;
    $t_yc=0;
    $w=w;
    $t_pofb=t_pofb;//přesah okrajů
    $tmpb=(1+(2*$t_pofb));
    $gird=gird;
    //------------------------------------
    $t_file=tmpfile2("2d,$t_size,$t_zoom,$xc,$yc,$w,$gird,".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.$GLOBALS['ss']["ww"],"png","map");
    if(file_exists($t_file) and !notmp /**and false/**/){
        $t_img=imagecreatefrompng($t_file);
        imagesavealpha($t_img,true);
    }else{
        //$wofb=6;
        //$qofb=1000;
        //$t_sofb=$size*100;//100;//velikost bloku ze zdroje
        //$ss=$t_size*$t_pofb;
        $sss=($t_zoom*$t_size)+($t_size*$t_pofb*2);//4
        $t_img=imagecreatetruecolor($sss,$sss);
        imagealphablending($t_img,true);
        $alpha = imagecolorallocatealpha($t_img, 0, 0, 0,127);
        //$alpha = imagecolorallocatealpha($t_img, 255, 0, 0,0);
        imagefill($t_img,0,0,$alpha);
        for ($y=$t_xc; $y<=$t_zoom-$t_xc-1; $y++) {
            for ($x=$t_yc; $x<=$t_zoom-$t_yc-1; $x++) {
                
                if($xc==-1){$terrain="t1";}else{$terrain=$mapt[$y][$x];}
		if(!$terrain)$terrain='t1';
		//die('---'.$terrain);
                $terrain=map1($terrain);
                imagecopy($t_img,$terrain,($x/*-($t_pofb/2)*/)*$t_size,($y/*-($t_pofb/2)*/)*$t_size,0,0,$t_size*$tmpb,$t_size*$tmpb);
                //    $terrain=$mapt[$y+$t_yc][$x+$t_xc];
                //    imagestring ($t_img , 23 ,  ($x/*-($t_pofb/2)*/)*$t_size,($y/*-($t_pofb/2)*/)*$t_size , $terrain ,  $red );
                imagedestroy($terrain);
            }
        }
        /*--dobre--*/
        if($gird){
            $red = imagecolorallocate($t_img, 50, 50 , 50);
            for ($y=0; $y<=$t_zoom-1; $y= $y+(1/$gird)) {
                for ($x=0; $x<=$t_zoom-1; $x=$x+(1/$gird)) {
                    //$terrain=$mapt[$y+$t_yc][$x+$t_xc];
                    //imagestring ($t_img , 23 ,  ($x+$t_pofb)*$t_size+10,  ($y+$t_pofb)*$t_size+3 , $terrain ,  $red );
                    imagerectangle($t_img,($x+$t_pofb)*$t_size,($y+$t_pofb)*$t_size,($x+1+$t_pofb)*$t_size,($y+1+$t_pofb)*$t_size,$red);
                }
            }
        }
        //$red = imagecolorallocate($t_img, 255, 0 , 0);
        //imagerectangle($t_img,1,1,imagesx($t_img)-1,imagesy($t_img)-1,$red);
        imagesavealpha($t_img,true);
        imagepng($t_img,$t_file);
        chmod($t_file,0777);
    }
    return($t_img);
}
//r(map2d());
//=============================================================
function map3d($xc=xc,$yc=yc){
    //echo($xc."/".$yc);exit;
    /*OPTIMALIZACE*///if($xc<1 or $yc<1 or $xc>=mapsize or $yc>=mapsize){$xc=-1;$yc=-1;}
    //echo($xc."/".$yc);exit;
    //$mapl=mapdata($xc,$yc,"level");
    $size=size;
    $zoom=zoom;
    $t_size=size*100;
    $t_xc=0;
    $t_yc=0;
    $w=w;
    $gird=gird;
    $p=2;
    $distrel=distrel;
    $shr=shr;$shq=shq;
    $t_zoom=zoom;
    //$sshx=0.6;$sshy=0.3;
    $file=tmpfile2("3d,$size,$zoom,$xc,$yc,$w,$gird,".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb."","png","map");
    //------------------------------
    //r(notmp);exit;
    if(file_exists($file) and !notmp /**and false/**/){//r("ahoj");exit;
        $img=imagecreatefrompng($file);
        //imagealphablending($img,true);
        //imagesavealpha($img,true);
    }else{
        /*$img=map2d($xc,$yc);
        header ("Content-type: image/png");
        imagepng($img);
        imagedestroy($img);
        exit;*/
        $t_img=map2d($xc,$yc);
        $width=(6/5)*(500*$p)*(($zoom+($t_pofb*2))/5)*$size;
        $height=(7/5)*(250*$p)*(($zoom+($t_pofb*2))/5)*$size;//+10+top;
        
        
        //$img=imagecreatetruecolor($width,$height);
        //imagealphablending($img,true);
        $alpha = imagecolorallocatealpha($t_img, 0, 0, 0,127);
        //imagefill($img,0,0,$alpha);
        
        $t_img = imagerotate($t_img, -45,$alpha );
        $f=(5/5.5);
        $img=imgresizecrop($t_img,$width,$height,imagesx($t_img)*((1-$f)/2),imagesy($t_img)*((1-$f)/2),imagesx($t_img)*$f,imagesy($t_img)*$f);
    
        imagesavealpha($img,true);
        imagepng($img,$file);
        chmod($file,0777);
    }
    return($img);
}


//$image=(map3d(31,31));
//$image=map1('t1');
//r($image);
//header("Content-type: image/png");
//imagepng($image);
//exit;
//----------------------------------------------------------------------------------------------------------------------MODELS
//=============================================================
function paint($im){//return($im);
    /*imagefilter($im,IMG_FILTER_SMOOTH,5);
    return($im);

    //-----------------------------
    
    $im2 = imagecreatetruecolor(imagesx($im),imagesy($im));
    $bg= imagecolorallocatealpha($im2,0,0,0,127);
    ImageFill($im2,0,0,$bg);
    imagecopy ($im2,$im,0,0,0,0,imagesx($im2),imagesy($im2));
    imagefilter($im2,IMG_FILTER_GAUSSIAN_BLUR);
    imagecopy ($im2,$im,0,0,0,0,imagesx($im2),imagesy($im2));
    
    
    return($im2);*/
    //-----------------------------
    $im2 = imagecreate(imagesx($im),imagesy($im));
    $paleta=array();
    $rand=array();
    $bg= imagecolorallocatealpha($im2,0,0,0,127);
    $brd= imagecolorallocate($im2,0,0,0);
    ImageFill($im2,0,0,$bg);
    for($y = 1; $y!=imagesy($im); $y++){
        for($x = 1; $x!=imagesx($im); $x++){
                $rgb=imagecolorsforindex($im,imagecolorat($im, $x,$y));
                //r($rgb);
                //exit;
                $r=$rgb["red"];
                $g=$rgb["green"];
                $b=$rgb["blue"];
                $al=$rgb["alpha"];
                if($al==0){
                    //r($rgb);
                    //r($r, $g, $b);
                    //exit;
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
                    //imageellipse($im2,$x,$y,$rand[$i]["h"],$rand[$i]["w"],$brd);
                    //return($im2);
                    //imagecolordeallocate($im2,$color);
                }
        }
    }
    //imagefilter($im2,IMG_FILTER_CONTRAST,255);
    return($im2);
}

//=============================================================

function model2area($model,$name,$id,$x,$y){//return("");
    $s=height/(414*1.3)*0.95;
    $w=200*$s;
    $h=380*$s;
    $model=explode(":",$model);
    $points=$model[0];
    $points=str_replace("[","",$points);
    $points=explode("]",$points); 
    $d=10;
    foreach($points as $point){
        list($xx,$yy,$zz)=explode(",",$point);
        if($xx and $yy){//$z==0 and 
            $dd=sqrt(pow($xx-50,2)+pow($yy-50,2))/sqrt(2)*($w/200);
            if($dd>$d)$d=$dd;
            //r($dd,$xx.",".$yy);
        }
    }/**/
    $d=$d*1.2;
    //rx($d);
    $cx=$x+($w/2);
    $cy=$y+($h-($w/2));
    $ax=intval($cx-$d)-6;
    $ay=intval($cy-($d/2))+2;
    $bx=intval($cx+$d)-6;
    $by=intval($cy+($d/2))+2;
    /*$ax=intval($cx-10);
    $ay=intval($cy-10);
    $bx=intval($cx+10);
    $by=intval($cy+10);*/
    
    return("<area class=\"area\" name=\"$id\" shape=\"rect\" title=\"$name\" coords=\"".$ax.",".$ay.",".$bx.",".$by."\" "
    /*."data-maphilight='{\"stroke\":false,\"fillColor\":\"000000\",\"fillOpacity\":0.5,\"alwaysOn\":true}'"*/.">");
    //
    /*for ($y=1; $y<=imagesy($im)-1; $y++) {
        for ($x=1; $x<=imagesx($im)-1; $x++) {
            $rgb=imagecolorsforindex($im,imagecolorat($im, $x,$y));
            if($rgb["alpha"]!=0){
                s
            }
        }
    }*/
    
}



/*
    $cx=$x+($w/2);
    $cy=$y+($h-($w/2));
    $ax=intval($cx-$d);
    $ay=intval($cy-($d/2));
    $bx=intval($cx+$d);
    $by=intval($cy+($d/2));
    $ax=intval($cx-10);
    $ay=intval($cy-10);
    $bx=intval($cx+10);
    $by=intval($cy+10);
    //$xxx="data-maphilight='{\"stroke\":false,\"fillColor\":\"000000\",\"fillOpacity\":0.5,\"alwaysOn\":true}'";
    $xxx="";
    return("<area href=\"$url\" shape=\"rect\" title=\"$name\" coords=\"".$ax.",".$ay.",".$bx.",".$by."\" "
    .$xxx.">");
*/
//define("res","[0,0,0][100,0,0][0,100,0][100,100,0][0,0,0]:5,2,4,3:666666,CCCCCC");
//rx(model2area(res,"","",0,0));

//==========================================================================================================================MODEL

//=============================================================
/*define("res","[-1,-1,0][90,50,0][10,90,0][10,10,0][50,90,0][90,10,0][60,60,0][50,60,0][60,50,0][50,84,30][50,66,30][50,84,0][50,66,0][95,63,0][91,54,0][81,52,0][73,58,0][73,69,0][81,75,0][91,73,0][95,63,30][91,54,30][81,52,30][73,58,30][73,69,30][81,75,30][91,73,30][50,90,51][50,60,51][60,50,51][90,50,51][90,10,51][10,10,51][10,90,51][60,60,51][40,90,51][20,90,51][90,20,51][90,40,51][98,20,0][40,98,0][20,98,0][90,40,0][90,20,0][98,40,0][40,90,0][20,90,0][20,80,51][80,27,51][80,20,51][20,20,51][44,48,51][40,40,105][47,43,51][29,80,51][22,66,30][22,66,0]:24,23,22,21,27,26,25;34,28,29,35,30,31,32,33;57,56,11,13;14,14,21,27,20;19,20,27,26;18,19,26,25;24,25,18,17;12,5,28,29,8,13,11,10;28,5,3,34;4,3,34,33;4,33,32,6;32,31,2,6;30,31,2,9;29,35,7,8;35,30,9,7;44,40,38;43,39,45;44,43,45,40;38,39,45,40;47,42,37;36,41,46;37,36,41,42;48,53,51;51,53,50;53,50,49;53,55,48;53,52,54;14,21,22,15;15,22,23,16;24,23,16,17:0000cc,888888,111111,006600,006600,006600,006600,444444,444444,444444,444444,444444,444444,444444,444444,111111,111111,111111,111111,111111,111111,111111,ff5500,ff5500,551100,551100,551100,006600,006600,006600");*/
function modelx($res){
    $GLOBALS['model_noimg']=true;
    model($res,0.75);
    $GLOBALS['model_noimg']=false;
    return(rebase(url.base.$GLOBALS['model_file']));
}
function model($res,$s=1,$rot=0,$slnko=1.5,$ciary=0,$zburane=0,$hore=0){$pres=$res;
    //--------------------MULTIMODEL
    if(substr($res,0,1)=='{'){    
        $res=substr($res,1);
        $res=explode('}',$res,1);
        $res=$res[0];
    }
    //--------------------NORES - POKUD $res NENí MODEL
    if(substr($res,0,1)=='('){
        $res=str_replace(array('(',')'),'',$res);
        list($res,$rot)=explode(':',$res);
        if(substr($res,0,1)=='_'){
            $res=substr($res,1);
            $file0=root.'data/image/res/'.$res;
        }else{
            $file0=root.'userdata/res/'.$res;
        }
        //error_reporting(E_ALL);
        //if($GLOBALS['model_bigimg']==true)$rot='0';
        $file0=trim(str_replace('{}','16',$file0));
        $file0_=str_replace('/1.png','/'.$rot.'.png',$file0);
        if(file_exists($file0_))$file0=$file0_;
        //e($file0);
        $file=tmpfile2($pres,"png","nores");
        $GLOBALS['model_file']=$file;
        if(!$GLOBALS['model_noimg'])$GLOBALS['ss']["im"]=imagecreatefrompng($file0);
        if(!file_exists($file)){
            copy($file0,$file);
            chmod($file,0777);
        }
        if(!$GLOBALS['model_noimg'])return($GLOBALS['ss']["im"]);
        else return;
    }
    //---------------------------------
    $s=$s*height/500;
    $file=tmpfile2("model$res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore","png","model");//
    $GLOBALS['model_file']=$file;
    //r($file);exit;
    if(file_exists($file)){
        $img=imagecreatefrompng($file);
        imagealphablending($img,true);
        imagesavealpha($img,true);
        return($img);
    }else{
        //$s=0.5;
        //$res=res;
        $res=str_replace("::",":1,1,1:",$res);
        $tmp=explode(":",$res);
        /*if($tmp[0]=="tree"){
            $name=$tmp[0];
            $type=$tmp[1];
            //$tmp=imagecreatefrompng("image/nature/$name/$type.png");
            //return($tmp);
            $res=str_replace("::",":
        if($GLOBALS['model_noimg'])return($GLOBALS['ss']["im"]);1,1,1:",$res);
            $tmp=explode(":",$res);
        }*/
        $points=$tmp[0];
        $polygons=$tmp[1];
        $colors=/*explode(",",)*/$tmp[2];
        $rot=$tmp[3];
        //---------------------------colors
        $colors=explode(",",$colors);
        //---------------------------rozklad bodu
        $points=substr($points,1,strlen($points)-2); 
        $points=explode("]",$points); 
        $i=-1;
        foreach($points as $tmp){
        $i=$i+1; 
        $points[$i]=str_replace("[","",$points[$i]);
        $points[$i]=explode(",",$points[$i]);
        }
        //---------------------------zburane
        $i=-1;
        foreach($points as $ii){
        $i=$i+1;
        $x=$points[$i][0];
        $y=$points[$i][1];
        $z=$points[$i][2];
        //-------------------------
        //$x=$x+rand(-10,10);
        //$y=$y+rand(-10,10);
        $z=$z-((($points[$i-1][2]+$points[$i-2][2])*$zburane)/100);
        if($z<0){$z=0;}
        //-------------------------
        $points[$i][0]=$x;
        $points[$i][1]=$y;
        $points[$i][2]=$z;
        //---
        }
        //---------------------------rotace
        $i=-1;
        foreach($points as $ii){
        $i=$i+1;
        $x=$points[$i][0];
        $y=$points[$i][1];
        //echo("(".$x.",".$y.")");
        //-------------------------
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
        //-------------------------
        //echo("(".$x.",".$y.")<br/>");
        $points[$i][0]=$x;
        $points[$i][1]=$y;
        //---
        }
        //---------------------------polygons
        $polygons=explode(";",$polygons);
        $i=-1;
        foreach($polygons as $tmp){
        $i=$i+1;
        $polygons[$i]=explode(",",$polygons[$i]);
        if($polygons[$i]==array("")){$polygons[$i][0]=1;$polygons[$i][1]=1;$polygons[$i][2]=1;}
        $polygons[$i][count($polygons[$i])]=$colors[$i];
        
        }
        //---
        /*foreach($polygons as $tmp1){
        echo(join(",",$tmp1));
        echo("<br/>");
        } */
        //---------------------------serazeni bodu
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
        //---------------------------vykresleni
        if($hore!=1){
        $GLOBALS['ss']["im"] = imagecreate($s*200,$s*380);
        }else{
        $GLOBALS['ss']["im"] = imagecreate($s*150,$s*150);
        }
        //imagealphablending($GLOBALS['ss']["im"],false);
        $GLOBALS['ss']["bg"] = imagecolorallocatealpha($GLOBALS['ss']["im"],0,0,0,127);
        $cierne = imagecolorallocate($GLOBALS['ss']["im"],10,10,10);
        ImageFill($GLOBALS['ss']["im"],0,0,$GLOBALS['ss']["bg"]);
        //$bg = imagecolorallocatealpha($im,0,0,0,127);
        //ImageFill($im,0,0,$bg);
        //----------------------------------------------------------------stin
        //$shadow = imagecolorallocatealpha($GLOBALS['ss']["im"],0,0,0,50);
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
        //$xx=100+($x*1)-($y*1);
        ///$yy=279+($x*0.5)+($y*0.5)-($z*1.11);
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
        }/**/
        
        //--------------------------------------------------------------polygons
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
        
        
        $color=/*$colors[$i2]*/$tmp[count($tmp)-1];
        //----------------------
        $x1=$points[$tmp[0]-1][0];
        $y1=$points[$tmp[0]-1][1];
        $x2=$points[$tmp[2]-1][0];
        $y2=$points[$tmp[2]-1][1];
        $x=abs($x1-$x2)+1;
        $y=abs($y1-$y2)+1;
        $rand=pow($x/$y,1/2);
        if($rand>1.5){$rand=1.5;}
        $rand=($rand*30*$slnko)-(25*$slnko);
        //----------------------
        
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
        //---------------------------rozvostreni
        $GLOBALS['ss']["im"]=paint($GLOBALS['ss']["im"]);
        //$file=tmpfile2("model,$res,$s,$rot,$slnko,$ciary,$zburane,$hore","png");
        ImagePng($GLOBALS['ss']["im"],$file);
        chmod($file,0777);
        chmod($file);
        
        
        //imagesavealpha($GLOBALS['ss']["im"],true);

        return($GLOBALS['ss']["im"]);
        //---
        /*header("Cache-Control: max-age=3600");
        header("Content-type: image/png");
        ImagePng($GLOBALS['ss']["im"]);
        ImageDestroy($GLOBALS['ss']["im"]);*/
        //---
    }
}
//$res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore=0
//r(model(res,1,0,1,0));
//============================================================
/*function mapblock($xc=xc,$yc=yc){
    $img=map3d($xc,$yc);
    //imagesavealpha($img,true);
    //imagefilter($img,IMG_FILTER_GRAYSCALE,230);
    $x=$xc;
    $y=$yc;
    $file=tmpfile2("mapblock,".size.",".zoom.",".$xc.",".$yc.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb."","png");
    //r($file);exit;
    if(file_exists($file) and !notmp and false){
        $img=imagecreatefrompng($file);
    }else{
    $q=0;
        while($q<1){
            foreach(sql_array("SELECT x,y,res FROM `objects` WHERE res!='' AND x>=$x AND y>=$y AND x<=$x+5 AND y<=$y+5 ORDER BY x,y") as $row){
                $model=model($row[2],1,20,1.5,0);
                //imagealphablending($model,true);
                //imagesavealpha($model,true);
                $model=place($model);
                $xx=$row[0]-$x;
                $yy=$row[1]-$y;
                $rxp=(imagesx($img)-imagesx($model))*0.5;//($width/2)-(imagesx($cast)*0.5*$size);
                $ryp=-134;
                $p=(200*size);
                $ix2rx=0.5*$p;$ix2ry=0.25*$p;
                $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
                $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
                $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;
                // ( $dst_im , $src_im , $dst_x , $dst_y , $src_x , $src_y , $src_w , $src_h )
                imagecopy($img,$model,$rx,$ry,0,0,imagesx($model),imagesy($model));
            }
            //if($q==0)imagefilter($img,IMG_FILTER_SMOOTH,1);
        $q++;}
        imagepng($img,$file);
        chmod($file,0777);
        //ImageDestroy($img);
    }
    return($img);
}*/
//=============================================================
//phpinfo();exit;
function map($gx,$gy,$xy){
    define("xx",0);
    define("yy",0);
    define("top",200*(height/375));
    //---------------------------------
    //2NOCACHE//$file=tmpfile2("map2,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.$GLOBALS['ss']["ww"],"png","map");
    //r($gx.",".$gy);
    //$xy="x".$gx."y".$gy;
    //2NOCACHE//$file2=tmpfile2("area".$xy.$GLOBALS['ss']["ww"],"txt","map");
    //echo($file2);exit;
    //2NOCACHE//if(file_exists($file) and file_exists($file2) and !notmp /*and false*/){
    //2NOCACHE//    //r("areax".xc."y".yc);exit;
    //2NOCACHE//    $img=imagecreatefrompng($file);
    //2NOCACHE//    //r($file2);
    //2NOCACHE//    $area=file_get_contents($file2);
    //2NOCACHE//    //$images=file_get_contents($file2);
    //2NOCACHE//}else{
    //---------------------------------
        //ÁREA$area="<map name=\"".$xy."\" >";
        $size=1;
        $width=150*5*(height/375);
        $height=75*5*(height/375);
        $img=imagecreatetruecolor($width,$height);
        //imageantialias($img, true);
        $z=3;
        $zoom=$z*5;
        $zzoom=1+(($z-1)*5);
        $top=250*(height/375);//230;
        for($x=$gx;$x<$gx+$zzoom;$x=$x+5){
            for($y=$gy;$y<$gy+$zzoom;$y=$y+5){
                //echo("$x,$y<br>");
                $cast=map3d($x-5,$y-5);
                //r("($x,$y)");
                //$rxp=imagesx($cast)/2;$ryp=(imagesy($cast)/2)-top;
                $xx=($x-$gx);
                $yy=($y-$gy);
                //echo("$xx,$yy - ");
                $p=(2*100*size*$size*1);
                $rxp=($width/2)-(imagesx($cast)*0.5*$size);
                $ryp=-top*$size-$top;
                $ix2rx=0.5*$p;$ix2ry=0.25*$p;
                $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
                $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
                $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;
                imagecopyresized($img,$cast,$rx,$ry,0,0,imagesx($cast)*$size,imagesy($cast)*$size,imagesx($cast),imagesy($cast));
            }
        }
        return($img);
}
//--------------------------------------------------------------UNITS
function mapunits($gx,$gy,$xy){
    define("xx",0);
    define("yy",0);
    define("top",200*(height/375));
    //---------------------------------
        $size=1;
        $width=150*5*(height/375);
        $height=75*5*(height/375);
        $img=imagecreatetruecolor($width,$height);//r();
        //imagealphablending($img,false);
        //imagesavealpha($img,true);
        //imagesavealpha($img,true);
        $fill=imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $fill);
        //imageantialias($img, true);
        $z=3;
        $zoom=$z*5;
        $zzoom=1+(($z-1)*5);
        $top=250*(height/375);//230;
        //----------------------------------AREA------------
        $x=$gx-5;
        $y=$gy-5;
        $top=408*(height/375);//458;
        foreach(sql_array("SELECT x,y,res,name,id FROM `".mpx."objects` WHERE res!='' AND ww=".$GLOBALS['ss']["ww"]." "."AND `type`!='building'"."  AND x>=$x AND y>=$y AND x<=$x+$zoom AND y<=$y+$zoom ORDER BY x,y") as $row){
                    //if($row[2]){
                        $model=model($row[2],1,20,1.5,0);                        
						//r($row[3]);                        
                        //r($model);
                        //imagealphablending($model,true);
                        //imagesavealpha($model,true);
                        //$model=place($model);
                        $xx=$row[0]-$x;
                        $yy=$row[1]-$y;
                        $rxp=(imagesx($img)-imagesx($model))*0.5;//($width/2)-(imagesx($cast)*0.5*$size);
                        $ryp=-top*$size-$top;
                        $p=(200*size);
                        $ix2rx=0.5*$p;$ix2ry=0.25*$p;
                        $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
                        $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
                        $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;
                        // ( $dst_im , $src_im , $dst_x , $dst_y , $src_x , $src_y , $src_w , $src_h )
                        $s=height/500;
                        //r("imagecopyresized(img,model,$rx,$ry,0,0,$s*200*(".imagesx($model)."/110),$s*380*(".imagesy($model)."/209),".imagesx($model).",".imagesy($model)."));");
                        imagecopyresized($img,$model,$rx,$ry,0,0,$s*200*(imagesx($model)/110),$s*380*(imagesy($model)/209),imagesx($model),imagesy($model));
                    //}
                }
        /**/ 
    //exit;
	imagesavealpha($img,true);
    return($img);
}
//r(mapunits(0,2,'x'));
//exit;
//=============================================================
function htmlmap($gx=false,$gy=false,$w=0,$only=false/*$width=424*/){
            $width=424;
    //NOCACHE//ile$file=tmpfile2("output6,".root.",$gx,$gy,".$GLOBALS['ss']["ww"],"txt","map");
    //NOCACHE//if(!file_exists($file) and !notmp){
        //if($_GET["x"]){$gx=$_GET["x"];}else{$gx=0;}
        //if($_GET["y"]){$gy=$_GET["y"];}else{$gy=0;}
            
            //echo(mapsize);
            $ym=ceil(mapsize/5);//-1;
            $xm=ceil((mapsize/5-1)/2);
            $x=($gy+$gx)*5+1;
            $y=($gy-$gx)*5+1;            
            
            //echo("($gx>$xm) or ($gx<-$xm) or ($gy>$ym) or ($gy<0)");
            // or ($gx>$xm) or ($gx<-$xm) or ($gy>$ym) or ($gy<0)
            $t=11;
            if(is_bool($gx) or is_bool($gy) or ($x<-$t) or ($y<-$t) or ($x>mapsize+$t) or ($x>mapsize+$t)){$gx=-$xm;$gy=0;}
            if($w!=2)$outimg=tmpfile2("outimg,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"],"jpg","map");
			if($w!=1)$outimgunits=tmpfile2("outimgunits,".size.",".zoom.",".$gx.",".$gy.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"],"png","map");

            if($w==1 and $only)return($outimg);
            if($w==2 and $only)return($outimgunits);
            
            $border=0;
            $html='';
            //======================================================BACKGROUND
            if($w!=2){
            if(!file_exists($outimg)){if(debug)$border=3;
                $x=($gy+$gx)*5+1;
                $y=($gy-$gx)*5+1;
                $img=map($x,$y,"x".$gx."y".$gy);
                //$img=imgresizew($img,424);
                //r($GLOBALS['ss']["area"]);exit;
                imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
                imagefilter($img, IMG_FILTER_CONTRAST,-10);
                $emboss = array(array(0, 0.05, 0), array(0.05, 0.8,0.05), array(0, 0.05, 0));
                imageconvolution($img, $emboss, 1, 0);
            
                //header('Content-Type: image/jpeg');
                imagejpeg($img,$outimg,95);
                chmod($outimg,0777);
                ImageDestroy($img);
            }
            //-----------------------
            $datastream=rebase(url.base.str_replace('../','',$outimg).'?'.filemtime($outimg));
            //$datastream='data:image/png;base64,'.base64_encode(file_get_contents($outimg));
            if($w==0)$html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*211)).'" style="z-index:1;" height="'.(round($width/424*211)).'" "/>';//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
            else     $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*211)).'" />';            
            }
            //======================================================UNITS
            if($w!=1){
            if(!file_exists($outimgunits)/* or 1*/){if(debug)$border=3;
                $x=($gy+$gx)*5+1;
                $y=($gy-$gx)*5+1;
                $img=mapunits($x,$y,"x".$gx."y".$gy);
                //$img=imgresizew($img,424);
                //r($GLOBALS['ss']["area"]);exit;
                imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
                imagefilter($img, IMG_FILTER_CONTRAST,-5);
                //$emboss = array(array(0, 0.05, 0), array(0.05, 0.8,0.05), array(0, 0.05, 0));
                //imageconvolution($img, $emboss, 1, 0);
            
                //header('Content-Type: image/jpeg');
                imagepng($img,$outimgunits);
                chmod($outimgunits,0777);
                ImageDestroy($img);
            }
            //-----------------------
            $datastream=rebase(url.base.str_replace('../','',$outimgunits).'?'.filemtime($outimgunits));
            //$datastream='data:image/png;base64,'.base64_encode(file_get_contents($outimg));
            if($w==0)$html.='<span style="position:absolute;width:0px;z-index:2;"><img src="'.$datastream.'" style="position:relative;left:-'.$width.'px;z-index:2;" class="clickmap" width="'.$width.'" height="'.(round($width/424*211)).'" border="'.$border.'"/></span>';//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
            else     $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*211)).'" class="clickmap" border="'.$border.'"/>';
            }
            //======================================================
                    //NOCACHE//    file_put_contents2($file,$html);
        //NOCACHE// }else{
        //NOCACHE//     //r($file);
        //NOCACHE//    $html=file_get_contents($file);
        //NOCACHE//}
    //if(root)$html=str_replace("src=\"","src=\"".root,$html);
    if(!$w)echo($html);
    else   return($html);
}
htmlmap(0,7);
die();
?>
