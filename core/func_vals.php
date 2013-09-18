<?php
class vals{
    var $vals=array();
    var $numberindex=0;
    function __construct($str="",$q=false){
        if(is_array($str)){
            $this->vals=$str;
        }else{
            //if($q){r($str);}
            $tmp=str_replace(";\r\n",";",$str);
            $tmp=explode(";",$tmp);
            foreach($tmp as $row){
            list($a,$b)=explode("=",$row);
            //$this->add($a,$b);
            //r($b);
            $b=explode(",",$b);
            foreach($b as $bb){
            //r($bb);
            $this->add($a,$bb,true);
            }}
        }
    }
    //--------------------------------------------
     function r(){r($this->vals);}
    //--------------------------------------------
    function add($a,$b,$unserialize=false){
        //echo($a."=".$b.br);
        //r($this->nojoin);
        if($a and !$b){
            $q=true;
            //r("swichaandb",$this->numberindex,$a,$b);
            $b=$a;
            $a=$this->numberindex;
            $this->numberindex++;
        }
        if($a or $q){
            //r($b);
            //$b=xx2x($b);
            if($unserialize){$b=xx2x($b);}
            //r($b);
            //echo("$a=$b<br>");
            if(!$this->vals[$a] or ($this->nojoin and $a!="join")){
                if($this->nojoin==="plus"){
                    //echo("plus");
                    $this->vals[$a]=$this->vals[$a]+$b;
                }else{
                    //echo("equate");
                    $this->vals[$a]=$b;
                }
            }else{
                if(!is_array($this->vals[$a])){
                    $x=$this->vals[$a];
                    $this->vals[$a]=array();
                    $this->vals[$a][0]=$x;
                    $this->vals[$a][1]=$b;
                }else{
                    $this->vals[$a][count($this->vals[$a])]=$b;
                }
            }
        }
        //print_r($this->vals);
    }
    //--------------------------------------------
    function delete($a){
        unset($this->vals[$a]);
    }
    //--------------------------------------------
     function vals2str($conf=false){
        //r(1);
        $tmp=array();$i=0;
        foreach($this->vals as $a=>$b){
            if(is_object($b))$b=$b->vals2str();
            if(is_array($b)){
                $ii=0;while($b[$ii]){$b[$ii]=x2xx($b[$ii]);$ii=$ii+1;}
                $b=join(",",$b);
            }else{
                //r($b);
                $b=x2xx($b);
                //r($b);
            }
            $tmp[$i]="$a=$b";
            //r($tmp[$i]);
            $i=$i+1;
        }
        //r($tmp);
        if($conf){$sch=";".nln;$bch=";";}else{$sch=";";$bch="";}
        $tmp=join($sch,$tmp);
        $tmp=$tmp.$bch;
        //r($tmp);
        return($tmp);
    }
    //--------------------------------------------
     function vals2list(){
        return($this->vals);
    }
    //--------------------------------------------
     function val($val){
        $val=($this->vals[$val]);
        if($val){
            return($val);
        }else{
            return(false);
        }
    }
    //--------------------------------------------
     function ifnot($key,$default){
        $val=($this->vals[$key]);
        if(!$val){
            //$this->add($key,$default);
            //return($val);
            return($default);
        }
        return($val);
    }
    //--------------------------------------------
    function sort(){ksort($this->vals);}
    //--------------------------------------------
     function vals2strobj($head){
        $tmp=array();$i=0;
        foreach($this->vals as $a=>$b){
            if(is_array($b)){
                $i=0;while($b[$i]){$b[$i]=x2xx($b[$i]);$i=$i+1;}
                $b=join(",",$b);
            }else{
                $b=x2xx($b);
            }
            $tmp[$i]="$head:$a=$b;";
            $i=$i+1;
        }
        $tmp=join(nln,$tmp);
        return($tmp);
    }
}
//$tmp=new vals("");
//$tmp->add("qq","=;class=qqw;params=[equate];profile=[equate]");
//print_r($tmp->vals2list());
//exit;
/*$tmp = new vals("a=7;page=use;c=x;c=c");
$tmp->add("c","xxx");
$tmp->add("page","xxx2");
print_r($tmp->vals2list());
if($tmp->val("aa")){echo("hurá");}*/
//--------------------------------------------
function str2list($tmp){
    if(!is_object($tmp))$tmp=new vals($tmp);
    $tmp=$tmp->vals2list();
    return($tmp);
}
//--------------------------------------------
function list2str($tmp){
    if(!is_object($tmp))$tmp=new vals($tmp);
    $tmp=$tmp->vals2str();
    return($tmp);
}
//$r=str2list( "  =;x=15;y=110");
//r($r["x"]);
//--------------------------------------------
function valsintext($text,$vals,$x2xx=false){
    $list=str2list($vals);
    foreach($list as $key=>$value){
        if($x2xx)$value=x2xx($value);
        $text=str_replace("[$key]",$value,$text);
    }
    return($text);
}
//$text=valsintext("[0]oo[hovno]","ggg");
//r($text);
//die();
//--------------------------------------------
function xxx2conf($tmp){
    $tmp=new vals($tmp);
    $tmp=$tmp->vals2str(true);
    return($tmp);
}
/*$vals=new vals("a=1,2;b=3,4");
$vals->r();
$vals=$vals->vals2str();
r($vals);*/
//--------------------------------------------
/*function list2str($tmp){
    $sub=array(0);
    $i=0;
    while(!$sub[-1] and $i<1000){$i++;
        $value=$text;
        foreach($sub as $ii){
            $keys=array_keys($value);
            $key=$keys[$ii];
            $value=$value[$key];
        }
        if($value){
            if(!is_array($value)){
                $iii=1;$sp="";
                while($iii<sizeof($sub)){$iii++;
                    $sp=$key."=".x2xx($value);
                }
                $sub[sizeof($sub)-1]++;
            }else{
                $iii=1;$sp="";
                $sp=$key."=";
                $sub[sizeof($sub)]=0;
            }
        }else{
            array_pop($sub);
            $sub[sizeof($sub)-1]++;
        }
        //print_r($sub);
        //echo(br);

    }
}
$array=(array("hovno",array(array(array(1,2,3,4,5)),8),array(array(2,4)),array(7,abc=>"aaa")));
r($array);
$array=list2str($array);
r($array);*/
//===============================================================================================================
class func{
    function __construct($str=""){
         $this->funcs=new vals($str);
         $this->funcs->nojoin=true;
         $this->funcs->sort();
         //------------------------------
         $tmp=$this->funcs->vals2list();
         //if(isset($tmp['login'])){
         if(!isset($tmp['chat']))$this->add('chat','chat');
         if(!isset($tmp['info']))$this->add('info','info');
         if(!isset($tmp['logout']))$this->add('logout','logout');
         if(!isset($tmp['login']))$this->add('login','login');
         if(!isset($tmp['profile_edit']))$this->add('profile_edit','profile_edit');
         if(!isset($tmp['set_edit']))$this->add('set_edit','set_edit');
         if(!isset($tmp['stat']))$this->add('stat','stat');
         if(!isset($tmp['text']))$this->add('text','text');
         if(!isset($tmp['use']))$this->add('use','use');
         if(!isset($tmp['leave']))$this->add('leave','leave');
         if(!isset($tmp['dismantle']))$this->add('dismantle','dismantle');
         if(!isset($tmp['repair']))$this->add('repair','repair');
         //}
         //$emptyvals=new vals();
         //login=1;use=1;info=1;item=1;profile_edit=1;set_edit=1;move=2;message=1;image=1
         //if(!$this->funcs->val("")){$this->add("","",$emptyvals,$emptyvals);}
    }
    //--------------------------------------------
    function add($name,$class,$params="",$profile=""){
        $func=new vals();
        if($params){$params=$params->vals2str();}else{$params=/*"qw"*/'';}
        if($profile){$profile=$profile->vals2str();}else{$profile=/*"qw"*/'';}
        //rn("name: ".$name);
        //rn("class: ".$class);
        //rn("params: ".$params);
        //rn("profile: ".$profile);
        $func->add("class",$class);
        $func->add("params",$params);
        $func->add("profile",$profile);
        $func=$func->vals2str();
        //rn($func);
        $this->funcs->add($name,$func);
        //r();
        //rn($this->funcs->vals2str());
        $this->funcs->sort();
        //r();
        //rn($this->funcs->vals2str());
        //r($this->funcs->vals2list());
    }
        //--------------------------------------------
    function addF($name,$key,$value,$wtf='params'){
        //r($this->vals2list());
        $func=$this->funcs->val($name);       
        if(!$func){
            $class=str_replace(array(0,1,2,3,4,5,6,7,8,9),'',$name);
            $this->add($name,$class);
            $func=$this->funcs->val($name);
            $func=new vals($func);  
        }
        //r(gettype($func));
        //r($func);
        
        //r(1);
        $params=new vals($func->val($wtf));
        //r(2);
        if($wtf=='params')$value=array(floatval($value),1);
        $params->add($key,$value);
        //$params->add($key,1);
        //r(3);        
        $params=$params->vals2str();
        if($wtf=='profile')$params=str_replace('[2]',',',$params);        
        
        $func->delete($wtf);
        $func->add($wtf,$params);
        
        
        $this->funcs->delete($name);
        $this->funcs->add($name,$func);
        //r(4);
    }
    //--------------------------------------------
    function delete($func){$this->funcs->delete($func);}
    //--------------------------------------------
     function vals2str(){
         $return=$this->funcs->vals2str();
         return($return);
    }
    //--------------------------------------------
    function vals2strobj($head){
         $return=$this->funcs->vals2strobj($head);
         return($return);
    }
    //--------------------------------------------
    function vals2list(){
        //r('vals2list');
        //r($this->funcs->vals2str());
        $return=$this->funcs->vals2list();
        //r(1);
        //r($return["login"]);
        foreach($return as $i=>$tmp){
            //r($return[$i]);
            //r(gettype($return[$i]));
            $return[$i]=str2list($return[$i]);//funkce
            //r(2);
            
            //$return[$i][1]=str2list($return[$i][1]);//
            $return[$i]["params"]=str2list($return[$i]["params"]);//params
            foreach($return[$i]["params"] as $key=>$value){
                if(!$return[$i]["params"][$key][0]){$return[$i]["params"][$key][0]=0;}
                if(!$return[$i]["params"][$key][1]){$return[$i]["params"][$key][1]=1;}
                //if(!$return[$i]["params"][$key][2]){$return[$i]["params"][$key][2]=1;}
            }
            $return[$i]["profile"]=str2list($return[$i]["profile"]);//profile
            /*foreach($return[$i]["params"] as $ii=>$tmp2){
                $return[$i]["params"][$ii]=str2list($return[$i]["params"][$ii]);
            }*/
        }
        //r($return["login"]);
        return($return);
    }
    //--------------------------------------------
     function func($func){
         $return=$this->vals2list();
         $return=$return[$func];
         if($return){
             $return=$return["params"];
             foreach($return as $i=>$param){
                 $exp1=$param[0];//["exp1"];
                 $exp2=$param[1];//["exp2"];
                 //$exp3=$param[2];//["exp3"];
                 //r($exp1);
                 //r($param);
                 if(!$exp1){$exp1=0;}
                 if(!$exp2){$exp2=1;}
                 //if(!$exp3){$exp3=1;}
                 $value=($exp1*$exp2);
                 $return[$i]=$value;
             }
             return($return);
         }else{
             return(false);
        }
    }
    //--------------------------------------------
    function profile($func,$param){
        $return=$this->vals2list();
        $return=$return[$func]["profile"][$param];
        //r($return);
        return($return);
    }
    //--------------------------------------------
    function fs(){
        $fs=0;
        foreach($this->vals2list() as $func){
            $f=$func["class"];
            //$params=$params["class"];
            $tmp=($GLOBALS['config']["fs"][$f]);
            if($tmp){
                //r($func["params"]);
                foreach($func["params"] as $key=>$v){
                    list($e1,$e2)=$v;
                    if($e2<1){$e2=1/$e2;}
                    $v=$e1*($e2*$e2);
                    //rn($v);
                    $tmp=str_replace($key,$v,$tmp);
                }
                $tmp="\$tmp=".$tmp.";";
                eval($tmp);
                $fs=$fs+$tmp;
            }
        }
        return($fs);
    }
    //--------------------------------------------
}
function level($list){
    list($exp1,$exp2)=$list;
    if(!$exp2){$exp2=1;}
    //if(!$exp3){$exp3=1;}
    $value=($exp1*$exp2);
    return($value);
}
//--------------------------------------------
function func2list($tmp){
    $tmp=new func($tmp);
    $tmp=$tmp->vals2list();
    return($tmp);
}
//login=1;use=1;info=1;item=1;profile_edit=1;set_edit=1;move=2;message=1;image=1);
//$profile=new vals("password=".md5("a"));
//$params=new vals("speed=10,3");
//$p=new func();
//$p->add("login","login","",$profile);
//$p->add("move","move",$params);
//$p->add("use","use");
//$p->add("info","info");
//$p->add("item","item");
//$p->add("profile_edit","profile_edit");
//$p->add("set_edit","set_edit");
//$p->add("move","move");
//$p->add("message","message");
//$p->add("image","image");
//$p=$p->vals2str();
//r(x2xx($p));
//$p=new func("attack=class[equate]attack[semicolon]params[equate]attack[babracket]equate[bbbracket]1[babracket]comma[bbbracket]1.2[babracket]semicolon[bbbracket]distance[babracket]equate[bbbracket]1[babracket]comma[bbbracket]1[semicolon]profile[equate]name[babracket]equate[bbbracket]útok;hold=class[equate]hold[semicolon]params[equate]q[babracket]equate[bbbracket]10[babracket]comma[bbbracket]1[semicolon]profile[equate]name[babracket]equate[bbbracket]batoh;hold1=class[equate]hold[semicolon]params[equate]q[babracket]equate[bbbracket]2[babracket]comma[bbbracket]1[babracket]semicolon[bbbracket]move[babracket]equate[bbbracket]1[babracket]comma[bbbracket]0.8[semicolon]profile[equate]name[babracket]equate[bbbracket]ruce;image=class[equate]image[semicolon]params[equate][semicolon]profile[equate];info=class[equate]info[semicolon]0[equate]params[semicolon]1[equate]profile;item=class[equate]item[semicolon]0[equate]params[semicolon]1[equate]profile;items=class[equate]items[semicolon]0[equate]params[semicolon]1[equate]profile;login=class[equate]login[semicolon]params[equate][semicolon]profile[equate]password[babracket]equate[bbbracket]0cc175b9c0f1b6a831c399e269772661;message=class[equate]message[semicolon]params[equate][semicolon]profile[equate];move=class[equate]move[semicolon]params[equate]speed[babracket]equate[bbbracket]7[babracket]comma[bbbracket]1[semicolon]profile[equate]name[babracket]equate[bbbracket]chůze;profile_edit=class[equate]profile_edit[semicolon]params[equate][semicolon]profile[equate];set_edit=class[equate]set_edit[semicolon]params[equate][semicolon]profile[equate];stat=class[equate]stat[semicolon]0[equate]params[semicolon]1[equate]profile;task_delete=class[equate]task_delete[semicolon]params[equate][semicolon]profile[equate];use=class[equate]use[semicolon]0[equate]params[semicolon]1[equate]profile");
//r($p->fs());
//exit;
//======================================================================================
class set extends vals{
    var $nojoin=true;
    var $vals=array(
    //$status=>new status()
    );
}
//----------
class windows extends vals{
    var $nojoin=true;
    var $vals=array(
    //$status=>new status()
    );
}
//======================================================================================
class profile extends vals{
    var $nojoin=true;
    var $vals=array(
    realname=>"",
    gender=>"",
    age=>"",
    mail=>"@",
    showmail=>"",
    web=>"",
    description=>"",
    join=>""
    //=>"",
    );
}
//===============================================================================================================
class hold extends vals{
    var $nojoin="plus";
    var $vals=array(
    fp=>0
    //=>"",
    );
    function textr($q=''){
        $stream="";
        foreach($this->vals as $key=>$value){//hu buc bud
            if($key and $value)$stream=$stream.("{res_".$key.$q."}: ".ir($value).' ');
    }
    if(!$stream)$stream="{res_no}";
    return($stream);
    }
    function show(){
        foreach($this->vals as $key=>$value){//hu buc bud
            echo(textbr("{res_".$key."}: ").ir($value).br);
        }
    }
    function showjs(){
        //echo("<script type=\"text/javascript\"><!--");
        foreach($this->vals as $key=>$value){//hu buc bud
            echo("countdownto('res_$key',$value); ");
            //echo("\$(\"#res_$key\").html($value);");
        }
        //echo("--></script>");/**/
    }
    function showimg($q=false,$notable=false){
        if(!$notable)echo("<table width=\"0\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>");
        foreach($this->vals as $key=>$value){//hu buc bud
            if($key and !is_numeric($key) and $value)echo((!$notable?'<td>':'').imgr("icons/res_$key.png","{res_$key}",15,15)."<span id=\"res_".($q?$key:'no')."\">".ir($value)."</span>".(!$notable?nbsp3.'</td>':' '));
        }
        if(!$notable)echo("</tr></table>");
    }
    function test($a,$b){
        //r($a,$b);
        $b=round($b);
        if($this->vals[$a]<$b){
            return(false);
        }else{
            return(true);
        }
    }
    function take($a,$b){
        //r($a,$b);
        $b=round($b);
        if($this->vals[$a]<$b){
            return(false);
        }else{
            $this->vals[$a]=$this->vals[$a]-$b;
            return(true);
        }
    }
     function fp(){
        $fp=0;
        foreach($this->vals as $key=>$value){
            $fp=$fp+$value;
        }
        return($fp);
    }
    //-------------------
        function testhold($hold){
        $hold=$hold->vals2list();
        foreach($hold as $key=>$value){
            if(!$this->test($key,$value))return(false);
        }
        return(true);
    }
    //-----
   function takehold($hold){
        if(!$this->testhold($hold))return(false);
        $hold=$hold->vals2list();
        foreach($hold as $key=>$value)$this->take($key,$value);
        return(true);
    }
        //-----
   function rhold($hold){
       $newvals=array(); 
       
        $hold=$hold->vals2list();
        foreach($hold as $key=>$value){
            $newvals[$key]=($this->vals[$key]-$value)*-1;
            if($newvals[$key]<1)$newvals[$key]=0;
            
        }
        
        $this->vals=$newvals;
        return(true);
    }
    //-----
   function multiply($q){
        foreach($this->vals as $key=>&$value)$value=round($value*$q);
    }
}
   
function showhold($hold,$cols=false){
    //e($hold);
    $hold=new hold($hold);
    $hold->showimg(NULL,$cols);
    unset($hold);
}

//--------------------------------------------
/*$hold=new hold("a=1");
$hold->add("a",1);
$hold->add("c",1);
echo($hold->fp());
exit;*/
//===============================================================================================================
/*class status{
    function __construct($str="actual="){
         $this->status=new vals($str);
         $this->status->nojoin=true;
    }
    //--------------------------------------------
    function add($name,$vals){
        $vals=vals2list($vals);
        $this->status->add($name,$vals);
    }
    function delete($name){$this->status->delete($name);}
    //--------------------------------------------
     function vals2str(){
         $return=$this->status->vals2str();
         return($return);
    }
    //--------------------------------------------
    function vals2list(){
        $return=$this->status->vals2list();
        foreach($return as $i=>$tmp){
            $return[$i]=str2list($return[$i]);
        }
        return($return);
    }
    //--------------------------------------------
}*/
?>