<?php
window('{profile_edit}');
infob(ahrefr('{back}','e=content;ee=profile'));

contenu_a();

if($GLOBALS['get']['id'])$GLOBALS['ss']['profile_edit_id']=$GLOBALS['get']['id'];
if(!$GLOBALS['ss']['profile_edit_id'])$GLOBALS['ss']['profile_edit_id']=useid;
$id=$GLOBALS['ss']['profile_edit_id'];

    $info=array();
    $tmpinfo=xquery("info",$id);
    $info["profile"]=new profile($tmpinfo["profile"]);
    $info["name"]=$tmpinfo["name"];
    $p=$info["profile"]->vals2list();

if($_GET["profile_edit"]){
    //xreport();
    //$response=xquery("move",$_POST["move_x"],$_POST["move_y"]);  
    if($_POST["name"] and $info["name"]!=$_POST["name"]){
        xquery("profile_edit",$id,"name",$_POST["name"]);
        //print_r($GLOBALS['ss']["xresponse"]);
        xreport();
        $info["name"]=$_POST["name"];
    }
    //if($post["realname"]){xquery("profile_edit","realname",$post["realname"]);}
    //if($post["gender"]){xquery("profile_edit","gender",$post["gender"]);}
    //if($post["showmail"]){xquery("profile_edit","showmail",$post["showmail"]);}
    //if($post["web"]){xquery("profile_edit","web",$post["web"]);}
    //if($post["image"]){xquery("profile_edit","image",$post["image"]);}
    if($_POST["description"] and $p["description"]!=$_POST["description"]){xquery("profile_edit",$id,"description",$_POST["description"]);xreport();$p["description"]=$_POST["description"];}
    
    
}
//realname,gender,age,showmail,web,description

//print_r($array);
?>

<?php

form_a(urlr('profile_edit=1'),'profile_edit');
//<form id="login" name="login" method="POST" action="">
?>


<table>


<tr><td><b><?php le("name"); ?>:</b></td><td><?php input_text("name",$info["name"]); ?></td></tr>
<?php /* ?>
<tr><td><b><?php le("realname"); ?>:</b></td><td><?php input_text("realname",$p["realname"]); ?></td></tr>
<tr><td><b><?php le("gender"); ?>:</b></td><td><?php input_select("gender",$p["gender"],array(" "=>"---", "male"=>"Muž", "female"=>"Žena")); ?></td></tr>
<tr><td><b><?php le("showmail"); ?>:</b></td><td><?php input_checkbox("showmail",$p["showmail"]);  le("Mail můžete změnit v nastavení."); ?></td></tr>
<tr><td><b><?php le("web"); ?>:</b></td><td>http://<?php input_text("web",$p["web"]); ?></td></tr>
<tr><td><b><?php le("image"); ?>:</b></td><td><?php input_text("image",$p["image"]); ?></td></tr>
<?php */ ?>
<tr><td><b><?php le("description"); ?>:</b></td><td><?php input_textarea("description",$p["description"],44,17); ?></td></tr>



<tr><td colspan="2"><input type="submit" value="OK" /></td>
</tr></table>

<?php
form_b();
form_js('content','?e=profile_edit&profile_edit=1',array('name','description'));



contenu_b();
?>
