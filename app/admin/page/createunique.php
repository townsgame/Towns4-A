<h3>Object</h3>
Tato funkce slouží k vytvoření stavebních plánů.<br/>
<b>Upozornění: </b>Tato funkce může při nesprávném použití poškodit nultý podsvět!<br />
<b>Upozornění: </b>Tento proces může trvat i několik minut.<br/>
<b>NEXTID: </b><?php echo(sql_1data("SELECT max(id) FROM ".mpx."objects WHERE ww!='0'")-(-1)); ?><br/>
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
		$q=false;
		foreach(split(nln,$models) as $tmp){
		if(trim($tmp)){
			if($q/*substr($tmp,0,1)=="[" or substr($tmp,0,1)=="{" or substr($tmp,0,1)=="("*/){

				if(strpos($tmp,'=')){

					list($key,$value)=split('=',$tmp);
					$value=trim($value);
					if(substr($value,-1)==';')$value=substr($value,0,strlen($value)-1);
					//r($key.' = '.$value);
					if($key=='id'){
						$id=intval($value);
					}elseif($key=='description'){
						$description=$value;
					}else{
						if(strpos($key,'__')){
							list($a,$b)=split('__',$key);
							$func->addF($a,$b,$value,'profile');
						}elseif(strpos($key,'_')){
							list($a,$b)=split('_',$key);
							$func->addF($a,$b,$value);
						}else{
							$func->addF($key,$key,$value);
						}
					}

				}else{
					$q=false;
					$res=$tmp;
				}
			}else{
				$id=false;
				$func=new func();
				$description='';
				$q=true;
				$name=$tmp;
				$name=str_replace(":","",$name);

			}
		}
		if($res){
			$object=new object('create');
			$object->name=trim($name);
			$object->type='building';
			$object->func=$func;
			$object->profile->add('description',$description);
			$object->res=trim($res);
			$object->ww=0;
			
			r('name: '.$name);
			r('description: '.$description);
			r($func->vals2list());
			r($res);
			

			$object->update();

			if($id==register_building){
				$objectx=new object($object->id);
				$reg_name=$objectx->name;
				$reg_func=$objectx->func->vals2str();
				$reg_fs=$objectx->fs;
				//$reg_fp=$object->fp;
				$reg_fr=$objectx->fr;
				$reg_fc=$objectx->fc;
				$reg_fx=$objectx->fx;
				$reg_hard=$objectx->hard;
				$reg_expand=$objectx->expand_;
				$reg_collapse=$objectx->collapse_;
			}

			if($id and $object->id!=$id){
				sql_query('DELETE FROM [mpx]objects WHERE id='.$id,1);
				sql_query('UPDATE [mpx]objects SET id='.$id.' WHERE id='.$object->id,1);
				r('reid: '.$object->id.' >>> '.$id);
			}

			r();
			//$sql=file_get_contents(adminroot.'sql/unique.sql');
			//$sql=str_replace('[id]',nextid(),$sql);
			//$sql=str_replace('[mpx]',mpx,$sql);
			//$sql=str_replace('[name]',trim($name),$sql);
			//$sql=str_replace('[res]',trim($res),$sql);
			//hr();echo($sql);			
			//sql_query($sql);
			$res="";
		}

		}

		br();
		if($reg_name){
			sql_query("UPDATE [mpx]objects SET func='$reg_func', fs='$reg_fs', fp='$reg_fs', fr='$reg_fr', fc='$reg_fc', fx='$reg_fx', hard='$reg_hard', expand='$reg_expand', collapse='$reg_collapse' WHERE name='$reg_name'",2);

		}


		sql_query("UPDATE [mpx]objects SET fp=fs WHERE ww='0'");
	}else{
		echo('Soubor neexistuje!');
		br();
	}
}
?>

