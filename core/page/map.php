<?php
//r('setx'.$GLOBALS['ss']["use_object"]->x.','.$GLOBALS['ss']["use_object"]->y);
//Dropbox
if(!defined("func_map"))require(root.core."/func_map.php");
?>

<!--<script type="text/javascript" src="jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="jquery/js/jquery-ui-1.8.16.custom.min.js"></script>-->

<?php
    
    if($GLOBALS['get']['ww']){
       $GLOBALS['ss']["ww"]=intval($GLOBALS['get']['ww']);
    }


    if(logged()){
        $xc=$GLOBALS['ss']["use_object"]->set->ifnot("map_xc",1);
        $yc=$GLOBALS['ss']["use_object"]->set->ifnot("map_yc",1);
        $xx=$GLOBALS['ss']["use_object"]->set->ifnot("map_xx",0);
        $yy=$GLOBALS['ss']["use_object"]->set->ifnot("map_yy",0);    
    }else{
        $xc=1;
        $yc=1;
        $xx=0;
        $yy=0;    
    }
    
    //if($GLOBALS['ss']["get"]["xc"]!=""){$GLOBALS['ss']["map_xc"]=$GLOBALS['ss']["get"]["xc"];}
    //if($GLOBALS['ss']["get"]["yc"]!=""){$GLOBALS['ss']["map_yc"]=$GLOBALS['ss']["get"]["yc"];}
    if($_GET["xc"]!=""){$xc=$_GET["xc"];}
    if($_GET["yc"]!=""){$yc=$_GET["yc"];}
    if($_GET["xx"]!=""){$xx=$_GET["xx"];}
    if($_GET["yy"]!=""){$yy=$_GET["yy"];}
    if($GLOBALS['get']["xc"]!=""){$xc=$GLOBALS['get']["xc"];}
    if($GLOBALS['get']["yc"]!=""){$yc=$GLOBALS['get']["yc"];}
    if($GLOBALS['get']["xx"]!=""){$xx=$GLOBALS['get']["xx"];}
    if($GLOBALS['get']["yy"]!=""){$yy=$GLOBALS['get']["yy"];}
    $GLOBALS['ss']["map_xc"]=$xc;
    $GLOBALS['ss']["map_yc"]=$yc;
    $GLOBALS['ss']["map_xx"]=$xx;
    $GLOBALS['ss']["map_yy"]=$yy;
    $GLOBALS['xc']=$xc;
    $GLOBALS['yc']=$yc;
    $GLOBALS['xx']=$xx;
    $GLOBALS['yy']=$yy;
    //------------------------------
    if(logged()){
        $GLOBALS['ss']["use_object"]->set->add("map_xc",$xc);
        $GLOBALS['ss']["use_object"]->set->add("map_yc",$yc);
        $GLOBALS['ss']["use_object"]->set->add("map_xx",$xx);
        $GLOBALS['ss']["use_object"]->set->add("map_yy",$yy);
    }
    
    //e("$xc,$yc,$xx,$yy");
?>


<?php
    if(logged()){
?>
<script type="text/javascript">
    /*---------------------------------POSITION*/
        function pos2pos(xt,yt)x{
                xxt=(yt/212*5)+(xt/424*5);
                yyt=(yt/212*5)-(xt/424*5); /*aaa*/
                xc=<?php echo($xc); ?>;
                yc=<?php echo($yc); ?>;
                /*alert(yc);*/
                xxc=(yc*5)+(xc*5)-12.5+xxt; /*-17.5*/
                yyc=(yc*5)-(xc*5)+12.5+yyt; /*+17.5*/
                return([xxt,yyt]);
        }x
    $(function() x{
        /*---------------------------------DRAG*/
        drag=0;
        /*parseMap();*/
		$('#draglayer').draggable(x{ disabled: false }x/**/);
        $( "#draglayer" ).bind( "dragstart", function(event, ui)x{
            drag=1;
            $('#map_context').css('display','none');
        }x);
         $( "#draglayer" ).bind( "dragstop", function(event, ui)x{
            /*$( "#draglayer" ).draggable( "option", "disabled", true );*/
            setTimeout(function()x{drag=0;}x,100);
            parseMap();
            /*window.location.replace('?e=map&xc='+xc+'&yc='+yc+'&xx='+xx+'&yy='+yy);*/

            

        }x);/**/
        /*---------------------------------POSITIONCLICK*/
        $("#map_context").click(function() x{
            $('#map_context').css('display','none');
        }x);/**/
        /*$(".tabulkamapy").draggable();*/
        $(".clickmap").click(function(hovno) x{
            if(drag!=1)x{
                /*alert("click");*/
                $('#map_context').css('left',hovno.pageX-10);
                $('#map_context').css('top',hovno.pageY-10);
                $('#map_context').css('display','block');/**/
                offset =  $("#tabulkamapy").offset();
                /*alert(hovno.pageX);*/
                xt=(hovno.pageX-offset.left);/*pozice myši px*/
                yt=(hovno.pageY-offset.top);
                tmp=pos2pos(xt,yt);
                xxt=tmp[0];
                yyt=tmp[1];
                /*$("#copy").html(xt+","+yt+" = "+(Math.round(xxc*100)/100)+","+Math.round(Math.round(yyc*100)/100)+";"+xxt+","+yyt);
                */
                tmp=1;
                title=(Math.round(xxc*tmp)/tmp)+","+Math.round(Math.round(yyc*tmp)/tmp);
                
                $('#map_context').html(title);
                 <?php if(logged){ ?>
                $(function()x{$.get('?e=miniprofile&w=&x='+xxc+'&y='+yyc, function(vystup)x{if(vystup.length>30)$('#miniprofile').html(vystup);}x);}x);
                 <?php } ?>
            }x
        }x);
        /*---------------------------------UNITCLICK*/
        $(".unit").click(function(hovno) x{
            if(drag!=1)x{   
                $('#map_context').css('left',hovno.pageX-10);
                $('#map_context').css('top',hovno.pageY-10);
                $('#map_context').css('display','block');
                title=$(this).attr('title');
                name=$(this).attr('id');
                $('#map_context').html(title);
                 <?php if(logged){ ?>
                $(function()x{$.get('?e=miniprofile&w=&contextid='+name+'&contextname='+title, function(vystup)x{$('#miniprofile').html(vystup);}x);}x);
                 <?php } ?>
            }x
        }x);/**/
        /*---------------------------------CENTER*/
        <?php if($GLOBALS['get']['center']){ ?>
        
        
		xc=parseInt($( "#draglayer" ).css('left'));
		yc=parseInt($( "#draglayer" ).css('top'));     
        $( "#draglayer" ).css('left',xc-400/*(window.width)*/);
        $( "#draglayer" ).css('top',yc+200/*((window.height-120)/2)*/);
		setTimeout(function()x{         
        parseMapF(
		function()x{        
        $('#map_context').css('left',645);
        $('#map_context').css('top',195);
        $('#map_context').css('display','block');
        $(function()x{$.get('?e=miniprofile&w=&contextid='+<?php e($GLOBALS['get']['center']); ?>, function(vystup)x{$('#miniprofile').html(vystup);}x);}x);
		}x
		);
        }x,23);/**/
        <?php } ?>   
        /*------------------------------------NEWVALS*/
        xc=<?php echo($xc); ?>;
        yc=<?php echo($yc); ?>;
        countdowns=[ ];
        windows="";
}x);
</script>


<div id="map_context" style="position:absolute; top:100; left:100; display:none;  background: rgba(0,0,0,0.75); border-radius: 2px; padding: 4px;z-index:30;">
</div>
<!--================BUILD===================-->
<div  id="create-build"  name="create-build" style="position:absolute;display:none;top:0; left:0;z-index:25;">&nbsp;</div>
<script type="text/javascript">
            /* 3.66    3.02*/
            build_x=0;
            build_y=0;
            //window.build_master=false;
            //window.build_id=false;
            $("#create-build").css("left",(screen.width/2)-55);
            $("#create-build").css("top",(screen.height/2)-154);
            build=function(master,id,func) x{//alert(master+','+id+','+func);
                window.build_master=master;
                window.build_id=id;
                window.build_func=func;
                $("#expandarea").css("display","block");
                $("#create-build").css("display","block");
                $("#create-build").draggable();
                $( "#create-build" ).bind( "dragstop", function(event, ui)x{
                    bx=parseFloat($("#create-build").css("left"));
                    by=parseFloat($("#create-build").css("top"));
                    offset =  $("#tabulkamapy").offset();
                    xt=(bx-offset.left);/*pozice myši px*/
                    yt=(by-offset.top);
                    tmp=pos2pos(xt,yt);
                    xxc=xxc+4.57;
                    yyc=yyc+3.67;
                    build_x=xxc;
                    build_y=yyc;
                    //$("#copy").html(xxc+","+yyc);
                    
                    
                }x);
              /*alert('?e=object_build&master='+master+'&id='+id);*/
                $.get('?e=create-build&master='+master+'&func='+func+'&id='+id, function(vystup)x{$('#create-build').html(vystup);}x);
            }x
            <?php
                if(defined('object_build')){
                    e('build('.$GLOBALS['ss']['master'].','.$GLOBALS['ss']['object_build_id'].',\''.$GLOBALS['ss']['object_build_func'].'\');');
                }
                if(defined('create_error')){
                    e('alert("'.create_error.'");');
                }
            ?>
</script>
<?php } ?>

<!--===================================-->
<?php /*<div style="position:absolute;width:100%;height:100%;z-index:10;">
<div style="position:relative;top:0px;left:0px;width:100%;height:100%;z-index:10;">
<?php htmlmap(false,false,'100%'); ?>
</div></div>
 onmousedown="alert(1)" onmouseup="alert(2)" onmouseout=""
onclick="key_up=true" onmouseup="key_up=false" onmouseout="key_up=false"
*/ ?>

<?php if(logged()){ ?>
<div style="position:absolute;top:0px;left:0px;width:100%;height:27px;z-index:550;">
<a onmousedown="key_up=true" onmouseup="key_up=false" onmouseout="key_up=false">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_up" border="0" alt="<?php le('navigation_up'); ?>" title="<?php le('navigation_up'); ?>" width="100%" height="100%">
</a>
</div>

<div style="position:absolute;top:0px;left:0px;width:27px;height:100%;z-index:550;">
<a onmousedown="key_left=true" onmouseup="key_left=false" onmouseout="key_left=false">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_left" border="0" alt="<?php le('navigation_left'); ?>" title="<?php le('navigation_left'); ?>" width="100%" height="100%">
</a>
</div>

<div style="position:absolute;top:100%;left:0px;width:100%;height:47px;z-index:550;">
<div style="position:relative;top:-163px;left:0px;width:100%;height:100%;">
<a onmousedown="key_down=true" onmouseup="key_down=false" onmouseout="key_down=false">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_down" border="0" alt="<?php le('navigation_down'); ?>" title="<?php le('navigation_down'); ?>" width="100%" height="100%">
</a>
</div></div>

<div style="position:absolute;top:0px;left:100%;width:27px;height:100%;z-index:550;">
<a onmousedown="key_right=true" onmouseup="key_right=false" onmouseout="key_right=false">
<div style="position:relative;top:0px;left:-27px;width:100%;height:100%;">
<img src="<?php imageurle('design/blank.png'); ?>" id="navigation_right" border="0" alt="<?php le('navigation_right'); ?>" title="<?php le('navigation_right'); ?>" width="100%" height="100%">
</a>
</div></div>

<?php /*<script type="text/javascript" >
        /*----------------------------------------------------------NAVIGATOR---/        
        //$('#navigation_up').mousedown(function() x{key_up=true;}x);
        $('#navigation_down').mousedown(function() x{key_down=true;}x);  
        $('#navigation_left').mousedown(function() x{key_left=true;}x);  
        $('#navigation_right').mousedown(function() x{key_right=true;}x);  
        
        $(document).mouseup(function(e) x{
            /*---------UP,DOWN,LEFT,RIGHT/
            //key_up=false;
            key_down=false;
            key_left=false;
            key_right=false;
            /*---------/
        }x);  
        /*------------------------------------/    
</script>*/ ?>


<?php } ?>

<div style="top:<?php  echo($yy); ?>;left:<?php  echo($xx); ?>;z-index:20;" id="draglayer">
<?php
//subref("map_units",60);
//---------------------
$stream1='';
$stream2='';
//$mapsize=20;
$screen=1270;
$ym=6;//6;//$mapsize/5+1;//-1;
$xm=5;//5;//ceil(($mapsize/5-1)/2);
//echo($xm);
$ym=$ym-1;$xm=$xm-1;$xm=$xm/2;
$size=$screen/($xm+$xm+1);//750;

$ad=("<table cellspacing=\"0\" cellpadding=\"0\" width=\"".$screen."\" id=\"tabulkamapy\">");
$stream1.=$ad;$stream2.=$ad;
for($y=$yc; $y<=$ym+$yc; $y++){
    $ad=("<tr>");$stream1.=$ad;$stream2.=$ad;
    for ($x=-$xm+$xc; $x<=$xm+$xc; $x++) {
        $ad=(dnln.'<td width="424" height="211">');$stream1.=$ad;$stream2.=$ad;
        //r("$x,$y");
        $stream1.=htmlmap($x,$y,1);
        $stream2.=htmlmap($x,$y,2);
        $ad=("</td>");$stream1.=$ad;$stream2.=$ad;
    }
    $ad=("</tr>");$stream1.=$ad;$stream2.=$ad;
}
$ad=("</table>");$stream1.=$ad;$stream2.=$ad;/**/
//-------------------------------

e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:100;">'.$stream1.'</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:200;">');
eval(subpage('map_units'));
e('</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:300;">'.$stream2.'</div></div>');
e('<div style="position:absolute;width:0px;height:0px;"><div style="position:relative;top:0px;left:0px;z-index:400;">'.$GLOBALS['units_stream'].'</div></div>');

/*echo('<script type="text/javascript">'.nln);
$d=17;
$xa=intval($GLOBALS['ss']["use_object"]->x-$d);
$xb=intval($GLOBALS['ss']["use_object"]->x+$d);
$ya=intval($GLOBALS['ss']["use_object"]->y-$d);
$yb=intval($GLOBALS['ss']["use_object"]->y+$d);
if($xa<1){$xa=1;$xb=1+$d+$d;}
if($ya<1){$ya=1;$yb=1+$d+$d;}
if($xb>mapsize){$xb=mapsize;}
if($yb>mapsize){$yb=mapsize;}
echo('area_x='.$xa.';'.nln);
echo('area_y='.$ya.';'.nln);
//e('alert('.$GLOBALS['ss']["use_object"]->x.');');
echo('area=['.nln);
foreach(sql_array("SELECT x,y,hard FROM `".mpx."map` WHERE ww=".$GLOBALS['ss']["ww"]." AND x>=$xa AND y>=$ya AND x<=$xb AND y<=$yb ORDER BY y,x") as $row){
    list($area_x,$area_y,$area_hard)=$row;
    $q=1-$area_hard;
    if($q<0.2)$q=0;
    if($q>1)$q=1;
    //echo("($area_x==$xa)");
    if($area_x==$xa)echo('[');
    echo($q);
    if($area_x!=$xb)echo(',');
    if($area_x==$xb)echo(']');
    if($area_x==$xb and $area_y!=$yb)echo(','.nln);
}
echo('];'.nln);
echo('</script>');*/
//-------------------------------
?>

</div>