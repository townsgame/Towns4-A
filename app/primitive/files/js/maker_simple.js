      function addCube()
      {         
          var height = parseInt($('#amount_1').val());
          if (isNaN(height))
            height = 0;
          var width = parseInt($('#amount_2').val());
          if (isNaN(width))
            width = 0;
          var depth = parseInt($('#amount_3').val());
          if (isNaN(depth))
            depth = 0;
            

          height = Math.min(height, 50);
          width = Math.min(width, 50);
          depth = Math.min(depth, 50);

          if (height == 0 || width == 0 || depth == 0)
          {
              alert("The height, width and depth can not be null.");
              return;
          }
          
          // offsets
          var height_o = 1;
          var width_o = 50 - (width / 2);
          var depth_o = 50 - (depth / 2);
          
          // count
          var count = 0;
          var points = $("#points").val().split('\n');
          for (var i in points)
          {
              if (points[i] != '\n' && points[i] != '' && points[i] != ' ')
                count += 1;    
          }
          
          // count
          var pol = 0;
          var polygons = $("#polygons").val().split('\n');
          for (var i in polygons)
          {
              if (polygons[i] != '\n' && polygons[i] != '' && polygons[i] != ' ')
                  pol += 1;    
          }
          
          var cube_points = "";
          var cube_polygons = "";
          var cube_colors = "";
          
          var color = htmlspecialchars($('input[name="cube_color"]').val());
          var dcolor = htmlspecialchars($('input[name="doorcolor"]').val());
           
          if (!$('input:checkbox[name="door"]').is(':checked'))
          {   
              cube_points = "c!" + (count+1) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+2) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+3) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+4) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+5) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+6) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+7) + ")" + (width+width_o) + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+8) + ")" + width_o + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+9) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+10) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+11) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+12) + ")" + (width+width_o) + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+13) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+14) + ")" + width_o + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+15) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+16) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+17) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+18) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+19) + ")" + width_o + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+20) + ")" + width_o + "," + depth_o + "," + (height+height_o) + "\n";
              cube_polygons = "c!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) + "," + (count+4) +
                  "\nc!" + (pol+2) + ")" + (count+5) + "," + (count+6) + "," + (count+7) + "," + (count+8) +
                  "\nc!" + (pol+3) + ")" + (count+9) + "," + (count+10) + "," + (count+11) + "," + (count+12) +
                  "\nc!" + (pol+4) + ")" + (count+13) + "," + (count+14) + "," + (count+15) + "," + (count+16) +
                  "\nc!" + (pol+5) + ")" + (count+17) + "," + (count+18) + "," + (count+19) + "," + (count+20) + "\n";                        
              cube_colors = "|c!" + (pol+1) + "|)" + color +
                  "\n|c!" + (pol+2) + "|)" + color +
                  "\n|c!" + (pol+3) + "|)" + color +
                  "\n|c!" + (pol+4) + "|)" + color +
                  "\n|c!" + (pol+5) + "|)" + color + "\n";
              // is color  
              if (checkColor(color))
              {
                  $("#points").val($("#points").val() + cube_points);
                  $("#polygons").val($("#polygons").val() + cube_polygons);
                  $("#colors").val($("#colors").val() + cube_colors);
              }
              else
                  alert("The color is not in correct format."); 
              }
          else
          {
              var DH = parseInt($('#amount_21').val());
              if (isNaN(DH))
                DH = 0;
              var DW = parseInt($('#amount_22').val());
              if (isNaN(DW))
                DW = 0;
              DH = Math.min(height, DH);
              DW = Math.min(depth, DW);          
                    
              cube_points = "c!" + (count+1) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+2) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+3) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+4) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+5) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+6) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+7) + ")" + (width+width_o) + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+8) + ")" + width_o + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+9) + ")" + (width+width_o) + "," + depth_o + "," + height_o +
                  "\nc!" + (count+10) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + height_o +
                  "\nc!" + (count+11) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + (height+height_o) +
                  "\nc!" + (count+12) + ")" + (width+width_o) + "," + depth_o + "," + (height+height_o) +
                  "\nc!" + (count+13) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+14) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + height_o +
                  "\nc!" + (count+15) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + (height+height_o) +
                  "\nc!" + (count+16) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + (height+height_o) + 
                  "\nc!" + (count+17) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + (height_o+DH) +
                  "\nc!" + (count+18) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + (height_o+DH) +
                  "\nc!" + (count+19) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + height_o +
                  "\nc!" + (count+20) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + height_o +
                  "\nc!" + (count+21) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + (height_o+DH) +
                  "\nc!" + (count+22) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + (height_o+DH) +
                  "\nc!" + (count+23) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)+DW/2) + "," + (height+height_o) +
                  "\nc!" + (count+24) + ")" + (width+width_o) + "," + parseInt(((depth/2)+depth_o)-DW/2) + "," + (height+height_o) +
                  "\nc!" + (count+25) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+26) + ")" + width_o + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+27) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+28) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+29) + ")" + width_o + "," + depth_o + "," + height_o +
                  "\nc!" + (count+30) + ")" + width_o + "," + (depth+depth_o) + "," + height_o +
                  "\nc!" + (count+31) + ")" + width_o + "," + (depth+depth_o) + "," + (height+height_o) +
                  "\nc!" + (count+32) + ")" + width_o + "," + depth_o + "," + (height+height_o) + "\n";      
              cube_polygons = "c!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) + "," + (count+4) +
                  "\nc!" + (pol+2) + ")" + (count+5) + "," + (count+6) + "," + (count+7) + "," + (count+8) +
                  "\nc!" + (pol+3) + ")" + (count+9) + "," + (count+10) + "," + (count+11) + "," + (count+12) +
                  "\nc!" + (pol+4) + ")" + (count+13) + "," + (count+14) + "," + (count+15) + "," + (count+16) + 
                  "\nc!" + (pol+5) + ")" + (count+17) + "," + (count+18) + "," + (count+19) + "," + (count+20) +
                  "\nc!" + (pol+6) + ")" + (count+21) + "," + (count+22) + "," + (count+23) + "," + (count+24) +
                  "\nc!" + (pol+7) + ")" + (count+25) + "," + (count+26) + "," + (count+27) + "," + (count+28) +
                  "\nc!" + (pol+8) + ")" + (count+29) + "," + (count+30) + "," + (count+31) + "," + (count+32) + "\n";
              
              cube_colors = "|c!" + (pol+1) + "|)" + color +
                  "\n|c!" + (pol+2) + "|)" + color +
                  "\n|c!" + (pol+3) + "|)" + color +
                  "\n|c!" + (pol+4) + "|)" + color +
                  "\n|c!" + (pol+5) + "|)" + dcolor +
                  "\n|c!" + (pol+6) + "|)" + color + 
                  "\n|c!" + (pol+7) + "|)" + color + 
                  "\n|c!" + (pol+8) + "|)" + color + "\n";
                     
              // is color  
              if (checkColor(color) && checkColor(dcolor))
              {
                  $("#points").val($("#points").val() + cube_points);
                  $("#polygons").val($("#polygons").val() + cube_polygons);
                  $("#colors").val($("#colors").val() + cube_colors);
              }
              else
                  alert("The color is not in correct format.");    
          }
      }
      
      function removeCube()
      {
          if (true)
          {   
              var points = $("#points").val().split('\n');       
              var polygons = $("#polygons").val().split('\n');
              var colors = $("#colors").val().split('\n');
              
              var po = "";
              var pol = "";
              var co = "";
             
              for (var i in points)
              {
                  if (points[i].indexOf('c') < 0 && points[i] != "")
                  {
                      po += points[i] + "\n"; 
                  }
                    
              }
              for (var i in polygons)
              {
                  if (polygons[i].indexOf('c') < 0 && polygons[i] != "")
                  {
                      pol += polygons[i] + "\n"; 
                  }                    
              }
              for (var i in colors)
              {
                  if (colors[i].indexOf('c') < 0 && colors[i] != "")
                  {
                      co += colors[i] + "\n"; 
                  }
                    
              } 
              
              $("#points").val(po);
              $("#polygons").val(pol);
              $("#colors").val(co);              
          }          
      }
      
      function addCone()
      {         
          var offset = parseInt($('#amount_1').val());
          if (isNaN(offset))
            offset = 0;
          var height = parseInt($('#amount_11').val());
          if (isNaN(height))
            height = 0;
          var width = parseInt($('#amount_2').val());
          if (isNaN(width))
            width = 0;
          var depth = parseInt($('#amount_3').val());
          if (isNaN(depth))
            depth = 0;

          offset = Math.min(offset, 50);
          height = Math.min(height, 50);
          width = Math.min(width, 50);
          depth = Math.min(depth, 50);

          if (height == 0 || width == 0 || depth == 0)
          {
              alert("The height, width and depth can not be null.");
              return;
          }
          
          offset = Math.max(offset, 1);
          height = Math.max(height, 1);
          width = Math.max(width, 1);
          depth = Math.max(depth, 1);
          
          // offsets
          var width_o = 50 - (width / 2);
          var depth_o = 50 - (depth / 2);

          // count
          var count = 0;
          var points = $("#points").val().split('\n');
          for (var i in points)
          {
              if (points[i] != '\n' && points[i] != '' && points[i] != ' ')
                count += 1;    
          }
          
          // count
          var pol = 0;
          var polygons = $("#polygons").val().split('\n');
          for (var i in polygons)
          {
              if (polygons[i] != '\n' && polygons[i] != '' && polygons[i] != ' ')
                  pol += 1;    
          }
         
          var cone_points = "";
          var cone_polygons = "";
          
          if ($('input:radio[name="roof"]:checked').val() == "0")           
          {
              cone_points = "k!" + (count+1) + ")" + (width+width_o) + "," + depth_o + "," + offset +
                  "\nk!" + (count+2) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+3) + ")" + (width+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+4) + ")" + width_o + "," + depth_o + "," + offset +
                  "\nk!" + (count+5) + ")" + width_o + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+6) + ")" + width_o + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+7) + ")" + width_o + "," + depth_o + "," + offset +
                  "\nk!" + (count+8) + ")" +  width_o + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+9) + ")" + (width+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+10) + ")" + (width+width_o) + "," + depth_o + "," + offset +
                  "\nk!" + (count+11) + ")" + width_o + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+12) + ")" + width_o + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+13) + ")" + (width+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+14) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + offset + "\n";
               cone_polygons = "k!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) +
                  "\nk!" + (pol+2) + ")" + (count+4) + "," + (count+5) + "," + (count+6) +
                  "\nk!" + (pol+3) + ")" + (count+7) + "," + (count+8) + "," + (count+9) + "," + (count+10) +
                  "\nk!" + (pol+4) + ")" + (count+11) + "," + (count+12) + "," + (count+13) + "," + (count+14) + "\n";
          }
          else
          {    
              cone_points = "k!" + (count+1) + ")" + width_o + "," + depth_o + "," + offset +
                  "\nk!" + (count+2) + ")" + (width+width_o) + "," + depth_o + "," + offset +
                  "\nk!" + (count+3) + ")" + parseInt((width/2)+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+4) + ")" + width_o + "," + depth_o + "," + offset +
                  "\nk!" + (count+5) + ")" + width_o + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+6) + ")" + parseInt((width/2)+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+7) + ")" + (width+width_o) + "," + depth_o + "," + offset +
                  "\nk!" + (count+8) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+9) + ")" + parseInt((width/2)+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) +
                  "\nk!" + (count+10) + ")" + width_o + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+11) + ")" + (width+width_o) + "," + (depth+depth_o) + "," + offset +
                  "\nk!" + (count+12) + ")" + parseInt((width/2)+width_o) + "," + parseInt((depth/2)+depth_o) + "," + (height+offset) + "\n";
               cone_polygons = "k!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) + "," +
                  "\nk!" + (pol+2) + ")" + (count+4) + "," + (count+5) + "," + (count+6) +
                  "\nk!" + (pol+3) + ")" + (count+7) + "," + (count+8) + "," + (count+9) +
                  "\nk!" + (pol+4) + ")" + (count+10) + "," + (count+11) + "," + (count+12) + "\n";
          } 
           
          var color = htmlspecialchars($('input[name="cone_color"]').val());          
              
          var cone_colors = "|k!" + (pol+1) + "|)" + color +
              "\n|k!" + (pol+2) + "|)" + color +
              "\n|k!" + (pol+3) + "|)" + color +
              "\n|k!" + (pol+4) + "|)" + color + "\n";
          
          // is color  
          if (checkColor(color))
          {
              $("#points").val($("#points").val() + cone_points);
              $("#polygons").val($("#polygons").val() + cone_polygons);
              $("#colors").val($("#colors").val() + cone_colors);
          }
          else
              alert("The color is not in correct format.");    
         
      }
      
      function removeCone()
      {
          if (true)
          {   
              var points = $("#points").val().split('\n');       
              var polygons = $("#polygons").val().split('\n');
              var colors = $("#colors").val().split('\n');
              
              var po = "";
              var pol = "";
              var co = "";
             
              for (var i in points)
              {
                  if (points[i].indexOf('k') < 0 && points[i] != "")
                  {
                      po += points[i] + "\n"; 
                  }
                    
              }
              for (var i in polygons)
              {
                  if (polygons[i].indexOf('k') < 0 && polygons[i] != "")
                  {
                      pol += polygons[i] + "\n"; 
                  }
                    
              }
              for (var i in colors)
              {
                  if (colors[i].indexOf('k') < 0 && colors[i] != "")
                  {
                      co += colors[i] + "\n"; 
                  }
                    
              } 
              
              $("#points").val(po);
              $("#polygons").val(pol);
              $("#colors").val(co);              
          }          
      }
      
      function removeAll()
      {
          if (true)
          {   
              var points = $("#points").val().split('\n');       
              var polygons = $("#polygons").val().split('\n');
              var colors = $("#colors").val().split('\n');
              
              var po = "";
              var pol = "";
              var co = "";
             
              for (var i in points)
              {
                  if ((points[i].indexOf('c') < 0 && points[i].indexOf('k') < 0) && points[i] != "")
                  {
                      po += points[i] + "\n"; 
                  }
                    
              }
              for (var i in polygons)
              {
                  if ((polygons[i].indexOf('c') < 0 && polygons[i].indexOf('k') < 0) && polygons[i] != "")
                  {
                      pol += polygons[i] + "\n"; 
                  }
                    
              }
              for (var i in colors)
              {
                  if ((colors[i].indexOf('c') < 0 && colors[i].indexOf('k') < 0) && colors[i] != "")
                  {
                      co += colors[i] + "\n"; 
                  }
                    
              } 
              
              $("#points").val(po);
              $("#polygons").val(pol);
              $("#colors").val(co);              
          }          
      }
      