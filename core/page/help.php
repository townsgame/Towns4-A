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


if(!file_exists(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["page"].'.html')){
    $GLOBALS['ss']["page"]="index";
}


$stream=file_get_contents(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["page"].'.html');

$stream=substr2($stream,'<title>','</title>',0,'<script>$("#window_title_content").html("[]");</script>',false);

$i=0;
while($tmp=substr2($stream,'src="','"',$i)){
    $stream=substr2($stream,'src="','"',$i,imageurl('../help/image/'.$tmp));
    $i++;
}

$i=0;
while($tmp=substr2($stream,'href="','"',$i)){
    $stream=substr2($stream,'href="','"',$i,urlr('e=content;ee=help;page='.$tmp));
    $i++;
}
$stream=str_replace('href="javascript:','href="#" onclick="',$stream);


if(!$GLOBALS['nowidth']){
    infob(ahrefr('{help_list}','e=content;ee=help;page=list'));
    contenu_a();
    e($stream);
    contenu_b();
}else{
    e($stream);
}
?>