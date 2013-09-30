<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/html_fullscreen.php

   V tomto souboru je html vnitřku stránky a správa oken.
*/
//==============================
?><div style="width: 100%; height: 100%;background-color:#43a1f7;overflow: hidden;">


<div id="windows" style="position:relative;top:0px;left:0px;width:100%;height:100%;">
<?php
//#050505
//sleep(5);
if(logged()){
    //r("ahoj");
    $windows=array(
    'topinfo'=>false,
    'chat'=>false,
    'tabs'=>false,
    'miniprofile'=>false,
    'surkey'=>false,
    'topcontrol'=>false,
    );
    //drag,close,mini,changetitle
    //name content x y w h rights noborders
    /*//"left"=>array("left",0,0,180,0,array(1,0,1,1),0),
    "chat"=>array("chat",0,-120,"103%",130,array(0,1,1,1),2),
    "miniprofile"=>array("miniprofile","%%",-120,"103%",130,array(0,1,1,1),1),
    "surkey"=>array("surkey","%%",-25,0,0,array(0,1,1,1),1),
    
       // "funccontrol"=>array("funccontrol",-40,100,40,500,array(0,1,1,1),1),
    //"control"=>array("control",0,50,0,0,array(1,1,1,1),0),
    //"places"=>array("places",-200,350,0,0,array(1,1,1,1),0)
    //"minimap"=>array("minimap",-110,10,0,0,array(0,0,1,1),3),
    "topcontrol"=>array("topcontrol",-75,5,0,0,array(0,0,1,1),3),
    );*/
    //r("ahoj");
    //----------------
    $interface=str2list(xx2x($GLOBALS['ss']["log_object"]->set->val("interface")));
    foreach($interface as $w_name=>$tmp){
        list($w_content,$w_x,$w_y)=explode(",",$tmp);
        $windows[$w_name][0]=$w_content;
        $windows[$w_name][1]=$w_x;
        $windows[$w_name][2]=$w_y;
        $windows[$w_name][5]=array(1,1,1,1);
    }
    //----------------
    $windows['chat']=array("chat",0,-107,"103%",130,array(0,1,1,1),2);
    $windows['tabs']=array("tabs","%%",-141+13,"103%",0,array(0,1,1,1),1);
    $windows['miniprofile']=array("miniprofile","%%",/*-120*/-107,"103%",130,array(0,1,1,1),1);
    $windows['surkey']=array("surkey","%%",-25,0,0,array(0,1,1,1),1);

    if($windows['topcontrol']){
        $x=$windows['topcontrol'][1];
        $y=$windows['topcontrol'][2];
    }else{
        $x=-200;
        $y=1;//-164;//5;
    }
    $windows['topcontrol']=array("topcontrol",$x,$y,204,0,array(0,0,1,1),4);
    
    /*if(!$windows['content'])
    $windows=array_merge($windows,array('content'=>array("help",1,1,contentwidth,0,array(1,1,1,1),0)));*/
    

    //----------------TUTORIAL
    if($GLOBALS['ss']["log_object"]->set->val("tutorial") and !$windows['help']){
        $GLOBALS['ss']["page"]='tutorial1';
        $windows=array_merge($windows,array('content'=>array("help",1,1,contentwidth,0,array(1,1,1,1),0)));
        $GLOBALS['ss']["log_object"]->set->delete("tutorial");
    }
    //----------------NOPASSWORD
    if(nopass and nofb){
        $GLOBALS['topinfo']='{register_nopassword}';
        $GLOBALS['topinfo_url']='e=content;ee=password_edit;'.js2('$(\'#topinfo\').css(\'display\',\'none\');');
        $windows=array_merge(
        $windows,
        array(
            "topinfo"=>array("topinfo",'%%',-161+13,'103%',0,array(0,1,1,1),1),
        ));
    }
    //----------------    
    
    
}else{
    //------------BG
    if(!$GLOBALS['ss']['bg']){
        $bgs=explode(',',$GLOBALS['config']['bg']);
        shuffle($bgs);
        $GLOBALS['ss']['bg']=$bgs[0];
        if(!$GLOBALS['ss']['bg'])$GLOBALS['ss']['bg']='_';
    }
    //------------
    if(substr($GLOBALS['ss']['bg'],0,1)=='_'){
        $windows=array(
        //"login"=>array("login","-350","%",0,0,array(1,1,1,1),0)
        "login-login"=>array("login-login",-350,-450,300,400,array(0,1,1,1),3)
        );
    }else{
        $windows=array(
        "login-login"=>array("login-login",50,-450,300,400,array(0,1,1,1),3)
        );
    }

    if ( $GLOBALS['mobile_detect']->isMobile()) {
        $windows["login-login"]=array("login-login",2,2,'100%',1000,array(0,1,1,1),3);
    }




if($GLOBALS['ss']['fb_select_ids'] and $GLOBALS['ss']['fb_select_key']){
    //echo('fbwindow');
    $windows=array_merge(
    $windows,
    array(
    "login-fb_select"=>array("login-fb_select",'%','%',0,0,array(1,1,1,1),0),
    ));  
}
}
    $windows=array_merge(
    $windows,
    array(
    'copy'=>array("copy",logged?-50:-143,-25,500,0,array(0,1,1,1),1),
    'name'=>array("none",'[xx]','[yy]','[ww]','[hh]',array(1,1,1,1),0),
    'langcontrol'=>array("langcontrol",97,1,62,0,array(0,0,1,1),4)
    ));

    if ( $GLOBALS['mobile_detect']->isMobile()) {
        $windows["langcontrol"][1]=-70;
    }

    if(debug){
        $windows=array_merge(
        $windows,
        array(
        "debug"=>array("debug",10,10,70,0,array(0,1,1,1),1)
        ));
    }
    //$windows=array();
//----------------

foreach($windows as $w_name=>$window){
//r($w_name);
$w_content=$window[0];
$w_x=$window[1];if(!$w_x)$w_x=0;
$w_y=$window[2];if(!$w_y)$w_y=0;
$w_w=$window[3];if(!$w_w)$w_w=0;
$w_h=$window[4];if(!$w_h)$w_h=0;
$w_rights=$window[5];//print_r($w_rights);
$w_noborders=$window[6];
if($w_content and $w_name){
if($w_name=="name")echo("<div id=\"window\" style=\"display:none;\">");
t("window_$w_name>>");
?>
<div id="window_<?php echo($w_name); ?>" style="position:relative; <?php if($w_x==="%"){$w_x=0;echo("left:40%;");}if($w_y==="%"){$w_y=0;echo("top:40%;");}if($w_x==="%%"){$w_x=0;echo("left:50%;");}if($w_y==="%%"){$w_y=0;echo("top:50%;");}if($w_x<0){echo("left:100%; ");}if($w_y<0){echo("top:100%; ");} ?>width:100%; height:0px; overflow:visible;z-index:1000;">
<div id="window_sub_<?php echo($w_name); ?>" <?php  if($w_rights[0]){ ?>class="window"<?php  } ?> style="position:relative; left:<?php echo(is_numeric($w_x)?$w_x-2:$w_x); ?>px; top:<?php echo(is_numeric($w_y)?$w_y-2:$w_y); ?>px; width:<?php echo($w_w); ?>;">
  <table id="window_table_<?php echo($w_name); ?>" width="<?php echo($w_w); ?>" height="<?php echo($w_h); ?>" <?php  if(!$w_noborders or $w_noborders==3){ ?> style="border: 2px solid #222222;border-radius: 5px; " cellpadding="3" cellspacing="0" <?php  }elseif($w_noborders==4){ ?> style="border: 2px solid #222222;border-radius: 5px; " cellpadding="0" cellspacing="0" <?php } ?> >
  	<?php
  	 if(!$w_noborders/* and $w_name!="content"*/){
  	?>
    <tr>
      <td height="19" bgcolor="#444444" class="dragbar" valign="center">
		 <?php
		 $js="w_close('window_$w_name')";
         //$js="$('#window_$w_name').remove();";
		 if($w_rights[1])icon(js2($js),"close","{close}",18);
		 ?>
          <span id="window_title_<?php echo($w_name); ?>"  style="font-size: 17 px;"><?php echo($w_title); ?></span>
	  </td>
    </tr>
	<?php  } ?>
    <tr>
      <td <?php /*e(($w_name=="content")?'class="dragbar"':'');*/ ?> align="left" valign="top" <?php if(!$w_noborders or $w_noborders==2 or $w_noborders==3 or $w_noborders==4){e('style="background: rgba(7,7,7,0.88);"');/*e("background=\"");imageurle("design/windowbg.png");e("\"");*/} ?>>
      
      
	<?php /*if($w_name=="content"){ ?>

		 <?php
         $q=true;
		 $js="w_close('window_$w_name')";
		 moveby(iconr(js2($js),"close","{close}",18),contentwidth-20,0);
		  
		 ?>

	<?php  }*/ ?>
      
      <?php
        //r("t");
     //if($w_name=="content")contenu_a();
		if($w_content!="none"){
        if($w_name=="content")xreport();
		eval(subpage($w_name,$w_content));
		}else{
		echo("innercontent");
		}
		//if($w_name=="content")contenu_b();
        //r("t");
		?>
	</td>
    </tr>
  </table>

</div></div>
<?php
t("<<window_$w_name");
if($w_name=="name")echo("</div>");
}}
?>



<script type="text/javascript">

   $('#window_table_content').height($(window).height()-118);
   $(window).resize(function()x{
      $('#window_table_content').height($(window).height()-118);
   }x);

	function w_close(w_name)x{
        <?php if(debug){ ?>
        alert(w_name);
        <?php } ?>
        if(w_name.substring(0,7)!='window_')x{ 
            w_name='window_'+w_name;
        }x  
	    
        $('#'+w_name).remove();
        w_name=w_name.split("window_").join("");
        windows=windows+w_name+',none,,;';
    }x
	/*-------*/
    zi=1001;
	function w_drag()x{
		$(".window").draggable(x{ handle: ".dragbar" }x);
        $(".window").bind( "dragstart", function(event, ui)x{
			$(this).parent().css("z-index",zi);
            zi=zi+1;
            /*$(this).parent().css("width",2000);*/
		}x);
            $(".window").bind( "dragstop", function(event, ui)x{
			x=parseInt($(this).css("left"))+2;
            y=parseInt($(this).css("top"))+2;
			name= $(this).context.id.split('window_sub_').join('');
			/*alert(name+','+x+','+y);*/
			windows=windows+name+',,'+x+','+y+';';
		}x);
	}x
	w_drag();
	/*-------*/
	function w_open(w_name,w_content,w_urlpart,xx,yy,ww,hh)x{
        /*alert('w_open: '+w_name+'('+w_content+')');*/
        if(!w_urlpart)w_urlpart="";
        /*if(!xx)xx=1;
        if(!yy)yy=1;
        if(!ww)ww=449;
        if(!hh)hh=$(document).height()-118;*/
        if(w_name!='content')x{
            if(!xx)xx=50;
            if(!yy)yy=50;
            if(!ww)ww=<?php e(contentwidth); ?>;
            if(!hh)hh=$(/*window*/'#html_fullscreen').height()-118;
        }xelsex{
            if(!xx)xx=1;
            if(!yy)yy=1;
        }x
        if(!ww)ww=0;
        if(!hh)hh=0;
        /*r(w_name+","+w_content+","+xx+","+yy);*/
		url="?e="+w_content+w_urlpart+"&i="+w_name+","+w_content+","+xx+","+yy;
		/*--------*/
			stream=$('#window').html();
			stream=stream.split("window_name").join("window_"+w_name);
			stream=stream.split("window_sub_name").join("window_sub_"+w_name);
			stream=(stream.split("window_title_name")).join("window_title_"+w_name);
			   stream=(stream.split("[xx]")).join(xx-2);
            stream=(stream.split("[yy]")).join(yy-2);
            stream=(stream.split("[ww]")).join(ww);
            stream=(stream.split("[hh]")).join(hh);
            /*stream=(stream.split("221")).join(xx);
            stream=(stream.split("223")).join(yy);
            stream=(stream.split("225")).join(ww);
            stream=(stream.split("227")).join(hh);*/
			/*alert("window_title_"+w_name);*/
			loadingstream='<?php include(root.core."/page/loading.php"); ?>';
                stream=stream.split("innercontent").join('<div id="'+w_name+'">'+loadingstream+"</div>");
            stream=$('#windows').html()+stream;
			$('#windows').html(stream);
			w_drag();
		/*--------*/
		$.get(url, function(vystup)x{
			$('#'+w_name).html(vystup);
		}x);
	}x
	/*$('#loading').css('visibility','visible');/*
	-------*/
		w_drag();
        /*-------*/
        function r(text)x{/*alert(text);*/
            contents=$("#output").html();
            /*alert(contents);*/
            if(contents)x{
                $("#output").html(text+'<br>'+contents);
             }x
        }x/**/
        
</script>


</div>
<div style="position:relative;top:-100%;left:0px;width:100%;height:100%;z-index:2;">
<?php
if(logged()){
    //eval(subpage('map_units'));
    eval(subpage("map"));
    eval(subpage("javascript"));
    ?><script type="text/javascript">parseMap();</script><?php
}else{
if($GLOBALS['ss']['bg']=='_'){


//<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background-color: rgba(0,0,0,0);z-index:500;"></div>

eval(subpage("map"));     


 }else{
    //print_r($GLOBALS['config']['bg']);
    //echo($GLOBALS['ss']['bg']);
    $imageurl=imageurl('bg/'.$GLOBALS['ss']['bg']);//vaslvvas.jpg
    //$imageurl=imageurl("bg/demacia.jpg");
    if(substr($GLOBALS['ss']['bg'],0,1)=='_'){
        $bgpos=0;    
    }else{
        $bgpos=100; 
    }
?>
<div style="top:0px;left:0px;width:100%;height:100%;background-color: rgb(0,0,0);background-image: url('<?php e($imageurl); ?>');Background-position: <?php echo($bgpos); ?>% 80%; Background-repeat:no-repeat	;Background-attachment:fixed; Background-size: auto 100%;"></div>
<?php
    //===================    
    //e('');
    //imge("bg4 (kopie).jpg","bg","100%");
    //imge("bg4.jpg","bg","100%");
        //imge("bg4.png","bg","100%");//David Hrůša
        
        //imge("bg6.jpg","bg","70%");
        //imge("bg5.png","bg","100%");
    //imge("bg3.png","bg","100%");
    //imge("bg2.png","bg","100%");
    //imge("bg_listy.jpg","bg","100%");
    //imge("bg.jpg","bg","100%");
}
?>
<?php } ?>
</div>
</div>
