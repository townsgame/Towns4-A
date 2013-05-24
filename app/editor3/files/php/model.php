<?php
// AJAX version
if (isset($_GET["res"]))
{       
    $res = htmlspecialchars($_GET["res"]);
    $data = "res=" . $res;
 
    // setting and sending        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://4.towns.cz/3dmap/model.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $return = curl_exec($ch);
    curl_close($ch);    
    
    if ($return != null)
      echo (string)$return;
}
?>