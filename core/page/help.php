<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/help.php

   Tento soubor slouží k zobrazování help oken.
*/
//==============================




if(!$GLOBALS['nowidth']){
window("{title_help}");
?>
<!--<div style="width:400;"></div>-->
<?php
}

if(!$GLOBALS['ss']["helppage"]){$GLOBALS['ss']["helppage"]="index";$GLOBALS['ss']["helpanchor"]=false;}

if($GLOBALS['get']["page"]){
    $GLOBALS['ss']["helppage"]=$GLOBALS['get']["page"];
    list($GLOBALS['ss']["helppage"],$GLOBALS['ss']["helpanchor"])=explode('_',$GLOBALS['ss']["helppage"],2);
}

if($GLOBALS['ss']["helpanchor"]=='x'){
	$GLOBALS['ss']["helpanchor"]=$GLOBALS['ss']["log_object"]->set->ifnot('help_'.$GLOBALS['ss']["helppage"].'_anchor',1);
}
$GLOBALS['ss']["log_object"]->set->add('help_'.$GLOBALS['ss']["helppage"].'_anchor',$GLOBALS['ss']["helpanchor"]);


r($GLOBALS['ss']["helppage"].'_'.$GLOBALS['ss']["helpanchor"]);



if(!file_exists(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["helppage"].'.html')){
    $GLOBALS['ss']["helppage"]="tutorial";
    $GLOBALS['ss']["helpanchor"]=1;
}


$stream=file_get_contents(root.'data/help/'.$GLOBALS['ss']["lang"].'/'.$GLOBALS['ss']["helppage"].'.html');

if($GLOBALS['ss']["helpanchor"]){
	$stream=explode('<hr>',$stream);
	$stream=$stream[$GLOBALS['ss']["helpanchor"]-1];
}

$stream=substr2($stream,'<title>','</title>',0,'<script>$("#window_title_content").html("[]");</script>',false);


$stream=str_replace('src="../image/','src="',$stream);
$stream=str_replace('src="../../image/','src="../../image/',$stream);
$i=0;
while($tmp=substr2($stream,'src="','"',$i)){
    $stream=substr2($stream,'src="','"',$i,imageurl('../help/image/'.$tmp));
    $i++;
}

$stream=str_replace('href="http://','http="',$stream);
$i=0;
while($tmp=substr2($stream,'href="','"',$i)){
    $stream=substr2($stream,'href="','"',$i,urlr('e=content;ee=help;page='.$tmp));
    $i++;
}
$stream=str_replace('http="','target="_blank" href="http://',$stream);




$stream=str_replace('href="javascript:','href="#" onclick="',$stream);
$stream=smiles($stream);

if(!$GLOBALS['nowidth']){
    if($GLOBALS['ss']["helpanchor"]){


infob((($GLOBALS['ss']["helpanchor"]-1)?ahrefr('{help_previous}','e=content;ee=help;page='.$GLOBALS['ss']["helppage"].'_'.($GLOBALS['ss']["helpanchor"]-1)).nbspo:'').ahrefr('{help_next}','e=content;ee=help;page='.$GLOBALS['ss']["helppage"].'_'.($GLOBALS['ss']["helpanchor"]-1+2)));


    }else{
	infob(ahrefr('{help_list}','e=content;ee=help;page=list'));
    }
    contenu_a();
    e($stream);
    contenu_b();
}else{
    e($stream);
}
?>
