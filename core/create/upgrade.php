<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/create/upgrade.php

   Opravit / vylepšit budovu
*/
//==============================




$fields="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, (SELECT `name` from ".mpx."objects as x WHERE x.`id`=".mpx."objects.`own`) as `ownname`, `in`, `ww`, `x`, `y`, `t`";
/*if($_GET["id"]){
    $id=$_GET["id"];
}elseif($GLOBALS['get']["id"]){
    $id=$GLOBALS['get']["id"];
}else{
    $id=$GLOBALS['ss']["use_object"]->set->ifnot('upgradetid',0);
}*/
sg("id");
//echo($id);

//--------------------------
if($id?ifobject($id):false){
    $sql="SELECT $fields FROM ".mpx."objects WHERE id=$id";
    $array=sql_array($sql);
    list($id, $name, $type, $dev, $fs, $fp, $fr, $fx, $fc, $func, $hold, $res, $profile, $set, $hard, $own, $ownname, $in, $ww, $x, $y, $t)=$array[0];
 
    if($own==useid or $own==logid){
        //$GLOBALS['ss']["use_object"]->set->add('upgradetid',$id);
        //--------------------------
        if($fs==$fp){
	    //========================================UPGRADE
		//$tmpobject=new object($id);
		window('{title_upgrade}');
		$q=submenu(array("content","create-upgrade"),array("upgrade_func","upgrade_res","upgrade_rot"/*,"messages_report","messages_new"*/),1,'upgrade');

		contenu_a();

		if($q==3){
		//------------------------------------

		//------------------------------------
		}elseif($q==2){
		//------------------------------------
			e('{upgrade_res_by_editor}');
			br();br();


			$wurl=str_replace('/[world]','',url);
			$p_url=str_replace('http://','',url);
			$p_url=str_replace('[world]',w,$p_url);

			$p_id=$id;
			$p_pass='328678';

			$p_pass=sql_1data('SELECT `key` FROM `[mpx]login` WHERE `id`='.$id);
			if(!$p_pass){
				$p_pass=md5(rand(1,999999999));
				sql_query("INSERT INTO `world1_login` (`id`, `method`, `key`, `text`, `time_create`, `time_change`, `time_use`) VALUES ('$id', 'editor', '$p_pass', '', '".time()."', '".time()."', '".time()."');");
			}


			tfont('<a href="#" onclick="window.open(\''.$wurl.'/app/easy/index.php?url='.$p_url.'&id='.$p_id.'&pass='.$p_pass.'&lang='.$GLOBALS['ss']["lang"].'\', \'_blank\', \'width=430, height=320,resizable=yes\');">{easyeditor}</a>',20);

			br();br();
			info('{upgrade_res_info}');
		//------------------------------------
		}elseif($q==1){
		//------------------------------------UPGRADE_FUNC

			xreport();
			if(xsuccess()){
			  ?>
			<script>
			<?php urlx('e=miniprofile',false); ?>
			</script>
			<?php
			}

			e('{upgrade_title}');
			br();

			$functions=array(
					'attack'=>array(array('attack',1),array('count',5),array('distance',0.2),array('cooldown',-120,1),array('eff',0.05,0.9,'%'),array('xeff',0.05,0.9,'%')),
					'create'=>array(array('cooldown',-20,1),array('eff',0.05,0.9,'%')),
					'change'=>array(array('eff',0.05,0.9,'%')),
					'expand'=>array(array('distance',0.2)),
					'collpse'=>array(array('distance',0.2)),
					'resistance'=>array(array('hard',0.1))
					);
			br();
			e('<table width="100%" border="0" cellpadding="0" cellspacing="0">');
		
			$funcp=$func;
			$tmp=new func($funcp);
			$pricep=$tmp->fc();
			$func=func2list($func);
			foreach($functions as $funcname=>$data){
				if($func[$funcname]){
					if($func[$funcname]['profile']['name']){
						$funcname_=$func[$funcname]['profile']['name'];
					}else{
						$funcname_='{f_'.$func[$funcname]['class'].'}';
					}	

					//alert('<h2>'.$funcname_.'</h2>','000000');
					e('<tr bgcolor="111111"><td colspan="3"><h2>'.$funcname_.'</h2></td></tr>');
					//foreach($func[$funcname]['params'] as $paramname=>$value){
				
					foreach($data as $tmp){list($paramname,$step,$max,$type)=$tmp;
						if($func[$funcname]['params'][$paramname]){
							//$func[$funcname]['params']
							if($step>0)$step_='(+'.nbsp.($type=='%'?ceil($step*100).'%':$step).nbsp.')'; else $step_='('.nbsp.($type=='%'?ceil($step*100).'%':$step).nbsp.')';
							$value=$func[$funcname]['params'][$paramname];
							$value=$value[0]*$value[1];
							//e($paramname.': '.$value);

							if($max and ((($value-(-$step))>=$max and $step>0) or (($value-(-$step))<=$max) and $step<0)){$step_='';}
								//-------výpočet ceny
								$funcx=new func($funcp);
								//e("addF($funcname,$paramname,$value-(-$step))");
								$funcx->addF($funcname,$paramname,$value-(-$step));
								$pricex=$funcx->fc();
								//$pricep->showimg(true);
								//$pricex->showimg(true);

								$pricex->takehold($pricep);
								//e($funcx->fs().','.$pricep);
								//-------
						
							e('<tr bgcolor="222222"><td width="150"><b>{f_'.$func[$funcname]['class'].'_'.$paramname.'}: </b></td><td width="50">'.($type=='%'?ceil($value*100).'%':$value).'</td><td>'.ahrefr($step_,'e=content;ee=create-upgrade;q='.$id.'.upgrade '.$funcname.','.$paramname.','.($value-(-$step))).'</td></tr>');
							e('<tr><td colspan="3">');

							if($step_){
		
								$pricex->showimg(true);

								if(!$GLOBALS['ss']['use_object']->hold->testhold($pricex)){
									//br();
									tfont('{upgrade_error_price}',NULL,'FF0000');
								}
							}else{
								e('{upgrade_noupgrade}');
							}
							e('</td></tr>');
						
						}
					}
					e('<tr><td colspan="3"><br></td></tr>');
					//print_r($tmp);
				
				}
				
			}

			e('</table>');

		//------------------------------------
		}
		contenu_b();
	    //========================================
        }else{
	    //========================================REPAIR
            window('{title_repair}');
            
            
            
            infob(ahrefr('{repair_ok}','e=content;ee=create-upgrade;q='.$id.'.repair'));
            contenu_a();
            xreport();
if(xsuccess()){
  ?>
<script>
setTimeout(function()x{
    w_close('content');
}x,3000);
<?php urlx('e=miniprofile',false); ?>
</script>
<?php
}
            $price=new hold($fc);
            $price->multiply($fp/$fs);
            textb('{repair_price}: ');
            $price->showimg();
            hr();
            profile($id);
            contenu_b();
            
        }
        //--------------------------
    }
	    //========================================
}

?>
