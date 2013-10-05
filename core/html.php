<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/html.php

   V tomto souboru je html "obal".
*/
//==============================
?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Towns 4</title>
<meta name="author" content="Pavel Hejný" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<link rel="shortcut icon" href="<?php e(rebase(root.base)); ?>favicon.ico">
<style type="text/css">
<!--
body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
color: #cccccc;
font-size: 14px;
font-family: "trebuchet ms";
}
h1{
font-size: 25px;
}
h3{
font-size: 15px;
}
hr {
border-color: #cccccc;
height: 0.5px;
}
a{color: #cccccc;text-decoration: none;}
-->
</style>

<?php
function script_($script){
    e('<script type="text/javascript" src="'.rebase(url.base.'/'.$script).'"></script>');
}
script_('lib/jquery/js/jquery-1.6.2.min.js');
script_('lib/jquery/js/jquery-ui-1.8.16.custom.min.js');
//script_('lib/jquery/kemayo-maphilight-4cdc2e2/jquery.maphilight.min.js');
//script_('lib/jquery/jquery.tinyscrollbar.min.js');
script_('lib/jquery/jquery.fullscreen-min.js');
script_('lib/jquery/jquery.mousewheel.js');
script_('lib/jquery/jquery.scrollbar.js');
?>

 <script type="text/javascript"> fps=30;</script>
<?php
if(defined('analytics')){
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo(analytics); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ?  'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php 
}
?>
</head>
<body>
<script type="text/javascript">

    z_index=1000;
    <?php if(!debug){ ?>
    $(document).ready(function()x{
       $(document).bind("contextmenu",function(e)x{
              return false;
       }x);
    }x);
    <?php } ?>
    connectfps=2;
    fps=37;
   /*$(document).disableSelection();*/
</script>
<?php
if(logged()/** and 0/**/){
?>
<div style="width:100%;height:100%;" id="html_fullscreen">
<table width="100%" height="100%"><tr>
<td align="center" valign="center"><?php include(root.core."/page/loading.php"); ?></td>
</tr></table>


</div>
<script type="text/javascript">
$(function()x{$.get('?s=<?php e(ssid); ?>&e=-html_fullscreen', function(vystup)x{$('#html_fullscreen').html(vystup);}x);}x);
</script>
<?php
}else{
require(root.core.'/html_fullscreen.php');
}
?>

</body>
</html>
