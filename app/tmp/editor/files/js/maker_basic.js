      function addPoint()
      { 
          var x = parseInt($('input[name="points_x"]').val());
          if (isNaN(x))
            x = 0;
          var y = parseInt($('input[name="points_y"]').val());
          if (isNaN(y))
            y = 0;
          var z = parseInt($('input[name="points_z"]').val());
          if (isNaN(z))
            z = 0;
          
          // count
          var count = 0;
          var points = $("#points").val().split('\n');
          for (var i in points)
          {
              if (points[i] != '\n' && points[i] != '' && points[i] != ' ')
                count += 1;    
          }
            
          var str = (count+1) + ')' + x + ',' + y + ',' + z + '\n';
          $("#points").val($("#points").val() + str);
          
          generate();
      }
      
      function addPolygon()
      { 
          var x = parseInt($('input[name="polygons_x"]').val());
          var y = parseInt($('input[name="polygons_y"]').val());
          var z = parseInt($('input[name="polygons_z"]').val());
          var t = parseInt($('input[name="polygons_t"]').val());
          
          var str = "";
          var count = 0;
          var stop = false;
          if (x != 0 && !isNaN(x))
          {
              str += x;
              count += 1;
          }
          if (y != 0 && !isNaN(y))
          {
            str += ',' + y;
            count += 1;
            
            if (y == x)
              stop = true;
          }
          if (z != 0 && !isNaN(z))
          {
              str += ',' + z;
              count += 1;
              
              if (z == x || z == y)
                stop = true;
          }
          if (t != 0 && !isNaN(t))
          {
              str += ',' + t;
              count += 1;
              
              if (t == x || t == y || t == z)
                stop = true;
          }
          str += '\n';

          // cannot twice
          if (stop)
          {
              alert("Polygon can not contain the same vertex twice.");
              return;
          }
          // at least 3
          if (count < 3)
          {
              alert("Polygon must contain at least first 3 vertices.");
              return;
          }
          
          var count = 0;
          // is polygon
          if (str != '\n' && str != '')         
          {
              // count
              // count = 0;
              var polygons = $("#polygons").val().split('\n');
              for (var i in polygons)
              {
                  if (polygons[i] != '\n' && polygons[i] != '' && polygons[i] != ' ')
                    count += 1;    
              }
          
              str = (count+1) + ')' + str;
              $("#polygons").val($("#polygons").val() + str);
                   
              var color = htmlspecialchars($('input[name="polygons_color"]').val());
              
              // is color
              if (checkColor(color))
              {
                  str = color + '\n';
                  
                  // count
                  count = 0;
                  var colors = $("#colors").val().split('\n');
                  for (var i in colors)
                  {
                      if (colors[i] != '\n' && colors[i] != '' && colors[i] != ' ')
                        count += 1;    
                  }
                  
                  str = '|' + (count+1) +  '|' + ')' + str;
                  $("#colors").val($("#colors").val() + str);
              
                  generate();
              }
              else
                alert("The color is not in correct format.");
          }
      }