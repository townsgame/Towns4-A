<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/miniprofile.php

   Dolní ovládací prvky u každé budovy
*/
//==============================




function centerurl($id,$x='x',$y=0,$ww=1){//echo('bbb');
    if($x=='x'){//echo('aaaaa');echo($id);
        $destinationobject=new object($id);
        if(!$destinationobject->loaded)return('');
        $x=$destinationobject->x;
        $y=$destinationobject->y;
        $ww=$destinationobject->ww;
        unset($destinationobject);  
    }
    $tmp=3;
    $xc=(-(($y-1)/10)+(($x-1)/10));
    $yc=((($y-1)/10)+(($x-1)/10));
    $xx=(($xc-intval($xc))*-414);
    $yy=(($yc-intval($yc)+$tmp)*-211);
    $xc=intval($xc);
    $yc=intval($yc)-$tmp;
    $url='e=miniprofile;e=map;xc='.$xc.';yc='.$yc.';xx='.$xx.';yy='.$yy.';ww='.$ww.';center='.$id.';noi=1';
    //echo($url);
    return($url);
}

//--------------------------
if(!$GLOBALS['hl']){
if($GLOBALS['config']['register_building']){
if($hl=sql_1data('SELECT id FROM [mpx]objects WHERE ww='.$GLOBALS['ss']['ww'].' AND own='.useid.' AND type=\'building\' and TRIM(name)=\''.id2name($GLOBALS['config']['register_building']).'\' LIMIT 1')){
    $GLOBALS['hl']=$hl;
}else{
    $GLOBALS['hl']=0; 
}
}else{
    $GLOBALS['hl']=0; 
}
}
//--------------------------
$fields="`id`, `name`, `type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `set`, `hard`, `own`, (SELECT `name` from ".mpx."objects as x WHERE x.`id`=".mpx."objects.`own`) as `ownname`, `in`, `ww`, `x`, `y`, `t`";
if($_GET["x"] and $_GET["y"]){
    $x_=$_GET["x"]+1;
    $y_=$_GET["y"]+1;
    $sql="SELECT $fields FROM ".mpx."objects WHERE `ww`='".$GLOBALS['ss']['ww']."' AND (`type`='building' OR `type`='tree' OR `type`='rock') ORDER BY ABS(x-$x_)+ABS(y-$y_) LIMIT 1";
}else{
    if($_GET["contextid"]){
        $id=$_GET["contextid"];
        //$name=$_GET["contextname"];
    }elseif($GLOBALS['get']["contextid"]){
        $id=$GLOBALS['get']["contextid"];
    }else{
        
        $id=$GLOBALS['ss']["use_object"]->set->ifnot('contextid',$GLOBALS['hl']);
    }
    if(!ifobject($id))$id=$GLOBALS['hl'];
    $sql=/*$id!=useid?*/"SELECT $fields FROM ".mpx."objects WHERE id=$id";//:false;
    $x_=false;
}
//--------------------------
//echo($sql);
//echo($GLOBALS['hl']);
if($sql and $id?ifobject($id):true){
    //echo($sql);
    $array=sql_array($sql);
    list($id, $name, $type, $dev, $fs, $fp, $fr, $fx, $fc, $func, $hold, $res, $profile, $set, $hard, $own, $ownname, $in, $ww, $x, $y, $t)=$array[0];
    //$profile=new profile($profile);
    //$description=$profile;
    //----------------------------------------------    
    if(is_numeric($name))$name=lr($type);
    if($x_){
        $dist=sqrt(pow($x_-$x,2)+pow($y_-$y,2));
        if($dist>1)exit2();
    }
    $GLOBALS['ss']["use_object"]->set->add('contextid',$id);
    //---------------------------------
    /*
?>
<div style="width:100%;height:2px;background-color:rgb(0,0,0);"></div>
<div style="width:100%;height:2px;background-color:rgba(0,0,0,0);"></div> 
<?php
    */
 
    //---------------------------------
    e('<table border="0" width="47%"><tr height="70"><td width="50" align="left" valign="top">'); 
    mprofile($id);br(3);
    
    //tfont(/*shortx($name,8)*/nbsp,12);
    e('</td><td align="left" valign="top" width="110">');
    
    
    
    //-----------------------------------------------------------------------------------------------profile
    if($own==useid){ 
            $own_=('{xtype_own}');
    }elseif($own){
        $own_='město '.($ownname);
    }elseif($type=='tree' or $type=='rock'){        
        $own_=('{xtype_nature}');
    }else{
        $own_=('{xtype_noown}');
    }    
    
    
	labele(textbr(short($name,20)),$name.'(id: '.$id.')');//br();
	//e('<hr width="100%" size="2" align="center" style="margin: 0px 0px 0px 0px">');
	imge('design/dot.png','','100%',2);
	//echo('<span style="background-color: #cccccc;width:100%;height:2px;"></span>');br();
	textab_(array(array('{fp}:',$fp.'/'.$fs/*.'('.fs2lvl($fs,2).')'*/),
	              array('{position}:','['.round($x).','.round($y).']'/*.(($ww!=1)?'['.$ww.']':'')*/),
	              array($own_)),90,55,13);//br();           
	e('</td><td align="left" valign="top">');
	e('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="top">'); 
	
	//===============================================================
    $iconsize=35;
    $iconbrd=3;
    //===============================================================GOLD
	if(id2name($GLOBALS['config']['register_building'])==$name and $own==useid){ 
		border(iconr("e=content;ee=plus-index","res_".plus_res,"{title_plus}",$iconsize),0,$iconsize);
	}
    //===============================================================FUNC
    if($own==useid){
         $functionlist=array('attack','create','teleport','portal','repair','upgrade','replace','change');   
    }else{
         $functionlist=array('portal');   
    }    
        
//Parse error: syntax error, unexpected '' in /media/towns4/towns4/core/page/miniprofile.php on line 177 
$set=new set($set); 
$set=$set->vals2list();   
    
$q=1;$yes=0;
$funcs=func2list($func);
foreach($functionlist as $qq_class){
    foreach($funcs as $fname=>$func){
        $class=$func["class"];
        if($class==$qq_class){
                $params=$func["params"];
                $stream="";$ahref='';$yes=0;
                //--------------------------------------------
                $profile=$func["profile"];
                if($profile["icon"]){
                    $icon=$profile["icon"];
                }else{
                        $icon="f_$class";
                }
                $xname=$profile["name"];
                if(!$xname){$xname="{f_$class}";}
                //--------------------------------------------
                switch ($class) {
                        /*case "move":
                                $movefunc=$name;
                                $movespeed=$params["speed"][0]*$params["speed"][1];
                                $stream=("movespeed=$movespeed;movefunc='$movefunc';".borderjs($movefunc,'move',iconbrd));
                                if($settings["move"]==$movefunc)$yes=1;
                        break;*/
                        case 'attack':
                        
                                     $set_key='attack_mafu';
                                    $set_value=$id.'-'.$fname;
                                    $set_value2=$id.'-'.$fname.'-'.$xname.'-'.$icon;
                                    
                                    if(!($profile['limit']=='tree' or $profile['limit']=='rock')){
                                        //if(id2name($GLOBALS['config']['register_building'])!=$name){
                                        //$ahref='e=attack-attack;function='.$fname.';master='.$id;
                                        //echo($set_value2);
                                        $stream=($set_key."='$set_value2".'\';'.borderjs($set_value,$set_value2,$set_key,$iconbrd));
                                        //echo('('.$GLOBALS['settings'][$set_key].'='.$set_value2.')');
                                        list($a,$b)=explode('-',$GLOBALS['settings'][$set_key]);                             
                                        if($a.'-'.$b==$set_value)$yes=1;
                                        //echo($yes);
                                        //r($GLOBALS['settings'][$set],$fname);
                                        //r($stream);
                                    //}
                                    }else{
                                        $ahref='e=content;ee=attack-mine;attack_mafu='.$set_value.';attack_limit='.$profile['limit'];
                                    }
                                
                        break;
                        case 'create':
                               if(is_array($func['profile']['limit']) or !$func['profile']['limit'] or true){
                                    $ahref='e=content;ee=create-unique;type=building;master='.$id.';func='.$fname;
                               }else{
                                    $stream="build($id,".$func['profile']['limit'].",'$fname')";
                               }                        
                                //$stream=("attackfunc='$name';".borderjs($name,'attack',iconbrd));
                                //if($settings["create"]==$name)$yes=1;
                        break;
                        case 'replace':
                               if(intval(sql_1data("SELECT COUNT(1) FROM [mpx]objects WHERE own='".useid."' AND `ww`=".$GLOBALS['ss']["ww"]))<=1){
                                    $stream="build($id,".$GLOBALS['config']['register_building'].",'$fname')";
                               }
                        break;
                        case 'teleport':
                        case 'portal':
                               $ahref=centerurl($func['profile']['id']);

                        break;
                        case 'repair':
                           if($fs!=$fp){
                                $ahref='e=content;ee=create-upgrade;id='.$id; 
                           }
                        break;
                        case 'change':
                           $ahref='e=content;ee=hold-change;id='.$id; 
                        break;
                }
                if($stream or $ahref){

                    
                    //te($xname);        
                    //br();
                        if($yes and $stream){echo("<script>$stream</script>");}
                        //echo("<span class=\"functiondrag\" id=\"fd_$name\" style=\"position: relative;top:0px;left:0px;z-index:2;\">");
                        //echo("<a onclick=\"$stream\">".nln);
                        //imge("icons/$icon.png",$xname,22,22);
                        //echo(nln."</a>");
                        if($yes){$brd=$iconbrd;}else{$brd=0;}
                        e(nln);
                             
                                              
                        
                        if(defined("a_".$class.'_cooldown')){//$fname
                            $cooldown=$params['cooldown'][0]*$params['cooldown'][1];
                            if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
                            $lastused=$set['lastused_'.$fname];
                            $time=($cooldown-time()+$lastused);           
                            if($time>0){
                                $countdown=$time;
                            }
                        }  
                        
                        //Parse error: syntax error, unexpected ',' in /media/towns4/towns4/core/page/miniprofile.php on line 191 
                        border(iconr(
                        (($countdown and $class!='attack')?'':
                        (($ahref?$ahref.';':'').($stream?"js=".x2xx($stream).';':''))),
                        $icon,$xname,$iconsize,NULL,$countdown),$brd,$iconsize,$set_value,$set_key,$countdown/*class*/);
                        $countdown=0; 
                        
                        
                 }
        }
    }
}   



    if($own==useid){ 


       /*if($fs==$fp){
            //border(iconr('e=miniprofile;ee=upgrade;id='.$id,'f_upgrade','{f_upgrade}',$iconsize),0,$iconsize);    
       }else{
            border(iconr('e=content;ee=create-upgrade;id='.$id,'f_repair','{f_repair}',$iconsize),0,$iconsize); 
       }*/
       if(id2name($GLOBALS['config']['register_building'])!=$name){
            border(iconr('e=miniprofile;prompt={f_dismantle_prompt};q=dismantle '.$id,'f_dismantle','{f_dismantle}',$iconsize),0,$iconsize);
            border(iconr('e=miniprofile;prompt={f_leave_prompt};q=leave '.$id,'f_leave','{f_leave}',$iconsize),0,$iconsize);
            //a_dismantle(2000233);
       }else{
            //border(iconr("build('".$GLOBALS['ss']['hl']."_replace',‎'".$GLOBALS['config']['register_building']."');",'f_leave','{f_leave}',$iconsize),0,$iconsize);
       }
//----------------------------------------------
        //$own_=('vlastní budova');
    }elseif($own){
        //$own_=($ownname);
        border(iconr("e=content;ee=profile;id=".$own,"profile_town2","{profile_town2}",$iconsize),0,$iconsize);
        
        $ownown=sql_1data('SELECT `own` FROM [mpx]objects WHERE `id`=\''.$own.'\'');
        if($ownown)border(iconr("e=content;ee=profile;id=".$ownown,"profile_user2","{profile_user2}",$iconsize),0,$iconsize);
    }/*elseif($type=='tree' or $type=='rock'){        
        //$own_=('příroda');
    }else{
        //$own_=('opuštěná budova');
    }*/



if($own!=useid){
if( $type!='tree' and $type!='rock') {
    
    if(id2name($GLOBALS['config']['register_building'])!=$name){ 
    if($GLOBALS['settings']['attack_mafu']){
        list($attack_master,$attack_function,$attack_function_name,$attack_function_icon)=explode('-',$GLOBALS['settings']['attack_mafu']);
        if(ifobject($attack_master)){
            
            $set=new set(sql_1data("SELECT `set` FROM [mpx]objects WHERE `id`='$attack_master'"));
            $set=$set->vals2list();
            $func=new func(sql_1data("SELECT `func` FROM [mpx]objects WHERE `id`='$attack_master'"));            
            $func=$func->vals2list();                    
            
            
           //e($name.'aaa');
           
               if(defined('a_attack_cooldown')){//$fname
                    $cooldown=$func[$attack_function]['params']['cooldown'][0]*$func[$attack_function]['params']['cooldown'][1];
                    if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
                    $lastused=$set['lastused_'.$attack_function]; 
                    $time=($cooldown-time()+$lastused);
                    //r("$cooldown-time()+$lastused");  
                    //r($time);       
                    if($time>0){
                        $countdown=$time;
                    }
   
                
                border(iconr($countdown?'':'e=content;ee=attack-attack;set=attack_id,'.$id.';noshit=1',$attack_function_icon,"$attack_function_name (".id2name($attack_master).")",$iconsize,NULL,$countdown),0,$iconsize,NULL,NULL,$countdown);
                $countdown=0;
            }
            
            
            
        }
    
    }    
    border(iconr('e=content;ee=attack-attack;set=attack_id,'.$id,'f_attack_window','{f_attack_window}',$iconsize),0,$iconsize);
}
}

}

//r('xc='.(-(($y-1)/10)+(($x-1)/10)).';yc='.((($y-1)/10)+(($x-1)/10)));

$url=centerurl($id,$x,$y,$ww);
border(iconr($url,'fx_center','{fx_center}',$iconsize),0,$iconsize);  
//-----------autocenter
//br();
//echo(($GLOBALS['config']['register_building']).','.id2name($GLOBALS['config']['register_building']).''.$name);

$xc_=$GLOBALS['ss']["use_object"]->set->ifnot("map_xc",false);
$yc_=$GLOBALS['ss']["use_object"]->set->ifnot("map_yc",false);
$xx_=$GLOBALS['ss']["use_object"]->set->ifnot("map_xx",false);
$yy_=$GLOBALS['ss']["use_object"]->set->ifnot("map_yy",false);
//echo($xc.','.$yc.','.$xx.','.$yy);
//if($xc===false and $yc===false and $xx===false and $yy===false)echo('hurá');   
if($xc_===false and $yc_===false and $xx_===false and $yy_===false and id2name($GLOBALS['config']['register_building'])==$name){
    //echo($xc.','.$yc.','.$xx.','.$yy);
    /*$GLOBALS['ss']["log_object"]->set->add("map_xc",$xc);
    $GLOBALS['ss']["log_object"]->set->add("map_yc",$yc);
    $GLOBALS['ss']["log_object"]->set->add("map_xx",$xx);
    $GLOBALS['ss']["log_object"]->set->add("map_yy",$yy);*/
    click($url,1);
}
//---------------

$tabs=$GLOBALS['ss']["use_object"]->set->ifnot('tabs','');
$tabs=explode(',',$tabs);
$q=false;foreach($tabs as $tab){if($tab==$id){$q=true;}}

$set_value='tab_'.$id;
$set_key='1';
$stream=borderjs($set_value,$set_value,$set_key,($q?0:$iconbrd),false);
border(iconr("e=tabs;tab=$id;wtf=".($q?0:1).";js=".x2xx($stream),'fx_tab','{fx_tab}',$iconsize),$q?$iconbrd:0,$iconsize,$set_value,$set_key/*class*/);
                       
//-----------------------------------------------ADMIN 
    if(debug){
    $tmp=$_SERVER["REQUEST_URI"];
    if(strpos($tmp,'?'))$tmp=substr($tmp,0,strpos($tmp,'?'));
    ?><br/>
    <a href="<?php e($tmp); ?>/admin?page=object&amp;s_input_admin=<?php e($id); ?>">admin</a>, 
    <?php
    //r($GLOBALS['get']['changemap']);
    if($GLOBALS['get']['changemap']){    
        list($tmpx,$tmpy)=explode(',',$GLOBALS['get']['changemap']);
        //r("changemap(floatval($tmpx),floatval($tmpy),true);");
        changemap(floatval($tmpx),floatval($tmpy),true);
    }
    ?>
    <?php ahref('changemap','e=miniprofile;ref=map_units;changemap='.$x.','.$y); ?>
    <?php
    }
    
    e(nbsp2);
    imge('design/dot.png','',2,$iconsize);
    e(nbsp2);//br();
    //tfont('|',40);
    icon("e=content;ee=profile;id=".useid,"profile_town","{profile_town}",$iconsize);
    icon("e=content;ee=profile;id=".logid,"profile_user","{profile_user}",$iconsize);
     //===============================================================
    $iconsize=24;
    

    e('</td><td align="left" valign="top" width="'.$iconsize.'">');     
    
}
         //icon("js=$(document).fullScreen(true);","fullscreen","{fullscreen}",$iconsize);br();
         icon("q=logout","logout","{logout}",$iconsize);   
    br();icon("e=content;ee=help;page=index",'help',"{help}",$iconsize); 
    br();icon(js2('if($(\'#expandarea\').css(\'display\')==\'block\')x{$(\'#expandarea\').css(\'display\',\'none\')}xelsex{$(\'#expandarea\').css(\'display\',\'block\')}x1'),"expand","{expand}",$iconsize);
    //Parse error: syntax error, unexpected ')' in /media/towns4/towns4/core/page/miniprofile.php on line 263 
if($sql and $id?ifobject($id):true){
 
    e('</td></tr></table>'); 
    //===============================================================
    e('</td></tr><tr><td colspan="3" align="left" valign="top">');
    //info('',false);
    //info(short($name,50).'(id: '.$id.'): '.labelr($fp.'/'.$fs.'('.fs2lvl($fs,2).')','fp/fs(lvl)').', '.labelr('['.round($x,1).','.round($y,1).']'.(($ww!=1)?'['.$ww.']':''),'pozice').', '.labelr($own_,'vlastník'),false);
    e('</td></tr></table>');    
    /*OLD//te($name);
    echo("<hr>");
    //ahref("page_move","e=content;ee=move;page=move;ref=left;$show;id=$id","none"); br();
    ahref("context_profile","e=content;ee=profile;id=$id","none");br();
    ahref("attack_$type","e=content;ee=attack-attack;page=attack;id=$id","none"); br();*/
?>
<script type="text/javascript">
$('#map_context').html('<?php e(trim($name)); ?>');
</script>
<?php } ?>
