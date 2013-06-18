<?php
r($GLOBALS['get']["id"]);
if($_GET["id"]){
    $id=$_GET["id"];
}elseif($GLOBALS['get']["id"]){
    $id=$GLOBALS['get']["id"];
}else{
    $id=$GLOBALS['ss']["use_object"]->set->ifnot('changeid',0);
}


//--------------------------
if(ifobject($id)){
 $GLOBALS['ss']["use_object"]->set->add('changeid',$id);    
    
$object= new object($id);
$eff=$object->supportF('change','eff');
$surkey=array('fuel'=>'Palivo',
              'wood'=>'Dřevo',
              'stone'=>'Kámen',
              'iron'=>'Železo'
);
window('{change_title}');
infob($object->name." (efektivita: ".round(100*$eff)."%)");
contenu_a();
    //xreport();
    
    $url=("q=$id.change [change_from],[change_to],[change_count]");
    form_a(urlr($url),'change');
    
    input_select('change_from',NULL,$surkey);
    textb(nbsp3.'{change_fromto}'.nbsp3);
    input_select('change_to',NULL,$surkey);br();
    textb('{change_count}: ');
    input_text('change_count',100,15,7);br();
    
    
    form_sb();
    form_js('content','?e=hold-change&'.$url,array('change_to','change_from','change_count'));

contenu_b();
}
?>