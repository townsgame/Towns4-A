<h3>PatchMap</h3>
"Vypálení" modelů na mapový podklad<br/>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
ini_set("max_execution_time","1000");
//==========================================
if($_GET['start']){
echo('<hr>');
//require2('func_vals.php');
foreach(sql_array('SELECT id,`set`,x,y FROM '.mpx.'objects WHERE `type`=\'building\'') as $row){list($id,$set,$x,$y)=$row;
	$set=new vals($set);
	$set=$set->vals2list();
	if($set['x']=='x' or $set[0]=='x' or $set['x']=='0'){
		echo($id.'<br/>');
		sql_query('UPDATE '.mpx.'objects SET `set`=\'\' WHERE id='.$id);
		changemap($x,$y);
	}
}
		echo('<script language="javascript">
    window.location.replace("?world='.w.'&page=createtmp&start=1");
    </script>');
}
?>
<a href="?page=patchmap&start=1">Spustit</a>
