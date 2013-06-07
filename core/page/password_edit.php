<?php
window('{password_edit}');

infob(ahrefr('{back}','e=content;ee=profile'));
contenu_a();

//echo(rand(1,1000));
//print_r($_POST);
if($_POST["oldpass"] or $_POST["newpass"] or $_POST["newpass"]){
    if($post["newpass"]){
	//alert("{password_change}",1);
	//echo("<hr>");
	//r('hovno');
	   xreport();
        xquery('login',$GLOBALS['ss']["logid"],'towns',$_POST["oldpass"]?$_POST["oldpass"]:$_POST["newpass"],$_POST["newpass"],$_POST["newpass2"]);
        
if(xsuccess()){
  ?> 
<script>
setTimeout(function()x{
    w_close('content');
}x,3000);
</script>
<?php
}
        
        
        xreport();
    }else{
        alert("{password_change_no_error}",2);
    }
}
if($GLOBALS['ss']["logid"]!=$GLOBALS['ss']["useid"]){
    //alert("{password_change_use_warning;".$info2["name"]."}",3);
}
//realname,gender,age,showmail,web,description
//print_r($array);
?>
<form id="changepass" name="changepass" method="POST" action="" onsubmit="return false">
<table>

<?php if(!nopass){ ?>
<tr><td><b><?php le("oldpass"); ?>:</b></td><td><?php input_pass("oldpass",$_POST["oldpass"]); ?></td></tr>
<?php } ?>
<tr><td><b><?php le("newpass"); ?>:</b></td><td><?php input_pass("newpass",$_POST["newpass"]); ?></td></tr>
<tr><td><b><?php le("newpass2"); ?>:</b></td><td><?php input_pass("newpass2",$_POST["newpass2"]); ?></td></tr>


</table>
<input type="submit" value="OK" />
</form>
<script>
$("#changepass").submit(function() x{
    //alert(1);
    $.post('?e=password_edit',
        x{ oldpass: $('#oldpass').val(), newpass: $('#newpass').val(), newpass2: $('#newpass2').val() }x,
        function(vystup)x{/*alert(2);*/$('#content').html(vystup);}x
    );
    return(false);
}x);
</script>
<?php
contenu_b();
?>