<?php
//$iconsize=22; 70a5cc 357088

e('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="23" bgcolor="#173440" class="dragbar" valign="center">');

$lang=$GLOBALS['ss']["lang"];

$cz_url='lang=cz';
$en_url='lang=en';

 moveby(tfontr(iconr($cz_url,'lang_cz','{lang_cz}',array(25,17),1,$lang=='cz'?1:0).'&nbsp;'.iconr($en_url,'lang_en','{lang_en}',array(25,17),1,$lang=='en'?1:0)),2,1);
 //.ahrefr('{lang_cz}',$cz_url).'&nbsp;'.ahrefr('{lang_cz}',$en_url)
 
e(nbsp.'</td><td>');





e('</td></tr></table>');


 ?>
