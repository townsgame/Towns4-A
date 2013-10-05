<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný, Přemysl Černý | 2011-2013
   _____________________________

   core/login/fb_process.php

   Přihlašování přes Facebook
*/
//==============================




if($GLOBALS['ss']['fbid']!=-1){
    $fbid=$GLOBALS['ss']['fbid'];
	
	$tmpids=sql_array('SELECT `id` FROM `[mpx]login` WHERE `key`=\''.$fbid.'\' AND `method`=\'facebook\'');
	if(count($tmpids)==0){
		echo('createuser');
	}elseif(count($tmpids)==1){
		$$tmpid=$tmpids[0][0];
		xquery('login',$tmpid,'facebook',$fbid);
	}else{
		$GLOBALS['ss']['fb_select_ids']=array();
		$GLOBALS['ss']['fb_select_key']=$fbid;
		foreach($tmpids as $tmpid){
			$tmpid=$tmpid[0];
			$GLOBALS['ss']['fb_select_ids'][count($GLOBALS['ss']['fb_select_ids'])]=$tmpid;
			//echo($tmpid);
		}
	}
	
}else{
    xerror("{f_login_nofblogin}");
    //$GLOBALS['ss']["query_output"]->add("error","{f_login_nologin}");
}
$GLOBALS['ss']['fbid']=false;
?>

