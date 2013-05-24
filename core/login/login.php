<?php
window('',0,0,'login');
//r($GLOBALS['get']);
/*if($GLOBALS['get']["login_try"]){
    xquery("login",$post["login_username"],$post["login_password"]);
}*/



?>
<div style="width:100%; height: 100%; background-color:rgba(17,17,17,0.7);">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45" height="45"><?php imge('logo/fract3.png','',73); ?></td>
    <td width="0" height="0"><span style="font-size:25px;" >&nbsp;Towns&nbsp;-&nbsp;Města</span></td>
  </tr>
</table>
<br/>
<div style="background:#111111;" >
Vítejte na stránkách nové online hry.
<br/>

</div>
<br/>


<?php xreport(); ?>

<?php

$q=submenu('login-login',array('login','register','about'),1);
if($q==1){
    eval(subpage('login-log_form'));
}elseif($q==2){
    eval(subpage('login-reg_form'));
}elseif($q==3){
    $GLOBALS['ss']["page"]='about';
    $GLOBALS['nowidth']=true;
    eval(subpage('help'));
}

?>

<div style="background:#222222;" >{info}</div>
</div>

