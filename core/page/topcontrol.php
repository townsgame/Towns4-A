<?php
//$iconsize=22; 70a5cc 357088

e('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="23" bgcolor="#173440" class="dragbar" valign="center">');

$url=js2('
var offset = $(\'#window_sub_topcontrol\').offset();
tmp=parseFloat($(\'#window_topcontrol\').css(\'top\'));
if($(\'#minimap\').css(\'display\')==\'block\')x{
    if(offset.top>$(window).height()/2)$(\'#window_topcontrol\').css(\'top\',tmp-(-100));
    $(\'#minimap\').css(\'display\',\'none\');
}xelsex{
    if(offset.top>$(window).height()/2)$(\'#window_topcontrol\').css(\'top\',tmp-100);
    /*$(\'#minimap\').css(\'display\',\'block\');*/
 }x1');
$url2='e=content;ee=help;page=copy';

 moveby(ahrefr(imgr('logo/50.png','',27),$url2),0,-5);
 moveby(tfontr(ahrefr('<b>Towns</b>',$url2).'&nbsp;&gt;&nbsp;'.ahrefr('Hlavní&nbsp;ostrov',$url).'',14),27,0);
  
e(nbsp.'</td><td>');





e('</td></tr></table>');




if(!defined("func_map"))require(root.core."/func_map.php");
ahref('<img id="minimap" style="display:none;" src="'.worldmap(300,50).'" width="200"/>',$url);

 ?>
<!--
<span id="minimap_select" style="position:absolute;"><div style="position:relative;left:-109;top:0;width:25px;height:18px;background-color:#993333;border: 1px solid #ff0000;"></div></span>

<script type="text/javascript" >
    $('#minimap_select').draggable();
</script>
-->