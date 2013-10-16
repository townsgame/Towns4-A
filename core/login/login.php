<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/login/login.php

   Úvodní přihlašovací obrazovka
*/
//==============================




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
    <td width="0" height="0"><span style="font-size:25px;" >&nbsp;{towns_towns}</span></td>
  </tr>
</table>
<br/>
<div style="background:#111111;" >
{welcome}
<br/>

</div>

<?php
if(defined('countdown') and countdown-time()>0){$disabled='disabled';
?>
<div style="background:#222222;" >{countdown} <?php timese(countdown-time()); ?></div>
<?php
}else{
    $disabled='';
}
?>


<br/>


<?php xreport(); ?>

<?php

$q=submenu('login-login',array('login','register','about'),1);
if($q==1){
    eval(subpage('login-log_form'));
}elseif($q==2){
    eval(subpage('login-reg_form'));
}elseif($q==3){
    $GLOBALS['ss']["helppage"]='about';
    $GLOBALS['nowidth']=true;
    eval(subpage('help'));
}

?>



<div style="background:#222222;" >{info}</div>

<?php 
if ( $GLOBALS['mobile_detect']->isMobile() ) {
?>
<div style="background:#222222;" >{info_mobile}</div>
<?php } ?>

</div>


<?php if($q==1){ ?>

<?php /* ?>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5059650173115860";
google_ad_slot = "9306763729";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php */ 

tfont('{ad_title}',10);
?>

<table border="1" cellspacing="0" cellpadding="0" width="100%" bgcolor="#111111" bordercolor="#cccccc">
<tr>
<td align="left">

<script type="text/javascript"><!--
google_ad_client = "ca-pub-5059650173115860";
/* towns4-A */
google_ad_slot = "6375146928";
google_ad_width = 280;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


</td>
</tr>
</table>

<?php } ?>

