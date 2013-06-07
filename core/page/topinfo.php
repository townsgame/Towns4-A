<?php
if($GLOBALS['topinfo']){
    if($GLOBALS['topinfo_url']){$url=$GLOBALS['topinfo_url'];}else{$url='';}
    if($GLOBALS['topinfo_color']){$color=$GLOBALS['topinfo_color'];}else{$color=/*'770077'*/'292929';}
    if($GLOBALS['topinfo_textcolor']){$textcolor=$GLOBALS['topinfo_textcolor'];}else{$textcolor='ffcccc';}


    //e('<div style="background:#'.$color.';width:100%;border:0px;" >'.ahrefr($GLOBALS['topinfo'],$url,'none;font-size:16px;color: #'.$textcolor.';').'</div>');

e('<table style="background: rgba(30,30,30,0.9);border: 2px solid #222222;border-radius: 7px;" cellpadding="0" cellspacing="0" width="1000" height="20"><tr><td>');

ahref($GLOBALS['topinfo'],$url,'none;color: #'.$textcolor.';');

e('</td></tr></table>');


}
?>