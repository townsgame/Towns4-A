<?php
// or cURL
function post($url, $data)
{
        $params = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data),
                 'header' => "Content-type: application/x-www-form-urlencoded"
          ));

          // send
          // sending
          $ctx = stream_context_create($params);          
          $fp = fopen($url, 'rb', false, $ctx);
          // once more
          if (!$fp) 
          {
             $fp = fopen($url, 'rb', false, $ctx);
          }
          
          // return
          $response = stream_get_contents($fp);
          // once more
          if ($response == false)
          {
              $response = stream_get_contents($fp);
          }
          return $response;
}
?>