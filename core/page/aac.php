<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/aac.php

   Tlačítko zprávy
*/
//==============================




    //$GLOBALS['js']=true;
    //echo("alert('aac');");
	if(!logged()){
		e('window.location.replace(\'?q=logout\');');
	}else{
?>
if(!document.nochatref)x{<?php subjs('chat_text');/**/ ?>;$("#chatscroll").scrollTop(10000);}x
<?php subjs('surkey');/*$GLOBALS['ss']['use_object']->hold->showjs();*/ ?>
<?php subjs('chat_aac'); ?>
<?php /*
setTimeout(function()x{
    urlpart='?e=aac&i='+windows;windows='';
    $(function()x{$.get(urlpart, function(vystup)x{eval(vystup);}x);}x);
}x,(connectfps*1000));
*/ ?>
<?php } ?>
