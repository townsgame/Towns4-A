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