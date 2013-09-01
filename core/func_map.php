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
//--------level
define('lvl',0);//Zatím je terén vypnutý
define("clvl",35);
define("sun",0.5);
define("sunc",15);

if(lvl){
    define('htmlbgc',60/*-70*/);
    define('htmlunitc',0/*-60-250*/);
}else{
    
    if(logged()){
        define('htmlbgc',60);
        define('htmlunitc',0);
    }else{
        define('htmlbgc',0);
        define('htmlunitc',-60);
    }
}

$GLOBALS['t2lvl']=array(
   't1' =>0,
   't2' =>40,
   't3' =>15,
   't4' =>16,
   't5' =>50,
   't6' =>70,
   't7' =>15,
   't8' =>30,
   't9' =>25,
   't10'=>50,
   't11'=>10,
   't12'=>27,
   't13'=>30
);
$GLOBALS['t2lvlexp']=3;
$GLOBALS['t2rockkk']=2;
//$GLOBALS['rock2lvl']=100;
//---------------------------NENASTAVITELNÉ
define("size",height/212);
//define("size",0.75*(height/375));
define("zoom",5);

define("nob",true);
define("t_",implode(',',array(height,t_brdcc,t_brdcc,t_brdca,t_brdcb,t_pofb,t_sofb,size,zoom,grid,clvl,sun,sunc,lvl)).'-'.implode(',',$GLOBALS['t2lvl']));
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
    $kk=($param=='t2'?$GLOBALS['t2rockkk']:1);
    //$kk=2;
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
                    $dist=pow(pow(abs($tmps2-$ytmp),2)+pow(abs($tmps2-$xtmp),2),1/2);
                    $alpha=$dist/($tmps2*1);
                    if($alpha>1){$alpha=1;}
                    $radiusx=rand($t_brdca,$t_brdcb);
                    $radiusy=rand($t_brdca,$t_brdcb);
                    $rgb = imagecolorat($terrain2, round($xtmp),round($ytmp));
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $a=intval((1-(1-$alpha)*$kk)*127);
                    if($a<1)$a=1;if($a>127)$a=127;
                    $alpha = imagecolorallocatealpha($terrain, $r, $g, $b,$a);
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
/*r(map1('t2'));
exit;

r(map1('t1'));
header("Content-type: image/png");
imagepng(map1('t1'));
exit;*/
//-------------------------------------------------t2rgb
function t2rgb($param=0){
    
    //echo($param);
    if(!$param){$param='t1';}
    
    if(!$GLOBALS['t2rgb'])$GLOBALS['t2rgb']=array();
    
    if(!$GLOBALS['t2rgb'][$param]){

        $tmp=imagecreatefrompng(root."data/image/terrain/$param.png");

        $r=0;$g=0;$b=0;

        for($y=1;$y<imagesy($tmp);$y++){
            for($x=1;$x<imagesx($tmp);$x++){
                 $rgb = imagecolorat($tmp, $x, $y);
                 $rr = ($rgb >> 16) & 0xFF;
                 $gg = ($rgb >> 8) & 0xFF;
                 $bb = $rgb & 0xFF;

                 $q=imagesx($tmp)*imagesy($tmp);

                 $r+=$rr/$q;
                 $g+=$gg/$q;
                 $b+=$bb/$q;


            }
        }

        $r=intval($r);
        $g=intval($g);
        $b=intval($b);
        
        $GLOBALS['t2rgb'][$param]=array($r,$g,$b);
    }
    
    
    return($GLOBALS['t2rgb'][$param]);
}
//echo('>>');
//r(t2rgb());
//exit2();
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
    $GLOBALS['model_resize']=0.75/(0.75*gr);
    model($res,0.75*gr);//1
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
    //--------------------ROCK
     if(substr($res,0,4)=='rock'){
         $file=tmpfile2("model,$res","png","model");
         if(file_exists($file)/** and false/**/){
            $img=imagecreatefrompng($file);
            imagealphablending($img,true);
            imagesavealpha($img,true);
            return($img);
        }else{
            r('create new rock');
            $s=$s*height2/500;
            $img = imagecreatetruecolor($s*200,$s*380);
            $img2 = imagecreatetruecolor($s*200,$s*380);   
            $alpha=  imagecolorallocatealpha($img, 0, 0, 0, 127);
            imagefill($img,0,0,$alpha);
            $alpha=  imagecolorallocatealpha($img2, 0, 0, 0, 127);
            imagefill($img2,0,0,$alpha);
            //imagesavealpha($img2, false);
            imagealphablending($img2, false);
            
            $maxk=5;
            $posuvx=-5;
            $posuvy=-10;
            
            
            $x=0;//0-100
            $y=-50;
            $gr=rand(30,130);
            $lvl=-5;
            $rx=2;
            $ry=2;
            
            $cx=rand(-10,10);
            $cy=rand(-10,-30);
            $vv=rand(1,8)/10;
            
            $shade=  imagecolorallocatealpha($img2, 0, 0, 0,0.85*127);
            
            //$tmpcolors=array();
            $i=50000;while($i>0){$i--;
            
                $xx=($s*100)+($x*$s);
                $yy=($s*330)+($y*$s*0.5);
                
                $dist2=sqrt(pow($x-$cx,2)+pow($y-$cy,2));
                
                $a=(127-$lvl);
                if($a<1)$a=1;if($a>127)$a=127;
                //$a=50;
                //$ii=$gr;
                /*if(!$tmpcolors[$ii]){
                    $tmpcolors[$ii]=  imagecolorallocatealpha($img, $gr, $gr, $gr,$a);
                }
                imagefilledellipse($img, $xx, $yy-$lvl, $rx, $ry, $tmpcolors[$ii]);*/
                
                
                $tmpcolor=  imagecolorallocatealpha($img, round($gr), round($gr), round($gr),$a);
                
                imagefilledellipse($img, $xx+$posuvx, $yy+$posuvy-$lvl, $rx, $ry+($lvl/5), $tmpcolor);
                imagefilledellipse($img2, $xx+$posuvx+($lvl*sqrt(2)*0.4)+4, $yy+$posuvy+($lvl*sqrt(2)*0.1), $rx, $ry+($lvl/5), $shade);
                
                
            
                imagecolordeallocate($img, $tmpcolor);
                
                $px=$x;$py=$y;
                $x+=rand(-1,1);
                $y+=rand(-1,1);
                $gr+=(rand(-1,1)+2*(-$x+$px))/2;
                
                $dist1=sqrt(pow($x-$cx,2)+pow($y-$cy,2));
                
                $distq=$dist1-$dist2;
                
                $tmp=abs($x-$px)*rand(0,10)*-ceil($distq)+$vv;
                if($tmp>$maxk)$tmp=$maxk;if($tmp<-$maxk)$tmp=-$maxk;
                $lvl+=$tmp;
                $rx+=rand(-1,1);
                $ry+=rand(-1,1);
                
                $bounds=80;
                if($dist1>$bounds){$x=$px;$y=$py;}
                //if($x<-$bounds+$rx)$x=-$bounds+$rx;if($x>$bounds-$rx)$x=$bounds-$rx;
                //if($y<-$bounds+$ry)$y=-$bounds+$ry;if($y>$bounds-$ry)$y=$bounds-$ry;
                if($gr<30)$gr=30;if($gr>130)$gr=130;
                if($lvl<-5)$lvl=-5;if($lvl>200)$lvl=200;
                if($rx<2)$rx=2;if($rx>11)$rx=11;
                if($ry<2)$ry=2;if($ry>11)$ry=11;
                
            }
            imagealphablending($img2, true);
            imagecopy($img2, $img,0,0,0,0,imagesx($img2),imagesy($img2));
            
            imagesavealpha($img2, true);
            ImagePng($img2,$file);
            chmod($file,0777);
            return($img2);
        }
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
        r('create new model');
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
        //chmod($file);
        
        
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
//r(model('rock'.rand(0,100000),1,0,1,0));
//die();
//============================================================
//   //======================================================================================polyrand
function polyrand($seed,$amplitude,$periode,$x,$y){

		$detail=11;
                
                $file=tmpfile2('polyrand-'.$seed,'txt','seed');
                //echo($file);
                if(!$GLOBALS/*['ss']*/['polyseed'][$seed]){
                    if(file_exists($file) /**and false/**/){
                            $contents=file_get_contents($file);
                            $GLOBALS/*['ss']*/['polyseed'][$seed]=unserialize($contents);
                    }else{
                    //if(!$GLOBALS/*['ss']*/['polyseed'][$seed]){

                            //foreach(array('x','y') as $dim){
                                    $i=0;while($i<$detail){$i++;
                                            $GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][0]=rand(0,$amplitude*100)/300;//amplituda
                                            $GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][1]=rand($periode*100,$periode*1000)/100;//perioda
                                            $GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][2]=rand(0,$periode*100)/100;//posuv
                                            $GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][3]=rand(0,100)/100;//váha X	
                                            $GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][4]=rand(0,100)/100;//váhaY	
                                    }
                            //}
                            $contents=serialize($GLOBALS/*['ss']*/['polyseed'][$seed]);
                            file_put_contents2($file, $contents);
                    }
                }
		//--------
		//$zx=0;$zy=0;
                //$zdx=0;$zdy=0;
                $z=0;$zd=0;
                
		//foreach(array('x','y') as $dim){
			$i=0;while($i<$detail){$i++;
				$p1=$GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][0];//amplituda
				$p2=$GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][1];//perioda
				$p3=$GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][2];//posuv	
                                $p4=$GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][3];//váha X	
                                $p5=$GLOBALS/*['ss']*/['polyseed'][$seed]/*[$dim]*/[$i][4];//váhaY
                                
                                /*if($dim=='x'){
                                    $zx=$zx+(sin(($x*$p2)+$p3));
                                    $zdx=$zdx+(cos(($x*$p2)+$p3));
                                }else{
                                    $zy=$zy+(sin(($y*$p2)+$p3));
                                    //$zdy=$zdy+(cos(($y*$p2)+$p3));
                                }*/
                                $z=$z+(sin(((($x*$p4)+($y*$p5))*$p2)+$p3)*$p1);
                                $zd=$zd+(cos(((($x*$p4)+($y*$p5))*$p2)+$p3)*$p1);
                                

			}
		//}
                //echo($zy.',');
                //$z=$zx*$zy*$p1;
                //$zd=$zdx*$p1;
                
		//$range=$to-$from;
		
		//$z=intval($z)%$range;
		//$z=$z+$from;
                
                $GLOBALS['dt']=$zd;
		return($z);
	}
//   //======================================================================================rgb2lvl
function rgb2lvl($r,$g,$b){
    //clvl,sunc
    //t2rgb,t2lvl
    $lvl=0;
    $sum=0;
    
    foreach($GLOBALS['t2lvl'] as $t=>$lvl2){
        list($rr,$gg,$bb)=t2rgb($t);
        
        //$gs2=1/(abs($rr-$gg)+abs($gg-$bb)+abs($bb-$rr)+1);
        
        
        $rate=1/(1+pow(pow(abs($r-$rr),$GLOBALS['t2lvlexp'])+pow(abs($g-$gg),$GLOBALS['t2lvlexp'])+pow(abs($b-$bb),$GLOBALS['t2lvlexp']),1/$GLOBALS['t2lvlexp']));
        
        
        
        
        $sum+=$rate;
        $lvl+=$lvl2*$rate;
        
        
    }
    //$gs=1/(abs($r-$g)+abs($g-$b)+abs($b-$r)+0.001);
    //$sum+=$gs;
    //$lvl+=$GLOBALS['rock2lvl']*$gs;
    
    
    $lvl=$lvl/$sum;
    
    
    
    $lvl=intval($lvl);
    
    return($lvl);
}
//----------------------------------------------------------------------------------------------------------------------PROPOJENI
function mapbg($xc,$yc){
    //echo("$xc,$yc");
    define("xx",0);
    define("yy",0);
    //define("top",200*(height/375));
    $t_pofb=t_pofb;
    //---------------------------------
        $size=1;
        $width=height*2;//150*5*(height/375);
        $height=height;//75*5*(height/375);
        $img=imagecreatetruecolor($width,$height*(lvl?(7/5):1));
        //$black=imagecolorallocate($img, 0, 0, 0);
        $white=imagecolorallocate($img, 255, 255, 255);
        imagefill($img,0,0,$white);
        //imageantialias($img, true);
        
        
        //$xc=5*($y+$x)+1;//-(($gy-1)/10)+(($gx-1)/10);
        //$yc=5*($y-$x)+1;//(($gy-1)/10)+(($gx-1)/10);
        $zoom=5;
        $exp=4;
        $pos=4.5;
        $lvlexp=0;
        
        //--------------------
        $data=array();
        for($y=0;$y<($yc+$zoom+$exp+$pos)-($yc-$exp-$pos);$y++){
            $data[$y]=array();
            for($x=0;$x<($xc+$zoom+$exp+$pos)-($xc-$exp-$pos);$x++){
                $data[$y][$x]='t1';  
            }    
        }        
        //--------------------
           
        $array=sql_array("SELECT x,y,terrain from `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]." AND `x`>=".round($xc-$exp-$pos)." AND `y`>=".round($yc-$exp-$pos)." AND `x`<".round($xc+$zoom+$exp+$pos+$lvlexp)." AND `y`<".round($yc+$zoom+$exp+$pos+$lvlexp)." ORDER by `y`,`x`");
        
        
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
        //------------------------------------------ELEVATION
        if(lvl){
            $clvl=-clvl;//-35;
            $stickarea=10;
            $sun=sun;//2;
            $sunc=sunc;//15;
            
            $img2=imagecreatetruecolor($width,$height*(7/5));
            $fill=imagecolorallocatealpha($img2, 0, 0, 0, 127);
            imagefill($img2, 0, 0, $fill);


            for($yy=0;$yy<$height*(6/5);$yy++){
                for($xx=0;$xx<$width;$xx++){

                    //$lvl=rand(-10,10);
                    //$lvl=(sin($xx/17)+sin($yy/17))*10+10;
                    
                    $x=$xc+($xx*5/$width)-2.5+($yy*5/$heigth);
                    $y=$yc-($xx*5/$width)+($yy*5/$heigth);
                    
                    $rgb = imagecolorat($img, $xx, $yy);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    
                    $lvl=rgb2lvl($r,$g,$b);
                    //$lvl=polyrand('lvl',20,1,$x,$y);
                    if($lvl<0)$lvl=0;
                    $dt=$lvl;/*$GLOBALS['dt'];*/
                    

                    $r=$r+(($dt+$clvl+$sunc)*$sun);
                    $g=$g+(($dt+$clvl+$sunc)*$sun);
                    $b=$b+(($dt+$clvl+$sunc)*$sun);
                    if($r<0)$r=0;if($r>255)$r=255;
                    if($g<0)$g=0;if($g>255)$g=255;
                    if($b<0)$b=0;if($b>255)$b=255;
                    
                    if($yy-$lvl-$clvl>$stickarea){
                        $tmpcolor=imagecolorallocate($img2, $r, $g, $b);
                    }else{
                        $a=intval(127*(1-($yy/$stickarea)));
                        if($a<0)$a=0;if($a>127)$a=127;
                        $tmpcolor=imagecolorallocatealpha($img2, $r, $g, $b,$a);
                    }

                    
                    imagefilledellipse($img2, $xx,  $yy-$lvl-$clvl+50, 5, 100, $tmpcolor);
                    
                    //imageline($img2, $xx, $yy-$lvl-$clvl, $xx, $yy-$lvl+100+$clvl, $tmpcolor);
                    imagecolordeallocate($img2, $tmpcolor);
                }
            }

            imagesavealpha($img2,true);
            return($img2);
        }else{
            return($img);
        }
}


/*r(mapbg(20,5));
r(mapbg(25,0));
r(mapbg(30,-5));
die();
/*br();
?>

<div style="position: absolute;">
<div style="position: relative;top:<?php e(-clvl-(height/5)); ?>px;">

<?php r(mapbg(25,10)); ?>
</div>
</div>


<?php

die();
 * */

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
function htmlmap($gx=false,$gy=false,$w=0,$only=false,$row=1/*$width=424*/){
            //$gx=-10;            
            //$gy=0;
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
            if($w!=2)$outimg=tmpfile2("outimgbg,".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,/*lvl?'png':*/"jpg","mapbg");
			if($w!=1)$outimgunits=tmpfile2("outimgunits".$gx.",".$gy.",".$GLOBALS['ss']["ww"].','.t_,"png","mapunits");

            if($w==1 and $only)return($outimg);
            if($w==2 and $only)return($outimgunits);
            
            $border=0;
            $html='';
            //======================================================BACKGROUND
            if($w!=2){
            if(!file_exists($outimg)/** or 1/**/){if(debug)$border=3;
                r('generate new bg');
                
                $x=($gy+$gx)*5+1-5;
                $y=($gy-$gx)*5+1-5;
                
                
                
                $img1=mapbg($x,$y/*,"x".$gx."y".$gy*/);
                $img2=mapbg($x+5,$y+5/*,"x".$gx."y".$gy*/);

                
                $img=imagecreatetruecolor(imagesx($img1), round($width/424*212));
                
                $posuvy=0;
                imagecopy($img, $img1, 0, imagesy($img)*(-1/5)+$posuvy, 0, 0, imagesx($img1), imagesy($img1));
                imagecopy($img, $img2, 0, imagesy($img)*(4/5)+$posuvy, 0, 0, imagesx($img1), imagesy($img2));
//                imagefilter($img, IMG_FILTER_COLORIZE,9,0,5);
//                imagefilter($img, IMG_FILTER_CONTRAST,-10);
//                $emboss = array(array(0, 0.05, 0), array(0.05, 0.8,0.05), array(0, 0.05, 0));
//                imageconvolution($img, $emboss, 1, 0);
            
                /*if(lvl){
                    imagesavealpha($img,true);
                    imagepng($img,$outimg);
                }else{*/
                    imagejpeg($img,$outimg,95);
                //}
                chmod($outimg,0777);
                ImageDestroy($img);
            }
            //-----------------------
            if(lvl){
                //$row=1;
                //$clvla='<span style="position: relative;top:'.(htmlbgc+(-clvl-(height/5))*$row).'px;">';
                //$clvlb='</span>';
                //$clvlh=6/5;
                $clvla='';$clvlb='';
                $clvlh=1;
            }else{
                $clvla='';$clvlb='';
                $clvlh=1;
            }
            //-----------------------
            
            $datastream=rebase(url.base.str_replace('../','',$outimg).'?'.filemtime($outimg));
            //$datastream='data:image/png;base64,'.base64_encode(file_get_contents($outimg));
            if($w==0)$html.=$clvla.'<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212*$clvlh)).'" style="z-index:1;" "/>'.$clvlb;//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
            else     $html.=$clvla.'<img src="'.$datastream.'" width="'.$width.'" height="'.(round($width/424*212*$clvlh)).'" />'.$clvlb;            
            }
            //======================================================UNITS
            if($w!=1){
            if(!file_exists($outimgunits)/** or 1/**/){if(debug)$border=3;
                r('generate new units');
            
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
                if($w==0)$html.='<span style="position:absolute;width:0px;z-index:2;"><img src="'.$datastream.'" style="position:relative;left:-'.($width+htmlunitc).'px;z-index:2;" class="clickmap" width="'.$width.'" height="'.(round($width/424*212)).'" border="'.$border.'"/></span>';//class="clickmap"   usemap="#x'.$gx.'y'.$gy.'"
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
//htmlmap(-3,2);
//br();
/*htmlmap(-3,3);
//htmlmap(-2,3);
br();
htmlmap(-3,4);
//htmlmap(-2,4);
die();*/
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
        //-------------------------------------------------------
        if($worldmap_red){
            $red=imagecolorallocate($img, 255,0,0);   
            foreach($worldmap_red as $row){
                list($x,$y)=$row;
                $xx=($x-$y)/($mapsize*2)*($width/$kk)+($width/2);
                $yy=($x+$y)/($mapsize*2)*($height/$kk)+(($height-($height/$kk))/2);
                imagefilledellipse($img, round($xx), round($yy), $radius, ceil($radius/gr), $red);
            }
        }
        //-------------------------------------------------------
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
