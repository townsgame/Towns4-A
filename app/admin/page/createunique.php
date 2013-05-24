<h3>Object</h3>
Tato funkce slouží k vytvoření stavebních plánů.<br/>
<b>Upozornění: </b>Tato funkce může při nesprávném použití poškodit nultý podsvět!<br />
<b>Upozornění: </b>Tento proces může trvat i několik minut.<br/>
<form id="form1" name="form1" method="post" action="">
<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Soubor:</strong></td>

    <td><label>
      <?php echo(adminroot); ?>objects/<input name="filename" type="text" id="filename" value="models.txt" />
    </label></td>
  </tr>
    <tr>
    <td colspan="2"><label>
      <input type="submit" name="Submit" value="OK" />
    </label></td>
    </tr>
</table>
</form>

<?php
if($_POST['filename']){
//echo('files/'.$_POST['filename'].'.xml');
	if(file_exists(adminroot.'objects/'.$_POST['filename'])){
		echo('<b>hotovo</b>');
		$sql=('DELETE FROM `'.mpx.'objects` WHERE `ww` = 0');
		hr();echo($sql);			
		sql_query($sql);
		$models=file_get_contents(adminroot.'objects/'.$_POST['filename']);
		foreach(split(nln,$models) as $tmp){
		if($tmp){
			if(substr($tmp,0,1)=="[" or substr($tmp,0,1)=="{" or substr($tmp,0,1)=="("){
				$res=$tmp;
			}else{
				$name=$tmp;
				$name=str_replace(":","",$name);
			}
		}
		if($res){
			$sql=file_get_contents(adminroot.'sql/unique.sql');
			$sql=str_replace('[mpx]',mpx,$sql);
			$sql=str_replace('[name]',trim($name),$sql);
			$sql=str_replace('[res]',trim($res),$sql);
			hr();echo($sql);			
			sql_query($sql);
			$res="";
		}

		}

		br();
	}else{
		echo('Soubor neexistuje!');
		br();
	}
}
?>

