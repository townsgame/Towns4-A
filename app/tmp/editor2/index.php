<?php
// save to file
require "files/php/response.php";
if (isset($_POST['ok1']))
{      
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
        "doorcolor"
    );    
    
    $response = array();
    foreach ($array_int as $value)
    {
        $response[$value] = (int)htmlspecialchars($_POST[$value]);
    }
    foreach ($array_string as $value)
    {
        $response[$value] = (string)htmlspecialchars($_POST[$value]);
    }
    
    // checkboxes
    // door
    if (isset($_POST["door"]))
      $response["door"] = $_POST["door"];
    else
      $response["door"] = 0;
    
    response($response);
}
// save to database by saver.php AJAX
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
  <script type="text/javascript" src="files/js/saver.js"></script>
  <script type="text/javascript" src="files/js/maker_basic.js"></script>
  <script type="text/javascript" src="files/js/maker_simple.js"></script>
  
  <script type="text/javascript">
    $(function() {
          var i = 0;
          $("div[id^='rotation_']").each(function() {
              
              i = parseInt(this.id.split('_')[1]);
              if (isNaN(i))
                i = 0;
                          
              // definition
              var character = '';
              var max = 50;
              var val = 25;
              var min = 1;
              if (i == 0)
              {
                character = '°';
                max = 360;
                val = 0;
                min = 0;
              }
              if (i == 21 || i == 22)
              {
                val = 10;
              }                             
          
              var amount = "#amount_" + i.toString();
              $(this).slider({
                      range: "min",
                      value: val,
                      min: min, 
                      max: max,
                      slide: function( event, ui ) 
                      {
                           $(amount).val(ui.value + character);
                      }        
                  });        
                            
              $(amount).val($(this).slider("value") + character);
          });          
      });
      
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
  </style>
  
</head>
<body onmouseup="javascript: begin();" onchange="javascript: begin();">  
<center>
<form id="modelform_primitive" method="post" action="#">
  <div class="advanced">
    <textarea id="points" name="points" onchange="javascript: generate();"></textarea>
    <textarea id="polygons" name="polygons" onchange="javascript: generate();"></textarea>
    <textarea id="colors" name="colors" onchange="javascript: generate();"></textarea>
  </div>
  <table>
  <tr valign="top">
    <td>
        Model<br />
        <iframe id="modelpage" scrolling="yes"></iframe><br />  
    </td>
  </tr>
  <tr valign="middle">
    <td colspan="3" align="center">
        <label for="amount_0">Rotation:</label>&nbsp;<input type="text" id="amount_0" name="amount_0"  onchange="javascript: generate();" /><br />
        <div id="rotation_0" onclick="javascript: generate();"></div> 
    </td>
  </tr>
  </table>
  <hr />
  
    <table>
    <tr>
      <td><img src="files/images/walls.JPG" title="Walls" /></td>
      <td><img src="files/images/roof.JPG" title="Roof" /></td>
      <td><img src="files/images/door.JPG" title="Door" /></td>
    </tr>
    <tr>
      <td>        
        <label for="amount_1"><b>Height:</b></label>&nbsp;<input type="text" id="amount_1" name="amount_1" value="25" /><br />
        <div id="rotation_1"></div> 
      </td>
      <td>        
        <label for="amount_11"><b>Height:</b></label>&nbsp;<input type="text" id="amount_11" name="amount_11" value="25" /><br />
        <div id="rotation_11"></div>  
      </td>
      <td>
        <input type="checkbox" id="door" name="door" value="1" checked="yes" onclick="javascript: cube();" />Door        
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_2"><b>Left width:</b></label>&nbsp;<input type="text" id="amount_2" name="amount_2" value="25" /><br />
        <div id="rotation_2"></div> 
      </td>      
      <td>
          <table class="coltab"><tr>
            <td><div class="colorsdiv" style="background-color: #964636" onmouseup="javascript: changeColor('cone_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #AD1642" onmouseup="javascript: changeColor('cone_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #17621A" onmouseup="javascript: changeColor('cone_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #2D2A62" onmouseup="javascript: changeColor('cone_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #624B35" onmouseup="javascript: changeColor('cone_color', this);"></div></td>
          </tr></table>          
      </td>
      <td> 
        <label for="amount_21"><b>Height:</b></label>&nbsp;<input type="text" id="amount_21" name="amount_21" value="10" /><br />
        <div id="rotation_21"></div>         
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_3"><b>Right width:</b></label>&nbsp;<input type="text" id="amount_3" name="amount_3" value="25" /><br />
        <div id="rotation_3"></div> 
      </td>
      <td>
          <input type="text" id="cone_color" name="cone_color" class="color" value="964636" />          
      </td>
      <td>
          <label for="amount_22"><b>Width:</b></label>&nbsp;<input type="text" id="amount_22" name="amount_22" value="10" /><br />
          <div id="rotation_22"></div>  
      </td>
    </tr>
    <tr>       
      <td>
          <table class="coltab"><tr>
            <td><div class="colorsdiv" style="background-color: #6A979E" onmouseup="javascript: changeColor('cube_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #AD7886" onmouseup="javascript: changeColor('cube_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #A5AD3A" onmouseup="javascript: changeColor('cube_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #089F68" onmouseup="javascript: changeColor('cube_color', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #826655" onmouseup="javascript: changeColor('cube_color', this);"></div></td>
          </tr></table>          
      </td>
      <td>
          <img src="files/images/classic.JPG" />&nbsp;<img src="files/images/pyramid.JPG" />
      </td>
      <td>
          <table class="coltab"><tr>
            <td><div class="colorsdiv" style="background-color: #5A944B" onmouseup="javascript: changeColor('doorcolor', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #596994" onmouseup="javascript: changeColor('doorcolor', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #E5FF1C" onmouseup="javascript: changeColor('doorcolor', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #BF432A" onmouseup="javascript: changeColor('doorcolor', this);"></div></td>
            <td><div class="colorsdiv" style="background-color: #B96213" onmouseup="javascript: changeColor('doorcolor', this);"></div></td>
          </tr></table>          
      </td>
    </tr> 
    <tr>       
      <td><input type="text" id="cube_color" name="cube_color" class="color" value="6A979E" /></td>
      <td>
          <input type="radio" id="roof0" name="roof" value="0" checked="checked" onclick="javascript: cone();" />Classic&nbsp;
          <input type="radio" id="roof1" name="roof" value="1" onclick="javascript: cone();" />Pyramid
      </td>
      <td><input type="text" id="doorcolor" name="doorcolor" class="color" value="5A944B" /></td>
    </tr>                
    </table>
  <hr />
  <input type="submit" name="ok1" value="Save" onclick="javascript: return confirm('Do you really want to save the model?')" />&nbsp;
  <input type="button" name="ok" value="Create" onclick="javascript: if (confirm('Do you really want to create the model?')) { save(); }" />  
</form>  
<hr />
  Load:&nbsp;<input type="file" name="saved" onchange="javascript: readSaved();" />
</center>
<script type="text/javascript">
// begin
begin();
</script> 
</body>
</html>