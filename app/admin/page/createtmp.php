<h3>CreateTmp</h3>
Vygenerování všech pomocných podkladů, 2D bloků, 3D bloků, modelů, přípravných a finálních obrázků na mapě<br/>
<b>Upozornění: </b>Celý tento proces může trvat i několik hodin.<br/>
<b>Upozornění: </b>Na začátku je vhodné vizuálně zkontrolovat generované výstupy.<br/>

<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
ini_set("max_execution_time","1000");
require2("/func_map.php");
$time=time();
//---------------------
//sleep(1);
$mapsize=mapsize;
$ym=$mapsize/5;//-1;
$xm=ceil(($mapsize/5-1)/2);

$x=$_GET["x"];//6;
$y=$_GET["y"];//16;
if(!isset($x))$x=-$xm;
if(!isset($y))$y=0;

$actual=(($xm+$xm+1)*($y))+$x+$xm+1;
$total=($xm+$xm+1)*($ym+1);
$percent=intval($actual/$total*100);

echo("<h2>$percent% ($actual/$total)</h2>");
echo("<b>[$x,$y]</b><br>");
//echo("<table border=\"1\" width=\"424\" height=\"211\"><tr><td>");
htmlmap($x,$y);
//echo("</tr></td></table>");
echo("<br/>");
$time=time()+((time()-$time)*($total-$actual));
timece($time);
echo("<br/>");

$nx=$x+1;$ny=$y;
if($nx>$xm){$nx=-$xm;$ny++;}
if($ny>$ym){
echo("<b>hotovo</b><br>");
echo("<a href=\"?world=".w."\">znovu</a>");
}else{
echo("loading: $nx,$ny<br/>");
echo("<a href=\"?world=".w."\">znovu</a><br/>");
if($actual!=1 or $_GET["start"]){
echo("<a href=\"?x=$nx&amp;y=$ny&amp;world=".w."\">next</a><br/>");
echo('<script language="javascript">
    window.location.replace("?x='.$nx.'&y='.$ny.'&world='.w.'");
    </script>');/**/
}else{
echo("<a href=\"?x=$nx&amp;y=$ny&amp;world=".w."\"><h3>start</h3></a><br/>");
}
}




//---------------------

/*$mapsize=5;
$size=750;
$ym=$mapsize/5-1;
$xm=ceil(($mapsize/5-1)/2);
//echo("imagecreate(($xm+$xm+1)*$size,$xm*$size*0.5);");
$img=imagecreatetruecolor(($xm+$xm+1)*$size,($ym+1)*$size*0.5);
for($y=0; $y<=$ym; $y++){
    for ($x=-$xm; $x<=$xm; $x++) {
        $file="http://localhost/4/?e=map_image&x=$x&y=$y";
        //echo($file."<br>");
        //$file=file_get_contents($file);
        $part=imagecreatefrompng($file);
        imagecopyresampled ($img,$part,(($x*$size)+(imagesx($img)/2)-($size/2)),  ($y*$size*0.5) , 0 , 0 ,  $size ,  $size*0.5 , $size ,  $size*0.5 );
        imagedestroy($part);
     }
}
header("Content-type: image/png");
imagepng($img);
imagepng($img,"glob.png");
chmod("glob.png",0777);
imagedestroy($img);*/
?>
