<h3>CreateGlob</h3>
Vykreslení celé mapy do jednoho obrázku<br/>
<b>Upozornění: </b>Tuto funkci spouštějte až po vygenerování všech pomocných podkladů!<br/>
<b>Upozornění: </b>Tuto funkci spouštějte až po "opravě mapy", nevypálené budovy se nebudou zpracovávat!<br/>
<b>Upozornění: </b>Tento proces může trvat i několik minut.<br/>
<b>Upozornění: </b>Bude přemazán soubor <?php echo(adminroot); ?>files/<?php e(w); ?>_glob.png.<br/>
<a href="?create=1">Vygenerovat</a>
<?php
//error_reporting(E_ALL);
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
        
	
	$file1=htmlmap($x,$y,1,true);
	$file2=htmlmap($x,$y,2,true);
	//r($file2);
	//$file=tmpfile2("outimg,".size.",".zoom.",".$x.",".$y.",".w.",".gird.",".t_sofb.",".t_pofb.",".t_brdcc.",".t_brdca.",".t_brdcb.','.$GLOBALS['ss']["ww"],'jpg','map');
	
        //die($file."aaa<br>");
        //$file=file_get_contents($file);

	$posuv=htmlunitc-htmlbgc;
	foreach(array(array($file1,0),array($file2,$posuv)) as $tmp){list($file,$posuv)=$tmp;
        	$part=imagecreatefromstring(file_get_contents($file));
        	imagecopyresampled ($img,$part,(($x*$size)+(imagesx($img)/2)-($size/2)),  ($y*$size*0.5)+$posuv , 0 , 0 ,  $size ,  $size*0.5+1 , imagesx($part),imagesy($part) /*$size ,  $size*0.5 */);
        	imagedestroy($part);
	}
        /*width="<? echo(ceil($size)); ?>" border="0" style="position: absolute;top:<? echo($y*$size*0.5); ?>px;left:<? echo(($x*$size)+($screen/2)-($size/2)); ?>px;"/>*/
    }
}
/*header("Content-type: image/png");
imagepng($img);*/
//r($img);
imagepng($img,adminroot.'files/'.w.'_glob.png');
chmod(adminroot.'files/'.w.'_glob.png',0777);
imagedestroy($img);
echo('<br/><b>uloženo do '.adminroot.'files/'.w.'_glob.png</b>');
}
?>
