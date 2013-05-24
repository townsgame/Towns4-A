<h3>CreateGlob</h3>
Vykreslení celé mapy do jednoho obrázku<br/>
<b>Upozornění: </b>Tuto funkci spouštějte až po vygenerování všech pomocných podkladů!<br/>
<b>Upozornění: </b>Tento proces může trvat i několik minut.<br/>
<b>Upozornění: </b>Bude přemazán soubor files/<?php e(w); ?>.png.<br/>
<a href="?create=1">Vygenerovat</a>
<?php
ini_set("max_execution_time","1000");
require2("/func_map.php");
//---------------------

if($_GET['create']){


$mapsize=mapsize;
$size=424;//424
$ym=$mapsize/5-1;
$xm=ceil(($mapsize/5-1)/2);
//echo("imagecreate(($xm+$xm+1)*$size,$xm*$size*0.5);");
$img=imagecreatetruecolor(($xm+$xm+1)*$size,($ym+1)*$size*0.5);
for($y=0; $y<=$ym; $y++){
    for ($x=-$xm; $x<=$xm; $x++) {
        
	
	$file=tmpfile2("outimg,".size.",".zoom.",".$x.",".$y.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"],'jpg','map');
	
        //die($file."aaa<br>");
        //$file=file_get_contents($file);
        $part=imagecreatefromjpeg($file);
        imagecopyresampled ($img,$part,(($x*$size)+(imagesx($img)/2)-($size/2)),  ($y*$size*0.5) , 0 , 0 ,  $size ,  $size*0.5+1 , $size ,  $size*0.5 );
        imagedestroy($part);
        /*width="<? echo(ceil($size)); ?>" border="0" style="position: absolute;top:<? echo($y*$size*0.5); ?>px;left:<? echo(($x*$size)+($screen/2)-($size/2)); ?>px;"/>*/
    }
}
/*header("Content-type: image/png");
imagepng($img);*/
imagepng($img,'files/'.w.'.png');
chmod('files/'.w.'.png',0777);
imagedestroy($img);
echo('<br/><b>uloženo do files/'.w.'.png</b>');
}
?>
