<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/login/func_core.php

   Přihlášení / Registrace - funkce systému
*/
//==============================




//======================================================================================REGISTER
define("a_register_help","user");
function a_register($param1){
    if(defined('countdown') and countdown-time()>0){return;}
    //$GLOBALS['ss']["query_output"]->add("success",'register '.$param1);
    if(!defined('register_block')){
    if(!($error=name_error($param1))){
        //$GLOBALS['ss']["query_output"]->add("success",'register '.$param1);
        //--------------------
        if(defined('register_user') and defined('register_building') and ifobject(register_user) and ifobject(register_building)){
             $q=false;             
            /*$limit=100;          
            while(!$g and $limit>0){$limit--;       
                $x=rand(1,mapsize);            
                $y=rand(1,mapsize);
                $hard=sql_1data("SELECT `hard` FROM ".mpx."map where `ww`='".$GLOBALS['ss']["ww"]."' AND `x`='$x' AND `y`='$y'");
                if(floatval($hard)<0.3)$q=true;
            }*/
            $file=tmpfile2("register_list","txt","text");
            if(!file_exists($file) or unserialize(file_get_contents($file))==array()){
                $array=sql_array("
                SELECT `x`,`y` FROM [mpx]map where `ww`='".$GLOBALS['ss']["ww"]."' AND 
		RAND()>0.99 AND
                (`terrain`='t3' OR `terrain`='t4' OR `terrain`='t7' OR `terrain`='t8' OR `terrain`='t9' OR `terrain`='t12' OR `terrain`='t13')  AND 
                9=(SELECT COUNT(1) FROM [mpx]map AS Y where Y.`ww`='".$GLOBALS['ss']["ww"]."' AND (Y.`terrain`='t3' OR Y.`terrain`='t4' OR Y.`terrain`='t7' OR Y.`terrain`='t8' OR Y.`terrain`='t9' OR Y.`terrain`='t12' OR Y.`terrain`='t13') AND (Y.`x`+1>=[mpx]map.`x` AND Y.`y`+1>=[mpx]map.`y` AND Y.`x`-1<=[mpx]map.`x` AND Y.`y`-1<=[mpx]map.`y`))
                AND
                0=(SELECT COUNT(1) FROM [mpx]objects AS X where X.`ww`='".$GLOBALS['ss']["ww"]."' AND  X.`own`!='0' AND (X.`x`+3>[mpx]map.`x` AND X.`y`+3>[mpx]map.`y` AND X.`x`-3<[mpx]map.`x` AND X.`y`-3<[mpx]map.`y`))
                ORDER BY RAND()");
                
            }else{
                $array=unserialize(file_get_contents($file));    
            }
            if($array){ 
                $q=true;            
                list($x,$y)=$array[0];
                array_splice($array,0,1);
            }
            file_put_contents2($file,serialize($array));
            if($q){
                $set='tutorial=1';
                $id=nextid();          
                $rows='`type`, `dev`, `fs`, `fp`, `fr`, `fx`, `fc`, `func`, `hold`, `res`, `profile`, `hard`, `expand`';                
                sql_query/*e*/("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id','$param1',$rows,'$set', '0', '0', '".$GLOBALS['ss']["ww"]."', '0', '0', '".time()."' FROM ".mpx."objects WHERE id='".register_user."';");
                $id2=nextid();                
                sql_query/*e*/("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id2','$param1',$rows,`set`, '$id', '0', '".$GLOBALS['ss']["ww"]."', '$x', '$y', '".time()."' FROM ".mpx."objects WHERE id='".register_town."';");
                $id3=nextid();                
                sql_query/*e*/("INSERT INTO ".mpx."objects (`id`,`name` ,$rows, `set`, `own`, `in`, `ww`, `x`, `y`, `t`) SELECT '$id3',`name`,$rows,`set`, '$id2', '0', '".$GLOBALS['ss']["ww"]."', '$x', '$y', '".time()."' FROM ".mpx."objects WHERE id='".register_building."';");
                                
                //------LOGIN                
                $GLOBALS['ss']["query_output"]->add("1",1);
                $GLOBALS['ss']["log_object"]=new object($id);
                $GLOBALS['ss']["log_object"]->func->delete('login');
                $GLOBALS['ss']["log_object"]->func->add('login','login');
                $GLOBALS['ss']["log_object"]->update();           
                $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
                a_use($id2/*$param1*/);/**/
            }else{
                $GLOBALS['ss']["query_output"]->add("error",'{register_error_nospace}'); 
            }
        }else{
            $GLOBALS['ss']["query_output"]->add("error",'{config_error}'); 
        }
        //--------------------
    }else{
        $GLOBALS['ss']["query_output"]->add("error",$error);
    }
    }else{
        $GLOBALS['ss']["query_output"]->add("error",'{register_block_error}');
    }
    
}
//======================================================================================LOGIN
define("a_login_help","user,method,password[,newpassword,newpassword2]");
function a_login($param1,$param2,$param3,$param4="",$param5=""){
    //if(defined('countdown') and countdown-time()>0){return;}
    //$GLOBALS['ss']["query_output"]->add("success",$param1);
    //e("$param1,$param2,$param3,$param4,$param5");
    if($param2=='towns'){
        $GLOBALS['ss']["log_object"] = new object(NULL,"type='user' AND (id='$param1' OR name='$param1')");
        $pass=sql_1data('SELECT `key` FROM `[mpx]login` WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\' LIMIT 1');
        if($pass==md5($param3) or !$pass){
            if(!$param4 and !$param5 and !$param6)$GLOBALS['ss']["query_output"]->add("1",1);
            //--------------------CREATEPASSWORD
            if(!$pass and $param4){
            if($param4==$param5){
                sql_query("INSERT INTO `[mpx]login` (`id`,`method`,`key`,`text`,`time_create`,`time_change`,`time_use`) VALUES ('".($GLOBALS['ss']["log_object"]->id)."','towns','".md5($param4)."','','".time()."','".time()."','".time()."')");
                $GLOBALS['ss']["query_output"]->add("success","{f_login_createpass}");
                $GLOBALS['ss']["query_output"]->add("1",1);           
            }else{
                $GLOBALS['ss']["query_output"]->add("error","{f_login_nochangepass}");
            }
                
                $param4=false;$param5=false;
            }            
            //--------------------
            sql_query('UPDATE `[mpx]login` SET  `time_use`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\'');
            //--------------------CHANGEPASSWORD            
            if($param4){
                if($param4==$param5){
                    sql_query('UPDATE `[mpx]login` SET `key`=\''.md5($param4).'\', `time_change`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'towns\'');

                    $GLOBALS['ss']["query_output"]->add("success","{f_login_changepass}");
                    $GLOBALS['ss']["query_output"]->add("1",1);
                }else{
                    $GLOBALS['ss']["query_output"]->add("error","{f_login_nochangepass}");
                }
            }
            //--------------------
            
            
            //die($GLOBALS['ss']["logid"]);
            //echo("abc");
            $use=sql_1data('SELECT `id` FROM [mpx]objects WHERE `own`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `type`=\'town\'');
            //die($use);            
            if($use){
                
                $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
                a_use($use/*$param1*/);
            }else{
                $GLOBALS['ss']["query_output"]->add("error","{f_login_notown}");
            }
            
        }else{
            xerror("{f_login_nologin}");
        }
    }elseif($param2=='facebook'){
        //echo('aaa'.$param3);
        //echo('UPDATE [mpx]login SET time_use = \''.time().'\' WHERE `id`=\''.($param1).'\' AND `method`=\'facebook\' AND `key`=\''.($param3).'\' ');        
        
        //--------------------CREATEPASSWORD
        $pass=sql_1data('SELECT `key` FROM `[mpx]login` WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'facebook\' LIMIT 1');
        if(!$pass and $param4){
        if($param4){
            sql_query("INSERT INTO `[mpx]login` (`id`,`method`,`key`,`text`,`time_create`,`time_change`,`time_use`) VALUES ('".($GLOBALS['ss']["log_object"]->id)."','towns','".md5($param4)."','','".time()."','".time()."','".time()."')");
        }
            $GLOBALS['ss']["query_output"]->add("success","{f_login_createfb}");
            $param4=false;$param5=false;
        }            
        //--------------------        
        
        if(1==sql_query('UPDATE [mpx]login SET time_use = \''.time().'\' WHERE `id`=\''.($param1).'\' AND `method`=\'facebook\' AND `key`=\''.($param3).'\' ')){      
            //if(!$param4)$GLOBALS['ss']["query_output"]->add("1",1);            
            //--------------------CHANGEPASSWORD
            if($param4){
                sql_query('UPDATE `[mpx]login` SET `key`=\''.($param4).'\', `time_change`=\''.time().'\' WHERE `id`=\''.($GLOBALS['ss']["log_object"]->id).'\' AND `method`=\'facebook\'');
                $GLOBALS['ss']["query_output"]->add("success","{f_login_changefb}");
                $GLOBALS['ss']["query_output"]->add("1",1); 
            }      
            //--------------------
        
            $GLOBALS['ss']["log_object"] = new object($param1);
            $GLOBALS['ss']["query_output"]->add("1",1); 
            $GLOBALS['ss']["logid"]=$GLOBALS['ss']["log_object"]->id;
            a_use($param1);
        }else{
            $GLOBALS['ss']["query_output"]->add("error","{f_login_nofblogin}");
        }   
    }
}
//======================================================================================LOGOUT
define("a_logout_help","");
function a_logout(){
    $GLOBALS['ss']=array(); 
    //session_destroy();
    setcookie('towns_login_username','',1);
    setcookie('towns_login_password','',1);
    reloc();
    exit2();
}
//======================================================================================USE
define("a_use_help","user");
function a_use($param1){
    //echo("use($param1)");
    $GLOBALS['ss']["use_object"] = new object($param1);
    //$GLOBALS['ss']["use_object"]->xxx();
    //$GLOBALS['ss']["query_output"]->add("1",1);
    $GLOBALS['ss']["useid"]=$GLOBALS['ss']["use_object"]->id;
    if($GLOBALS['ss']["use_object"]->own!=$GLOBALS['ss']["logid"] and $GLOBALS['ss']["logid"]!=$GLOBALS['ss']["useid"]){
        $GLOBALS['ss']["query_output"]->add("error","Tento objekt vám nepatří!");
        $GLOBALS['ss']["useid"]=$GLOBALS['ss']["logid"];
        unset($GLOBALS['ss']["use_object"]);
        
    }
}/**/
?>
