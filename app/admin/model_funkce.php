<?php
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
//---------------------------------------------------------------------------------
function model($res,$s,$rot,$slnko,$ciary=1,$zburane=0,$hore=0){
//$ciary=0;
//$slnko=1.5;
//---------------------------------------------------------------------------------
$res=str_replace("::",":1,1,1:",$res);
$tmp=split(":",$res);
$points=$tmp[0];
$polygons=$tmp[1];
$colors=/*split(",",)*/$tmp[2];
//---------------------------colors
$colors=split(",",$colors);
//---------------------------rozklad bodu
$points=substr($points,1,strlen($points)-2); 
$points=split("]",$points); 
$i=-1;
foreach($points as $tmp){
$i=$i+1; 
$points[$i]=str_replace("[","",$points[$i]);
$points[$i]=split(",",$points[$i]);
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
$polygons=split(";",$polygons);
$i=-1;
foreach($polygons as $tmp){
$i=$i+1;
$polygons[$i]=split(",",$polygons[$i]);
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
$polygons[$x]=split("_",$polygons[$x]);
$polygons[$x]=split(",",($polygons[$x][1]));
}
//---------------------------vykresleni
if($hore!=1){
$GLOBALS['ss']["im"] = imagecreate($s*200,$s*380);
}else{
$GLOBALS['ss']["im"] = imagecreate($s*150,$s*150);
}
$GLOBALS['ss']["bg"] = imagecolorallocatealpha($GLOBALS['ss']["im"],0,0,0,127);
$cierne = imagecolorallocate($GLOBALS['ss']["im"],0,0,0);
ImageFill($GLOBALS['ss']["im"],0,0,$GLOBALS['ss']["bg"]);
//$bg = imagecolorallocatealpha($im,0,0,0,127);
//ImageFill($im,0,0,$bg);
//---
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
$rand=($rand*30*$slnko)-20;
//----------------------
$red=hexdec(substr($color,0,2))+$rand;
$green=hexdec(substr($color,2,2))+$rand;
$blue=hexdec(substr($color,4,2))+$rand;
if($red>255){$red=255;}if($red<0){$red=0;}
if($green>255){$green=255;}if($green<0){$green=0;}
if($blue>255){$blue=255;}if($blue<0){$blue=0;}
$nejmcolor="color".rand(1000,9999);
$$nejmcolor = imagecolorallocate($GLOBALS['ss']["im"],$red,$green,$blue);
imagefilledpolygon($GLOBALS['ss']["im"],$tmppoints,count($tmppoints)/2,$$nejmcolor);
if($ciary==1){imagepolygon($GLOBALS['ss']["im"],$tmppoints,count($tmppoints)/2,$cierne);}
}
//---
/*header("Cache-Control: max-age=3600");
header("Content-type: image/png");
ImagePng($GLOBALS['ss']["im"]);
ImageDestroy($GLOBALS['ss']["im"]);*/
//---
if(!$ciary)$GLOBALS['ss']["im"]=paint($GLOBALS['ss']["im"]);
}
?>
