<?php
function initialize(array $config)
{
  $temp = array();

  // config
  $config_file = parse_ini_file($config['config']);
  // file
  $file = json_decode(json_encode((array)simplexml_load_file($config['file'])), 1);
  
  // read
  $functions = array();
  // functions
  // from config file
  foreach ($config_file as $key => $value)
  {
      $keys = preg_split('~_\s*~', $key);
      
      // must be a function
      if ($keys[0] != 'f')
        continue;
      
      $temp[$keys[1]][$keys[2]][$keys[3]] = $value;
      
      // to functions
      if (!in_array($keys[1], $functions))
      {
          $functions[] = $keys[1];
      }
  }
  // from file
  foreach ($functions as $function)
  {  
    // just one
    if (isset($file['func'][$function]['params']['param']['@attributes']['key']))
    {
        $key = $file['func'][$function]['params']['param']['@attributes']['key'];
        $value = (int)$file['func'][$function]['params']['param']['@attributes']['value'];
        $temp[$function][$key]['default'] = $value; 
    }
  
    // more
    for ($i = 0; isset($file['func'][$function]['params']['param'][$i]['@attributes']['key']); $i++)
    {
        $key = $file['func'][$function]['params']['param'][$i]['@attributes']['key'];
        $value = (int)$file['func'][$function]['params']['param'][$i]['@attributes']['value'];
        $temp[$function][$key]['default'] = $value;
    }
    
    // profile
    // just one
    if (isset($file['func'][$function]['profile']['param']['@attributes']['key']))
    {
        $key = $file['func'][$function]['profile']['param']['@attributes']['key'];
        $value = $file['func'][$function]['profile']['param']['@attributes']['value'];

        $value  = htmlspecialchars_decode($value);
        $value = str_replace("[nln]", "|", $value);  
        $value = str_replace("[doublequote]", '~', $value); 

        // icon
        if ($key == "icon")
        {
            if (strlen($value) < 2)
              $value = $function . '.png';  
            $value = $config['icons'] . '/' . $function . '/' . $value;
        }

        $temp[$function][$key] = $value; 
    }
  
    // more
    for ($i = 0; isset($file['func'][$function]['profile']['param'][$i]['@attributes']['key']); $i++)
    {
        $key = $file['func'][$function]['profile']['param'][$i]['@attributes']['key'];
        $value = $file['func'][$function]['profile']['param'][$i]['@attributes']['value'];
        
        $value = htmlspecialchars_decode($value);
        $value = str_replace("[nln]", "|", $value);  
        $value = str_replace("[doublequote]", '~', $value); 
        
        // icon
        if ($key == "icon")
        {
            if (strlen($value) < 2)
              $value = $function . '.png';  
            $value = $config['icons'] . '/' . $function . '/' . $value;
        }
        
        $temp[$function][$key] = $value;
    }
    
    if (!isset($temp[$function]['icon']))
    {
        $temp[$function]['icon'] = $config['icons'] . '/' . $function . '/' . $function . '.png';
    }    
    
    // get icons
    $files = glob($config['icons'] . '/' . $function . '/*');
    $temp[$function]['icons'] = $files;
  }
  
  // parameters
  $temp['res'] = array(); 
  for ($i = 0; isset($file['param'][$i]['@attributes']['key']); $i++)
  {  
      $key = $file['param'][$i]['@attributes']['key'];
      
      if ($key != "xres")
        continue;
      
      $value = $file['param'][$i]['@attributes']['value'];
      $temp['res'] = array();
      $temp['res'] = unserialize(urldecode($value));
      
      if (is_array($temp['res']))
      {
          foreach ($temp['res'] as $k => $v)
          {
              $v  = htmlspecialchars_decode($v);
              $v = str_replace("[nln]", "|", $v);  
              $temp['res'][$k] = str_replace("[doublequote]", '~', $v);
          } 
      }
  }
  
  // other
  // name
  if (isset($file['@attributes']['name']))
    $temp['name'] = $file['@attributes']['name'];
  // description & author
  for ($i = 0; isset($file['profile']['param'][$i]['@attributes']['key']); $i++)
  {  
      $key = $file['profile']['param'][$i]['@attributes']['key'];      
      $value = $file['profile']['param'][$i]['@attributes']['value'];
      
      $value = htmlspecialchars_decode($value);         
      $value = str_replace("[nln]", "|", $value);  
      $value = str_replace("[doublequote]", '~', $value); 
      
      $temp[$key] = $value;
  } 
      
  return $temp;
}
?>