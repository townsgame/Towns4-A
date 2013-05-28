<?php
ini_set("max_execution_time","1000");
define("func_map",true);
//=============================================================MAPCONFIG
define("height",212/*1.3*/);//výška html bloku
//---------------------------
define("grid",0);
define("t_brdcc",0.3);//počet kuliček
define("t_brdca",2);//6;//min radius kule
define("t_brdcb",10);//8;//max radius kule
define("t_brdcr",1.62);//8;//poměr šířka/výška kule
define("t_pofb",1);//přesah okrajů
define("t_sofb",100);//velikost bloku z průvodního obrázku

define("height2",212*1.3);
define("size2",0.75*(height2/375));
//---------------------------NENASTAVITELNÉ
define("size",height/212);
//define("size",0.75*(height/375));
define("zoom",5);

define("nob",true);
define("t_",implode(',',array(height,t_brdcc,t_brdcc,t_brdca,t_brdcb,t_pofb,t_sofb,size,zoom,grid)));
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
//----------------------------------------------------------------------------------------------------------------------MAP1
//=============================================================
/*function mapdata($xc=xc,$yc=yc,$wtf="terrain"){
    //$xc=xc;
    //$yc=yc;
    $w=w;
    $zoom=zoom;
    //die("SELECT x,y,$wtf from `map` WHERE `w`=$w AND `x`>=$xc AND `y`>=$yc AND `x`<$xc+$zoom+2 AND `y`< $yc+$zoom+2 ORDER by `y`,`x`");
    $mapd=sql_array("SELECT x,y,$wtf from `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]." AND `x`>=$xc AND `y`>=$yc AND `x`<$xc+$zoom AND `y`< $yc+$zoom ORDER by `y`,`x`");
    $map=array();
    //r($mapd);exit;
    foreach($mapd as $row){list($x,$y,$wtf)=$row;
        $x=$x-$xc;
        $y=$y-$yc;
        if(!$map[$y]){$map[$y]=array();}
        $map[$y][$x]=$wtf;
    }
    return($map);
}*/
//=============================================================
function map1($param,$xc=false,$yc=false){
    //echo($param);
    if(!$param){$param='t1';}
    if($xc===false or $yc===false){
        $rand=rand(1,7);
    }else{
        $rand=((pow($xc,2)+pow($yc,3))%7)+1;
    }
    //echo($rand);
    
    $t_size=size*424/5;
    $t_sofb=t_sofb;
    $t_pofb=t_pofb;
    $t_brdcc=t_brdcc;//počet kuliček
    $t_brdca=t_brdca;//10;//min radius kule
    $t_brdcb=t_brdcb;//15;//max radius kule
    $file=tmpfile2("$rand,$param,".t_,"png","map");
    //------------------------------
    if(file_exists($file) and !notmp /**and false/**/){
        $terrain=imagecreatefrompng($file);
    }else{
//echo(root."data/image/terrain/$param.png");
            //--------------------------2D
            $tmp=imagecreatefrompng(root."data/image/terrain/$param.png");
            $tmpb=(1+(2*$t_pofb));
            $maxx=imagesx($tmp)-($t_sofb*$tmpb);
            $maxy=imagesy($tmp)-($t_sofb*$tmpb);
            $xt=rand(0,$maxx);
            $yt=rand(0,$maxy);
                $terrain=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb/2);
                $terrain2=imagecreatetruecolor($t_size*$tmpb,$t_size*$tmpb);
                imagealphablending($terrain,false);
                //echo("imagecopy($terrain,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb)");
                  $alpha = imagecolorallocatealpha($terrain, 0, 0, 0,127);
                  imagefill($terrain,0,0,$alpha);
                  //imagecopy($terrain,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb);
                  //r($tmp);
                imagecopy($terrain2,$tmp,0,0,$xt,$yt,$t_size*$tmpb,$t_size*$tmpb);
                //r($terrain2);
                //$black = imagecolorallocate($terrain, 0, 0, 0);
                //imagestring ($terrain , 23 ,  1,  1 ,  "hovno" ,  $alpha );
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
                    //imagesetpixel($terrain,$xtmp,$ytmp,$alpha);
                    imagefilledellipse($terrain,$xtmp,$ytmp/2,$radiusx,$radiusy/t_brdcr,$alpha);
                    //imagefilledellipse($terrain,$xtmp,$ytmp,$radiusx,$radiusy,$alpha); 
    /**/
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
                
        //--------------------------3D               
        //--------------------------Save       
        imagedestroy($terrain2);
        imagedestroy($tmp);
        imagesavealpha($terrain,true);
        imagepng($terrain,$file);
	//die($file);
        chmod($file,0777);
    }
    return($terrain);
}
//r(map1());
//exit;
/*
r(map1('t1'));
header("Content-type: image/png");
imagepng(map1('t1'));
exit;*/
//----------------------------------------------------------------------------------------------------------------------MODELS
//=============================================================
/*function ImageEllipseAA( &$img, $x, $y, $w, $h,$color,$segments=70){
    $w=$w/2;
    $h=$h/2;
    $jump=2*M_PI/$segments;
    $oldx=$x+sin(-$jump)*$w;
    $oldy=$y+cos(-$jump)*$h;
    for($i=0;$i<2*(M_PI);$i+=$jump)
    {
        $newx=$x+sin($i)*$w;
        $newy=$y+cos($i)*$h;
        ImageLine($img,$newx,$newy,$oldx,$oldy,$color);
        $oldx=$newx;
        $oldy=$newy;
    }
}*/
//-----------------------------
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
    if(function_exists('imageantialias'))imageantialias($im2, true);
    $paleta=array();//$paleta2=array();
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
                    //if(!$paleta2[$i])$paleta2[$i]=imagecolorallocatealpha($im2,$r, $g, $b,$rand[$i]["a"]*2);
                    //imagefilledellipse($im2,$x+1,$y+1,$rand[$i]["h"]-2,$rand[$i]["w"]-2,$paleta[$i]);
                    imagefilledellipse($im2,$x,$y,$rand[$i]["h"],$rand[$i]["w"],$paleta[$i]);
                    //imageellipseAA($im2,$x,$y,$rand[$i]["h"],$rand[$i]["w"],$paleta[$i]);
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


//==========================================================================================================================MODEL

//=============================================================
/*define("res","[-1,-1,0][90,50,0][10,90,0][10,10,0][50,90,0][90,10,0][60,60,0][50,60,0][60,50,0][50,84,30][50,66,30][50,84,0][50,66,0][95,63,0][91,54,0][81,52,0][73,58,0][73,69,0][81,75,0][91,73,0][95,63,30][91,54,30][81,52,30][73,58,30][73,69,30][81,75,30][91,73,30][50,90,51][50,60,51][60,50,51][90,50,51][90,10,51][10,10,51][10,90,51][60,60,51][40,90,51][20,90,51][90,20,51][90,40,51][98,20,0][40,98,0][20,98,0][90,40,0][90,20,0][98,40,0][40,90,0][20,90,0][20,80,51][80,27,51][80,20,51][20,20,51][44,48,51][40,40,105][47,43,51][29,80,51][22,66,30][22,66,0]:24,23,22,21,27,26,25;34,28,29,35,30,31,32,33;57,56,11,13;14,14,21,27,20;19,20,27,26;18,19,26,25;24,25,18,17;12,5,28,29,8,13,11,10;28,5,3,34;4,3,34,33;4,33,32,6;32,31,2,6;30,31,2,9;29,35,7,8;35,30,9,7;44,40,38;43,39,45;44,43,45,40;38,39,45,40;47,42,37;36,41,46;37,36,41,42;48,53,51;51,53,50;53,50,49;53,55,48;53,52,54;14,21,22,15;15,22,23,16;24,23,16,17:0000cc,888888,111111,006600,006600,006600,006600,444444,444444,444444,444444,444444,444444,444444,444444,111111,111111,111111,111111,111111,111111,111111,ff5500,ff5500,551100,551100,551100,006600,006600,006600");*/
function modelx($res){
    $GLOBALS['model_noimg']=true;
    $GLOBALS['model_resize']=0.75;
    model($res,0.75*gr);//0.75
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
        $GLOBALS['model_resize']=1;
        if(!$GLOBALS['model_noimg'])return($GLOBALS['ss']["im"]);        
        else return;
    }
    //---------------------------------
    $s=$s*height2/500;
    $file=tmpfile2("model,aa,$res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore","png","model");//
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
//----------------------------------------------------------------------------------------------------------------------PROPOJENI
function mapbg($xc,$yc){
    define("xx",0);
    define("yy",0);
    //define("top",200*(height/375));
    $t_pofb=t_pofb;
    //---------------------------------
        $size=1;
        $width=height*2;//150*5*(height/375);
        $height=height;//75*5*(height/375);
        $img=imagecreatetruecolor($width,$height);
        //$black=imagecolorallocate($img, 0, 0, 0);
        $white=imagecolorallocate($img, 255, 255, 255);
        imagefill($img,0,0,$white);
        //imageantialias($img, true);
        
        
        //$xc=5*($y+$x)+1;//-(($gy-1)/10)+(($gx-1)/10);
        //$yc=5*($y-$x)+1;//(($gy-1)/10)+(($gx-1)/10);
        $zoom=5;
        $exp=4;
        $pos=4.5;
        
        //--------------------
        $data=array();
        for($y=0;$y<($yc+$zoom+$exp+$pos)-($yc-$exp-$pos);$y++){
            $data[$y]=array();
            for($x=0;$x<($xc+$zoom+$exp+$pos)-($xc-$exp-$pos);$x++){
                $data[$y][$x]='t1';  
            }    
        }        
        //--------------------
           
        $array=sql_array("SELECT x,y,terrain from `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]." AND `x`>=".round($xc-$exp-$pos)." AND `y`>=".round($yc-$exp-$pos)." AND `x`<".round($xc+$zoom+$exp+$pos)." AND `y`<".round($yc+$zoom+$exp+$pos)." ORDER by `y`,`x`");
        
        
        foreach($array as $row){
            list($x,$y,$terrain)=$row;
            $data[$y-($yc-$exp-$pos)][$x-($xc-$exp-$pos)]=$terrain; 
        } 
        //--------------------

        $y=-$exp-$pos-$pos-1;
        foreach($data as $row){$y++;
        $x=-$exp-$pos-$pos-1;
        foreach($row as $terrain){$x++;
            //echo("($x,$y)");
            //echo("$terrain,");    
            //$x=$x-$xc-$pos;
            //$y=$y-$yc-$pos;
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
            //imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
            if($q)imagecopy($img,$cast,$rx,$ry,0,0,imagesx($cast),imagesy($cast));   
            imagedestroy($cast);
        }}
        
        return($img);
}
//r(mapbg(24,57));
//--------------------------------------------------------------UNITS
function mapunits($gx,$gy,$xy){
    define("xx",0);
    define("yy",0);
    define("height2",height*1.3);
    define("top",200*(height2/375));
    //---------------------------------
        $size=1;
        $width=150*5*(height2/375);
        $height=75*5*(height2/375);
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
        $top=250*(height2/375);//230;
        //----------------------------------AREA------------
        $x=$gx-5;
        $y=$gy-5;
        $top=408*(height2/375);//458;
        $q=false;
        foreach(sql_array("SELECT x,y,res,name,id FROM `".mpx."objects` WHERE res!='' AND ww=".$GLOBALS['ss']["ww"]." "."AND `type`!='building'"."  AND x>=$x AND y>=$y AND x<=$x+$zoom AND y<=$y+$zoom ORDER BY x,y") as $row){
                    //if($row[2]){
                        $q=true;                        
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
                        $p=(200*size2);
                        $ix2rx=0.5*$p;$ix2ry=0.25*$p;
                        $iy2rx=-0.5*$p;$iy2ry=0.25*$p;
                        $rx=($ix2rx*$xx)+($iy2rx*$yy)+$rxp;
                        $ry=($ix2ry*$xx)+($iy2ry*$yy)+$ryp;
                        // ( $dst_im , $src_im , $dst_x , $dst_y , $src_x , $src_y , $src_w , $src_h )
                        $s=height2/500;
                        //r("imagecopyresized(img,model,$rx,$ry,0,0,$s*200*(".imagesx($model)."/110),$s*380*(".imagesy($model)."/209),".imagesx($model).",".imagesy($model)."));");
                        imagecopyresized($img,$model,$rx,$ry,0,0,$s*200*(imagesx($model)/110),$s*380*(imagesy($model)/209),imagesx($model),imagesy($model));
                    //}
                }
          
        /**/ 
    //exit;
    if($q){	
	   imagesavealpha($img,true);
        return($img);
    }else{
        return(false);   
    }
}
//r(mapunits(50,30));
//exit;
//------------------------------------------------------------------------------------------------------------PROPOJENI2 HTMLMAP
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
            if(is_bool($gx) or is_bool($gy) or ($x<-$t) or ($y<-$t) or ($x>mapsize+$t) or ($x>mapsize+$t)){$gx=-$xm-1;$gy=-1;}//$gx=-$xm;$gy=0;
            if($w!=2)$outimg=tmpfile2("outimgbg,".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,"jpg","map");
			if($w!=1)$outimgunits=tmpfile2("outimgunits".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,"png","map");

            if($w==1 and $only)return($outimg);
            if($w==2 and $only)return($outimgunits);
            
            $border=0;
            $html='';
            //======================================================BACKGROUND
            if($w!=2){
            if(!file_exists($outimg)/** or 1/**/){if(debug)$border=3;
                $x=($gy+$gx)*5+1-5;
                $y=($gy-$gx)*5+1-5;
                $img=mapbg($x,$y/*,"x".$gx."y".$gy*/);
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
            if($w==0)$html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" style="z-index:1;" height="'.(round($width/424*211)).'" "/>';//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
            else     $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" />';            
            }
            //======================================================UNITS
            if($w!=1){
            if(!file_exists($outimgunits)/** or 1/**/){if(debug)$border=3;
                $x=($gy+$gx)*5+1;
                $y=($gy-$gx)*5+1;
                if($img=mapunits($x,$y/*,"x".$gx."y".$gy*/)){
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
                }else{
                    file_put_contents2($img,'');    
                }
            }
            //-----------------------
            if(filesize($outimgunits)>1){
                $datastream=rebase(url.base.str_replace('../','',$outimgunits).'?'.filemtime($outimgunits));
                //$datastream='data:image/png;base64,'.base64_encode(file_get_contents($outimg));
                if($w==0)$html.='<span style="position:absolute;width:0px;z-index:2;"><img src="'.$datastream.'" style="position:relative;left:-'.$width.'px;z-index:2;" class="clickmap" width="'.$width.'" height="'.(round($width/424*212)).'" border="'.$border.'"/></span>';//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
                else     $html.='<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212)).'" class="clickmap" border="'.$border.'"/>';
            }elseif($w!=0){
                $html.='<table width="'.$width.'" height="'.($width/2).'" border="0" cellpadding="0" cellspacing="0" class="clickmap" ><tr><td></td></tr></table>';

            }
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
//htmlmap(-3,3);
//htmlmap(-2,3);
//die();
//======================================================
/*function terraincolor($terrain){
    $tmp=imagecreatefrompng(root."data/image/terrain/$terrain.png");
    $r=0;$g=0;$b=0;
    $d=imagesx($tmp)*imagesy($tmp)/100000;
    for($yyy=1;$yyy<=imagesy($tmp);$yyy+=100){
        for($xxx=1;$xxx<=imagesx($tmp);$xxx+=100){
            $rgb = imagecolorat($tmp, $xxx,$yyy);
            $r += (($rgb >> 16) & 0xFF)/$d;
            $g += (($rgb >> 8) & 0xFF)/$d;
            $b += ($rgb & 0xFF)/$d;
        }
    }
    imagedestroy($tmp);
    return(array($r,$g,$b));
}*/
function terraincolor($terrain){
    $tmp=imagecreatefrompng(root."data/image/terrain/$terrain.png");
    $rgb = imagecolorat($tmp,round(imagesx($tmp)/2),round(imagesy($tmp)/2));
    $r = (($rgb >> 16) & 0xFF);
    $g = (($rgb >> 8) & 0xFF);
    $b = ($rgb & 0xFF);
    imagedestroy($tmp);
    return(array($r,$g,$b));
}
//-----------------------
function worldmap($width=500,$minsize=0,$w=false){
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
    
    $outimg=tmpfile2("worldmap,$width,$w,$minsize".t_,"png","map");
    if(!file_exists($outimg)/** or true/**/){
        
        if($mapsize<$minsize){   
            $kk=$minsize/$mapsize; 
        }else{
            $kk=1;   
        }      
        
        $colors=array();
        
        $s=$width/(sqrt(2*pow($mapsize,2))*$kk);      
        //$width=sqrt(2*pow($mapsize,2))*$s*$kk;
        $height=$width/2;
        
        $img=imagecreatetruecolor($width, $height);
        imagealphablending($img, false);
        list($r,$g,$b)=terraincolor('t1');
        $y=gr;$yy=5;//5;
        $colors[0]=imagecolorallocatealpha($img, ((($y*$r)+$g+$b)/(2+$y))/$yy,(($r+($y*$g)+$b)/(2+$y))/$yy,(($r+$g+($y*$b))/(2+$y))/$yy,90);   
        //$colors[0]=imagecolorallocatealpha(0,0,0,50);  
        imagefill($img,0,0,$colors[0]);
        
        $limit=0;$q=true;
        while($q){$q=false;
            foreach(sql_array('SELECT x,y,terrain FROM [mpx]map WHERE terrain!=\'t1\' AND ww=\''.$w.'\' LIMIT '.$limit.',500') as $row){
                $q=true;
                list($x,$y,$terrain)=$row;
                $xx=($x-$y)/($mapsize*2)*($width/$kk)+($width/2);
                $yy=($x+$y)/($mapsize*2)*($height/$kk)+(($height-($height/$kk))/2);
                $radius=ceil($s*sqrt(2));
                
                if($terrain and $terrain!='t1'/**/){
                    if(!$colors[$terrain]){
                        list($r,$g,$b)=terraincolor($terrain);
                        $colors[$terrain]=imagecolorallocate($img, $r, $g, $b);   
                    }
                    imagefilledellipse($img, round($xx), round($yy), $radius, ceil($radius/gr), $colors[$terrain]);
                    //imagesetpixel($img, round($xx), round($yy), $colors[$terrain]);
                }
            
            }
            $limit+=500;
        }
        //imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
        imagefilter($img, IMG_FILTER_CONTRAST,-5);
        imagesavealpha($img, true);
        imagepng($img,$outimg);
    }
    return($outimg);
}
//echo('<img src="'.worldmap(200,50,1).'"/>');
//die();
?>
