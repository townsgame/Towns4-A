<?php
if (isset($_POST['ok']))
{
    // save to database
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
  
  <script type="text/javascript">
    $(function() {
          var i = 0;
          $("div[id^='rotation_']").each(function() {
              
              i = parseInt(this.id.split('_')[1]);
              if (isNaN(i))
                i = 0;
                          
              // definition
              var character = '';
              var max = 100;
              if (i == 0)
              {
                character = '°';
                max = 360;
              }                             
          
              var amount = "#amount_" + i.toString();
              $(this).slider({
                      range: "min",
                      value: 0,
                      min: 0, 
                      max: max,
                      slide: function( event, ui ) 
                      {
                           $(amount).val(ui.value + character);
                      }        
                  });        
                            
              $(amount).val($(this).slider("value") + character);
          });          
      });
      
      function basic_activate()
      {
          $("#simple").hide();
          $("#basic").show();
      }
      
      function simple_activate()
      {
          $("#basic").hide();
          $("#simple").show();
      }
      
  </script>
  
  <style type="text/css">
    textarea
    {
        height: 200px;
        width: 300px;
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
  </style>
  
</head>
<body>
<center>
<form id="modelform" method="post" >
  <table onmouseup="javascript: generate();">
  <tr valign="top">
    <td>
        Vertices<br />
        <textarea id="points" onchange="javascript: generate();"></textarea><br />
        Polygons<br />
        <textarea id="polygons" onchange="javascript: generate();"></textarea>
    </td>
    <td>
        Model<br />
        <iframe id="modelpage" scrolling="yes"></iframe><br />  
    </td>
    <td>
        Colors<br />
        <textarea id="colors" onchange="javascript: generate();"></textarea>
    </td>
  </tr>
  <tr valign="middle">
    <td colspan="3" align="center">
        <label for="amount_0">Rotation:</label>&nbsp;<input type="text" id="amount_0" onchange="javascript: generate();" /><br />
        <div id="rotation_0" onclick="javascript: generate();"></div> 
    </td>
  </tr>
  <tr valign="bottom">
    <td colspan="3" align="center">
      <input type="button" onclick="javascript: simple_activate();" value="Simple tools" />
      <input type="button" onclick="javascript: basic_activate();" value="Basic tools" />
    </td>
  </tr>
  </table>
  <hr />
  
  <div id="simple">
    <table>
    <tr>
      <td>Add Cube</td>
      <td>Add Cone</td>
    </tr>
    <tr>
      <td>        
        <label for="amount_1">Height:</label>&nbsp;<input type="text" id="amount_1" /><br />
        <div id="rotation_1"></div> 
      </td>
      <td>        
        <label for="amount_10">Offset:</label>&nbsp;<input type="text" id="amount_10" /><br />
        <div id="rotation_10"></div> 
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_2">Width:</label>&nbsp;<input type="text" id="amount_2" /><br />
        <div id="rotation_2"></div> 
      </td>
      <td>        
        <label for="amount_12">Width:</label>&nbsp;<input type="text" id="amount_12" /><br />
        <div id="rotation_12"></div>
      </td>
    </tr>
    <tr>
      <td>        
        <label for="amount_3">Depth:</label>&nbsp;<input type="text" id="amount_3" /><br />
        <div id="rotation_3"></div> 
      </td>
      <td>        
        <label for="amount_13">Depth:</label>&nbsp;<input type="text" id="amount_13" /><br />
        <div id="rotation_13"></div> 
      </td>
    </tr>
    <tr>
      <td>        
      </td>
      <td>        
        <label for="amount_11">Height:</label>&nbsp;<input type="text" id="amount_11" /><br />
        <div id="rotation_11"></div>  
      </td>
    </tr>
    <tr>       
      <td><input type="text" name="cube_color" class="color" value="000000" /></td>
      <td><input type="text" name="cone_color" class="color" value="000000" /></td>
    </tr>     
    <tr>       
      <td><input type="button" name="cube_a" value="Add" onclick="javascript: addCube();" />&nbsp;<input type="button" name="cube_r" value="Delete previous" onclick="javascript: removeCube();" /></td>
      <td><input type="button" name="cone_a" value="Add" onclick="javascript: addCone();" />&nbsp;<input type="button" name="cone_r" value="Delete previous" onclick="javascript: removeCone();" /></td>
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
      <td><input type="button" name="point_a" value="Add" onclick="javascript: addPoint();" /></td>
      <td><input type="button" name="polygon_a" value="Add" onclick="javascript: addPolygon();" /></td>
      <td></td>
      <td></td>                                  
    </tr>
    </table>
  </div>
  <hr />
  <input type="submit" name="ok" value="Create" onclick="javascript: return confirm('Do you really want to create the model?')" />
</form>
</center>

</body>
</html>