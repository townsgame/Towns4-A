<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/chat.php

   Chat -obal
*/
//==============================
?><div style="width:100%;height:2px;background-color:rgb(0,0,0);"></div>
<div style="width:100%;height:2px;background-color:rgba(0,0,0,0);"></div>

<div style="width:40%;height:96px;overflow:hidden;">
<div style="width:110%;height:111px;overflow: hidden;" id="chatscroll">
<?php eval(subpage("chat_text"));/*subref("chat_text",3);*/ ?>
</div>
</div>


<span style="position:absolute;width:100%;"><span style="position:relative;left:45%;top:-77px;">
<?php
eval(subpage("chat_aac"));
 ?>
</span></span>

<?php /*
<form id="form_chat" name="form_chat" onsubmit="return document.chatsubmit();"><!--  method="post"action=""?q=chat [say]-->
    <table border="0" width="50%"><tr><td>
    <input type="text" id="say" name="say" maxlength="160" style="width:100%;height:22px;color: #cccccc;border: 2px solid #000000; background-color: rgba(0,0,0,1);"/>
    </td><td>
    <input type="submit" value=">" style="width:22px;height:22px;color: #cccccc;border: 2px solid #000000; background-color: #000000"/>
    </td></tr></table>
</form>
*/
?>
