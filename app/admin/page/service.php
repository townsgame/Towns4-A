<h3>Správa sv&#283;ta <?php echo(w); ?> </h3>

<?php

//smazání prázdných uživatelů:
//SELECT * FROM small_objects WHERE type='user' AND t<1470566888
if($_GET['add']){

	$count_tree=intval(sql_1data("SELECT COUNT(1) FROM small_objects WHERE type='tree' AND ww='".$GLOBALS['ss']["ww"]."'"));
	$count_tree=round(mapsize*mapsize*tree_count)-$count_tree;
	
	while($count_tree){$count_tree--;
	$x=rand(-100,100)/50;
	$y=rand(-100,100)/50;
	$nextid=nextid();
	$keys1="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`, `own`, `in`, `ww`, `x`, `y`, `t`";
	$keys2="".$nextid.", '{tree}', `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`,0, `in`, ".$GLOBALS['ss']["ww"].", `x`+$x, `y`+$y, ".time()."";
	sql_query("INSERT INTO `[mpx]objects` ($keys1) 
SELECT $keys2 FROM `[mpx]objects` WHERE type='tree' ORDER BY RAND() LIMIT 1");
	$array=sql_array("SELECT x,y FROM [mpx]objects WHERE id='$nextid'");
	list($x,$y)=$array[0];
    changemap($x,$y,true);
	}
//-----------------------------------

	$count_rock=intval(sql_1data("SELECT COUNT(1) FROM small_objects WHERE type='rock' AND ww='".$GLOBALS['ss']["ww"]."'"));
	$count_rock=round(mapsize*mapsize*rock_count)-$count_rock;
	
	while($count_rock){$count_rock--;
	$x=rand(-100,100)/100;
	$y=rand(-100,100)/100;
	$nextid=nextid();
	$keys1="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`, `own`, `in`, `ww`, `x`, `y`, `t`";
	$keys2="".$nextid.", '{rock}', `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `expand`,0, `in`, ".$GLOBALS['ss']["ww"].", `x`+$x, `y`+$y, ".time()."";
	sql_query("INSERT INTO `[mpx]objects` ($keys1) 
SELECT $keys2 FROM `[mpx]objects` WHERE type='rock' ORDER BY RAND() LIMIT 1");
	$array=sql_array("SELECT x,y FROM [mpx]objects WHERE id='$nextid'");
	list($x,$y)=$array[0];
    changemap($x,$y,true);
	}


}

$count_tree=intval(sql_1data("SELECT COUNT(1) FROM small_objects WHERE type='tree' AND ww='".$GLOBALS['ss']["ww"]."'"));
$count_rock=intval(sql_1data("SELECT COUNT(1) FROM small_objects WHERE type='rock' AND ww='".$GLOBALS['ss']["ww"]."'"));
$count_tree_=round(mapsize*mapsize*tree_count);
$count_rock_=round(mapsize*mapsize*rock_count);

echo('<b>tree:</b> '.$count_tree.' / '.$count_tree_);br();
echo('<b>rock:</b> '.$count_rock.' / '.$count_rock_);br();



?>

<a href="?add=1">add++</a>
