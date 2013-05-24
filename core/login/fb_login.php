
<?php
  eval('req'.'uire_once(root."lib/facebook_sdk/base_facebook.php");');
  eval('req'.'uire_once(root."lib/facebook_sdk/facebook.php");');

  $fb_config = array();
  $fb_config['appId'] = fb_appid;
  $fb_config['secret'] = fb_secret;

  $facebook = new Facebook($fb_config);
  
  // login URL
  $params = array(
    'redirect_uri' => url.('-fblogin')
  );
  $loginUrl = $facebook->getLoginUrl($params);
/*https://www.facebook.com/dialog/oauth?client_id=408791555870621&redirect_uri=http%3A%2F%2Flocalhost%2Ftowns%2Fworld2%2F%3Fe%3Dfb-fb_redirect&state=f9d7a50e6c86aa24102f5fb6d3e07d17*/
?>

<a href="<?php echo($loginUrl) ?>">{fb_login_button}</a>
	
