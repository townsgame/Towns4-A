<?php
if(!$GLOBALS['nowidth']){
window("{title_help}");
?>
<!--<div style="width:400;"></div>-->
<?php
}

if(!$GLOBALS['ss']["page"]){$GLOBALS['ss']["page"]="index";}

if($GLOBALS['get']["page"]){
    $GLOBALS['ss']["page"]=$GLOBALS['get']["page"];
}

$stream=file_get_contents(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["page"].'.html');

$stream=substr2($stream,'<title>','</title>',0,'<script>$("#window_title_content").html("[]");</script>',false);

$i=0;
while($tmp=substr2($stream,'src="','"',$i)){
    $stream=substr2($stream,'src="','"',$i,imageurl('../help/image/'.$tmp));
    $i++;
}


infob(ahrefr('{help_index}','e=content;ee=help;page=index'));
contenu_a();
e($stream);
contenu_b();
?>