<?php
	//echo('bbb');
  eval('req'.'uire_once(root."lib/facebook_sdk/base_facebook.php");');
  eval('req'.'uire_once(root."lib/facebook_sdk/facebook.php");');

  $fb_config = array();
  $fb_config['appId'] = fb_appid;
  $fb_config['secret'] = fb_secret;
  
  $facebook = new Facebook($fb_config);
  
  // get him!
  $uid = $facebook->getSignedRequest();
  //echo $uid;
  /*if ($uid != 0)
  {                                                                                                              
      //echo $uid;
       echo('fb-1-'.$uid);
   }else{
       echo('fb-0');
      }*/
  //echo(1);
  try{
  $user_profile = $facebook->api('/me','GET');
    //echo(2);
  //echo(nl2br(var_export($user_profile,true)));

    //echo(3);
	$GLOBALS['user_profile']=$user_profile;
	$fbid=$user_profile['id'];
	
    
	
        $GLOBALS['ss']['fbid']=$fbid;
	
	}catch(Exception $e){
        $GLOBALS['ss']['fbid']=-1;
	}

    //reloc();
	//echo('ccc');
?>

