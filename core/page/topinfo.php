<?php
if($GLOBALS['topinfo']){
    if($GLOBALS['topinfo_url']){$url=$GLOBALS['topinfo_url'];}else{$url='';}
    if($GLOBALS['topinfo_color']){$color=$GLOBALS['topinfo_color'];}else{$color=/*'770077'*/'292929';}
    if($GLOBALS['topinfo_textcolor']){$textcolor=$GLOBALS['topinfo_textcolor'];}else{$textcolor='cccccc';}


    e('<div style="background:#'.$color.';width:100%;border:0px;" >'.ahrefr($GLOBALS['topinfo'],$url,'none;font-size:22px;color: #'.$textcolor.';').'</div>');
}
?>