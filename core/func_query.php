<?php
unset($GLOBALS['ss']["use_object"]);
unset($GLOBALS['ss']["log_object"]);
//r($GLOBALS['ss']["useid"]);
//r($GLOBALS['ss']["logid"]);
function townsfunction($query,$q){$queryp=$query;
    //r($query);
    //print_r($query);
    //if(is_string($query)){echo($query);
        $query=str_replace(' ',',',$query);
        $query=explode(",",$query,2);
    //}
    
    $GLOBALS['ss']["query_output"]= new vals();
    list($func,$params)=$query;
    if(strstr($func,'.')){list($remoteobject,$func)=explode('.',$func,2);}else{$remoteobject=false;}
    
    //r("$remoteobject , $func , $params");
    //$params=str_replace(" ",",",$params);
    //$params=explode(",",$params);
    if($GLOBALS['ss']["useid"] and $GLOBALS['ss']["logid"]){
        if($remoteobject){
            $aid=$remoteobject;
        }else{
            $aid=$GLOBALS['ss']["useid"];
        }
    }
    if($func=="login"){
        list($aid)=explode(",",$params);
        if(!ifobject($aid)){
            $aid=false;
            $GLOBALS['ss']["query_output"]->add("error","Tento uživatel neexistuje.");
        }
    }
    if($func=="register"){
        list($aid)=explode(",",$params);
        $funcname='register';
        $noregister=false;
    }else{
        $noregister=true;
    }
    
    
    if($aid){//K+M+B
            //----------------
            if($noregister){
                t("obj>>");
                //if(!$GLOBALS['ss']["use_object"] and $GLOBALS['ss']["useid"]){$GLOBALS['ss']["use_object"]= new object($GLOBALS['ss']["useid"]);}
                //if(!$GLOBALS['ss']["log_object"] and $GLOBALS['ss']["logid"]){;$GLOBALS['ss']["log_object"]= new object($GLOBALS['ss']["logid"]);}
                if(!$GLOBALS['ss']["aac_object"] and $remoteobject){$GLOBALS['ss']["aac_object"]= new object($remoteobject);}            
                if(!$GLOBALS['ss']["use_object"] and $GLOBALS['ss']["useid"]){$GLOBALS['ss']["use_object"]= new object($GLOBALS['ss']["useid"]);}            
                if(!$GLOBALS['ss']["log_object"] and $GLOBALS['ss']["logid"]){;$GLOBALS['ss']["log_object"]= new object($GLOBALS['ss']["logid"]);}
                if(!$GLOBALS['ss']["aac_object"])$GLOBALS['ss']["aac_object"]=$GLOBALS['ss']["use_object"];
                t("<<obj");
                //r($aid);
                if($aid==$remoteobject)$aid_object=$GLOBALS['ss']["aac_object"];
                if($aid==useid)$aid_object=$GLOBALS['ss']["use_object"];
                if(!$aid_object)$aid_object=new object($aid);
                
                
                
                //$GLOBALS['ss']["use_object"]->xxx();
                //r($aid_object->loaded);
                //r(true);
                //if($GLOBALS['ss']["useid"]){$id}
                $GLOBALS['ss']["aac_func"]=$aid_object->support();//func->vals2list();
                $GLOBALS['ss']["aac_func"]=$GLOBALS['ss']["aac_func"][$func];
                $GLOBALS['ss']["aac_func"]["name"]=$func;
            
                $funcname=$GLOBALS['ss']['aac_func']['class'];
                
                //-------------COOLDOWN
                if(defined("a_".$funcname.'_cooldown')){
                    $cooldown=$GLOBALS['ss']['aac_func']['params']['cooldown'][0]*$GLOBALS['ss']['aac_func']['params']['cooldown'][1];
                    if(!$cooldown)$cooldown=$GLOBALS['config']['f']['default']['cooldown'];
                    $lastused=$GLOBALS['ss']['aac_object']->set->ifnot("lastused_$func",1);
    
                    //r($cooldown.' / '.$lastused);
                }
                //r($GLOBALS['ss']['aac_func']);
                //r($GLOBALS['config']);
                //-------------
                
                /*r($GLOBALS['ss']["aac_object"]->func->vals2list()); 
                $a=($GLOBALS['ss']["aac_object"]->func->vals2list());     
                $a=new func($a);
                hr();
                r($a->vals2list());        
                hr();hr();*/
                
            }
            //r($GLOBALS['ss']["aac_func"]);
            
            
            //r($GLOBALS['ss']["aac_func"]);
            //----------------
        $funcname_=$funcname;
        $funcname=$q."_".($funcname);
        
        if(/*$func=="login" or */$GLOBALS['ss']["aac_func"] or !$noregister){
            if(function_exists($funcname)){
                
                        
                if(!defined("a_".$funcname_.'_cooldown') or $cooldown<=(time()-$lastused)){
                    
                    //r("a_".$funcname_.'_cooldown');
                    if(defined("a_".$funcname_.'_cooldown')){
                        //r();
                        $GLOBALS['ss']['aac_object']->set->add("lastused_".$func,time());
                    }
                    
                    
                    /*$tmp=($GLOBALS['ss']["aac_object"]->func->vals2list());
                    $tmp[$funcname_]['params']['lastused']=time();
                    $GLOBALS['ss']["aac_object"]->func=new func($tmp);*/
                    
                    
                    $params=str_replace(",","\",\"",$params);
                    $params="\"$params\"";
                    $params=str_replace(",\"\"","",$params);//Prázdné parametry
                    $params=str_replace("\"\",","",$params);
                    if($params=="\"\""){$params="";}
                    $funceval="$funcname($params);";
                    //r($funceval);
                    eval($funceval);
                    
                
                }else{
                    $GLOBALS['ss']["query_output"]->add("error",'Tuto funkci lze použít za '.timesr($cooldown-time()+$lastused).'.');
                }
                
            }else{
                //r($GLOBALS['ss']["aac_func"]);
                if($funcname!='a_')$GLOBALS['ss']["query_output"]->add("error","tato funkce je pasivní - $funcname");
            }
        }else{
            //echo($func);
            $GLOBALS['ss']["query_output"]->add("error","$queryp: neexistující funkce u tohoto objektu($aid) $func");
        }
        }else{
            if($func!="login"){
                $GLOBALS['ss']["query_output"]->add("error","nepřihlášený uživatel");
            }
       }
    return($GLOBALS['ss']["query_output"]/*->vals2str()*/);
}
//----------------
function use_param($p){//konstanty
    return($GLOBALS['ss']["aac_func"]["params"][$p][0]);
}
//----------------
/*function use_price($hold){
    //r(abc,$GLOBALS['ss']["aac_func"]["class"],$GLOBALS['config']["fur"][$GLOBALS['ss']["aac_func"]["class"]]);
    $resource=$GLOBALS['config']["f"]["use"]["w"][$GLOBALS['ss']["aac_func"]["class"]];
    if(!$GLOBALS['ss']["use_object"]->hold->take($resource,$hold)){
        $GLOBALS['ss']["query_output"]->add("error","Potřebujete alespoň {q_".$resource.";$hold}.");
        return(false);
    }else{return(true);}
}*/
//======================================================================================
function query($query){
    //r($query);
    return(townsfunction($query,"a"));
}
//======================================================================================
function use_price($func,$params,$constants=false,$mode=0){//0=take, 1=test, 2=hold
    if(!$constants)$constants=$GLOBALS['ss']["aac_func"]["params"];
    foreach($constants as &$value_c)$value_c=$value_c[0]*$value_c[1];
    //r($params);
    //r($constants);
    //f:use:fp:move
    //f:use:r:move
    foreach($GLOBALS['config']["f"]["default"] as $key=>$value){
        if(!$constants[$key]){
            $constants[$key]=$value;
        }
    }
    foreach($GLOBALS['config']["f"]["global"]["use"] as $key=>$value){$key="_".$key;
            //r("$key=>$value");
            if(!defined($key))define($key,$value);
    }
    //foreach($constants as $key=>$value){echo('$_'.$key."=$value;");br();}
    //r($constants);
    //foreach($params as $key=>$value){echo('$'.$key."=$value;");br();}
    foreach($constants as $key=>$value)eval('$_'.$key.'=$value;');
    foreach($params as $key=>$value)eval('$'.$key.'=$value;');
    //echo('ahoj'.$func);
    $c1=$GLOBALS['config']["f"][$func]["use"]["q"];
    //print_r($GLOBALS['config']);
    //echo('$price='.$c1.";");br();
    eval('$price='.$c1.";");
    //echo("$price="._move."*($distance*$_speed)*(1/$_eff);");br();
    $c2=$GLOBALS['config']["f"][$func]["use"]["w"];
    $count=0;
    //echo($c2);
    $c2=explode("+",$c2);
    //r($c2);
    //r();
    foreach($c2 as &$value){
        $value=explode("*",$value);
        //r($value);
        if(!$value[1]){$value[1]=$value[0];$value[0]=1;}
        $count=$count+$value[0];
    }
    
    //-------------
    //r($price);
    $q=true;
    foreach($c2 as &$value){
        $resource=$value[1];
        $hold=ceil($price*$value[0]/$count);
        //r($resource.": $hold");
        if(!$GLOBALS['ss']["use_object"]->hold->test($resource,$hold)){
            $q=false;
            $GLOBALS['ss']["query_output"]->add("error","Potřebujete alespoň {q_".$resource.";$hold}.");
        }
        //$hold->add($value[1],ceil($price*$value[0]/$count));
    }
    if($mode==2){
        $return=new hold('');
        foreach($c2 as &$value){
            $resource=$value[1];
            $hold=ceil($price*$value[0]/$count);
            $return->add($resource,$hold);
        }
        return($return);
    }
    if($q){
        if($mode==0){
            foreach($c2 as &$value){
                $resource=$value[1];
                $hold=ceil($price*$value[0]/$count);
                $GLOBALS['ss']["use_object"]->hold->take($resource,$hold);
            }
        }
        return(true);
    }else{
        return(false);
    }
    //return($hold);
    //$hold->r();
    //r($c2);
    //r($count);
    //
    //$hold->add();
    
    //r($price);
    //r($constants);
    
}
//------
function use_hold($hold){
return($GLOBALS['ss']["use_object"]->hold->takehold($hold));
}
//------
function test_hold($hold){
return($GLOBALS['ss']["use_object"]->hold->testhold($hold));  
}
//===============================================================================================================
$GLOBALS['ss']["xresponse"]='';
function xquery($a,$b="",$c="",$d="",$e="",$f="",$g="",$h="",$i=""){
    xreport();
    $b=x2xx($b);$c=x2xx($c);$d=x2xx($d);$e=x2xx($e);$f=x2xx($f);$g=x2xx($g);$h=x2xx($h);$i=x2xx($i);
    /*$query=$a;
    if($b){$query="$a $b";}
    if($c){$query="$a $b $c";}
    if($d){$query="$a $b $c $d";}
    if($e){$query="$a $b $c $d $e";}
    if($f){$query="$a $b $c $d $e $f";}
    if($g){$query="$a $b $c $d $e $f $g";}
    if($h){$query="$a $b $c $d $e $f $g $h";}
    if($i){$query="$a $b $c $d $e $f $g $h $i";}
    //r($query);*/
    //$query=array($a,$b,$c,$d,$e,$f,$g,$h,$i);
    //$query=implode(',',$query);
    $query=("$a $b,$c,$d,$e,$f,$g,$h,$i");    
    $response=query($query);

    if($response->val("1")=='1')
    $GLOBALS['ss']["xsuccess"]=($response->val("1"));
    //e($query.' - '.$GLOBALS['ss']["xsuccess"]);br();
    $response=$response->vals2list();
    //print_r($response);
    if($GLOBALS['ss']["xresponse"]=='')$GLOBALS['ss']["xresponse"]=$response;
    return($response);
    
}
$GLOBALS['ss']["xsuccess"]=0;
$GLOBALS['ss']["xresponse"]=array();
//-----------------------------------------------------
function xreport(){
    
    $response=$GLOBALS['ss']["xresponse"];
    $GLOBALS['ss']["xresponse"]='';
    if($response!=''){//r($response);
    //r($response);
    //$response=new vals($response);
    $error=$response['error'];
    if($error){
        if(!is_array($error)){//print_r($error);
            alert($error,2);
        }else{//print_r($error);
            foreach($error as $tmp){
                alert($tmp,2);
            }
        }
    }

    $success=$response['success'];
    if($success){
        if(!is_array($success)){
            alert($success,1);
        }else{
            foreach($success as $tmp){
                alert($tmp,1);
            }
        }
    }
    //r($response->own2);
    //$response->func=new func($response->func);
    //$response->res=new res($response->res);
    //$response->profile=new profile($response->profile);
    //$response->hold=new hold($response->hold);
    }
}
//-----------------------------------------------------

function xerror($text){//echo($text);
    if(!$GLOBALS['ss']["xresponse"]){$GLOBALS['ss']["xresponse"]=array();}
    if(!$GLOBALS['ss']["xresponse"]['error']){$GLOBALS['ss']["xresponse"]['error']=array();}
    $GLOBALS['ss']["xresponse"]['error'][count($GLOBALS['ss']["xresponse"]['error'])]=$text;
}
//-----------------------------------------------------
function xsuccess(){
    return($GLOBALS['ss']["xsuccess"]);
}
//-----------------------------------------------------
function xsuccessalert($text){
if(xsuccess()){alert($text,1);}
}
?>