<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/chat_aac.php

   Chat -obsah
*/
//==============================




 $iconsize=30;
 $url="e=content;ee=text-messages;ref=chat;id=".useid;
 $stream='';


 $add1='`to`='.useid.'';//' OR `to`='.logid.'';
 $add2="`type`='message' OR `type`='report' ";
 $q=sql_1data("SELECT COUNT(1) FROM `".mpx."text` WHERE `new`=1 AND ($add1) AND ($add2)");
 //$q=textbr($q);
 //$stream.=movebyr($q,-27,-4,'','z-index:2000;');
 //ahref($stream,$url);
 
 if($q){
    $stream.=imgr("icons/f_text_new.png",'{f_text_new;'.$q.'}',$iconsize);
    echo($q);
 }else{
    $stream.=imgr("icons/f_text.png",'{f_text}',$iconsize);
 }
 
 ahref($stream,$url);
if(debug)echo(rand(1111,9999));
 ?>
