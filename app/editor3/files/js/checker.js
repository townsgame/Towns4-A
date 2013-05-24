      function changeColor(id, colordiv)
      {
          var color = (rgb2hex($(colordiv).css("background-color"))).toUpperCase();    
          $('#' + id).val(color);
          $('#' + id).focus();
          $('#' + id).blur();
      }
      function rgb2hex(rgb) {
          rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
          function hex(x) 
          {
            return ("0" + parseInt(x).toString(16)).slice(-2);
          }
          return hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
      }

      function generate(ret)
      {         
          var url = URL; 
      
          // points
          var points = $("#points").val().split('\n');
          var def_points = points;
          var realpoints = "";
          for (var i in points)
          {
             if (points[i] != '')
             {
                var point = (points[i].split(')')[1]).split(',');
                var x = parseInt(point[0]);
                if (isNaN(x))
                  x = 0;
                var y = parseInt(point[1]);
                if (isNaN(y))
                  y = 0;
                var z = parseInt(point[2]);
                if (isNaN(z))
                  z = 0; 
                realpoints += '[' + x + ',' + y + ',' + z + ']';
             } 
          }
          // polygons
          var polygons = $("#polygons").val().split('\n');
          var def_polygons = polygons;
          var realpolygons = "";
          var first = true;
          var ispolygon = true;
          for (var i in polygons)
          {
             if (polygons[i] != '')
             {
                 var polygon = (polygons[i].split(')')[1]).split(',');
                 var special = (polygons[i].split(')')[0]).indexOf('!');
                 var specialchar = "";
                 if (special >= 0)
                    specialchar = (polygons[i].split(')')[0]).split('!')[0];
                 var str = "";
                 var first1 = true;
                 var threepoints = 0;
                 var points = "";                
                 for (var i in polygon)
                 { 
                    if (polygon[i] != "")
                    {
                        polygon[i] = parseInt(polygon[i]);
                        
                        var real = 1;
                        for (var j in def_points)
                        {
                            if (def_points[j] != "")
                            {
                                var po = 0;
                                var bef = def_points[j].split(')')[0];
                                if (bef.indexOf('!') < 0)
                                   po = parseInt(bef);
                                else
                                   po = parseInt(bef.split('!')[1]);                           
                                
                                var pospec = bef.indexOf('!'); 
                                if (po != 0 && !isNaN(po))
                                {
                                    if (po == polygon[i])
                                    {                                                   
                                        if (pospec < 0 && special < 0)
                                          break;
                                        // only the same
                                        if (pospec >= 0 && special >= 0)
                                          if (bef.split('!')[0].charCodeAt(0) == specialchar.charCodeAt(0))
                                            break;
                                    }                                
                                    real += 1;
                                }
                            }
                        }
                        
                        if (isNaN(real))
                          real = 0;
                        if (first1)
                        {
                          str += real;
                          first1 = false;
                        }
                        else
                          str += ',' + real;
                        threepoints += 1;
                        
                        // check
                        var points_a = points.split('!'); 
                        for (var j in points_a)
                        {
                            if (points_a[j] == 0 || points_a[j] == "")
                              continue;
                        
                            if (polygon[i] == points_a[j])
                            {
                                alert("Polygon can not contain the same vertex twice."); 
                                return;
                            }
                        } 
                        points += polygon[i] + '!';
                          
                        // is polygon
                        if (polygon[i] == 0)
                          ispolygon = false;                        
                    }
                 }
                 if (threepoints < 3)
                 {
                    alert("Polygon must contain at least 3 vertices.");
                    return; 
                 } 

                 if (first)
                 {
                     realpolygons += str;
                     first = false;
                 }
                 else
                   realpolygons += ';' + str;   
             } 
          }
           
          if (ispolygon)
          { 
              // colors
              var colors = $("#colors").val().split('\n');
              var realcolors = "";
              var iscolor = true;
              first = true;
              for (var i in colors)
              {
                 if (colors[i] != '')
                 { 
                    colors[i] = (colors[i].split(')')[1]).substring(0, 6);
                    
                    // is color
                    if (!checkColor(colors[i]))
                      iscolor = false;
                                 
                    if (first)
                    {
                        realcolors += htmlspecialchars(prepareColor(colors[i]).toLowerCase());
                        first = false;
                    }
                    else
                      realcolors += ',' + htmlspecialchars(prepareColor(colors[i]).toLowerCase());
                 } 
                    
              }
                  
              if (iscolor)
              {     
                  // check
                  if ($("#points").val() == "")
                    return;
                  if ($("#polygons").val() == "")
                    return;
                  if ($("#colors").val() == "")
                    return;
                   
                  // set 
                  var res = realpoints + ':' + realpolygons + ':' + realcolors;
                  
                  if (ret != 1)
                  {
                      var rot = parseInt($("#amount_0").val().split('°')[0]);
                      if (isNaN(rot))
                        rot = 0;
                       
                      $('#modelpage').attr('src', '');                                                    
                      $('#modelpage').attr('src', url + "?res=" + res + "&rot=" + rot + "&mode=2");
                  }
                  else
                  {
                      return res;
                  }
              }
              else
                alert("The color is not in correct format.");
           }
           else
              alert("Polygon can not contain zero or a letter.");
              
           return 0;         
      }
      
      function checkColor(hexcolor) 
      {         
         var r = parseInt(hexcolor.substring(0, 2), 16);
         var g = parseInt(hexcolor.substring(2, 4), 16);
         var b = parseInt(hexcolor.substring(4, 6), 16);
         
         if (isNaN(r) || isNaN(g) || isNaN(b))
            return false;
         else
            return true;         
      }
      
      function prepareColor(hexcolor)                 
      {     
         var r = parseInt(hexcolor.substring(0, 2), 16);
         var g = parseInt(hexcolor.substring(2, 4), 16);
         var b = parseInt(hexcolor.substring(4, 6), 16);
         
         r = r.toString(16);
         r = r.length == 1 ? "0" + r : r;
         g = g.toString(16);
         g = g.length == 1 ? "0" + g : g;
         b = b.toString(16);
         b = b.length == 1 ? "0" + b : b;
         
         return (r + g + b);        
      }