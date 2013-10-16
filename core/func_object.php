<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/func_object.php

   Tento soubor slouží k deklaraci objektu na spávu tabulky [mpx]objects.
*/
//==============================




/**
 *
 */
class object{
    /**
     * @param $id
     * @param string $where
     */
    function __construct($id=0,$where=""){
        //if($where==false){$where="";$this->noupdate=true;}else{$this->noupdate=false;}
        $this->noupdate=false;
        //r($id);
        $id=sql($id);
        //r($id);
        if(!$where){$where="id='$id' OR name='$id'";}
        if($id!="create"){
            //r("nocreate");
            //$this->id=$id;
            //r(">".$id,"t");
            $sql_ownname="(SELECT name FROM ".mpx."objects as tmp WHERE tmp.id=".mpx."objects.own) AS ownname";
            $sql_inname="(SELECT name FROM ".mpx."objects as tmp WHERE tmp.id=".mpx."objects.in) AS inname";
            $result = sql_array("SELECT *,$sql_ownname,$sql_inname FROM ".mpx."objects WHERE $where LIMIT 1",0);
            $row = $result[0];
            if($row){
                //---------------
                //TASKS//$this->tasks=sql_csv("SELECT * FROM ".mpx."tasks WHERE object='".$row["id"]."' ORDER BY time");
                //---------------
                /*$result3 = sql_query("SELECT id,name FROM objects WHERE own='".$row["id"]."' ORDER BY name");
                 $this->own2=new vals();
                while($own = mysql_fetch_array ($result3)){
                 $this->own2->add($own["id"],$own["name"]);
                }
                mysql_free_result($result3);*/
                //---------------
                /*$result3 = sql_query("SELECT id,type FROM objects WHERE `in`='".$row["id"]."' ORDER BY name");
                 $this->in2=new vals();
                while($own = mysql_fetch_array ($result3)){
                 $this->in2->add($own["id"],$own["type"]);
                }
                mysql_free_result($result3);*/
                //r("t");
                 $this->own2=sql_csv("SELECT id,name FROM ".mpx."objects WHERE (`type`='user' OR `type`='unit') AND own='".$row["id"]."' ORDER BY name");
                // r("t");
                 //r($this->own2);
                 //$this->in2=sql_csv("SELECT id FROM objects WHERE `in`='".$row["id"]."' ORDER BY t");
                //---------------
                $this->loaded=true;
                $this->id=$row["id"];
                $this->type=$row["type"];
                $this->fp=$row["fp"];
                $this->fs=$row["fs"];
                $this->fr=$row["fr"];
                $this->fx=$row["fx"];
                $this->fc=$row["fc"];
                $this->dev=$row["dev"];
                $this->name=$row["name"];
                //$this->password=$row["password"];
                $this->func=new func($row["func"]);
                $this->set=new set($row["set"]);
                $this->res=($row["res"]);
                $this->profile=new profile($row["profile"]);
                $this->hold=new hold($row["hold"]);
                $this->hard=$row["hard"];
                $this->expand_=$row["expand"];
                $this->collapse_=$row["collapse"];
                $this->own=$row["own"];
                $this->ownname=$row["ownname"];
                $this->in=$row["in"];
                $this->inname=$row["inname"];
                $this->ww=$row["ww"];
                $this->t=$row["t"];
                $this->x=$row["x"];
                $this->y=$row["y"];
                        //$this->fs=$this->func->fs();
                        //$this->fr=$this->fp+$this->hold->fp();
                $this->orig_sum=$this->sum();
                $this->orig_sum_=$this->sum_();
                $this->orig_sum2=$this->sum(true);
                if(!$this->x){$this->x=0;}
                if(!$this->y){$this->y=0;}
                
                //$this->x++;
                $this->type();
                //r("t","<");
                return(true);
            }else{
                //echo('hovnooooooooooooooo'.$id);
                r('not loaded '.$id);
                $this->loaded=false;
                return(false);
            }
        }else{
            //r($id);
            $id=nextid();
            $name='object '.$id;
            sql_query("INSERT INTO `".mpx."objects` (`id`,`name`, `type`, `fp`, `fs`, `dev`, `func`, `set`, `res`, `profile`, `hold`, `own`, `hard`, `expand`, `collapse`, `ww`,`in`, `t`, `x`, `y`) VALUES ('$id','$name', 'hybrid', '', '', NULL, NULL, NULL,NULL, NULL, NULL, NULL, 0, 0, 0,'1', NULL, NULL, '0', '0')",1);
            //$this->id=sql_1data("SELECT LAST_INSERT_ID()");
            $this->id=$id;
            $this->name=$name;
            r("creating ".$this->id);
            $this->loaded=true;
            $this->type="";
            $this->fp="";
            $this->fs="";
            $this->dev="";
            //$this->name="untitled_".$this->id;
            //$this->password="";
            $this->func=new func();
            $this->set=new set();
            $this->res="";
            $this->profile=new profile();
            $this->hold=new hold();
            $this->hard="";
            $this->expand_="";
            $this->collapse_="";
            $this->own="";
            $this->ownname="";
            $this->ww="1";
            $this->in="";
            $this->t="";
            $this->x="";
            $this->y="";
            $this->orig_sum="update";
        }
    }
    //--------------------------------------------
    /**
     * @param bool $image
     * @return string
     */
    function sum($image=false){
        $stream="";
        if(!$image){
            $stream.=",".$this->id;
            $stream.=",".$this->type;
            $stream.=",".$this->fp;
            //$stream.=",".$this->fs;
            //$stream.=",".$this->fr;
            //$stream.=",".$this->fx;
            $stream.=",".$this->dev;
            $stream.=",".$this->name;
            //$stream.=",".$this->password;
            //r(1);
            $stream.=",".$this->func->vals2str();
            //r(2);            
            $stream.=",".$this->set->vals2str();
            $stream.=",".$this->res;
            $stream.=",".$this->profile->vals2str();
            $stream.=",".$this->hold->vals2str();
            $stream.=",".$this->hard;
            $stream.=",".$this->expand_;
            $stream.=",".$this->collapse_;
            $stream.=",".$this->own;
            $stream.=",".$this->in;
            $stream.=",".$this->ww;
            $stream.=",".$this->x;
            $stream.=",".$this->y;
        }else{
            $stream.=",".$this->res;
            $stream.=",".$this->profile->vals2str();
        }
        $stream=md5($stream);
        return($stream);
    }
    function sum_($image=false){
        $stream="";
            $stream.=",".$this->type;
            $stream.=",".$this->fp;
            //$stream.=",".$this->fs;
            //$stream.=",".$this->fr;
            //$stream.=",".$this->fx;
            $stream.=",".$this->dev;
            $stream.=",".$this->func->vals2str();
            //$stream.=",".$this->set->vals2str();
            $stream.=",".$this->res;
            $stream.=",".$this->hold->vals2str();
            //$stream.=",".$this->hard;
            //$stream.=",".$this->expand_;
            $stream.=",".$this->own;
        $stream=md5($stream);
        return($stream);
    }
    //--------------------------------------------
    /**
     *
     */
    function __destruct(){/*$this->update();*/}//r(glob("tmp/32/193/*"));
    /**
     *
     */
    function update($force=false){
        //echo("destructing ".$this->id);
        //echo("<br>");
        //echo($this->orig_sum);
        //echo("<br>");
        //echo($this->sum());
        //echo("<br>");
        //load_file('/path/to/file')
        if($this->loaded){
            /*if(!$this->resfile){
                 //$res="'".(addslashes($this->res))."'";
            }else{
                //r(file_get_contents($this->res));
                //$res="'".(addslashes(file_get_contents($this->res)))."'";
                //echo("copy(".$this->res.",".root."data/image/".$this->id.".jpg);");
                $file=root."data/image/".$this->id.".jpg";
                copy($this->res,$file);
                chmod($file,0777);
            }
            $res="''";*/
            //if($this->id==1){cleartmp($this->id);}
            if($this->orig_sum!=$this->sum() or $force){$this->loaded=false;
                if($this->orig_sum2!=$this->sum(true)){cleartmp($this->id);}
                //echo("updating ".$this->id);
                //echo("<br>");
                //==================================================================ARYYD
                if(($this->orig_sum_!=$this->sum_() and !$this->noupdate) or $force){
                    r("updating sumaries - ".$this->id." + FS/FP");
                    //------------------------------FS + FC (FP - NONE)
                    $fc= new hold("");
                    $funcs=$this->func->vals2list();
                    foreach($funcs as $name=>$func){
                        $class=$func["class"];
                        if($c1=$GLOBALS['config']["f"][$class]["create"]["q"] and $c2=$GLOBALS['config']["f"][$class]["create"]["w"]){//r('xxx');
                            $constants=$func["params"];
                            foreach($constants as &$value_c)$value_c=$value_c[0]*$value_c[1];
                            //r($constants);
                            foreach($GLOBALS['config']["f"]["constant"] as $key=>$value){
                                if(!$constants[$key]){
                                    $constants[$key]=$value;
                                }
                            }
                            foreach($GLOBALS['config']["f"]["global"]["create"] as $key=>$value){$key="_".$key;
                                    //r("$key=>$value");
                                    if(!defined($key))define($key,$value);
                            }
                            //foreach($constants as $key=>$value){echo('$_'.$key."=$value;");br();}
                            //r($constants);
                            //foreach($params as $key=>$value){echo('$'.$key."=$value;");br();}
                            foreach($constants as $key=>$value)eval('$_'.$key.'=$value;');
                            //foreach($params as $key=>$value)eval('$'.$key.'=$value;');
                            
                            //r($GLOBALS['config']["f"]["create"]);
                            //echo('$price='.$c1.";");br();
                            eval('$price='.$c1.";");
                            //--------------------------------
                            $count=0;
                            $c2=explode("+",$c2);
                            foreach($c2 as &$value){
                                $value=explode("*",$value);
                                //r($value);
                                if(!$value[1]){$value[1]=$value[0];$value[0]=1;}
                                $count=$count+$value[0];
                            }
                            foreach($c2 as &$value){
                                $resource=$value[1];
                                $hold=ceil($price*$value[0]/$count);
                                //r($resource.": $hold");
                                $fc->add($resource,$hold);
                            }
                            //--------------------------------
                    }
                    }
                    $this->fs=ceil($fc->fp());
                    $this->fc=($fc->vals2str());
                    //------------------------------FR
                    //$this->hold->show();
                    $this->fr=$this->hold->fp();  
                    //------------------------------FX
                    $this->fx=$this->fp+$this->fr;
                    //------------------------------HARD,EXPAND,COLLAPSE
                    $tmp=$funcs["hard"]["params"]["hard"];$this->hard=$tmp[0]*$tmp[1];//r(444);r($tmp);
					$tmp=$funcs["expand"]["params"]["distance"];$this->expand_=$tmp[0]*$tmp[1];    
					$tmp=$funcs["collapse"]["params"]["distance"];$this->collapse_=$tmp[0]*$tmp[1];
		    //------------------------------TIME
		    $this->t=time();                
                    //------------------------------REPORT
                    /*r($this->fs);
                    r($this->fp);
                    r($this->fr);
                    r($this->fx);
                    r($this->fc);
                    r($this->hard);*/
                    //r($this->expand_);
                }else{
                    r("updating sumaries -".$this->id);
                }
                //==================================================================ARYYD
                $query=("UPDATE  ".mpx."objects SET 
                `type` =  '".($this->type)."',
                `fp` =  '".($this->fp)."',
                `fs` =  '".($this->fs)."',
                `fr` =  '".($this->fr)."',
                `fx` =  '".($this->fx)."',
                `fc` =  '".($this->fc)."',
                ".//`fx` =  ".($this->fr)."+(SELECT SUM(`fr`) FROM `objects` AS tmp WHERE tmp.`own`='".$this->id."' OR tmp.`in`='".$this->id."'),
                //UPDATE objects SET `fx` = 10+(SELECT 1 FROM objects AS xxxx)
                "`dev` =  '".($this->dev)."',
                `name` =  '".($this->name)."',
                `func` =  '".($this->func->vals2str())."',
                `set` =  '".($this->set->vals2str())."',
                `res` =  '".$this->res."',
                `profile` =  '".($this->profile->vals2str())."',
                `hold` =  '".($this->hold->vals2str())."',
                `hard` =  '".(($this->hard))."',
                `expand` =  '".(($this->expand_))."',
                `collapse` =  '".(($this->collapse_))."',
                `own` =  '".(($this->own))."',
                `in` =  '".(($this->in))."',
                `ww` =  '".(($this->ww))."',
                `t`=  '".($this->t)."',
                `x` =  '".($this->x)."',
                `y` =  '".($this->y)."'
                WHERE  id ='".($this->id)."'");
                r($query);
                //r("t");
                sql_query($query);
                //r("t");
//echo(mysql_error());
            }
        }else{
		r('update - not loaded');
	}
    }
    //--------------------------------------------
    /**
     *
     */
    function xxx(){
        r($this->id);
        if($this->loaded){
        r($this->name);
        r($this->profile->vals2str());
        }else{r("not loaded");}
    }
    //--------------------------------------------
    /**
     *
     */
    function delete(){
        sql_query("DELETE FROM `".mpx."objects` WHERE `id` = '".$this->id."'");
        $this->loaded=false;
    }
    //--------------------------------------------//TASKS//
    /**
     * @param $time
     * @param $func
     * @param $params
     */
    /*function addtask($name,$time,$func,$params){
        $result2 = sql_query("SELECT * FROM ".mpx."tasks WHERE object='".$this->id."' ORDER BY time");
        $this->maxtime=time();$q=0;
        while($task = mysql_fetch_array ($result2)){
            $this->maxtime=$task["time"];$q=1;
        }
        mysql_free_result($result2);/*
        if($q){
            $GLOBALS['ss']["query_output"]->add("error","Jste zaneprázdněni.");
            return(false);
        }
        //echo($time."<br>");
        $params=$params->vals2str();
        sql_query("INSERT INTO ".mpx."tasks (`name`,`object`,`timestart`,`time`,`func`,`params`) VALUES ('".($name)."','".($this->id)."',".($this->maxtime).",".($this->maxtime+$time).",'$func', '$params');");
        return(true);
    }
     //--------------------------------------------
     function deletetask($taskid){
        sql_query("DELETE FROM ".mpx."tasks WHERE id='".$taskid."' AND object='".$this->id."'");
    }*/
    //--------------------------------------------

    /**
     * @return mixed|string
     */
    function tostring(){
        $head=$this->name;
        $return=
"$head:type =  ".($this->type).";
$head:fp =  ".($this->fp).";
$head:fs =  ".($this->fs).";
$head:fr =  ".($this->fr).";
$head:fx =  ".($this->fx).";
$head:fc =  ".($this->fc).";
$head:dev =  ".($this->dev).";
$head:name =  ".($this->name).";
".($this->func->vals2strobj("$head:func"))."
".($this->set->vals2strobj("$head:set"))."
$res:dev =  ".($this->res).";
".($this->profile->vals2strobj("$head:profile"))."
".($this->hold->vals2strobj("$head:hold"))."
$head:hard =  ".(($this->hard)).";
$head:expand =  ".(($this->expand_)).";
$head:collapse =  ".(($this->collapse_)).";
$head:own =  ".(($this->own)).";
$head:in =  ".(($this->in)).";
$head:ww =  ".(($this->ww)).";
$head:t=  ".(time()).";
$head:x =  ".($this->x).";
$head:y =  ".($this->y).";";
        $return=str_replace(nln.nln,nln,$return);
        return($return);
    }
    //--------------------------------------------
    function type(){
        /*$types=array_reverse($GLOBALS['config']["types"]);
         foreach($types as $key=>$value){
             $af=explode(",",$value["af"]);
             r($key);
             r($af);
        }
         $funcs=$this->func->vals2list();
         r();*/
     }
     //--------------------------------------------
    function getName(){return($this->name);}
    function setName($value){$this->name=$value;}
    function getFS(){return($this->fs);}
    function getFP(){return($this->fp);}
    function setFP($value){$this->fp=$value;}
     //--------------------------------------------
    function position(){
        list(list($id,$name,$object,$timestart,$time,$func,$params))=csv2array($this->tasks);
        if($func=="move"){
            $params=str2list($params);
            $x=time5($timestart,$time,$this->x,$params["x"]);
            $y=time5($timestart,$time,$this->y,$params["y"]);
        }else{
            $x=$this->x;
            $y=$this->y;
        }
        return(array($x,$y));
    }
    //--------------------------------------------
    function support(){
        if($this->loaded){
            $funcs=$this->func->vals2list();
            $newfuncs=$funcs;
            $support=array();
            $in2=sql_array("SELECT `id`,`type`,`fp`,`fs`,`dev`,`name`,NULL,`func`,`set`,NULL,`profile`,`hold`,`hard`,`expand`,`collapse`,`own`,`in`,`t`,`x`,`y` FROM ".mpx."objects WHERE `in`='".($this->id)."' ORDER BY t desc");
            foreach($in2 as $item){
                list($_id,$_type,$_fp,$_fs,$_dev,$_name,$_password,$_func,$_set,$_res,$_profile,$_hold,$_hard,$_expand,$_collapse,$_own,$_in,$_t,$_x,$_y)=$item;
                $_x=intval($_x);$_y=intval($_y);
                if(!$_x)$_x="";
                foreach($funcs["hold$_x"]["params"] as $param=>$value){
                    list($qqe1,$e2)=$value;
                    if($param!="q"){
                        foreach(func2list($item[7]) as $funci){
                            if($funci["class"]==$param){
                                foreach($funci["params"] as $parami=>$valuei){
                                    list($e1i,$e2i)=$valuei;
                                    $e1i=$e1i*$e2;
                                    $e2i=pow($e2i,$e2);//2^0.2
                                    if(!$support[$funci["class"]])$support[$funci["class"]]=array();
                                    if(!$support[$funci["class"]][$parami])$support[$funci["class"]][$parami]=array(0,1);
                                    $support[$funci["class"]][$parami][0]=$support[$funci["class"]][$parami][0]+$e1i;
                                    $support[$funci["class"]][$parami][1]=$support[$funci["class"]][$parami][1]*$e2i;
    
                                }
                            }
                        }
                    }
                }
            }
            foreach($newfuncs as $name=>$func){
                $class=$func["class"];
                $params=$func["params"];
                $profile=$func["profile"];
                foreach($params as $fname=>$param){
                    $e1=$param[0];$e2=$param[1];
                    $support1=$support[$class][$fname];
                    if($support1){
                        list($se1,$se2)=$support1;
                        $q=($se1+$e1)*($se2*$e2);
                        $newfuncs[$name]["params"][$fname][0]=$q;
                        $newfuncs[$name]["params"][$fname][1]=1;
                    }
                }
            }
            //r($newfuncs);
            return($newfuncs);
        }else{return(array());}
    }
    //--------------------------------------------
    function supportF($function,$value=""){
        if(!$value)$value=$function;
        $funcs=$this->support();
        $func=$funcs[$function];
        if(!$func["params"][$value] and $GLOBALS['config']['f']['default'][$value]){
            return($GLOBALS['config']['f']['default'][$value]);
        }
        if($func){
            list($a,$b)=$func["params"][$value];
            return($a*$b);
        }else{
            return(0);
        }
    }
}
//======================================================================================
function supportF($id,$function,$value=""){
    $object=new object($id);
    return($object->supportF($function,$value));
}


function nextid($id){
    $id=sql_1data("SELECT max(id) FROM ".mpx."objects")-(-1);
    return($id);
}

///NEEEEEEEEEEEEFEKTINIIIIIIIIIIIII
function id2name($id){
    $name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
    return($name);
}

function name2id($name){
    if(!is_numeric($name)){
        $id=sql_1data("SELECT id FROM ".mpx."objects WHERE name='$name'");
    }else{
        $id=$name;
    }
    return($id);
}

function id2unique($id){
    if(!$id)return('');
    $name=sql_1data("SELECT name FROM ".mpx."objects WHERE id='$id'");
    $count=sql_1data("SELECT COUNT(1) FROM ".mpx."objects WHERE name='$name'")-1+1;
    if($count>1)$name.="($id)";
    return($name);
}

function unique2id($unique){
    $unique=trim($unique);
    list($name,$id)=explode('(',$unique);
    $name=trim($name);
    if($id){
        $id=trim(str_replace(')','',$id));
    }else{
        $id=sql_1data("SELECT id FROM ".mpx."objects WHERE name='$name'");
    }
    return($id);
    
}



function id2info($id,$rows){
    $info=sql_array("SELECT $rows FROM ".mpx."objects WHERE id='$id'");
    foreach ($info as &$value) {
    $info = $info[0];
    }
    return($info);
}


/**
 * @param string $where
 * @param string $order
 * @param string $limit
 * @return array
 */
function objects($where="",$order="",$limit=""){
    if($where){$where="WHERE ".$where;}
    if($order){$order="ORDER BY ".$order;}
    if($limit){$limit="LIMIT ".$limit;}
    $result = sql_query("SELECT * FROM ".mpx."objects $where $order $limit");
    $objects=array();
    while($object = mysql_fetch_array ($result)){
        $objects=array_merge($objects,array($object));
    }
    mysql_free_result($result);
    return($objects);
}
//======================================================================================
/**
 * @param $id
 * @return array|bool
 */
function ifobject($id){
    //r("SELECT id FROM objects WHERE id='$id' OR name='$id'");
    $result = sql_1data("SELECT id FROM ".mpx."objects WHERE id='$id' OR name='$id'");
    //r($result);
    if($result){
        return($result);
    }else{
        return(0);
    }
}
//================================================
function topobject($id){
    //r("SELECT id FROM objects WHERE id='$id' OR name='$id'");
    $result = sql_1data("SELECT own FROM ".mpx."objects WHERE id='$id' OR name='$id' LIMIT 1");
    //r($result);
    if($result){
        return(topobject($result));
    }else{
        return($id);
    }
}
//======================================================================================
/**
 * @param $id
 * @return bool|string
 */
function name_error($id){
    $id=xx2x($id);
    if($GLOBALS['ss']["use_object"]->name==$id){
            return('{name_error_same}');//"Toto jméno právě používáte.");
    }
    if($id!=trim($id)){
            return('{name_error_space}');//"Jméno nesmí začínat ani končit mezerou.");
    }
    if(!$id){
            return('{name_error_noname}');//"Musíte zadat jméno.");//K+M+B
    }
    if(strlen($id)<4){
            return('{name_error_minchars;4}');//"Jméno musí mít alespoň 3 znaky.");
    }
    if(strlen($id)>37){
            return('{name_error_maxchars;37}');//"Jméno nesmí mít víc než 100 znaků");
    }
    if(str_replace(str_split('`!@#$%^&*()+{}[]=:"|<>?;\'¨\\,/;=´§,'),'',$id)!=$id){
            return('{name_error_specialchars}');//"Jméno by nemělo nesmí speciální znaky.");
    }
    if(ifobject($id)){
            return('{name_error_used}');//"Jméno je už obsazené.");
    }
    if(($id-1+1).""==$id){
            return('{name_error_number}');//"Jméno nesmí být pouze číslo");
    }
    /*$disable=array();
    if(ifobject($id)){
            return("Jméno je obsazené");
    }*/
    return(false);
}
//$a=new object("create");
//$a->delete();
?>
