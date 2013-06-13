<?php
function save($response, $config, $style = 0)
{           
    $str = generate($response);     
    
    if ($style == 0)
    {
        // create
        $file = fopen($config['file'], "w+");
        fwrite($file, (string)$str);
        fclose($file);
        
        // refresh
        $page = $_SERVER['PHP_SELF'];
        header("Location: $page");
    }
    else
    {
        // AJAX
        $data = post($config['infourl'], array("object" => urlencode((string)$str)));
        echo (string)$data;
        exit;
    }
}
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
function generate($response)
{
    $serialize = array();
    $values = array();
    
    foreach ($response as $key => $value)
    {
        if ($key[0] == 'Z')
        {
            $values[substr($key, 1)] = $value;
        }
        else
        {
            $serialize[$key] = $value;
        }
    }
    $values['xres'] = urlencode(serialize($serialize));
    
    // xml
    $str = "
      <object name=\"". $values['name']. "\" type=\"building\">
      <param key=\"res\" value=\"" . $values['res'] . "\" />
      <param key=\"xres\" value=\"" . $values['xres'] . "\" />
      <profile>
      	<param key=\"description\" value=\"" . $values['description']. "\" />
      	<param key=\"author\" value=\"" . $values['author']. "\" />
      </profile>
      <func>
      	<attack class=\"attack\">
      		<params>
      			<param key=\"attack\" value=\"" . $values['amount_attack_attack'] . "\" />
            <param key=\"distance\" value=\"" . $values['amount_attack_distance'] . "\" />
            <param key=\"cooldown\" value=\"" . $values['amount_attack_cooldown'] . "\" />
            <param key=\"count\" value=\"" . $values['amount_attack_count'] . "\" />
            <param key=\"total\" value=\"" . $values['total'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['name_attack'] . "\" />
      			<param key=\"icon\" value=\"" . $values['icon'] . "\" />
      			<param key=\"description\" value=\"" . $values['description_attack'] . "\" />
      		</profile>
      	</attack>
      	<defence class=\"defence\">
      		<params>
      			<param key=\"defence\" value=\"" . $values['amount_defence_defence'] . "\" />
      		</params>
      		<profile>
      		</profile>
      	</defence>
      	<expand class=\"expand\">
      		<params>
      			<param key=\"distance\" value=\"" . $values['amount_expand_distance'] . "\" />
      		</params>
      		<profile>
      		</profile>
      	</expand>
      	<collapse class=\"collapse\">
      		<params>
      			<param key=\"distance\" value=\"" . $values['amount_collapse_distance'] . "\" />
      		</params>
      		<profile>
      		</profile>
      	</collapse>
      	<hard class=\"hard\">
      		<params>
      			<param key=\"hard\" value=\"" . $values['amount_hard_hard'] . "\" />
      		</params>
      		<profile>
      		</profile>
      	</hard>
      	<resistance class=\"resistance\">
      		<params>
      			<param key=\"hard\" value=\"" . $values['amount_resistance_hard'] . "\" />
      		</params>
      		<profile>
      		</profile>
      	</resistance>
      </func>
      </object>";
           
    return $str;
}
?>