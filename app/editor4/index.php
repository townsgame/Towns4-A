<?php
// add function attack
// save as attack, attack2, ...
/*
TO-DO: functions
*/
if (!isset($GLOBALS['config']))
{
  // test
  $config = array(
      'file' => 'files/test/test.xml',
      'modelurl' => 'http://test.towns.cz/app/3dmap/model.php',
      'infourl' => 'http://test.towns.cz/app/3dmap/objectinfo.php',
      'config' => 'config.ini',
      'icons' => 'files/test/icons',
  );
  $GLOBALS['config'] = $config;
}
// alternative
if (!isset($GLOBALS['config']['infourl']) && isset($GLOBALS['config']['objectinfo']))
{
  $GLOBALS['config']['infourl'] = $GLOBALS['config']['objectinfo'];
}

// init & read
require "files/init.php";
$file = initialize($GLOBALS['config']);
?>
<?php
// important
function objectToArray($d) 
{
		if (is_object($d)) 
    {
			$d = get_object_vars($d);
		}
    
		if (is_array($d)) 
    {
			 return array_map(__FUNCTION__, $d);
		}
		else 
    {
			 return $d;
		}
}
 
?>

<?php
// save to file
require "files/saver.php";
// user or ajax
$style = 0;
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
  $style = 1;
if (isset($_POST['ok1']) || $style == 1)
{      
    // checking
    if ($style != 1)
    {
      // name
      if (isset($_POST['name']))
      {
          if (strlen($_POST['name']) < 4 || ($_POST['name'][0] >= '0' && $_POST['name'][0] <= '9'))
          {
              exit("The name must not contain a number in the first position, and must contain at least 4 characters.");
          }
      }
      else
      {
        exit("You must fill in the name.");
      }
            
      // res
      if ($_POST['res'] == '0' || $_POST['res'] == '')
      {
          exit("Sorry, but the model could not be saved. Please check the filled values.");
      }
    }      

    // save to file    
    $response = array();
    
    // iclude name, description, author
    $array_int1 = array(
         "amount_defence_defence",
         "amount_expand_distance",
         "amount_collapse_distance",
         "amount_hard_hard",
         "amount_resistance_hard",
    ); 
    $array_string1 = array(
        "name",
        "description",
        "author",
        "defence_name",
        "defence_description",
        "expand_name",
        "expand_description",
        "collapse_name",
        "collapse_description",
        "hard_name",
        "hard_description",
        "resistance_name",
        "resistance_description",
    );
    foreach ($array_int1 as $value)
    {        
        $temp = (int)htmlspecialchars($_POST[$value]);
                
        // min, max
        $v = preg_split('~_\s*~', $value);
        if (isset($v[1]) && isset($v[2]))
        { 
          if (isset($file[$v[1]][$v[2]]['min']))
          {
                $temp = max($file[$v[1]][$v[2]]['min'], $temp); 
          }
          if (isset($file[$v[1]][$v[2]]['max']))
          {
                $temp = min($file[$v[1]][$v[2]]['max'], $temp); 
          }
        }
        
        $response[$value] = $temp;
    }   
    foreach ($array_string1 as $value)
    {
        // icons
        $f = preg_split('~_\s*~', $value);
    
        if ($value == 'name' || (isset($f[1]) && $f[1] == 'name'))
        {
          $_POST[$value] = str_replace("\n", "", $_POST[$value]);  
          $_POST[$value] = str_replace('"', "", $_POST[$value]);         
        }
        else
        {
          if ($value == 'description' || (isset($f[1]) && $f[1] == 'description'))
          {
            if ($_POST[$value] == "Description ...")
              $_POST[$value] = "";
          }

          $_POST[$value] = str_replace("\n", "[nln]", $_POST[$value]);  
          $_POST[$value] = str_replace('"', "[doublequote]", $_POST[$value]);     
          $_POST[$value] = str_replace("|", "[nln]", $_POST[$value]);  
          $_POST[$value] = str_replace('~', "[doublequote]", $_POST[$value]);
        }              
        
        $response[$value] = (string)htmlspecialchars($_POST[$value]);
    }
    
    // resource
    $response['res'] = (string)htmlspecialchars($_POST['res']);    
    
    // xresource
    $_POST['xres'] = str_replace("\n", "[nln]", $_POST['xres']);
    $_POST['xres'] = str_replace("\r", "", $_POST['xres']);
    $_POST['xres'] = str_replace("\t", "", $_POST['xres']);
    $_POST['xres'] = str_replace(" ", "", $_POST['xres']);
    $response['xres'] = (string)htmlspecialchars($_POST['xres']);    
       
    // functions  
    $response['func'] = (string)$_POST['func'];
    // from json 
    $response['func'] = objectToArray(json_decode(htmlspecialchars_decode($response['func'])));
    // min, max
    $funcs = array("attack", "create");
    foreach ($funcs as $func)
    {
      if (isset($response['func'][$func]) && is_array($response['func'][$func]))
      {
          foreach ($response['func'][$func] as $i => $v)
          {
            foreach ($v as $key => $value)
            {
                if ($key != 'name' && $key != 'icon' && $key != 'description')
                {
                    if (isset($file[$func][$key]['min']))
                      $response['func'][$func][$i][$key] = max($file[$func][$key]['min'], (int)$value);
                    if (isset($file[$func][$key]['max']))
                      $response['func'][$func][$i][$key] = min($file[$func][$key]['max'], (int)$value);
                }
                
                $_POST[$value] = str_replace("\n", "[nln]", $_POST[$value]);  
                $_POST[$value] = str_replace('"', "[doublequote]", $_POST[$value]);     
                $_POST[$value] = str_replace("|", "[nln]", $_POST[$value]);  
                $_POST[$value] = str_replace('~', "[doublequote]", $_POST[$value]);
            }
          }
      }
    }
    
    // save      
    save($response, $GLOBALS['config'], $style);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
	<meta name="author" content="Injection Computers"> 

	<title></title>
  
  <link rel="stylesheet" href="files/css/jquery-ui.css" />
  
  <script type="text/javascript" src="files/js/additional.js"></script>
	<script type="text/javascript" src="files/js/jquery.min.js"></script>
	<script type="text/javascript" src="files/js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="files/js/jscolor/jscolor.js"></script>
  <script type="text/javascript" src="files/js/jquery-1.8.2.js"></script>
  <script type="text/javascript" src="files/js/jquery-ui.js"></script> 
  <script type="text/javascript" src="files/js/checker.js"></script>
  <script type="text/javascript" src="files/js/maker_basic.js"></script>
  <script type="text/javascript" src="files/js/maker_simple.js"></script>
  <script type="text/javascript" src="files/js/jquery.json-2.4.min.js"></script>
  <script type="text/javascript" src="files/js/functions.js"></script>
  
  <script type="text/javascript">
    // URL
    var URL = "<?= $GLOBALS['config']['modelurl'] ?>";
    
    // sliders & values
    $(function() {
          var i = 0;
          var j;
          $("div[id^='rotation_']").each(function() {           
              // definition
              var character = '';
              var max = 50;
              var val = 25;
              var min = 0;
              
              j = this.id.split('_');
              var file = JSON.parse('<?= json_encode($file) ?>');
              
              // rotation
              i = parseInt(j[1]);
              if (isNaN(i))
                i = 1000; // functions                          
              if (i == 0)
              {
                character = '°';
                max = 360;
                val = 0;
                min = 0;
              }
              else if (i == 21 || i == 22)
              {
                val = 10;
              } 
              // functions
              else if (i == 1000)
              {         
                min = parseInt(file[j[1]][j[2]]['min']);
                max = parseInt(file[j[1]][j[2]]['max']);
                val = parseInt(file[j[1]][j[2]]['default']);
              }
              
              // set parameters
              if (i < 1000 && i != 0)
              {     
                  val = 0;
              }
              
              // save                                     
              if (i == 1000)
              {
                var amount = "#amount_" + j[1] + "_" + j[2];
              }
              else
              {
                var amount = "#amount_" + i.toString();
              }
              $(this).slider({
                      range: "min",
                      value: val,
                      min: min, 
                      max: max,
                      slide: function( event, ui ) 
                      {
                           $(amount).val(ui.value + character);
                           if ($(this).attr("id") != "rotation_0")
                              implode();
                      }        
                  });        
                            
              $(amount).val($(this).slider("value") + character);
          });          
      });
      
      // look up for keys
      function array_key_exists(key, search) 
      {
        if (!search || (search.constructor !== Array && search.constructor !== Object)) 
        {
          return false;
        }
        return key in search;
      }
      
      // important
      function explode()
      {
          // resource
          $("#res").val(generate(1));
          // xresource
          var str = $("#points").val() + ';' + $("#polygons").val() + ';' + $("#colors").val();
          $("#xres").val(htmlspecialchars(str).replace("\n", "[nln]"));
          // functions
          unifyFunctions();
          
          $("#ok1").css("background-color", "inherit");
      }
      
      function implode()
      {
          $("#ok1").css("background-color", "red");
          
          // bind
          // leave
          $(window).bind('beforeunload', function()
          {
                return "Do you really want to leave this page? Unsaved data may be lost.";
          });
      }
      
      function basic_activate()
      {
          $("#simple").hide();
          $("#information").hide();
          $("#attack").hide();
          $("#create").hide();
          $("#functions").hide();
          $("#basic").show();
      }
      
      function simple_activate()
      {
          $("#basic").hide();
          $("#information").hide();
          $("#attack").hide();
          $("#create").hide();
          $("#functions").hide();
          $("#simple").show();
      }

      function attack_activate()
      {
          $("#basic").hide();
          $("#information").hide();
          $("#create").hide();
          $("#functions").hide();
          $("#simple").hide();
          $("#attack").show();
      }
      
      function create_activate()
      {
          $("#basic").hide();
          $("#information").hide();
          $("#attack").hide();
          $("#functions").hide();
          $("#simple").hide();
          $("#create").show();
      }
      
      function functions_activate()
      {
          $("#basic").hide();
          $("#information").hide();
          $("#attack").hide();
          $("#create").hide();
          $("#simple").hide();
          $("#functions").show();
      }
      
      function information_activate()
      {
          $("#basic").hide();
          $("#attack").hide();
          $("#create").hide();
          $("#functions").hide();
          $("#simple").hide();
          $("#information").show();
      }
      
  </script>
  
  <style type="text/css">
    body
    {
      min-width: 1000px;
    }
    textarea
    {
        height: 200px;
        width: 200px;
    }
    div[id*="rotation"]
    {
        width: 200px;
        margin-bottom: 4px;
    }
    input[id*="amount"]
    {
        border: 0; 
        font-weight: bold;
        width: 35px;
    }
    iframe#modelpage
    {
        height: 440px;
        width: 240px;
    }
    td
    {
        padding: 0px 10px 0px 10px;
    }
    #hard
    {
       /* display: none; */
    }
    #basic
    {
    
    }
    #simple
    {
        display: none;
    }
    table
    {
        text-align: center;
    }
    img.icon
    {
        height: 32px;
    }
    img.active_icon
    {
        height: 64px;
        margin-bottom: 4px;
    }
  </style>
  
</head>
<body>
<center>
<form id="modelform" method="post" action="#">
  <table onmouseup="javascript: generate();">
  <tr valign="top">
    <td colspan="3">
      Name&nbsp;<input type="text" id="name" name="name" maxlength="100" value="<?= (isset($file['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['name'])) : "") ?>" />
    </td>
  </tr>
  <tr valign="top">
    <td>
        Vertices<br />
        <textarea id="points" name="points" onchange="javascript: generate();"><?= str_replace('~', "\n", $file['points']); ?></textarea><br />
        Polygons<br />
        <textarea id="polygons" name="polygons" onchange="javascript: generate();"><?= str_replace('~', "\n", $file['polygons']); ?></textarea>
    </td>
    <td>
        Model<br />
        <iframe id="modelpage" scrolling="no" frameBorder="0" border="0"></iframe><br />  
    </td>
    <td>
        Colors<br />
        <textarea id="colors" name="colors" onchange="javascript: generate();"><?= str_replace('~', "\n", $file['colors']); ?></textarea>
    </td>
  </tr>
  <tr valign="middle">
    <td colspan="3" align="center">
        <label for="amount_0">Rotation:</label>&nbsp;<input type="text" id="amount_0" onchange="javascript: generate();" /><br />
        <div id="rotation_0" onclick="javascript: generate();"></div> 
    </td>
  </tr
  <tr valign="bottom">
    <td colspan="3" align="center">
      <input type="button" onclick="javascript: information_activate();" value="Information" />
      <input type="button" onclick="javascript: attack_activate();" value="Attack function" />
      <input type="button" onclick="javascript: create_activate();" value="Create function" />
      <input type="button" onclick="javascript: functions_activate();" value="Other functions" />
      <input type="button" onclick="javascript: simple_activate();" value="Simple tools" />
      <input type="button" onclick="javascript: basic_activate();" value="Basic tools" />
    </td>
  </tr>
  </table>
  <hr />
  
  <div id="information">
      <table>
      <tr>
        <th>
          Information
        </th>
      </tr>
      <tr>
        <td>Author&nbsp;<input type="text" id="author" name="author" maxlength="100" value="<?= (isset($file['author']) ? str_replace('~', '"', str_replace('|', "\n", $file['author'])) : "") ?>" /></td>
      </tr>
      <tr>
        <td>Description<br /><textarea id="description" name="description"><?= (isset($file['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['description'])) : "Description ...") ?></textarea></td>
      </tr>
      </table>  
  </div>
  
  <div id="attack">
    <table>
      <tr valign="top">
        <td>
          <table>
            <tr align="center">
              <th>
                Attack
              </th>
            </tr>
            <tr  align="center">
              <td>
                    Name&nbsp;<input type="text" id="attack_name" name="attack_name" maxlength="100" />     
              </td>
            </tr>
            <tr  align="center">
              <td>
                    <label for="amount_attack_attack"><b>Attack:</b></label>&nbsp;<input type="text" id="amount_attack_attack" name="amount_attack_attack" /><br />
                    <div id="rotation_attack_attack"></div>          
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="amount_attack_distance"><b>Distance:</b></label>&nbsp;<input type="text" id="amount_attack_distance" name="amount_attack_distance" /><br />
                    <div id="rotation_attack_distance"></div>       
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="amount_attack_cooldown"><b>Cooldown:</b></label>&nbsp;<input type="text" id="amount_attack_cooldown" name="amount_attack_cooldown" /><br />
                    <div id="rotation_attack_cooldown"></div>        
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="rotation_attack_count"><b>Count:</b></label>&nbsp;<input type="text" id="amount_attack_count" name="amount_attack_count" /><br />
                    <div id="rotation_attack_count"></div>        
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="rotation_attack_eff"><b>Eff:</b></label>&nbsp;<input type="text" id="amount_attack_eff" name="amount_attack_eff" /><br />
                    <div id="rotation_attack_eff"></div>        
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="rotation_attack_xeff"><b>Xeff:</b></label>&nbsp;<input type="text" id="amount_attack_xeff" name="amount_attack_xeff" /><br />
                    <div id="rotation_attack_xeff"></div>         
              </td>
            </tr>
            <tr align="center">
            <td>
                  <?php $d = (isset($file['attack']['total']['default']) ? $file['attack']['total']['default'] : 0); ?>
                  <input type="checkbox" id="total" name="total" <?= $d == 1 ? 'checked="checked"' : '' ?> value="1" />Total<br />  
                  Icon<br />       
                  <img id="attack_active_icon" class="active_icon" src="<?= $GLOBALS['config']['icons'] . '/attack/attack.png' ?>" /><br />
                  <?php 
                      if (isset($file['attack']['icons']))
                      {           
                          $i = 1;
                          // default
                          $default = $GLOBALS['config']['icons'] . '/attack/attack.png';
                          if (file_exists($default))
                          {
                               echo "<img class=\"icon\" src=\"" . $default . "\" onclick=\"javascript: $('#attack_icon').val(this.src); $('#attack_active_icon').attr('src', this.src); implode();\" />&nbsp;";
                               $i = 2;
                          }
                          // others
                          foreach ($file['attack']['icons'] as $icon)
                          { 
                              $v = preg_split('~/\s*~', $icon);
                              $v = end($v);
                              if ($v == "attack.png")
                                continue;
                         
                              echo "<img class=\"icon\" src=\"" . $icon . "\" onclick=\"javascript: $('#attack_icon').val(this.src); $('#attack_active_icon').attr('src', this.src); implode();\" />&nbsp;";
                              
                              if ($i % 5 == 0)
                                echo "<br />";                                                  
                              $i++;
                          }
                      }
                  ?>
                  <input type="hidden" id="attack_icon" name="icon" value="<?= $GLOBALS['config']['icons'] . '/attack/attack.png' ?>" />       
            </td>
          </tr>
          <tr align="center">
            <td>
                  Description<br /><textarea id="attack_description" name="attack_description">Description ...</textarea><br />       
            </td>
          </tr>
          <tr align="center">
            <td>
                  <input type="button" id="attack_add" name="attack_add" value="Add" onclick="javascript: addFunction('attack'); implode();" />      
            </td>
          </tr>
          </table> 
      </td>
      <td>
          <div id="attack_ids">
            <?= $GLOBALS['func']['attack'] ?>
          </div>
      </td>
    </tr>
  </table>  
  </div>
  
  <div id="create">
    <table>
      <tr valign="top">
        <td>
          <table>
            <tr align="center">
              <th>
                Create
              </th>
            </tr>
            <tr  align="center">
              <td>
                    Name&nbsp;<input type="text" id="create_name" name="create_name" maxlength="100" />     
              </td>
            </tr>
            <tr  align="center">
              <td>
                    <label for="amount_create_maxfs"><b>Maxfs:</b></label>&nbsp;<input type="text" id="amount_create_maxfs" name="amount_create_maxfs" /><br />
                    <div id="rotation_create_maxfs"></div>         
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="amount_create_limit"><b>Limit:</b></label>&nbsp;<input type="text" id="amount_create_limit" name="amount_create_limit" /><br />
                    <div id="rotation_create_limit"></div>       
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="amount_create_cooldown"><b>Cooldown:</b></label>&nbsp;<input type="text" id="amount_create_cooldown" name="amount_create_cooldown" /><br />
                    <div id="rotation_create_cooldown"></div>        
              </td>
            </tr>
            <tr align="center">
              <td>
                    <label for="rotation_create_eff"><b>Eff:</b></label>&nbsp;<input type="text" id="amount_create_eff" name="amount_create_eff" /><br />
                    <div id="rotation_create_eff"></div>        
              </td>
            </tr>
            <tr align="center">
            <td>
                  Icon<br />       
                  <img id="create_active_icon" class="active_icon" src="<?= $GLOBALS['config']['icons'] . '/create/create.png' ?>" /><br />
                  <?php 
                      if (isset($file['create']['icons']))
                      {           
                          $i = 1;
                          // default
                          $default = $GLOBALS['config']['icons'] . '/create/create.png';
                          if (file_exists($default))
                          {
                               echo "<img class=\"icon\" src=\"" . $default . "\" onclick=\"javascript: $('#create_icon').val(this.src); $('#create_active_icon').attr('src', this.src); implode();\" />&nbsp;";
                               $i = 2;
                          }
                          // others
                          foreach ($file['create']['icons'] as $icon)
                          { 
                              $v = preg_split('~/\s*~', $icon);
                              $v = end($v);
                              if ($v == "create.png")
                                continue;
                         
                              echo "<img class=\"icon\" src=\"" . $icon . "\" onclick=\"javascript: $('#create_icon').val(this.src); $('#create_active_icon').attr('src', this.src); implode();\" />&nbsp;";
                              
                              if ($i % 5 == 0)
                                echo "<br />";                                                  
                              $i++;
                          }
                      }
                  ?>
                  <input type="hidden" id="create_icon" name="icon" value="<?= $GLOBALS['config']['icons'] . '/create/create.png' ?>" />       
            </td>
          </tr>
          <tr align="center">
            <td>
                  Description<br /><textarea id="create_description" name="create_description">Description ...</textarea><br />       
            </td>
          </tr>
          <tr align="center">
            <td>
                  <input type="button" id="create_add" name="create_add" value="Add" onclick="javascript: addFunction('create'); implode();" />      
            </td>
          </tr>
          </table> 
      </td>
      <td>
          <div id="create_ids">
            <?= $GLOBALS['func']['create'] ?>
          </div>      
      </td>
    </tr>
  </table>  
  </div>
  
  <div id="functions">
      <table>
        <tr align="center">
          <th>
            Defence
          </th>
          <th>
            Expand
          </th>
          <th>
            Collapse
          </th>
          <th>
            Hard
          </th>
          <th>
            Resistance
          </th>
        </tr>
        <tr  align="center">
           <td>
                Name&nbsp;<input type="text" id="defence_name" name="defence_name" maxlength="100" value="<?= isset($file['defence']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['defence']['name'])) : 0 ?>" />     
           </td>
           <td>
                Name&nbsp;<input type="text" id="expand_name" name="expand_name" maxlength="100" value="<?= isset($file['expand']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['expand']['name'])) : 0 ?>" />     
           </td>
           <td>
                Name&nbsp;<input type="text" id="collapse_name" name="collapse_name" maxlength="100" value="<?= isset($file['collapse']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['collapse']['name'])) : 0 ?>" />     
           </td>
           <td>
                Name&nbsp;<input type="text" id="hard_name" name="hard_name" maxlength="100" value="<?= isset($file['hard']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['hard']['name'])) : 0 ?>" />     
           </td>
           <td>
                Name&nbsp;<input type="text" id="resistance_name" name="resistance_name" maxlength="100" value="<?= isset($file['resistance']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['resistance']['name'])) : 0 ?>" />     
           </td>
        </tr>
        <tr align="center">
          <td>
                <label for="amount_defence_defence"><b>Defence</b></label>&nbsp;<input type="text" id="amount_defence_defence" name="amount_defence_defence" /><br />
                <div id="rotation_defence_defence"></div>          
          </td>
          <td>
                <label for="amount_expand_distance"><b>Distance</b></label>&nbsp;<input type="text" id="amount_expand_distance" name="amount_expand_distance" /><br />
                <div id="rotation_expand_distance"></div>          
          </td>
          <td>
                <label for="amount_collapse_distance"><b>Distance</b></label>&nbsp;<input type="text" id="amount_collapse_distance" name="amount_collapse_distance" /><br />
                <div id="rotation_collapse_distance"></div>          
          </td>
          <td>
                <label for="amount_hard_hard"><b>Hard</b></label>&nbsp;<input type="text" id="amount_hard_hard" name="amount_hard_hard" /><br />
                <div id="rotation_hard_hard"></div>          
          </td>
          <td>
                <label for="amount_resistance_hard"><b>Hard</b></label>&nbsp;<input type="text" id="amount_resistance_hard" name="amount_resistance_hard" /><br />
                <div id="rotation_resistance_hard"></div>          
          </td>
        </tr>
        <tr align="center">
            <td>
                  Description<br /><textarea id="defence_description" name="defence_description"><?= isset($file['defence']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['defence']['description'])) : "Description ..." ?></textarea><br />       
            </td>
            <td>
                  Description<br /><textarea id="expand_description" name="expand_description"><?= isset($file['expand']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['expand']['description'])) : "Description ..." ?></textarea><br />       
            </td>
            <td>
                  Description<br /><textarea id="collapse_description" name="collapse_description"><?= isset($file['collapse']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['collapse']['description'])) : "Description ..." ?></textarea><br />       
            </td>
            <td>
                  Description<br /><textarea id="hard_description" name="hard_description"><?= isset($file['hard']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['hard']['description'])) : "Description ..." ?></textarea><br />       
            </td>
            <td>
                  Description<br /><textarea id="resistance_description" name="resistance_description"><?= isset($file['resistance']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['resistance']['description'])) : "Description ..." ?></textarea><br />       
            </td>
        </tr>
      </table>
  </div>
  
  <div id="simple">
    <table>
    <tr>
      <td>Add Cube/Walls</td>
      <td>Add Cone/Roof</td>
    </tr>
    <tr>
      <td>        
        <label for="amount_4">Offset:</label>&nbsp;<input type="text" id="amount_4" /><br />
        <div id="rotation_4"></div> 
      </td>
      <td>        
        <label for="amount_10">Offset:</label>&nbsp;<input type="text" id="amount_10" /><br />
        <div id="rotation_10"></div> 
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_1"><b>Height:</b></label>&nbsp;<input type="text" id="amount_1" /><br />
        <div id="rotation_1"></div> 
      </td>
      <td>        
        <label for="amount_11"><b>Height:</b></label>&nbsp;<input type="text" id="amount_11" /><br />
        <div id="rotation_11"></div>  
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_5">Offset:</label>&nbsp;<input type="text" id="amount_5" /><br />
        <div id="rotation_5"></div> 
      </td>
      <td>        
        <label for="amount_14">Offset:</label>&nbsp;<input type="text" id="amount_14" /><br />
        <div id="rotation_14"></div> 
      </td>
      <td>        
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_2"><b>Width:</b></label>&nbsp;<input type="text" id="amount_2" /><br />
        <div id="rotation_2"></div> 
      </td>
      <td>        
        <label for="amount_12"><b>Width:</b></label>&nbsp;<input type="text" id="amount_12" /><br />
        <div id="rotation_12"></div>
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_6">Offset:</label>&nbsp;<input type="text" id="amount_6" /><br />
        <div id="rotation_6"></div> 
      </td>
      <td>        
        <label for="amount_15">Offset:</label>&nbsp;<input type="text" id="amount_15" /><br />
        <div id="rotation_15"></div> 
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_3"><b>Depth:</b></label>&nbsp;<input type="text" id="amount_3" /><br />
        <div id="rotation_3"></div> 
      </td>
      <td>        
        <label for="amount_13"><b>Depth:</b></label>&nbsp;<input type="text" id="amount_13" /><br />
        <div id="rotation_13"></div> 
      </td>
    </tr>
    <tr>       
      <td><input type="text" id="cube_color" name="cube_color" class="color" value="000000" /></td>
      <td><input type="text" id="cone_color" name="cone_color" class="color" value="000000" /></td>
    </tr>     
    <tr>       
      <td><input type="button" name="cube_a" value="Add" onclick="javascript: addCube(); implode();" />&nbsp;<input type="button" name="cube_r1" value="Delete previous" onclick="javascript: removeOneCube(); implode();" />&nbsp;<input type="button" name="cube_r" value="Delete all previous" onclick="javascript: removeCube(); implode();" /></td>
      <td><input type="button" name="cone_a" value="Add" onclick="javascript: addCone(); implode();" />&nbsp;<input type="button" name="cone_r2" value="Delete previous" onclick="javascript: removeOneCone(); implode();" />&nbsp;<input type="button" name="cone_r" value="Delete all previous" onclick="javascript: removeCone(); implode();" /></td>
    </tr>           
    </table>
  </div>
         
  <div id="basic">
    <table>
    <tr>
      <td>Add vertex</td>
      <td>Add polygon</td>
      <td></td>
      <td></td>
    </tr>
      <td>x:&nbsp;<input type="text" name="points_x" value="0" /></td>
      <td>1:&nbsp;<input type="text" name="polygons_x" value="0" /></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>y:&nbsp;<input type="text" name="points_y" value="0" /></td>
      <td>2:&nbsp;<input type="text" name="polygons_y" value="0" /></td>
      <td></td>
      <td></td> 
    </tr>
    <tr> 
      <td>z:&nbsp;<input type="text" name="points_z" value="0" /></td>
      <td>3:&nbsp;<input type="text" name="polygons_z" value="0" /></td>
      <td></td>
      <td></td> 
    </tr>
    <tr> 
      <td></td>
      <td>4:&nbsp;<input type="text" name="polygons_t" value="0" /></td>
      <td></td>
      <td></td> 
    </tr>
    <tr>
      <td></td>
      <td>Color</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>&nbsp;&nbsp;<input type="text" name="polygons_color" class="color" value="000000" /></td>
      <td></td>
      <td></td>   
    </tr>
    <tr>
      <td><input type="button" name="point_a" value="Add" onclick="javascript: addPoint(); implode();" /></td>
      <td><input type="button" name="polygon_a" value="Add" onclick="javascript: addPolygon(); implode();" /></td>
      <td></td>
      <td></td>                                  
    </tr>
    </table>
  </div>
  <hr />
  <input type="hidden" id="res" name="res" value="" />
  <input type="hidden" id="xres" name="xres" value="" />
  <input type="hidden" id="func" name="func" value="" />
  <input type="button" id="price" name="price" value="Compute price" onclick="javascript: readPrice();" />
  <input type="submit" id="ok1" name="ok1" value="Save" onclick="javascript: if(confirm('Do you really want to save the model?')) { if($('#name').val().length < 4 || isFinite($('#name').val()[0])) { alert('The name must not contain a number in the first position, and must contain at least 4 characters.'); return false; } if (generate(1) != null) { explode(); $(window).unbind('beforeunload'); return true; } else { alert('Please edit the model.'); return false; } } else { return false; } " />&nbsp;

  <br />
  <hr />
  Price:
  <br />
  <div id="pricediv">
  </div>

</form>
</center>
<script type="text/javascript">
// get price
function readPrice()
{
  $.post(document.URL, $('#modelform').serialize(), function(jsonData)
  {
       $("#pricediv").html(jsonData);
  });
}

// begin
information_activate();
generate();

// event
$(":input").change(function() { implode(); });
$(":input").on("keyup", function() { implode(); });
$(":textarea").on("keyup", function() { implode(); });

</script> 
</body>
</html>