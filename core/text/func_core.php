<?php

//======================================================================================
define("a_text_help","action{list,send,delete}[idle][idle,to,title,text][,id]");
function a_text($action,$idle,$to="",$title="",$text=""){
    //$add="(SELECT 1 FROM `".mpx."textqw` WHERE `".mpx."textqw`.`textclass`=`".mpx."text`.`class` AND `".mpx."textqw`.`object`='".($GLOBALS['ss']["use_object"]->id)."')";
    $add1='(`to`='.useid.' OR `from`='.useid.') AND `to`!=0';
    $add2="`type`='message'";
    if($action=="list"){
        if($idle and $idle!='new' and $idle!='public' and $idle!='report'){
            $add1='`to`='.useid.' OR `from`='.useid.' OR `to`=0';
            $add2="`type`='message' OR `type`='report' ";
            $array=sql_array("SELECT `id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop` FROM `".mpx."text` WHERE `idle`='$idle' AND ($add1) AND ($add2) ORDER BY `time` DESC",1);
            if($array[0][3]==1){
                r('notnew');
                $add1='`to`='.useid.'';
                sql_query("UPDATE   `".mpx."text` SET `new`='0' WHERE `idle`='$idle' AND ($add1) AND ($add2)");
            }
            $GLOBALS['ss']["query_output"]->add("list",$array);
        }else{
            if($idle=='new'){$add3='`new`=1';$add2.=" OR `type`='report'";/*$add3='`time`>'.(time()-(3600*24*7));*/}else{$add3='1';}
            if($idle=='public'){$add1='`to`=0';}
            if($idle=='report'){$add2="`type`='report'";}
            $array=sql_array("SELECT `id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,MAX(`time`) ,`timestop`, COUNT(`idle`) FROM `".mpx."text` WHERE ($add1) AND ($add2) AND ($add3) GROUP BY `idle` ORDER BY `time` DESC",1);
            $GLOBALS['ss']["query_output"]->add("list",$array);
        }
    }elseif($action=="send"){
        if(!$idle)$idle=sql_1data("SELECT MAX(idle) FROM `".mpx."text`")-(-1);
        if(trim($title) and trim($text)){
            if($to=='0' OR $to=ifobject($to)){
                if(!sql_1data("SELECT 1 FROM `".mpx."text` WHERE `to`='$to' AND `title`='$title' AND `text`='$text'")){
                    $no=0;
                    if($GLOBALS['ss']['message_limit'][$to]){if($GLOBALS['ss']['message_limit'][$to]+5>time()){$no=1;}}
                    $GLOBALS['ss']['message_limit'][$to]=time();
                    if(!$no){
                        sql_query("INSERT INTO `".mpx."text`(`id` ,`idle` ,`type` ,`new` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop`) VALUES(NULL,'$idle','message',1,'".useid."','".$to."','$title','$text','".(time())."','')");
                    $GLOBALS['ss']["query_output"]->add("success",'{send_success}');
                    $GLOBALS['ss']["query_output"]->add('1',1);
                    //js(target('aa',"e=content;ee=text-messages;submenu=1").'alert(1);');
                    }else{
                        $GLOBALS['ss']["query_output"]->add("error",'{message_limit}');
                    }
                }else{
                    $GLOBALS['ss']["query_output"]->add("error",'{same_message}');
                }
            }else{
                $GLOBALS['ss']["query_output"]->add("error",'{unknown_user}');
            }
        }else{
            $GLOBALS['ss']["query_output"]->add("error",'{no_message}');
        }
   
    }elseif($action=="delete"){  
        sql_query("DELETE FROM `".mpx."text` WHERE `id`= '$idle' AND `from`='".useid."'");
    }
}
//======================================================================================
function send_report($from,$to,$title="",$text=""){
    $idle=sql_1data("SELECT MAX(idle) FROM `".mpx."text`")-(-1);
    sql_query("INSERT INTO `".mpx."text`(`id` ,`idle` ,`type` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop`) VALUES(NULL,'$idle','report','$from','$to','$title','$text','".(time())."','')");
}

?>
