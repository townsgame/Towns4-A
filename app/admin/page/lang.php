<?php ob_end_flush(); ?>
<h3>Lang </h3>
<?php
if($_POST['contents']){
	echo('<b>změněno</b><br/>');
	$contents=file_put_contents2(root.'data/lang/cz.txt',$_POST['contents']);
}
$contents=file_get_contents(root.'data/lang/cz.txt');
$contents=htmlspecialchars($contents);
?>

<form id="form1" name="form1" method="post" action="">
<textarea name="contents" style="width: 90%;height: 70%;">
<?php echo($contents); ?> 
</textarea><br/>
<input type="submit" name="Submit" value="Změnit" />
</form>
