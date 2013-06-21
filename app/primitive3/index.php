<?php
// read
// test
$config = array(
    'config' => 'config.ini',
);
$GLOBALS['config'] = $config;
// config
$config_file = parse_ini_file($GLOBALS['config']['config']);
// read other data
$GLOBALS['config']['modelurl'] = $config_file['modelurl'];
$GLOBALS['config']['infourl'] = $config_file['infourl'];
$GLOBALS['config']['icons'] = $config_file['icons'];
$GLOBALS['config']['baseurl'] = $config_file['baseurl'];
// file
if (isset($_GET['url']) || isset($_GET['id']))
{
  if (isset($_GET['url']))
    $GLOBALS['config']['url'] = $_GET['url'];
  if (isset($_GET['id']))
    $GLOBALS['config']['id'] = $_GET['id'];
}
else if (isset($_POST['url']) || isset($_POST['id']))
{
  if (isset($_POST['url']))
    $GLOBALS['config']['url'] = $_POST['url'];
  if (isset($_POST['id']))
    $GLOBALS['config']['id'] = $_POST['id'];
}
else if ($config_file['baseurl'] == "test" && isset($config_file['file_testonly'])) 
{
  $GLOBALS['config']['file'] = $config_file['file_testonly'];
}
// init & read
require "files/init.php";
$file = initialize($GLOBALS['config'], $config_file);
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
    $array_int = array(
        "amount_1",
        "amount_11",
        "amount_2",
        "amount_21",
        "amount_3",
        "amount_22",
        "roof",        
    );
    $array_string = array(
        "cube_color",
        "cone_color",
        "doorcolor",
    );
    $array_int1 = array(
        "amount_attack_attack",
        "amount_attack_distance",
        "amount_attack_cooldown",
        "amount_attack_count",
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
        "name_attack",
        "description_attack",
        "icon",
        "res"
    );   
    
    $response = array();
    foreach ($array_int as $value)
    {        
        $response[$value] = (int)htmlspecialchars($_POST[$value]);
        
        // check at least some limit
        $response[$value] = max($response[$value], 0);
        if ($value == "roof")
          $response[$value] = min($response[$value], 1); // ROOF
        else
          $response[$value] = min($response[$value], 50);
    }
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
        
        $response['Z' . $value] = $temp;
    }
    foreach ($array_string as $value)
    {
        $response[$value] = (string)htmlspecialchars($_POST[$value]);
    }
    foreach ($array_string1 as $value)
    {
        // icon
        if ($value == 'icon') // attack
        {  
          $v = preg_split('~/\s*~', $_POST[$value]);
          // get last
          $_POST[$value] = end($v);
          // exists      
          if (!file_exists($GLOBALS['config']['icons'] . "/attack/" . $_POST[$value]))
          {                        
              $_POST[$value] = "attack.png";
          }
        }
        
        if ($value == "name" || $value == "name_attack")
        {
          $_POST[$value] = str_replace("\n", "", $_POST[$value]);  
          $_POST[$value] = str_replace('"', "", $_POST[$value]);         
        }
        else
        {
          $_POST[$value] = str_replace("\n", "[nln]", $_POST[$value]);  
          $_POST[$value] = str_replace('"', "[doublequote]", $_POST[$value]);     
          $_POST[$value] = str_replace("|", "[nln]", $_POST[$value]);  
          $_POST[$value] = str_replace('~', "[doublequote]", $_POST[$value]);
        }              
        
        $response['Z' . $value] = (string)htmlspecialchars($_POST[$value]);
    }
    
    // checkboxes
    // door
    if (isset($_POST["door"]) && ($_POST["door"] == "on" || $_POST["door"] == 1))
      $_POST["door"] = 1;
    else
      $_POST["door"] = 0;     
    $response["door"] = $_POST["door"];
    // functions
    // total
    if (isset($_POST["total"]) && ($_POST["total"] == "on" || $_POST["total"] == 1))
      $_POST["total"] = 1;
    else
      $_POST["total"] = 0;
    $response["Ztotal"] = $_POST["total"];
    
    // save      
    save($response, $GLOBALS['config'], $style);
}
?>
<!DOCTYPE html>
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
              var min = 1;
              
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
                  var amount = "amount_" + i.toString();
                  if (array_key_exists(amount, file["res"]))
                  {
                      val = file["res"][amount];
                  }
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

      
      function cube()
      {
          removeCube();
          addCube();
          generate();
      }
      
      function cone()
      {
          removeCone();
          addCone();
          generate();
      }
      
      function begin()
      {
          removeAll();
          addCube();
          addCone();
          generate();
      }
      
      function showF()
      {
          $("#M").hide();
          $("#F").show();
      }
      
      function showM()
      {
          $("#F").hide();
          $("#M").show();
      }
      
      // important
      function explode()
      {
          $("#res").val(generate(1));
          
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
               
  </script>
  
  <style type="text/css">
    div.colorsdiv
    {
        height: 10px;
        width: 10px;
        clear: none;
        margin: 1px;
        padding: 1px;
        border: 1px solid black;
    }
    textarea
    {
        height: 300px;
        width: 300px;
    }
    textarea .po
    {
        height: 500px;
    }
    div[id*="rotation"]
    {
        width: 200px;
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
    table
    {
        text-align: center;
    }
    .advanced
    {
        display: none;
    }
    .coltab
    {
        padding: 0px;
        margin: 0px;
    }
    img.icon
    {
        height: 32px;
    }
    img#active_icon
    {
        height: 64px;
    }
    td.td_side
    {
      max-width: 200px;
    }
  </style>
  
</head>
<body onmouseup="javascript: begin();" onchange="javascript: begin();">  
<center>

<form id="modelform_primitive" method="post" action="#">
  <input type="button" id="functions" onclick="javascript: showF();" value="Information" />&nbsp;
  <input type="button" id="model" onclick="javascript: showM();" value="Model" />
  <input type="button" id="price" name="price" value="Compute price" onclick="javascript: readPrice();" />
  <input type="submit" id="ok1" name="ok1" value="Save" onclick="javascript: if(confirm('Do you really want to save the model?')) { if($('#name').val().length < 4 || isFinite($('#name').val()[0])) { alert('The name must not contain a number in the first position, and must contain at least 4 characters.'); return false; } explode(); $(window).unbind('beforeunload'); return true; } else { return false; } " />&nbsp;
  <br />
  <hr />
  Price:
  <br />
  <div id="pricediv">
  </div>           
  <hr />
  <br />

  <div class="advanced">
    <textarea class="po" id="points" name="points" onchange="javascript: generate();"></textarea>
    <textarea class="po" id="polygons" name="polygons" onchange="javascript: generate();"></textarea>
    <textarea class="po" id="colors" name="colors" onchange="javascript: generate();"></textarea>
  </div> 
  <div id="F"> 
  <table>
  <tr valign="top">
  <td>
    <table>
    <tr>
      <th>
        Information
      </th>
    </tr>
    <tr>
      <td>Name&nbsp;<input type="text" id="name" name="name" maxlength="100" value="<?= (isset($file['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['name'])) : "") ?>" /></td>
    </tr>
    <tr>
      <td>Author&nbsp;<input type="text" id="author" name="author" maxlength="100" value="<?= (isset($file['author']) ? str_replace('~', '"', str_replace('|', "\n", $file['author'])) : "") ?>" /></td>
    </tr>
    <tr>
      <td>Description<br /><textarea id="description" name="description"><?= (isset($file['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['description'])) : "Description ...") ?></textarea></td>
    </tr>
    </table>
  </td>
  <td> 
    <table>
    <tr align="center">
      <th>
        Attack
      </th>
    </tr>
    <tr  align="center">
      <td>
            Name&nbsp;<input type="text" id="name_attack" name="name_attack" maxlength="100" value="<?= (isset($file['attack']['name']) ? str_replace('~', '"', str_replace('|', "\n", $file['attack']['name'])) : "") ?>" />     
      </td>
    </tr>
    <tr  align="center">
      <td>
            <label for="amount_attack_attack"><b>Attack:</b></label>&nbsp;<input type="text" id="amount_attack_attack" name="amount_attack_attack" value="<?= $file['attack']['attack']['default']; ?>" /><br />
            <div id="rotation_attack_attack"></div>          
      </td>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_attack_distance"><b>Distance:</b></label>&nbsp;<input type="text" id="amount_attack_distance" name="amount_attack_distance" value="<?= $file['attack']['distance']['default']; ?>" /><br />
            <div id="rotation_attack_distance"></div>       
      </td>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_attack_cooldown"><b>Cooldown:</b></label>&nbsp;<input type="text" id="amount_attack_cooldown" name="amount_attack_cooldown" value="<?= $file['attack']['cooldown']['default']; ?>" /><br />
            <div id="rotation_attack_cooldown"></div>        
      </td>
    </tr>
    <tr align="center">
      <td>
            <label for="rotation_attack_count"><b>Count:</b></label>&nbsp;<input type="text" id="amount_attack_count" name="amount_attack_count" value="<?= $file['attack']['count']['default']; ?>" /><br />
            <div id="rotation_attack_count"></div>        
      </td>
    </tr> 
    <tr align="center">
      <td>
            <?php $d = (isset($file['attack']['total']['default']) ? $file['attack']['total']['default'] : 0); ?>
            <input type="checkbox" id="total" name="total" <?= $d == 1 ? 'checked="checked"' : '' ?> value="1" />Total<br /> 
            
            Icon<br />       
            <img id="active_icon" src="<?= isset($file['attack']['icon']) && $file['attack']['icon'] != '' ? $file['attack']['icon'] : '' ?>" /><br />
            <?php 
                if (isset($file['attack']['icons']))
                {           
                    $i = 1;
                    // default
                    $default = $GLOBALS['config']['icons'] . '/attack/attack.png';
                    if (file_exists($default))
                    {
                         echo "<img class=\"icon\" src=\"" . $default . "\" onclick=\"javascript: $('#icon').val(this.src); $('#active_icon').attr('src', this.src); implode();\" />&nbsp;";
                         $i = 2;
                    }
                    // others
                    foreach ($file['attack']['icons'] as $icon)
                    { 
                        $v = preg_split('~/\s*~', $icon);
                        $v = end($v);
                        if ($v == "attack.png")
                          continue;
                   
                        echo "<img class=\"icon\" src=\"" . $icon . "\" onclick=\"javascript: $('#icon').val(this.src); $('#active_icon').attr('src', this.src); implode();\" />&nbsp;";
                        
                        if ($i % 5 == 0)
                          echo "<br />";                                                  
                        $i++;
                    }
                }
            ?>
            <input type="hidden" id="icon" name="icon" value="<?= isset($file['attack']['icon']) ? $file['attack']['icon'] : '' ?>" />       
      </td>
    </tr>
    <tr align="center">
      <td>
            Description<br /><textarea id="description_attack" name="description_attack"><?= (isset($file['attack']['description']) ? str_replace('~', '"', str_replace('|', "\n", $file['attack']['description'])) : "Description ...") ?></textarea><br />       
      </td>
    </tr>
    </table>
  </td>
  <td>
    <table>
    <tr align="center">
      <th>
        Defence
      </th>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_defence_defence"><b>Defence</b></label>&nbsp;<input type="text" id="amount_defence_defence" name="amount_defence_defence" value="<?= $file['defence']['defence']['default']; ?>" /><br />
            <div id="rotation_defence_defence"></div>          
      </td>
    </tr>
    </table>
    <table>
    <tr align="center">
      <th>
        Expand
      </th>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_expand_distance"><b>Distance</b></label>&nbsp;<input type="text" id="amount_expand_distance" name="amount_expand_distance" value="<?= $file['expand']['distance']['default']; ?>" /><br />
            <div id="rotation_expand_distance"></div>          
      </td>
    </tr>
    </table>
    <table>
    <tr align="center">
      <th>
        Collapse
      </th>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_collapse_distance"><b>Distance</b></label>&nbsp;<input type="text" id="amount_collapse_distance" name="amount_collapse_distance" value="<?= $file['collapse']['distance']['default']; ?>" /><br />
            <div id="rotation_collapse_distance"></div>          
      </td>
    </tr>
    </table>
    <table>
    <tr align="center">
      <th>
        Hard
      </th>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_hard_hard"><b>Hard</b></label>&nbsp;<input type="text" id="amount_hard_hard" name="amount_hard_hard" value="<?= $file['hard']['hard']['default']; ?>" /><br />
            <div id="rotation_hard_hard"></div>          
      </td>
    </tr>
    </table>
    <table>
    <tr align="center">
      <th>
        Resistance
      </th>
    </tr>
    <tr align="center">
      <td>
            <label for="amount_resistance_hard"><b>Hard</b></label>&nbsp;<input type="text" id="amount_resistance_hard" name="amount_resistance_hard" value="<?= $file['resistance']['hard']['default']; ?>" /><br />
            <div id="rotation_resistance_hard"></div>          
      </td>
    </tr>
    </table>
  </td>
  </tr>
  </table> 
  </div>
  <div id="M">
    <table>
    <tr valign="top">
      <td>
       <table>
        <tr>
          <td class="td_side"><img src="files/images/walls.JPG" title="Walls" /></td>
        </tr>
        <tr>
          <td class="td_side">        
            <label for="amount_1"><b>Height:</b></label>&nbsp;<input type="text" id="amount_1" name="amount_1" value="<?= (isset($file['res']['amount_1']) ? $file['res']['amount_1'] : 25) ?>" /><br />
            <div id="rotation_1"></div> 
          </td>
        </tr>
        <tr>
          <td class="td_side">        
            <label for="amount_2"><b>Left width:</b></label>&nbsp;<input type="text" id="amount_2" name="amount_2" value="<?= (isset($file['res']['amount_2']) ? $file['res']['amount_2'] : 25) ?>" /><br />
            <div id="rotation_2"></div> 
          </td>      
        </tr>
        <tr>
          <td class="td_side">        
            <label for="amount_3"><b>Right width:</b></label>&nbsp;<input type="text" id="amount_3" name="amount_3" value="<?= (isset($file['res']['amount_3']) ? $file['res']['amount_3'] : 25) ?>" /><br />
            <div id="rotation_3"></div> 
          </td>
        </tr>
        <tr>       
          <td class="td_side">
              <table class="coltab"><tr>
                <td><div class="colorsdiv" style="background-color: #6A979E" onmouseup="javascript: changeColor('cube_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #AD7886" onmouseup="javascript: changeColor('cube_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #A5AD3A" onmouseup="javascript: changeColor('cube_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #089F68" onmouseup="javascript: changeColor('cube_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #826655" onmouseup="javascript: changeColor('cube_color', this); implode();"></div></td>
              </tr></table>          
          </td>
        </tr> 
        <tr>       
          <td class="td_side"><input type="text" id="cube_color" name="cube_color" class="color" value="<?= (isset($file['res']['cube_color']) ? $file['res']['cube_color'] : '6A979E') ?>" /></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="td_side"><img src="files/images/door.JPG" title="Door" /></td>
        </tr>
        <tr>
          <td class="td_side">
            <?php $d = (isset($file['res']['door']) ? $file['res']['door'] : 1); ?>
            <input type="checkbox" id="door" name="door" value="1" <?= $d == 1 ? 'checked="checked"' : '' ?> onclick="javascript: cube();" />Door        
          </td>
        </tr>
        <tr>   
          <td class="td_side"> 
            <label for="amount_21"><b>Height:</b></label>&nbsp;<input type="text" id="amount_21" name="amount_21" value="<?= (isset($file['res']['amount_21']) ? $file['res']['amount_21'] : 10) ?>" /><br />
            <div id="rotation_21"></div>         
          </td>
        </tr>
        <tr>
          <td class="td_side">
              <label for="amount_22"><b>Width:</b></label>&nbsp;<input type="text" id="amount_22" name="amount_22" value="<?= (isset($file['res']['amount_22']) ? $file['res']['amount_22'] : 10) ?>" /><br />
              <div id="rotation_22"></div>  
          </td>
        </tr>
        <tr>       
          <td class="td_side">
              <table class="coltab"><tr>
                <td><div class="colorsdiv" style="background-color: #5A944B" onmouseup="javascript: changeColor('doorcolor', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #596994" onmouseup="javascript: changeColor('doorcolor', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #E5FF1C" onmouseup="javascript: changeColor('doorcolor', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #BF432A" onmouseup="javascript: changeColor('doorcolor', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #B96213" onmouseup="javascript: changeColor('doorcolor', this); implode();"></div></td>
              </tr></table>          
          </td>
        </tr> 
        <tr>       
          <td class="td_side"><input type="text" id="doorcolor" name="doorcolor" class="color" value="<?= (isset($file['res']['doorcolor']) ? $file['res']['doorcolor'] : '5A944B') ?>" /></td>
        </tr>                 
        </table>
      </td>
      <td align="center">
          Model<br />
          <iframe id="modelpage" scrolling="no" frameBorder="0" border="0"></iframe><br />
          <label for="amount_0">Rotation:</label>&nbsp;<input type="text" id="amount_0" name="amount_0"  onchange="javascript: generate();" /><br />
          <div id="rotation_0" onclick="javascript: generate();"></div>   
      </td>
     <td>
       <table>
        <tr>
          <td class="td_side"><img src="files/images/roof.JPG" title="Roof" /></td>
        </tr>
        <tr>
          <td class="td_side">        
            <label for="amount_11"><b>Height:</b></label>&nbsp;<input type="text" id="amount_11" name="amount_11" value="<?= (isset($file['res']['amount_11']) ? $file['res']['amount_11'] : 25) ?>" /><br />
            <div id="rotation_11"></div>  
          </td>
        </tr>
        <tr>   
          <td class="td_side">
              <table class="coltab"><tr>
                <td><div class="colorsdiv" style="background-color: #964636" onmouseup="javascript: changeColor('cone_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #AD1642" onmouseup="javascript: changeColor('cone_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #17621A" onmouseup="javascript: changeColor('cone_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #2D2A62" onmouseup="javascript: changeColor('cone_color', this); implode();"></div></td>
                <td><div class="colorsdiv" style="background-color: #624B35" onmouseup="javascript: changeColor('cone_color', this); implode();"></div></td>
              </tr></table>          
          </td>
        </tr>
        <tr>
          <td class="td_side">
              <input type="text" id="cone_color" name="cone_color" class="color" value="<?= (isset($file['res']['cone_color']) ? $file['res']['cone_color'] : '964636') ?>" />          
          </td>
        </tr>
        <tr>       
          <td class="td_side">
              <img src="files/images/classic.JPG" />&nbsp;<img src="files/images/pyramid.JPG" />
          </td>
        </tr> 
        <tr>       
          <td class="td_side">
              <?php $d = (isset($file['res']['roof']) ? $file['res']['roof'] : 0); ?>
              <input type="radio" id="roof0" name="roof" value="0" <?= $d == 0 ? 'checked="checked"' : '' ?> onclick="javascript: cone();" />Classic&nbsp;
              <input type="radio" id="roof1" name="roof" value="1" <?= $d == 1 ? 'checked="checked"' : '' ?> onclick="javascript: cone();" />Pyramid
          </td>
        </tr>
        <tr>
          <td class="td_side">
            <input type="hidden" id="res" name="res" value="" />
          </td>
        </tr>                
        </table>
      </td> 
    </tr>
    </table>
  </div>
  
</form>  
</center>
<script type="text/javascript">
// get price
function readPrice()
{
  $.post(document.URL, $('#modelform_primitive').serialize(), function(jsonData)
  {
       $("#pricediv").html(jsonData);
  });
}

// begin
begin();

// default
$("#M").hide();

// event
$(":input").change(function() { implode(); });
$(":input").on("keyup", function() { implode(); });
$(":textarea").on("keyup", function() { implode(); });

</script> 
</body>
</html>