<?php
window("{title_plus}");
infob('{plus_infob;'.$GLOBALS['ss']['use_object']->name.'}');
contenu_a();
//infob('');


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
contenu_b();
?>
