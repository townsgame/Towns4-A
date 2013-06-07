<div style="width:100%;height:2px;background-color:rgb(0,0,0);"></div>
<div style="width:100%;height:2px;background-color:rgba(0,0,0,0);"></div>

<div style="width:40%;height:86px;overflow:hidden;">
<div style="width:110%;height:101px;overflow:scroll;" id="chatscroll">
<?php eval(subpage("chat_text"));/*subref("chat_text",3);*/ ?>
</div>
</div>

<span style="position:absolute;width:100%;"><span style="position:relative;left:45%;top:-77px;">
<?php
 $iconsize=30;
 $url="e=content;ee=text-messages;ref=chat;id=".useid;
 $stream='';


 $add1='`to`='.useid.' OR `to`='.logid.'';
 $add2="`type`='message' OR `type`='report' ";
 $q=sql_1data("SELECT COUNT(1) FROM `".mpx."text` WHERE `new`=1 AND ($add1) AND ($add2)");
 //$q=textbr($q);
 //$stream.=movebyr($q,-27,-4,'','z-index:2000;');
 //ahref($stream,$url);
 
 if($q){
    $stream.=imgr("icons/f_text_new.png",'{f_text_new;'.$q.'}',$iconsize);
 }else{
    $stream.=imgr("icons/f_text.png",'{f_text}',$iconsize);
 }
 
 ahref($stream,$url);
 ?>
</span></span>

<form id="form_chat" name="form_chat" onsubmit="return document.chatsubmit();"><!--  method="post"action=""?q=chat [say]-->
    <table border="0" width="50%"><tr><td>
    <input type="text" id="say" name="say" maxlength="160" style="width:100%;height:22px;color: #cccccc;border: 2px solid #000000; background-color: rgba(0,0,0,1);"/>
    </td><td>
    <input type="submit" value=">" style="width:22px;height:22px;color: #cccccc;border: 2px solid #000000; background-color: #000000"/>
    </td></tr></table>
</form>

