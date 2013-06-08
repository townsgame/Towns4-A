<?php
$fields="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, (SELECT `name` from ".mpx."objects as x WHERE x.`id`=".mpx."objects.`own`) as `ownname`, `in`, `ww`, `x`, `y`, `t`";
if($_GET["id"]){
    $id=$_GET["id"];
}elseif($GLOBALS['get']["id"]){
    $id=$GLOBALS['get']["id"];
}else{
    $id=$GLOBALS['ss']["use_object"]->set->ifnot('upgradetid',0);
}


//--------------------------
if($id?ifobject($id):false){
    $sql="SELECT $fields FROM ".mpx."objects WHERE id=$id";
    $array=sql_array($sql);
    list($id, $name, $type, $dev, $fs, $fp, $fr, $fx, $fc, $func, $hold, $res, $profile, $set, $hard, $own, $ownname, $in, $ww, $x, $y, $t)=$array[0];
 
    if($own==useid or $own==logid){
        $GLOBALS['ss']["use_object"]->set->add('upgradetid',$id);
        //--------------------------
        if($fs==$fp){
        }else{
            window('Opravit budovu');
            
            
            
            infob(ahrefr('opravit budovu','e=content;ee=create-upgrade;q='.$id.'.repair'));
            contenu_a();
            xreport();
if(xsuccess()){
  ?>
<script>
setTimeout(function()x{
    w_close('content');
}x,3000);
<?php urlx('e=miniprofile',false); ?>
</script>
<?php
}
            $price=new hold($fc);
            $price->multiply($fp/$fs);
            textb('Cena: ');
            $price->showimg();
            hr();
            profile($id);
            contenu_b();
            
        }
        //--------------------------
    }
}

?>