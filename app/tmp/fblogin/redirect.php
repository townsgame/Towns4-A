<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
<a href="index.php">zpět</a><br/>
<?php 
  require_once("sdk/facebook.php");

  $config = array();
  $config['appId'] = '408791555870621';
  $config['secret'] = '155326bed6c70ad2d4b21ef27d69c94e';
  
  $facebook = new Facebook($config);
  
  // get him!
  $uid = $facebook->getSignedRequest();
  echo $uid;
  if ($uid != 0)
  {                                                                                                              
      echo $uid;
  }
  
  $user_profile = $facebook->api('/me','GET');

  echo(nl2br(var_export($user_profile,true)));

?>

</body>
</html>
				
