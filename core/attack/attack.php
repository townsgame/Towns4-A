<?php
    $iconsize=35;
    $iconbrd=3;
    $ns=($GLOBALS['get']['noshit']);

if($GLOBALS['ss']['attack_report']){
    if($GLOBALS['get']['noshit']){
    r('noshit');    
    w_close('content');
    }else{
        contenu_a(true);
        window('{title_attack_report}'/*,400,200*/);
        te($GLOBALS['ss']['attack_report']);
        contenu_b();
    }
    unset($GLOBALS['ss']['attack_report']);
    e('<script>refreshMap();'.urlxr('e=miniprofile',false).'</script>');
}else{
    //xreport();
//==============================================================================================================
//window("{title_attack}",600);
//blue("{no_module}");exit;
//r($get);

r($GLOBALS['settings']['attack_mafu']);
list($attack_master,$attack_function)=explode('-',$GLOBALS['settings']['attack_mafu']);

/*if($get['id']) $GLOBALS['ss']['use_object']->set->add('attack_id',$get['id']);
if($get['master'])$attack_master=$get['master'];
if($get['function'])$attack_function=$get['function'];
if($get['master'] or $get['function'])$GLOBALS['ss']['use_object']->set->add('attack_mafu',$attack_master.'-'.$attack_function);*/
//if($_POST['attack_id'])$GLOBALS['ss']['use_object']->set->add('attack_id',unique2id($_POST['attack_id']));

$attack_id=$GLOBALS['settings']['attack_id'];
//$attack_master=($GLOBALS['ss']['use_object']->set->ifnot('attack_master',false));
//$attack_function=($GLOBALS['ss']['use_object']->set->ifnot('attack_function',false));
 
if(!$ns)window("{attack_on} ".liner_($attack_id,4,true)/*,500,300*/);
if(!$ns)contenu_a(true);
/*/if(!$attack_id){
    form_a();
    le('attack_on');
    input_text('attack_id',id2unique($attack_id),200,NULL,'border: 2px solid #000000; background-color: #ffffff');
    form_sb();
//}/*/

if(!$ns)
foreach(sql_array('SELECT id,name,func FROM [mpx]objects WHERE own=\''.useid.'\' AND func LIKE \'%attack%\'') as $row){
    list($id,$name,$func)=$row;
    //echo($attack_master);
    if($id==$attack_master)
        $brd=$iconbrd;
    else
        $brd=0;
    
                //--------------------------------------------
                $funcs=func2list($func);
                $func=$funcs['attack'];
                $profile=$func["profile"];
                if($profile["icon"]){
                    $icon=$profile["icon"];
                }else{
                        $icon="f_".$func["class"];
                }
                $xname=$profile["name"];
                if(!$xname){$xname="{f_".$func["class"]."}";}
                //--------------------------------------------
                //eattack_mafu,cho("$id-attack-$xname-$icon");
    ahref(imgr("id_$id"."_icon",$name,$iconsize,$iconsize,NULL,$brd),"e=content;ee=attack-attack;set=attack_mafu,$id-attack-$xname-$icon","none",'x');
}
br();
//r($attack_id);r($attack_master);r($attack_function);
//===============================================================================================================ATTACK
    
$id=$attack_id;
if(!$id or !$attack_master){error('{attack_wtf}');}
elseif($id==$attack_master){error('{attack_self}');}
else{
$attacker=new object($attack_master);r($attack_master);
$attacked=new object($id);
if(!$attacked->loaded or !$attacker->loaded){error('{attack_wtf}');
    }/*elseif($attacked->ww!=$GLOBALS['ss']["ww"]){error('{attack_ww}');}*/else{
    $type=$attacked->type;
    
    //window("{attack_on} ".liner_($id,4,true),500,300);
    //textb("útok na ".liner($id,4));
    //r($funcs);
    $funcs=$attacker->func->vals2list();
    //$images=array();
    //$names=array();
    //$names2=array();
    //r($funcs);
    $q=0;
    foreach($funcs as $name=>$func){
        if($func["class"]=="attack"){
            //$icon='f_'.$func["class"];
            //if($func["profile"]["icon"])/*$images[count($images)-1]*/$icon=$func["profile"]["icon"];
                //--------------------------------------------
                $profile=$func["profile"];
                if($profile["icon"]){
                    $icon=$profile["icon"];
                }else{
                        $icon="f_".$func["class"];
                }
                $xname=$profile["name"];
                if(!$xname){$xname="{f_$class}";}
                //--------------------------------------------
             $set_key='attack_mafu';$set_value=$attack_master.'-'.$name.'-'.$xname.'-'.$icon;
    
             list($a,$b)=explode('-',$GLOBALS['settings']['attack_mafu']);
             if($a==$attack_master and $b==$name){
                 $brd=$iconbrd;
                 //echo("<script>$stream</script>");
             }else{$brd=0;}
             if(!$ns){//border(iconr("e=attack-attack;set=$set_key,$set_value"/*;js=".x2xx($stream).';'*/,$icon,$func["profile"]["name"],$iconsize),$brd,$iconsize,$set_value,$set_key/*class*/);
             //ahref(labelr(imgr("id_$id"."_icon","",50,50),$name),"e=attack-attack;set=attack_mafu,$attack_master-$name","none",'x');
             ahref(imgr('icons/'.$icon.'.png',$xname,$iconsize,$iconsize,NULL,$brd),"e=content;ee=attack-attack;set=attack_mafu,$set_value");
             }
        }
    }
    
    
    //tableab_a('left',400);
    //r($images);
    
    //$q=submenu_img(array('content','attack-attack'),"typ útoku",$images,$names,"attack");
    //$attack_function=$names2[$q-1];
    $a_id=$attack_master;//$GLOBALS['ss']["useid"];
    $b_id=$id;
    $attack_type=$attack_function;//$names2[$q-1];
    //===================================================================
    r($attack_id);
    r($attack_master);
    r($attack_function);
    //===================================================================
    $a_fp=$attacker->getFP();
    $b_fp=$attacked->getFP();
    $a_at=$attacker->supportF($attack_type,"attack");
    $b_at=$attacked->supportF("attack");
    $a_att=$attacker->supportF($attack_type,"total");
    $b_att=$attacked->supportF("attack","total");//r($b_att);
    $a_cnt=$attacker->supportF($attack_type,"count");
    $b_cnt=$attacked->supportF("attack",'count');
    $a_de=$attacker->supportF("defence");
    $b_de=$attacked->supportF("defence");
    $xeff=$attacker->supportF($attack_type,"xeff");
    $steal=clone $attacked->hold;$steal->multiply($xeff);
    if($b_at)$ns=false;
    //if($a_at<=$b_de)$ns=false;
    if($a_at-$b_de<1)$ns=false;
    //-------TYPE


    if($attacked->type=='user'){$noconfirm=1;
        blue("{attack_lock}");
    }
    
    //-------NON SAME WORLD

    if($attacker->ww!=$attacked->ww){$noconfirm=1;
        error(lr('attack_error_ww',$a_dist));
    }    
    
    //-------DISTANCE

    $a_dist=$attacker->supportF($attack_type,"distance");
    
    list($ax,$ay)=$attacker->position();
    list($bx,$by)=$attacked->position();
    $dist=sqrt(pow($ax-$bx,2)+pow($ay-$by,2));
    if($dist>$a_dist){$noconfirm=1;
        error(lr('attack_error_distance',$a_dist));
    }
    
    //-------PRICE
    
    list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
    $price=use_price("attack",array("time"=>$time),$support[$attack_type]["params"],2);
    if(!test_hold($price)){$noconfirm=1;
        blue(lr('attack_error_price'));
    }

    //-------
    //tableab_b("right","center");
    
     //-------------------------
   if(!isset($noconfirm)){
       $url="e=content;ee=attack-attack;q=$attack_master.$attack_type $b_id";
       if($ns)urlx($url.';noshit=1');
       $confirm=tfontr(ahrefr("{attack_$type}",$url,"none","x"),20);
       br();
       moveby($confirm,360,-35);
    }else{
      $ns=false;
    }
   //-------------------------
    //tableab_c();
    
     //-------
    
    hr(contentwidth);
    
    if($a_att)$a_attt="(+)";
    if($b_att)$b_attt="(+)";
    
    tableab_a('left',113);
    
    
    
    vprofile($a_id,array("{life}: "=>round($a_fp), "{attack}$a_attt: "=>$a_at,"{attack_count}: "=>$a_cnt, "{defence}: "=>$a_de, "{distance}: "=>$a_dist));
    tfont('vs.',30);
    vprofile($b_id,array("{life}: "=>round($b_fp), "{attack}$b_attt: "=>$b_at,"{attack_count}: "=>$b_cnt, "{defence}: "=>$b_de));

    
    tableab_b();

   
    $qs=array(4=>0,7=>0,3=>0,6=>0,8=>0,5=>0);
    for($i=0;$i<=100;$i++){
        if($i!=50){
            list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count($i,100-$i,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
            $qs[$q]++;
        }
    }
    textab("{attack_expected}");
    br(2);
    foreach($qs as $q=>$tmp){
        //$tmp=$tmp/array_sum($qs)*100;
        if($tmp)info($tmp."%: ".attack_name($q));
    }
    list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
    //r($a_fp2);
    if($a_fp2==0)error("{attack_warning_total_kill}");
    elseif($b_att)error("{attack_warning_total}");
    textab("{attack_expected_a}:",$a_fp2);br();
    textab("{attack_expected_b}:",$b_fp2);br();
    //textab("doba trvání:",timesr($time));
    //r($support[$attack_type]);
    
    if($price->fp()){textb('{attack_price}:');
    $price->showimg();}
    if($steal->fp()){textb('{attack_steal}:');
    $steal->showimg();}
    tableab_c();
    
    
}}

if(!$ns)contenu_b();
}

?>
