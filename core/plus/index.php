<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/plus/index.php

   Okno kupování bonusových surovin
*/
//==============================




window("{title_plus}");
//infob('{plus_infob;'.$GLOBALS['ss']['use_object']->name.'}');


$q=submenu(array("content","plus-index"),array("plus_pay"/*,"plus_code"*/),1,'plus');
//$q=$GLOBALS['ss']['submenu'];


contenu_a();
//infob('');
//echo($q);

if($q==1){

    $icon=iconr('e=content;ee=hold-change;id='.$GLOBALS['hl'],'f_change',"{f_change}",35);
    ?>
    {plus_info}<?php e($icon); ?>
    <hr/>
    <table border="0" cellpadding="3" cellspacing="0" width="100%">
    <?php
    $wurl=str_replace('[world]',w,url);

    $i=0;foreach($GLOBALS['config']['plus'] as $id=>$row){$i++;
    $title=$row['title'];
    $credit=$row['credit'];
    $amount=$row['amount'];
    ?>

    <tr style="<?php e(($i%2)?'background: rgba(0,0,0,0.4)':'') ?>">
    <td width="100" align="left" valign="center">
    <a href="#" onclick="window.open('<?php e($wurl); ?>?e=plus-paypal-psend&amp;first=<?php e($id); ?>&amp;second=<?php e(useid); ?>', '_blank', 'resizable=yes');">
    <h3><?php e($title); ?></h3>
    </a>
    </td><td align="left" valign="center">
    <a href="#" onclick="window.open('<?php e($wurl); ?>?e=plus-paypal-psend&amp;first=<?php e($id); ?>&amp;second=<?php e(useid); ?>', '_blank', 'resizable=yes');">
    <?php ie($credit); ?> {res_<?php e(plus_res); ?>2} {plus_fromto} $<?php e($amount); ?>
    </a>
    </td>
    </tr>


    <?php } ?>
    </table>
    <?php
}elseif($q==2){
   
    e('bonusové kódy');
    
}

contenu_b();
?>
