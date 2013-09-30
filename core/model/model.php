<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/model/model.php

   Tento soubor slouží k vykreslování 3D modelů - je vyvolávaný souborem func_map.php.
*/
//==============================




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
    //--------------------------------------------------------------------------MULTIMODEL
    if(substr($res,0,1)=='{'){    
        $res=substr($res,1);
        $res=explode('}',$res,1);
        $res=$res[0];
    }
    //--------------------------------------------------------------------------ROCK
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
        //----------------------------------------------------------------------TREE
     if(substr($res,0,4)=='tree'){
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
            $gr=0;//rand(30,130);
            $lvl=0;
            $rx=rand(5,10);
            $ry=rand(5,10);
            $parts=50000;
            
            $cd=30;$cd2=20;
            $ra=120+rand(-$cd,$cd);$rb=20+rand(-$cd,$cd);
            $ga=50+rand(-$cd,$cd);$gb=160+rand(-$cd,$cd);
            $ba=20+rand(-$cd,$cd);$bb=50+rand(-$cd,$cd);
            
            
            $cx=rand(-10,10);
            $cy=rand(-10,-30);
            $vv=rand(1,8)/10;
            $ss=rand(15,30)/100;
            $tt=rand(7,20)/10;
                    
            $shade=  imagecolorallocatealpha($img2, 0, 0, 0,0.85*127);
            
            //$tmpcolors=array();
            
            $i=$parts;while($i>0){$i--;
            
                $xx=($s*100)+($x*$s*$ss);
                $yy=($s*330)+($y*$s*0.5*$ss);
                
                $dist2=sqrt(pow($x-$cx,2)+pow($y-$cy,2));
                
                $a=(127-($lvl/2));
                if($a<1)$a=1;if($a>127)$a=127;
                //$a=50;
                //$ii=$gr;
                /*if(!$tmpcolors[$ii]){
                    $tmpcolors[$ii]=  imagecolorallocatealpha($img, $gr, $gr, $gr,$a);
                }
                imagefilledellipse($img, $xx, $yy-$lvl, $rx, $ry, $tmpcolors[$ii]);*/
                
                $r=$ra+($gr*($rb-$ra));
                $g=$ga+($gr*($gb-$ga));
                $b=$ba+($gr*($bb-$ba));
                $r+=rand(-$cd2,$cd2);
                $g+=rand(-$cd2,$cd2);
                $b+=rand(-$cd2,$cd2);
                if($r<0)$r=0;if($r>255)$r=255;
                if($g<0)$g=0;if($g>255)$g=255;
                if($b<0)$b=0;if($b>255)$b=255;
                
                $tmpcolor=  imagecolorallocatealpha($img, round($r), round($g), round($b),$a);
                
                imagefilledellipse($img, $xx+$posuvx, $yy+$posuvy-($lvl*$ss), $rx, $ry+(($lvl*$ss)/5), $tmpcolor);
                imagefilledellipse($img2, $xx+$posuvx+($lvl*$ss*sqrt(2)*0.4)+4, $yy+$posuvy+($lvl*$ss*sqrt(2)*0.1), $rx, $ry+(($lvl*$ss)/5), $shade);
                
                
            
                imagecolordeallocate($img, $tmpcolor);
                
                $px=$x;$py=$y;
                $x+=rand(-1,1);
                $y+=rand(-1,1);
                $gr+=1/$parts;
                
                $dist1=sqrt(pow($x-$cx,2)+pow($y-$cy,2));
                
                $distq=$dist1-$dist2;
                
                $tmp=abs($x-$px)*rand(0,10)*-ceil($distq)+$vv;
                if($tmp>$maxk)$tmp=$maxk;if($tmp<-$maxk)$tmp=-$maxk;
                $lvl+=$tmp+$tt;
                $rx+=rand(-1,1);
                $ry+=rand(-1,1);
                
                $bounds=80;
                if($dist1>$bounds){$x=$px;$y=$py;}
                //if($x<-$bounds+$rx)$x=-$bounds+$rx;if($x>$bounds-$rx)$x=$bounds-$rx;
                //if($y<-$bounds+$ry)$y=-$bounds+$ry;if($y>$bounds-$ry)$y=$bounds-$ry;
                //if($gr<30)$gr=30;if($gr>130)$gr=130;
                if($lvl<-5)$lvl=-5;if($lvl>200)$lvl=200;
                if($rx<2)$rx=2;if($rx>7)$rx=7;
                if($ry<2)$ry=2;if($ry>7)$ry=7;
                
            }
            imagealphablending($img2, true);
            imagecopy($img2, $img,0,0,0,0,imagesx($img2),imagesy($img2));
            
            imagesavealpha($img2, true);
            ImagePng($img2,$file);
            chmod($file,0777);
            return($img2);
        }
    }
    //--------------------------------------------------------------------------NORES - POKUD $res NENí MODEL
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
    //--------------------------------------------------------------------------3D MODEL
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
//============================================================
//$res,$s=1,$rot=0,$slnko=1,$ciary=1,$zburane=0,$hore=0
//r(model(res,1,0,1,0));
//r(model('rock'.rand(0,100000),1,0,1,0));
//r(model('tree'.rand(0,100000),1,0,1,0));
//die();
//============================================================
?>
