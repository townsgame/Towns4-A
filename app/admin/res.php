<?php
function file_put_contents2($file,$contents){
    //echo($file)url;
    //if(file_exists($file)){file_put_contents($file,"");}
    $fh = fopen($file, 'w');
    fwrite($fh, $contents);
    fclose($fh);
    chmod($file,0777);
}
//--------------------------------------------
if(!file_exists('password') or ($_POST["password_new"] and $_POST["password_new"]==trim(file_get_contents('password')))){
		
if($_POST['contents']){
	echo('<b>změněno</b><br/>');
	file_put_contents2('../../bin/towns.php',$_POST['contents']);
	}
}
?>
