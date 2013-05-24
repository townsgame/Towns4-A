<?php
$all='';
foreach(sql_array('SELECT id,name FROM '.mpx.'objects WHERE ww=0') as $row){list($id,$name)=$row;
	echo("$name($id)<br/>");
	$all.=$id.',';
}
echo('<hr/>'.$all);
?>
