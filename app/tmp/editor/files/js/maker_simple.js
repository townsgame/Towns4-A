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

          height = Math.min(height, 100);
          width = Math.min(width, 100);
          depth = Math.min(depth, 100);

          if (height == 0 || width == 0 || depth == 0)
          {
              alert("The height, width and depth can not be null.");
              return;
          }
          
          height = Math.max(height, 1);
          width = Math.max(width, 1);
          depth = Math.max(depth, 1);

          // count
          var count = 0;
          var points = $("#points").val().split('\n');
          for (var i in points)
          {
              if (points[i] != '\n' && points[i] != '' && points[i] != ' ')
                count += 1;    
          }
          
          var cube_points = "c!" + (count+1) + ")1,1,0" +
              "\nc!" + (count+2) + ")" + width + ",0,0" +
              "\nc!" + (count+3) + ")" + width + "," + depth + ",0" +
              "\nc!" + (count+4) + ")0," + depth + ",0" +
              "\nc!" + (count+5) + ")1,1," + height +
              "\nc!" + (count+6) + ")" + width + ",0," + height +
              "\nc!" + (count+7) + ")" + width + "," + depth + "," + height +
              "\nc!" + (count+8) + ")0," + depth + "," + height +
              "\nc!" + (count+9) + ")1,1,0" +
              "\nc!" + (count+10) + ")" + width + ",0,0" +
              "\nc!" + (count+11) + ")" + width + ",0," + height +
              "\nc!" + (count+12) + ")1,1," + height +
              "\nc!" + (count+13) + ")" + width + ",0,0" +
              "\nc!" + (count+14) + ")" + width + "," + depth + ",0" +
              "\nc!" + (count+15) + ")" + width + "," + depth + "," + height +
              "\nc!" + (count+16) + ")" + width + ",0," + height +
              "\nc!" + (count+17) + ")0," + depth + ",0" +
              "\nc!" + (count+18) + ")0," + depth + "," + height +
              "\nc!" + (count+19) + ")" + width + "," + depth + "," + height +
              "\nc!" + (count+20) + ")" + width + "," + depth + ",0" +
              "\nc!" + (count+21) + ")1,1,0" +
              "\nc!" + (count+22) + ")0," + depth + ",0" +
              "\nc!" + (count+23) + ")0," + depth + "," + height +
              "\nc!" + (count+24) + ")1,1," + height + "\n";


          // count
          var pol = 0;
          var polygons = $("#polygons").val().split('\n');
          for (var i in polygons)
          {
              if (polygons[i] != '\n' && polygons[i] != '' && polygons[i] != ' ')
                  pol += 1;    
          }
          
          var cube_polygons = "c!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) + "," + (count+4) +
              "\nc!" + (pol+2) + ")" + (count+5) + "," + (count+6) + "," + (count+7) + "," + (count+18) +
              "\nc!" + (pol+3) + ")" + (count+9) + "," + (count+10) + "," + (count+11) + "," + (count+12) +
              "\nc!" + (pol+4) + ")" + (count+13) + "," + (count+14) + "," + (count+15) + "," + (count+16) +
              "\nc!" + (pol+5) + ")" + (count+17) + "," + (count+18) + "," + (count+19) + "," + (count+20) +
              "\nc!" + (pol+6) + ")" + (count+21) + "," + (count+22) + "," + (count+23) + "," + (count+24) + "\n";

          var color = htmlspecialchars($('input[name="cube_color"]').val());          
              
          var cube_colors = "|c!" + (pol+1) + "|)" + color +
              "\n|c!" + (pol+2) + "|)" + color +
              "\n|c!" + (pol+3) + "|)" + color +
              "\n|c!" + (pol+4) + "|)" + color +
              "\n|c!" + (pol+5) + "|)" + color +
              "\n|c!" + (pol+6) + "|)" + color + "\n";
          
          // is color  
          if (checkColor(color))
          {
              $("#points").val($("#points").val() + cube_points);
              $("#polygons").val($("#polygons").val() + cube_polygons);
              $("#colors").val($("#colors").val() + cube_colors);
          
              generate();
          }
          else
              alert("The color is not in correct format.");    
         
      }
      
      function removeCube()
      {
          if (confirm("Do you really want to remove all previous cubes?"))
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
              
              generate();               
          }          
      }
      
      function addCone()
      {         
          var offset = parseInt($('#amount_10').val());
          if (isNaN(offset))
            offset = 0;
          var height = parseInt($('#amount_11').val());
          if (isNaN(height))
            height = 0;
          var width = parseInt($('#amount_12').val());
          if (isNaN(width))
            width = 0;
          var depth = parseInt($('#amount_13').val());
          if (isNaN(depth))
            depth = 0;

          offset = Math.min(offset, 100);
          height = Math.min(height, 100);
          width = Math.min(width, 100);
          depth = Math.min(depth, 100);

          if (height == 0 || width == 0 || depth == 0)
          {
              alert("The height, width and depth can not be null.");
              return;
          }
          
          offset = Math.max(offset, 1);
          height = Math.max(height, 1);
          width = Math.max(width, 1);
          depth = Math.max(depth, 1);

          // count
          var count = 0;
          var points = $("#points").val().split('\n');
          for (var i in points)
          {
              if (points[i] != '\n' && points[i] != '' && points[i] != ' ')
                count += 1;    
          }
          
          var cone_points = "k!" + (count+1) + ")1,1," + offset +
              "\nk!" + (count+2) + ")" + width + ",0," + offset +
              "\nk!" + (count+3) + ")" + width + "," + depth + "," + offset +
              "\nk!" + (count+4) + ")0," + depth + "," + offset +
              "\nk!" + (count+5) + ")1,0," + offset +
              "\nk!" + (count+6) + ")" + width + ",0," + offset +
              "\nk!" + (count+7) + ")" + (width/2) + "," + (depth/2) + "," + (height+offset) +
              "\nk!" + (count+8) + ")1,0," + offset +
              "\nk!" + (count+9) + ")0," + depth + "," + offset +
              "\nk!" + (count+10) + ")" + (width/2) + "," + (depth/2) + "," + (height+offset) +
              "\nk!" + (count+11) + ")" + width + ",0," + offset +
              "\nk!" + (count+12) + ")" + width + "," + depth + "," + offset +
              "\nk!" + (count+13) + ")" + (width/2) + "," + (depth/2) + "," + (height+offset) +
              "\nk!" + (count+14) + ")0," + depth + "," + offset +
              "\nk!" + (count+15) + ")" + width + "," + depth + "," + offset +
              "\nk!" + (count+16) + ")" + (width/2) + "," + (depth/2) + "," + (height+offset) + "\n";


          // count
          var pol = 0;
          var polygons = $("#polygons").val().split('\n');
          for (var i in polygons)
          {
              if (polygons[i] != '\n' && polygons[i] != '' && polygons[i] != ' ')
                  pol += 1;    
          }
          
          var cone_polygons = "k!" + (pol+1) + ")" + (count+1) + "," + (count+2) + "," + (count+3) + "," + (count+4) +
              "\nk!" + (pol+2) + ")" + (count+5) + "," + (count+6) + "," + (count+7) +
              "\nk!" + (pol+3) + ")" + (count+8) + "," + (count+9) + "," + (count+10) +
              "\nk!" + (pol+4) + ")" + (count+11) + "," + (count+12) + "," + (count+13) +
              "\nk!" + (pol+5) + ")" + (count+14) + "," + (count+15) + "," + (count+16) + "\n";

          var color = htmlspecialchars($('input[name="cone_color"]').val());          
              
          var cone_colors = "|k!" + (pol+1) + "|)" + color +
              "\n|k!" + (pol+2) + "|)" + color +
              "\n|k!" + (pol+3) + "|)" + color +
              "\n|k!" + (pol+4) + "|)" + color +
              "\n|k!" + (pol+5) + "|)" + color + "\n";
          
          // is color  
          if (checkColor(color))
          {
              $("#points").val($("#points").val() + cone_points);
              $("#polygons").val($("#polygons").val() + cone_polygons);
              $("#colors").val($("#colors").val() + cone_colors);
          
              generate();
          }
          else
              alert("The color is not in correct format.");    
         
      }
      
      function removeCone()
      {
          if (confirm("Do you really want to remove all previous cones?"))
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
              
              generate();               
          }          
      }