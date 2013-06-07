<?php
require_once(root.core."/func_map.php");
backup($GLOBALS['where'],"1");
//r($GLOBALS['where']);
$order="fs";
$max=sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE ".$GLOBALS['where']);
//echo($max);
$limit=limit("stat2",$GLOBALS['where'],102,$max);


$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`fc`,`res`,`own`,`in`,`x`,`y`,`ww` FROM `".mpx."objects` WHERE ".$GLOBALS['where']." ORDER BY $order DESC LIMIT $limit");

contenu_a();

?>
<table width="<?php e(contentwidth); ?>"><tr>

<?php
/**/
$i=$GLOBALS['ss']['ord'];
$onrow=3;
$ii=$onrow;
foreach($array as $row){$i++;$ii--;
    list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$fc,$res,$own,$in,$x,$y,$ww)=$row;
    /*$hline=ahrefr(textcolorr(lr($type),$dev)." ".tr($name,true),"e=content;ee=profile;id=$id","none","x");
    $in=xyr($x,$y);
    $lvl=fs2lvl($fs);
    if($fp==$fs){
        $fpfs=round($fs);
    }else{
        $fpfs=round($fp).'/'.round($fs);
    }*/
    e('<td>');
    //e($i);
    $js="w_close('content');build('".$GLOBALS['ss']['master']."$master','$id','".$GLOBALS['get']['func']."');";
    ahref('<img src="'.modelx($res).'" width="'.(70*0.75).'">',js2($js),'none',true);
    e('</td>');
    e('<td>');
    //e($i);
    ahref($name,'e=content;ee=profile;id='.$id,'none',true);
    showhold($fc);
    e('</td>');
    if($ii==0){e('</tr><tr>');$ii=$onrow;}
    /*if($ww==0){
	;
        icon(js2($js),"f_create_building_submit","{build_submit}",15);
    }*/
    
}/**/
while($ii>0){$ii--;
    e('<td>&nbsp;</td>');
    e('<td>&nbsp;</td>');
}
?>

</tr></table>
<?php
contenu_b();
?>
