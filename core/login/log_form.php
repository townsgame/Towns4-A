<form id="login" name="login" method="POST" action="<?php url("q=login [login_username],towns,[login_password];login_try=1"); ?>">
<table width="100%">
<tr>
<td width="10"><b>{login_username}:</b></td>
<td align="left"><input type="input" name="login_username" id="login_username" value="<?php echo($_POST["login_username"]) ?>" size="17"  style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr><tr>
<td><b>{login_password}:</b></td><td align="left"><input  type="password" name="login_password" value="" size="17"  style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr>
<!--
<tr>
<td colspan="2"><?php input_checkbox("login_permanent",$post["login_permanent"]); ?> {login_permanent}</td></tr>-->
<tr>
<td colspan="2"><input type="submit" value="{login_ok}" /></td></tr>
</tr>

</table></form>

<?php
if(defined('fb_appid') and defined('fb_secret'))
eval(subpage('login-fb_login'));
?>

<script type="text/javascript">
document.login.login_username.focus();
</script>