<?php

contenu_a(false,false);


if($GLOBALS['get']["profile_edit"]){
    //$response=xquery("move",$_POST["move_x"],$_POST["move_y"]);  
    if($post["name"]){xquery("profile_edit","name",$post["name"]);}
    if($post["realname"]){xquery("profile_edit","realname",$post["realname"]);}
    if($post["gender"]){xquery("profile_edit","gender",$post["gender"]);}
    //echo($post["showmail"]);
    if($post["showmail"]){xquery("profile_edit","showmail",$post["showmail"]);}
    if($post["web"]){xquery("profile_edit","web",$post["web"]);}
    if($post["image"]){xquery("profile_edit","image",$post["image"]);}
    if($post["description"]){xquery("profile_edit","description",$post["description"]);}
    $tmpinfo=xquery("info");
    $info["profile"]=new profile($tmpinfo["profile"]);
    $info["name"]=$tmpinfo["name"];
    //alert("Profil úspěšně upraven",1);
}
//realname,gender,age,showmail,web,description
$p=$info["profile"]->vals2list();
//print_r($array);
?>

<?php

ahref('{back}','e=content;ee=profile');

form_a('profile_edit=1','profile_edit');
//<form id="login" name="login" method="POST" action="">
?>


<table>


<tr><td><b><?php le("name"); ?>:</b></td><td><?php input_text("name",$info["name"]); ?></td></tr>
<tr><td><b><?php le("realname"); ?>:</b></td><td><?php input_text("realname",$p["realname"]); ?></td></tr>
<tr><td><b><?php le("gender"); ?>:</b></td><td><?php input_select("gender",$p["gender"],array(" "=>"---", "male"=>"Muž", "female"=>"Žena")); ?></td></tr>
<tr><td><b><?php le("showmail"); ?>:</b></td><td><?php input_checkbox("showmail",$p["showmail"]);  le("Mail můžete změnit v nastavení."); ?></td></tr>
<tr><td><b><?php le("web"); ?>:</b></td><td>http://<?php input_text("web",$p["web"]); ?></td></tr>
<tr><td><b><?php le("image"); ?>:</b></td><td><?php input_text("image",$p["image"]); ?></td></tr>
<tr><td><b><?php le("description"); ?>:</b></td><td><?php input_textarea("description",$p["description"],40,7); ?></td></tr>



<tr><td colspan="2"><input type="submit" value="OK" /></td>
</tr></table>

<?php
form_b();
form_js('content','?e=profile_edit&'.urlr('profile_edit=1'),array('name','realname','gender','showmail','web','image','description'));

contenu_b();
?>
