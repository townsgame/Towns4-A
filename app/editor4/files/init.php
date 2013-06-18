<?php
function initialize(array $config)
{
  // initialize
  $temp = array();
  // func
  $GLOBALS['func']['count_createfunction'] = 0;
  $GLOBALS['func']['attack'] = "";
  $GLOBALS['func']['create'] = "";

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
  // more functions, f. e. attack2, ...
  // attack
  for ($i = 2; isset($file['func']['attack' . $i]); $i++)
    $functions[] = 'attack' . $i;
  // create
  for ($i = 2; isset($file['func']['create' . $i]); $i++)
    $functions[] = 'create' . $i;
  
  // from file
  foreach ($functions as $function)
  {      
    // data
    // just one
    if (isset($file['func'][$function]['params']['param']['@attributes']['key']))
    {
        $key = $file['func'][$function]['params']['param']['@attributes']['key'];
        $value = (int)$file['func'][$function]['params']['param']['@attributes']['value'];
        // read them attack, create
        if (strpos($function, 'ttack') || strpos($function, 'reate')) 
          $temp[$function][$key]['value'] = (int)$value; 
        else
          $temp[$function][$key]['default'] = (int)$value;
    }
  
    // more
    for ($i = 0; isset($file['func'][$function]['params']['param'][$i]['@attributes']['key']); $i++)
    {
        $key = $file['func'][$function]['params']['param'][$i]['@attributes']['key'];
        $value = (int)$file['func'][$function]['params']['param'][$i]['@attributes']['value'];
        // read them 
        if (strpos($function, 'ttack') || strpos($function, 'reate')) 
          $temp[$function][$key]['value'] = (int)$value; 
        else
          $temp[$function][$key]['default'] = (int)$value;  
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

        // icon for only basic functions
        if ($key == "icon")
        {      
            if (!preg_match_all("/.*?(\d+)$/", $function))
            {      
              if (strlen($value) < 2)
                $value = $function . '.png';  
              $value = $config['icons'] . '/' . $function . '/' . $value;
            }
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
    
    // create for JavaScript; only if it is set
    if (isset($file['func'][$function]))
    {
      @createFunction($function, $temp, $config);
    }
    
    // icons
    if (!isset($temp[$function]['icon']))
    {
      if (!preg_match_all("/.*?(\d+)$/", $function))
      {      
          $temp[$function]['icon'] = $config['icons'] . '/' . $function . '/' . $function . '.png';
      }
    }    
    
    // get icons
    $files = glob($config['icons'] . '/' . $function . '/*');
    $temp[$function]['icons'] = $files;
  }
  
  // parameters
  $temp['points'] = ''; 
  $temp['polygons'] = ''; 
  $temp['colors'] = ''; 
  for ($i = 0; isset($file['param'][$i]['@attributes']['key']); $i++)
  {  
      $key = $file['param'][$i]['@attributes']['key'];
      
      if ($key != "xres")
        continue;
      
      // result
      $value = $file['param'][$i]['@attributes']['value'];
      
      if ($value != '') 
      {   
          $t = @unserialize(urldecode($value));
          if (is_array($t))
          {
              // exit
              exit ("You can't edit this file here. Please choose another editor.");          
          }
        
          $value = str_replace("[nln]", "~", $value); // ~ for colors
    
          // divide
          $three = preg_split('~;\s*~', $value);
          // points
          if (isset($three[0]))
            $temp['points'] = $three[0];
          // polygons
          if (isset($three[1]))
            $temp['polygons'] = $three[1];
          // colors
          if (isset($three[2]))
            $temp['colors'] = $three[2];
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

function createFunction($function, $temp, $config)
{
    // get the right function; otherwise return    
    $right_function = "";
    if (strpos($function, 'ttack'))
      $right_function = "attack";
    else if (strpos($function, 'reate')) 
      $right_function = "create";
    else
      return $temp;
      
    // initialize
    $count = (int)$GLOBALS['func']['count_createfunction'];
      
    // process
    $div = "<div id=\"f_" . $count . "\"><hr />";
    // icon image
    $icon = preg_split('~/\s*~', $temp[$function]['icon']);
    $icon = end($icon);
    $div .= "<img class=\"icon\" src=\"" . $config['icons'] . '/' . $right_function . '/' . $icon . "\" /><br />";    
    // function
    $div .= "Function: <span id=\"f_" . $count . "_function\">" . $right_function . "</span><br />";
    // name
    $div .= "Name: <span id=\"f_" . $count . "_name\">" . $temp[$function]['name'] . "</span><br />";
    // icon
    $div .= "Icon: <span id=\"f_" . $count . "_icon\">" . $icon . "</span><br />";
    // description
    $div .= "Description: <span id=\"f_" . $count . "_description\">" . $temp[$function]['description'] . "</span><br />";
    
    // variables
    if ($right_function == "attack")
    {
        $div .= "Attack: <span id=\"f_" . $count . "_attack\">" . (int)$temp[$function]['attack']['value'] . "</span><br />";
        $div .= "Distance: <span id=\"f_" . $count . "_distance\">" . (int)$temp[$function]['distance']['value'] . "</span><br />";
        $div .= "Cooldown: <span id=\"f_" . $count . "_cooldown\">" . (int)$temp[$function]['cooldown']['value'] . "</span><br />";
        $div .= "Count: <span id=\"f_" . $count . "_count\">" . (int)$temp[$function]['count']['value'] . "</span><br />";
        $div .= "Eff: <span id=\"f_" . $count . "_eff\">" . (int)$temp[$function]['eff']['value'] . "</span><br />";
        $div .= "Xeff: <span id=\"f_" . $count . "_xeff\">" . (int)$temp[$function]['xeff']['value'] . "</span><br />";
        // total
        $div .= "Total: <span id=\"f_" . $count . "_total\">" . (int)$temp[$function]['total']['value'] . "</span><br />";
    } 
    else if ($right_function == "create")
    {
        $div .= "Maxfs: <span id=\"f_" . $count . "_maxfs\">" . (int)$temp[$function]['maxfs']['value'] . "</span><br />";
        $div .= "Limit: <span id=\"f_" . $count . "_limit\">" . (int)$temp[$function]['limit']['value'] . "</span><br />";
        $div .= "Cooldown: <span id=\"f_" . $count . "_cooldown\">" . (int)$temp[$function]['cooldown']['value'] . "</span><br />";
        $div .= "Eff: <span id=\"f_" . $count . "_eff\">" . (int)$temp[$function]['eff']['value'] . "</span><br />";
    }
    
    // removing
    $div .= "<input type=\"button\" id=\"f_" . $count . "_remove\" name=\"f_" . $count . "_remove\" value=\"Remove\" onclick=\"javascript: $('#f_" . $count . "').remove(); implode();\" />";
    
    // ending
    $div .= "</div>";
    
    // save
    $GLOBALS['func'][$right_function] .= $div;
    
    // test
    // echo "<pre>" . htmlspecialchars($div) . "</pre><br />";
    
    // count!!!
    $GLOBALS['func']['count_createfunction'] = $count + 1;
}
?>