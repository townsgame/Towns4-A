<?php
backup($GLOBALS['stattype'],"buildings");

if($GLOBALS['stattype']=='buildings'){
    $GLOBALS['where']="type='building' AND ww!=0 AND ww!=-1 ";
}elseif($GLOBALS['stattype']=='towns'){
    $GLOBALS['where']="type='town' AND ww!=0 AND ww!=-1 ";
    $ad1='SELECT count(1) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'building\'';
    $ad2='SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'building\'';
    $order="ad2";
}elseif($GLOBALS['stattype']=='users'){
    $GLOBALS['where']="type='user' AND ww!=0 AND ww!=-1 ";
    $ad3='SELECT count(1) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'town\'';
    $ad1='SELECT count(1) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
    $ad2='SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
    
    $order="ad2";
}
if($ad1)$ad1=',('.$ad1.') as ad1';
if($ad2)$ad2=',('.$ad2.') as ad2';
if($ad3)$ad3=',('.$ad3.') as ad3';
if(!$order)$order="fs";

//r($GLOBALS['where']);

$max=sql_1data("SELECT COUNT(1) FROM `".mpx."objects` WHERE ".$GLOBALS['where']);
//echo($max);
$limit=limit("stat",$GLOBALS['where'],16,$max);


$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`own`,`in`,`x`,`y`,`ww`$ad1$ad2$ad3 FROM `".mpx."objects` WHERE ".$GLOBALS['where']." ORDER BY $order DESC LIMIT $limit");
//r($limit);
//fs2lvl
?>
<table width="100%">
<tr>
<td width="20">#</td>
<td width="50">ID</td>
<td width="150">jméno</td>
<?php if($GLOBALS['stattype']!='users'){ ?>
<td width="80">Poloha</td>
<?php }else{ ?>
<td width="30"><span title="Počet měst">M.</span></td>
<?php } ?>
<?php if($GLOBALS['stattype']=='buildings'){ ?>
<td width="80">Život</td>
<?php }else{ ?>
<td width="30"><span title="Počet budov">B.</span></td>
<?php } ?>
<td width="30"><span title="Level">L.</span></td>
<td>Akce</td>
</tr>

<?php
/**/
$i=$GLOBALS['ss']['ord'];
foreach($array as $row){$i++;
    list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$own,$in,$x,$y,$ww,$ad1,$ad2,$ad3)=$row;
    $hline=ahrefr(/*textcolorr(lr($type),$dev)." ".*/tr(short($name,20),true),"e=content;ee=profile;id=$id","none","x");
    
    if($GLOBALS['stattype']=='buildings'){
        $in=xyr($x,$y,$ww);
        $lvl=fs2lvl($fs);
        if($fp==$fs){
            $fpfs=round($fs);
        }else{
            $fpfs=round($fp).'/'.round($fs);
        }
    }elseif($GLOBALS['stattype']=='towns'){
        $in=xyr($x,$y,$ww);
        $lvl=fs2lvl($ad2);
        $fpfs=$ad1;
    }elseif($GLOBALS['stattype']=='users'){
        $lvl=fs2lvl($ad2);
        $fpfs=$ad1;
    }

    e("<tr>
    <td>$i</td>
    <td>$id</td>
    <td>$hline</td>");
    if($GLOBALS['stattype']!='users'){
        e("<td>$in</td>");
    }else{
        e("<td>$ad3</td>");
    }        
        
     e("<td>$fpfs</td>
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
