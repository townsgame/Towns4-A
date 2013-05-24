<?php
backup($GLOBALS['where'],"1");
//r($GLOBALS['where']);
$order="fs";
$max=sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE ".$GLOBALS['where']);
//echo($max);
$limit=limit("stat",$GLOBALS['where'],17,$max);
$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`own`,`in`,`x`,`y`,`ww` FROM `".mpx."objects` WHERE ".$GLOBALS['where']." ORDER BY $order DESC LIMIT $limit");
//r($limit);
//fs2lvl
?>
<table width="100%">
<tr>
<td width="20">#</td>
<td width="50">ID</td>
<td width="150">jméno</td>
<td width="80">Poloha</td>
<td width="80">Život</td>
<td width="30"><span title="Level">L.</span></td>
<td>Akce</td>
</tr>

<?php
/**/
$i=$GLOBALS['ss']['ord'];
foreach($array as $row){$i++;
    list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$own,$in,$x,$y,$ww)=$row;
    $hline=ahrefr(textcolorr(lr($type),$dev)." ".tr($name,true),"e=content;ee=profile;id=$id","none","x");
    $in=xyr($x,$y);
    $lvl=fs2lvl($fs);
    if($fp==$fs){
        $fpfs=round($fs);
    }else{
        $fpfs=round($fp).'/'.round($fs);
    }
    echo("<tr>
    <td>$i</td>
    <td>$id</td>
    <td>$hline</td>
    <td>$in</td>
     <td>$fpfs</td>
    <td>$lvl</td>
    <td>");
    if($ww==0){
	$js="w_close('window_unique');build('$id');";
        icon(js2($js),"f_create_building_submit","{build_submit}",15);
    }
    e("</td>
    </tr>");
    //r($row);
}/**/

?>

</table>
