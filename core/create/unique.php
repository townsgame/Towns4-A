<?php
window("{title_build}"/*,520,500*/);

//r($GLOBALS['get']);

if($GLOBALS['get']['master']){
$object=new object($GLOBALS['get']['master']);
$GLOBALS['ss']['master']=$object->id;


infob(lr('unique_from',$object->name));
$maxfs=$object->supportF('create','maxfs');
$func=$object->func->vals2list();
$limit=$func['create']['profile']['limit'];
$limit='(id='.implode(' OR id=',$limit).')';

$GLOBALS['where']="own=0 AND ww=0 AND fs<=".$maxfs.' AND '.$limit;


eval(subpage("stat2"));


}else{
//error('!id');
w_close('create-unique');
}
?>