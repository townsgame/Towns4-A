<?php
define('a_attack_cooldown',true);
function a_attack($id){
    //$id=sg("id");
    if(!$id){$GLOBALS['ss']["query_output"]->add("error","{attack_noid}");}
    elseif($id==useid){$GLOBALS['ss']["query_output"]->add("error","{attack_self}");}
    else{
    $attacked=new object($id);
    if(!$attacked->loaded){$GLOBALS['ss']["query_output"]->add("error","{attack_unknown}");
        }/*elseif($attacked->ww!=$GLOBALS['ss']["ww"]){$GLOBALS['ss']["query_output"]->add("error","{attack_ww}");}*/else{
        
        $attack_type=$GLOBALS['ss']["aac_func"]["name"];
        $attacked=new object($id);
        $type=$attacked->type;
        //-------
        $a_name=lr($GLOBALS['ss']["aac_object"]->type).' '.$GLOBALS['ss']["aac_object"]->name;
        $a_name_=$GLOBALS['ss']["aac_object"]->name;
        $b_name=lr($type).' '.$attacked->name;
        $b_name_=$attacked->name;
        $b_name4=lr($type,4).' '.$attacked->name;
        $attackname=lr('attack_'.$type.'2');
        $a_fp=$GLOBALS['ss']["aac_object"]->getFP();
        $b_fp=$attacked->getFP();
        $a_at=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"attack");
        $b_at=$attacked->supportF("attack");
        $a_att=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"total");
        $b_att=$attacked->supportF("attack","total");//r($b_att);
        $a_cnt=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"count");
        $b_cnt=$attacked->supportF("attack","count");//r($b_att);
        $a_de=$GLOBALS['ss']["aac_object"]->supportF("defence");
        $b_de=$attacked->supportF("defence");
        $xeff=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"xeff");
        $steal=clone $attacked->hold;$steal->multiply($xeff);
        
        
        //-------NON SAME WORLD
        if($GLOBALS['ss']["aac_object"]->ww!=$attacked->ww){
            $GLOBALS['ss']["query_output"]->add("error","{attack_error_ww}");
            return;
        }           
        
        //-------DISTANCE
    
        $a_dist=$GLOBALS['ss']["aac_object"]->supportF($attack_type,"distance");
        list($ax,$ay)=$GLOBALS['ss']["aac_object"]->position();
        list($bx,$by)=$attacked->position();
        $dist=sqrt(pow($ax-$bx,2)+pow($ay-$by,2));
        //r($bx,$by,$dist,$a_dist);
        if($dist>$a_dist){
            $GLOBALS['ss']["query_output"]->add("error",lr('attack_error_distance',$a_dist));
            return;
        }
        
        //-------PRICE
        
        list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count(50,50,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
        //e($a_tah);        
        $price=use_price("attack",array("time"=>$a_tah),$support[$attack_type]["params"],2);
        if(!test_hold($price)){
            $GLOBALS['ss']["query_output"]->add("error","{attack_error_price}");
            return;
        }
    
        //-------
        $a_seed=rand(0,100);
        $b_seed=rand(0,100);
        list($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf)=attack_count($a_seed,$b_seed,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att);
        
        //r('abc');
        //textab("váš konečný počet životů:",$a_fp2);
        //textab("soupeřův k. počet životů:",$b_fp2);
        
        
        $GLOBALS['ss']["aac_object"]->fp=$a_fp2;
        $attacked->fp=$b_fp2;
        use_hold($price);
        if(!$b_fp2){
        $attacked->hold->take($steal);
        $steal->multiply(-1);
        use_hold($steal);
        }else{
            $steal->multiply(0);
        }
        
        //$steal->showimg();
        //-----
        if($b_fp2==0 and $type!='user' and $type!='unit'){
            $attacked->delete();
            //Už ne//changemap($bx,$by);
            if($attacked->type=='building')
                changemap($bx,$by);//XXX
            else
                changemap($bx,$by,true);
        }
        //-----
        if($a_fp==0 and $type!='user' and $type!='unit' and (id2name($GLOBALS['config']['register_building'])!=$GLOBALS['ss']["aac_object"]->name)){
             $GLOBALS['ss']["aac_object"]->delete();
            //Už ne//changemap($bx,$by);
            if($GLOBALS['ss']["aac_object"]->type=='building')
                changemap($bx,$by);//XXX
            else
                changemap($bx,$by,true);
        }   
        //-----
        if($b_fp2==1){
            $attacked->own=$GLOBALS['ss']["aac_object"]->own;
        }
        $attacked->update();
        //-----
        /*if($a_fp2==1){
             $GLOBALS['ss']["aac_object"]->own->$attacked->own;
        }*/  
        //-----
        
        
        
        //--------------------------------------
        $steal->multiply(-1);
        $price=$price->textr();
        $steal=$steal->textr();
        $info=array('a_name'=>$a_name,'a_name_'=>$a_name_,'b_name'=>$b_name,'b_name_'=>$b_name_,'b_name4'=>$b_name4,'attackname'=>$attackname,'q'=>attack_name($q),'time'=>nn($time),'a_fp2'=>nn($a_fp2),'b_fp2'=>nn($b_fp2),'a_tah'=>nn($a_tah),'b_tah'=>nn($b_tah),'a_atf'=>nn($a_atf),'b_atf'=>nn($b_atf),'a_seed'=>nn($a_seed),'b_seed'=>nn($b_seed),'a_fp'=>nn($a_fp),'b_fp'=>nn($b_fp),'a_at'=>nn($a_at),'b_at'=>nn($b_at),'a_cnt'=>nn($a_cnt),'b_cnt'=>nn($b_cnt),'a_de'=>nn($a_de),'b_de'=>nn($b_de),'a_att'=>nn($a_att),'b_att'=>nn($b_att),'price'=>$price,'steal'=>$steal);
        $info=x2xx(list2str($info));
         /*le('attack_report_title',$info);
         br();
        le('attack_report',$info);
        hr();*/
        send_report(useid,$id,lr('attack_report_title_q'.$q,$info),lr('attack_report',$info));
        $GLOBALS['ss']['attack_report']=lr('attack_report',$info);
        $GLOBALS['ss']["query_output"]->add("1",1);
        //--------------------------------------
    
    
    }}
}
//-------
/*function attack_count($a_seed,$b_seed,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att){
    $a_min=1;
    $b_min=1;
    if($a_att)$b_min=0;
    if($b_att)$a_min=0;
    $a_atf=($a_at-$b_de)*0.01*$a_seed;
    $b_atf=($b_at-$a_de)*0.01*$b_seed;
    if($a_atf<=0){$a_atf=0;$b_tah=-1;}
    if($b_atf<=0){$b_atf=0;$a_tah=-1;}
    if($a_tah!=-1) $a_tah=$a_fp/$b_atf;//ZničeníA
    if($b_tah!=-1)$b_tah=$b_fp/$a_atf;
    $q=0;
    $time=-1;
    $a_fp2=$a_fp;$b_fp2=$b_fp;
           if($a_fp==0)                             {$q=1;$time=0;}
    elseif($b_fp==0)                             {$q=2;$time=0;}
    elseif($a_tah==-1 and $b_tah==-1){$q=3;}
    elseif($a_tah==-1)                          {$q=4;$b_fp2=$b_min;$time=$b_tah;}
    elseif($b_tah==-1)                          {$q=5;$a_fp2=$a_min;$time=$a_tah;}
    elseif($a_tah==$b_tah)                  {$q=6;$a_fp2=$a_min;$b_fp2=$b_min;$time=$a_tah;}
    elseif($a_tah>$b_tah)                    {$q=7;$a_fp2=$a_fp*(1-($b_tah/$a_tah));$b_fp2=$b_min;$time=$b_tah;}
    else                                                {$q=8;$a_fp2=$a_min;$b_fp2=$b_fp*(1-($a_tah/$b_tah));$time=$a_tah;}
    if($time==-1)$time=0;
    return(array($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf,$a_seed,$b_seed));
}*/
function attack_count($a_seed,$b_seed,$a_fp,$b_fp,$a_at,$b_at,$a_cnt,$b_cnt,$a_de,$b_de,$a_att,$b_att){
    $a_min=1;
    $b_min=1;
    if($a_att)$b_min=0;
    if($b_att)$a_min=0;
    $a_atf=($a_at-$b_de)*0.01*$a_seed;
    $b_atf=($b_at-$a_de)*0.01*$b_seed;
    $time=0;
    $a_tah=0;
    $b_tah=0;
    $a_fp2=$a_fp;
    $b_fp2=$b_fp;
    while(($a_fp2!=$a_min and $b_fp2!=$b_min) and (($a_cnt and $a_atf>0) or ($b_cnt and $b_atf>0))){$time++;
        if($a_cnt and $a_fp2>0 and $a_atf>0){$b_fp2=$b_fp2-$a_atf;$a_cnt--;$a_tah++;}
        if($b_cnt and $b_fp2>0 and $b_atf>0){$a_fp2=$a_fp2-$b_atf;$b_cnt--;$b_tah++;}
        if($a_fp2<$a_min)$a_fp2=$a_min;
        if($b_fp2<$b_min)$b_fp2=$b_min;
        
    }
    
    
    
        if($a_fp==$a_fp2 and $b_fp==$b_fp2)                                         {$q=1;}
    elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)<($b_fp-$b_fp2)) {$q=2;}
    elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)>($b_fp-$b_fp2)) {$q=3;}  
    elseif($a_fp2!=0 and $b_fp2!=0 and $b_fp2!=1 and ($a_fp-$a_fp2)==($b_fp-$b_fp2)){$q=4;}
    elseif($a_fp2!=0 and $b_fp2==0)                                                 {$q=5;}
    elseif($a_fp2==0 and $b_fp2!=0 and $b_fp2!=1)                                   {$q=6;}
    elseif($a_fp2==0 and $b_fp2==0)                                                 {$q=7;}
    elseif($b_fp2==1)                                                               {$q=8;} 
    else                                                                            {$q=9;}       
    
    
    return(array($q,$time,$a_fp2,$b_fp2,$a_tah,$b_tah,$a_atf,$b_atf));
}
//======================================================
    function attack_name($q){
        return(lr("attack_q$q"));
        /*switch($q){
          case 1: return("A má 0 životů");break;
          case 2: return("B má 0 životů");break;
          case 3: return("bez efektu");break;
          case 4:  return("totální výhra");break;
          case 5:  return("totální prohra");break;
          case 6: return("sebevražda");break;
          case 7:  return("výhra");break;
          case 8: return("prohra");break;
        }*/
    }
//======================================================
//towns 4 A_ctl function core
//$GLOBALS['ss']["query_output"]->add("1",1);
//$GLOBALS['ss']["query_output"]->add("error","");
?>
