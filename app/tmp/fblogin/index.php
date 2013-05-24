<!DOCTYPE HTML>
<html>
<head>

</head>
<body>   

<?php    
  require_once("sdk/facebook.php");

  $config = array();
  $config['appId'] = '408791555870621';
  $config['secret'] = '155326bed6c70ad2d4b21ef27d69c94e';

  $facebook = new Facebook($config);
  
  // login URL
  $params = array(
    'redirect_uri' => 'http://4.towns.cz/app/fblogin/redirect.php'
  );
  $loginUrl = $facebook->getLoginUrl($params);
?>

<a href="<?= $loginUrl ?>">Login with Facebook</a>


</body>
</html>
				
