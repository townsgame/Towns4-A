<?php
$inc=array(
    'base' => '',
    'core' => 'core',
    'app' => 'app',
    'world' => 'world1',
    'url' => 'http://test.towns.cz/[world]/',
    'cache' => 'tmp/[world]',
    'mysql_host' => 'localhost',
    'mysql_user' => 'towns.cz',
    'mysql_password' => 'phejn1322',
    'mysql_db' => 'towns_cz',
    'mysql_prefix' =>'[world]_',
    'debug' => true,
    'lang' => 'cz',
    //'fb_appid' =>'408791555870621',
    //'fb_secret' =>'155326bed6c70ad2d4b21ef27d69c94e',
    //'paypal_username' => 'info_1343221840_biz_api1.injectioncomp.com',
    //'paypal_password' => '1343221872',
    //'paypal_signature' => 'A2PyKp89S2eNM15amICDOkeE7uDNAF5TUyb1VKBs6nZo7noj3kX644Fa',
    //'paypal_enviroment' => 'sandbox.',
    'paypal_username' => 'info_api1.injectioncomp.com',
    'paypal_password' => '3E3DVY5G6H9PBHY5',
    'paypal_signature' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAU8F0VteQyr3LMgMhs0kv9FFNRnf',
    'paypal_enviroment' => '',
    'analytics' => 'UA-16346522-15',
    'fb_page' => 'pages/Townscz/224568984369751'
);
date_default_timezone_set('Europe/Prague');
require($inc['core'].'/index.php');
?>
