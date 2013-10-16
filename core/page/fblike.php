<div id="fb-root"></div>
<script>(function(d, s, id) x{
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1&appId=408791555870621";
  fjs.parentNode.insertBefore(js, fjs);
}x(document, 'script', 'facebook-jssdk'));</script>


<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="23" bgcolor="#173440" valign="center">

<?php if(defined('fb_page')){ ?>

<div class="fb-like" data-href="https://www.facebook.com/<?php e(fb_page); ?>" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="dark" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>
<?php } ?>

</td></tr></table>
