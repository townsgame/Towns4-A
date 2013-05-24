<form id="register" name="register" method="POST" action="<?php url("q=register [register_username];login_try=1"); ?>">
<table width="100%">
<tr>
<td width="10"><b>{register_username}:</b></td>
<td align="left"><input type="input" name="register_username" id="register_username" value="<?php echo($_POST["register_username"]) ?>" size="17"  style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr><?php /*<tr>
<td><b>{register_password}:</b></td><td align="left"><input type="password" name="register_password" value="" size="17"  style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr><tr>
<td><b>{register_password2}:</b></td><td align="left"><input type="password" name="register_password2" value="" size="17"  style="border: 2px solid #000000; background-color: #eeeeee"/></td>
</tr><tr>
<td colspan="2"><?php input_checkbox("login_permanent",$post["login_permanent"]); ?> {register_login_permanent}</td><tr> */ ?>
<td colspan="2"><input type="submit" value="{register_ok}" /></td></tr>
</tr></table></form>

<div style="background:#222222;" >{register_info}</div><br/>
<?php

if(defined('fb_appid') and defined('fb_secret'))
eval(subpage('login-fb_login'));
?>

<script type="text/javascript">
document.register.register_username.focus();
</script>