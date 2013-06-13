function help(url) 
{
  window.open(url, "Help", "toolbar=no,location=no,menubar=no,status=yes,width=640,height=480,scrollbars=yes,resizable=yes");
}

function htmlspecialchars(str)
{
    if (typeof(str) == "string")
    {
      str = str.replace(/&/g, "&amp;");
      str = str.replace(/"/g, "&quot;");
      str = str.replace(/'/g, "&#039;");
      str = str.replace(/</g, "&lt;");
      str = str.replace(/>/g, "&gt;");
    }
    return str;
}

function readSaved()
{               
     var input = document.getElementsByName('saved')[0]; 
     if (input.files && input.files[0])
     {
           // check
           if (input.files[0].size > 1024*1024)
           {
                alert("The file is too long.");
                return;
           }
           
           var f = input.files[0];
           var reader = new FileReader();

           reader.onload = function (e)
           {
                var vals = $.parseJSON(e.target.result);
                for (var key in vals)
                {
                    if (key == "door")
                    {
                        if (vals[key] == 0 && $("#door").is(':checked'))
                          $("#door").click();
                        else if (vals[key] == 1 && !$("#door").is(':checked'))
                          $("#door").click();
                    }
                    else if (key == "roof")
                    {
                        $("#roof" + vals[key]).click();
                    }
                    else
                    {
                        $('#' + key).val(vals[key]);
                    }
                }  
                           
                // new start                      
                alert("The saved data were successfully loaded.");
                begin();
                
                // color fields                
                $("#cube_color").focus();
                $("#cube_color").blur();               
                $("#cone_color").focus();
                $("#cone_color").blur();
                $("#doorcolor").focus();
                $("#doorcolor").blur();  
                              
           }

           reader.readAsText(f);
     }
}  