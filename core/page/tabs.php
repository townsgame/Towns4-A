<?php

$tabs=$GLOBALS['ss']["use_object"]->set->ifnot('tabs','');
$tabs="($tabs)";
$tabs=str_replace(array('(,',',)','(',')',',,'),'',$tabs);
$tabs=explode(',',$tabs);

//---------------------------------

$newtab=$GLOBALS['get']['tab'];
if($newtab){
    $wtf=$GLOBALS['get']['wtf'];
    if($wtf){
        $q=true;
        foreach($tabs as $tab){if($tab==$newtab){$q=false;}}
        if($q)$tabs[count($tabs)]=$newtab;
    }else{
        $tabs2=array();
        foreach($tabs as $tab){if($tab!=$newtab){$tabs2[count($tabs2)]=$tab;}}
        $tabs=$tabs2;
    }
}

//---------------------------------

if($GLOBALS['config']['register_building']){
if($hl=sql_1data('SELECT id FROM [mpx]objects WHERE ww='.$GLOBALS['ss']['ww'].' AND own='.useid.' AND type=\'building\' and TRIM(name)=\''.id2name($GLOBALS['config']['register_building']).'\' LIMIT 1')){
    $GLOBALS['hl']=$hl;
}else{
    $GLOBALS['hl']=0; 
}
}else{
    $GLOBALS['hl']=0; 
}
//--------------------------
if($GLOBALS['hl']){
    $q=false;
    foreach($tabs as $tab){if($tab==$hl){$q=true;}}
    if($q==false){$tabs[count($tabs)]=$hl;
    $newtab=$hl;}
}
//---------------------------------
$q=false;$stream='';
$stream.=('<table style="background: rgba(30,30,30,0.9);border: 2px solid #222222;border-radius: 7px;" cellpadding="0" cellspacing="0" width="1000"><tr><td>');
$tabs2=array();
foreach($tabs as $tab){
    if($name=id2name($tab)){
        $tabs2[count($tabs2)]=$tab;
        if($q)$stream.=(nbsp2.'|'.nbsp2);
        $stream.=labelr(ahrefr(short($name,20),"e=miniprofile;contextid=$tab","none","x"),$name." ($tab)");  
        $q=true;
    }
}
$tabs=$tabs2;
$stream.=('</td></tr></table>');
//if(debug)br();
if($q)e($stream);
//---------------------------------
if($newtab){
    $tabs=implode(',',$tabs);
    $GLOBALS['ss']["use_object"]->set->add("tabs",$tabs);
    subref('miniprofile');
}
 ?>