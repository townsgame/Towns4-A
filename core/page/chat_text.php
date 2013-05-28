<?php
if(logged()){
    //r(useid);
    $stream="";
    // `id`,`from`,`to`,`text`,`time`,`timestop`
    $sql="SELECT  `id`,`from`,`from` ,`to`,`text`,`time` FROM `".mpx."text` WHERE (`to`='' OR `to`='".useid."') AND `type`='chat' ORDER BY time DESC LIMIT 29";
    //r($sql);
    $array=sql_array($sql);
    if(count($array)<5)br(5-count($array));
    foreach($array as $row){
        $from=$row[1];
        $fromname=$row[3];
        $to=$row[3];
        $text=$row[4];
        $time=$row[5];
        
        $stream="[".timer($time)."][".liner($from)."]:".nbsp.tr($text).br.$stream;
    }
    $stream='<span id="chat_new" style="display:none;">['.timer(time())."][".liner(logid)."]:".nbsp.'[text]'.br.'</span>'.$stream;
    echo($stream);
}else{
    refresh();
}
?>
