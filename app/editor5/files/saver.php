<?php
require_once "files/general.php";
function save($response, $config, $style = 0)
{           
    $str = generate($response);     
    
    if ($style == 0)
    {
        if (isset($config['url']))
        {
           $id = '';
           if (isset($config['id']))
            $id = $config['id'];
           $file = post($config['url'], array('action' => 'save', 'id' => $id, 'object' => (string)$str)); 
        }
        else if (isset($config['baseurl']) && ($config['baseurl'] != "test" || isset($config['id'])))
        {
           $id = '';
           if (isset($config['id']))
            $id = $config['id'];
           $file = post($config['baseurl'], array('action' => 'save', 'id' => $id, 'object' => (string)$str)); 
        }
        else
        {
            // create
            $file = fopen($config['file'], "w+");
            fwrite($file, (string)$str);
            fclose($file);
        }
        // refresh
        $page = $_SERVER['PHP_SELF'];
        header("Location: $page");
    }
    else
    {
        // AJAX
        $data = post($config['infourl'], array('object' => urlencode((string)$str)));
        echo (string)$data;
        exit;
    }
}
function generate($values)
{    
    // xml
    $top = "
      <object name=\"". $values['name']. "\" type=\"building\">
      <param key=\"res\" value=\"" . $values['res'] . "\" />
      <param key=\"xres\" value=\"" . $values['xres'] . "\" />
      <profile>
      	<param key=\"description\" value=\"" . $values['description']. "\" />
      	<param key=\"author\" value=\"" . $values['author']. "\" />
      </profile>
      <func>
    ";
    
    // functions  
    $fielda = $values['func'];  
    
    // attacks
    $attacks = "";
    if (isset($fielda['attack']) && is_array($fielda['attack']))
    {
        $count = '';
        foreach ($fielda['attack'] as $value)
        {
           $attacks .= 
           "<attack" . $count . " class=\"attack\">
          		<params>
          			<param key=\"attack\" value=\"" . htmlspecialchars($value['attack']) . "\" />
                <param key=\"distance\" value=\"" . htmlspecialchars($value['distance']) . "\" />
                <param key=\"cooldown\" value=\"" . htmlspecialchars($value['cooldown']) . "\" />
                <param key=\"count\" value=\"" . htmlspecialchars($value['count']) . "\" />
                <param key=\"eff\" value=\"" . htmlspecialchars($value['eff']) . "\" />
                <param key=\"xeff\" value=\"" . htmlspecialchars($value['xeff']) . "\" />
                <param key=\"total\" value=\"" . htmlspecialchars($value['total']) . "\" />
          		</params>
          		<profile>
          			<param key=\"name\" value=\"" . htmlspecialchars($value['name']) . "\" />
          			<param key=\"icon\" value=\"" . htmlspecialchars($value['icon']) . "\" />
          			<param key=\"description\" value=\"" . htmlspecialchars($value['description']) . "\" />
          		</profile>
          	</attack" . $count . ">
            ";
            
            if ($count == '')
              $count = 2;
            else
              $count++;           
        }
    }
    
    // creates
    $creates = "";
    if (isset($fielda['create']) && is_array($fielda['create']))
    {
        $count = '';
        foreach ($fielda['create'] as $value)
        {
           $creates .= 
           "<create" . $count . " class=\"create\">
          		<params>
          			<param key=\"maxfs\" value=\"" . htmlspecialchars($value['maxfs']) . "\" />
                <param key=\"limit\" value=\"" . htmlspecialchars($value['limit']) . "\" />
                <param key=\"cooldown\" value=\"" . htmlspecialchars($value['cooldown']) . "\" />
                <param key=\"eff\" value=\"" . htmlspecialchars($value['eff']) . "\" />
          		</params>
          		<profile>
          			<param key=\"name\" value=\"" . htmlspecialchars($value['name']) . "\" />
          			<param key=\"icon\" value=\"" . htmlspecialchars($value['icon']) . "\" />
          			<param key=\"description\" value=\"" . htmlspecialchars($value['description']) . "\" />
          		</profile>
          	</create" . $count . ">
            ";
            
            if ($count == '')
              $count = 2;
            else
              $count++;           
        }
    }
     
    // other   
    $bottom = 
       "<defence class=\"defence\">
      		<params>
      			<param key=\"defence\" value=\"" . $values['amount_defence_defence'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['defence_name'] . "\" />
      			<param key=\"description\" value=\"" . $values['defence_description'] . "\" />
      		</profile>
      	</defence>
      	<expand class=\"expand\">
      		<params>
      			<param key=\"distance\" value=\"" . $values['amount_expand_distance'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['expand_name'] . "\" />
      			<param key=\"description\" value=\"" . $values['expand_description'] . "\" />
      		</profile>
      	</expand>
      	<collapse class=\"collapse\">
      		<params>
      			<param key=\"distance\" value=\"" . $values['amount_collapse_distance'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['collapse_name'] . "\" />
      			<param key=\"description\" value=\"" . $values['collapse_description'] . "\" />
      		</profile>
      	</collapse>
      	<hard class=\"hard\">
      		<params>
      			<param key=\"hard\" value=\"" . $values['amount_hard_hard'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['hard_name'] . "\" />
      			<param key=\"description\" value=\"" . $values['hard_description'] . "\" />
      		</profile>
      	</hard>
      	<resistance class=\"resistance\">
      		<params>
      			<param key=\"hard\" value=\"" . $values['amount_resistance_hard'] . "\" />
      		</params>
      		<profile>
      			<param key=\"name\" value=\"" . $values['resistance_name'] . "\" />
      			<param key=\"description\" value=\"" . $values['resistance_description'] . "\" />
      		</profile>
      	</resistance>
      </func>
      </object>";
           
    // save
    $str = $top . $attacks . $creates . $bottom;
           
    return $str;
}
?>