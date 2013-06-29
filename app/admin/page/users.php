<h3>Uživatelé</h3>

<a href="?delete=alles">Smazat vše nologin+1day+11</a>
<?php
function deleteuser($id,$show=1){
      $array=sql_array('SELECT id FROM [mpx]objects WHERE `own`='.$id);
      foreach($array as $row){
         deleteuser($row[0],$show);  
      }
      sql_query('DELETE FROM [mpx]objects WHERE id='.$id,$show);
      sql_query('DELETE FROM [mpx]login WHERE id='.$id,$show);
      sql_query('DELETE FROM [mpx]text WHERE to='.$id,$show);
}


if($_GET['delete'] and $_GET['delete']!='alles'){
   deleteuser($_GET['delete']);
}


$where="type='user' AND ww!=0 AND ww!=-1 ";
$ad1='SELECT count(1) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
$ad2='SELECT sum(x.fs) FROM [mpx]objects as x WHERE x.own=(SELECT y.id FROM [mpx]objects as y WHERE y.own=[mpx]objects.id LIMIT 1) AND type=\'building\'';
$ad3='SELECT count(1) FROM [mpx]objects as x WHERE x.own=[mpx]objects.id AND type=\'town\'';
$ad4='SELECT count(1) FROM [mpx]login as x WHERE x.id=[mpx]objects.id';
$ad1=',('.$ad1.') as ad1';
$ad2=',('.$ad2.') as ad2';
$ad3=',('.$ad3.') as ad3';
$ad4=',('.$ad4.') as ad4';
$order="ad4 DESC, ad2 DESC";

$array=sql_array("SELECT `id`,`name`,`type`,`dev`,`fs`,`fp`,`fr`,`fx`,`own`,`in`,`x`,`y`,`t`,`ww`$ad1$ad2$ad3$ad4 FROM `".mpx."objects` WHERE ".$where." ORDER BY $order");

e('<table width="100%" border="1">');

e('<tr>');
e('<td>id</td>');
e('<td>jméno</td>');
e('<td>login</td>');
e('<td>čas</td>');
e('<td>Měst</td>');
e('<td>Budov</td>');
e('<td>lvl</td>');
e('<td>akce</td>');
e('</tr>');   
   

foreach($array as $row){
   list($id,$name,$type,$dev,$fs,$fp,$fr,$fx,$own,$in,$x,$y,$t,$ww,$ad1,$ad2,$ad3,$ad4)=$row;
   $lvl=fs2lvl($ad2);   
   
   e('<tr>');
   e('<td>'.$id.'</td>');
   e('<td>'.$name.'</td>');
   e('<td>'.$ad4.'</td>');
   e('<td>'.timer($t).'</td>');
   e('<td>'.$ad3.'</td>');
   e('<td>'.$ad1.'</td>');
   e('<td>'.$lvl.'</td>');
      
   if($_GET['delete']=='alles' and (($t<time()-(3600*24)) and (!$ad4) and($ad3==1 and $ad1==1))){
      e('<td><b>smazáno</b></td>');
      deleteuser($id,0);
   }else{
      e('<td><a href="?delete='.$id.'">smazat</a></td>');
   }
   e('</tr>');
}
e('</table>');
?>
