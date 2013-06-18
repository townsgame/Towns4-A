<?php
if(logged()){
    //r(useid);
    $stream='';
    // `id`,`from`,`to`,`text`,`time`,`timestop`
    $sql="SELECT  `id`,`type`,`from`,`to`,`title`,`text`,`time` FROM `".mpx."text` WHERE (`to`='' OR `to`='".useid."' OR `from`='".useid."' OR `to`='".logid."' OR `from`='".logid."') AND (`type`='report') ORDER BY time DESC LIMIT 7";
    //r($sql);
    $array=sql_array($sql);
    if(count($array)<5)br(5-count($array));
    foreach($array as $row){
        list($id,$type,$from,$to,$title,$text,$time)=$row;
        //echo($type);
        if($type=='chat'){
            $stream="[".timer($time)."][".liner($from)."]:".nbsp.tr($text).br.$stream;
        }elseif($type=='report'){
            $stream="[".timer($time)."][".liner($from)."]:".nbsp.tr($title).br.$stream;
        }
    }
    //$stream='<span id="chat_new" style="display:none;">['.timer(time())."][".liner(logid)."]:".nbsp.'[text]'.br.'</span>'.$stream;
    echo($stream);
    //echo(rand(1,9999));
}else{
    refresh();
}
?>
