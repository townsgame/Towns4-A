<?php
window("{title_messages}"/*,400,400*/);
sg("textclass");

if(!$textclass)$q=submenu(array("content","text-messages"),array("messages_public","messages_unread","messages_all","messages_report","messages_new"),1);
$q=$GLOBALS['ss']['submenu'];
r('textclass: '.$textclass);


if($q==1 || $q==2 || $q==3 || $q==4){//r($q);
//===========================================================

//$textclass=$GLOBALS['get']['textclass'];
//sg("textclass");
//r($textclass);

if(!$textclass){
    if($q==1){$tmp='public';}elseif($q==2){$tmp='new';}elseif($q==4){$tmp='report';}else{$tmp=$textclass;}
}else{
    $tmp=$textclass;
}


$response=xquery("text","list",$tmp);//`id` ,`idle` ,`type` ,`from` ,`to` ,`title` ,`text` ,`time` ,`timestop`
//r($tmp);
$texts=$response["list"];
if($textclass){
    $col="222222";
    //r('hovno');
    infob(ahrefr("{message_back}","e=content;ee=text-messages;textclass=0").(nbspo.nbspo).bhpr("{message_reply}"));
    
contenu_a();    
    
    //-----------------------
    hydepark();
    $url=("q=text send,$textclass,".($texts[0][5]?$texts[0][4]:0).",[message_title],[message_text]");//($texts[0][4]?$texts[0][3]:0)
    //$url=urlr("textclass=aa;q=text");
    form_a(urlr($url),'messages_tc');
    //textb("Nadpis:");
    //input_text("title",1,100,30);
    //br();
    $style='border: 2px solid #222222; background-color: #CCCCCC';
    tableab("{message_subject}:",input_textr("message_title",'',100,26,$style),"100%","30%");
    br();
    input_textarea("message_text",'',45,6,$style);
    br();
    form_sb();
    ihydepark();
    form_js('content','?e=text-messages&'.$url,array('message_title','message_text'));
    
    //-----------------------
    echo("<table width=\"".(contentwidth)."\" bgcolor=\"$col\" cellspacing=\"0\">");

    /*echo("<tr  bgcolor=\"#444444\">");
    echo("<td height=\"\" valign=\"top\" colspan=\"6\">");
    echo("</td></tr>");*/

    foreach($texts as $tmp){
            list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop,$count)=$tmp;
            /*if(!$f and $textclass){$f=1;
                echo("<h2>$title</h2>");
                ahref("zpět","textclass=0");
            }else*/{
                //r($id,$class,$title,$time,$author,$text);
                echo("<tr  bgcolor=\"#$col\">");
                echo("<td width=\"120\">");
                $authorid=$from;
                //mprofile($author);br();br();
                $fromto=ifobject($to)?(short(id2name($from),8).nbsp.'&gt;&gt;'.nbsp.short(id2name($to),8)):short(id2name($from),8);
                
                
                //imge("id_".$author."_icon","",50,50);
                echo("<b>".tr($title)."</b>");
                echo("</td><td width=\"60\">");
                ahref($fromto,"e=content;ee=profile;page=profile;id=".$id,"",true);
                echo("</td><td width=\"\" align=\"right\">");
                timee($time);
                echo("</td><td width=\"22\">");
                //r($author);
                if((logid==$authorid or useid==$authorid) and $textclass){iconp("{delete_message_prompt}","e=content;ee=text-messages;q=text delete ".$id,"delete","Smazat");}
                echo("</td><td width=\"22\">");
                echo("</td></tr><tr  bgcolor=\"#000000\"><td align=\"left\" colspan=\"6\">");
                te($text);
                echo("<br><br></td></tr>");
            }
    }
    echo("</table>");
}else{
contenu_a();    
    
    e("<table width=\"".(contentwidth-6)."\" cellspacing=\"0\">");
    /*e("<tr><td width=\"36%\">");
    e("Předmět");
    e("</td><td width=\"5%\">");
    e("Počet");
    e("</td><td width=\"20%\">");
    e("Od");
    e("</td><td width=\"30%\">");
    e("Datum");
    e("</td></tr>");*/
    $i=1;foreach($texts as $tmp){$i++;
            list($id,$idle,$type,$new,$from,$to,$title,$text,$time,$timestop,$count)=$tmp;
                //r($id,$class,$title,$time,$author,$text);
                $fromto=ifobject($to)?(short(id2name($from),8).nbsp.'&gt;&gt;'.nbsp.short(id2name($to),8)):short(id2name($from),8);
                
                e("<tr bgcolor=\"#".($i%2==1?'222222':'333333')."\"><td width=\"41%\">");
                $title=short(tr($title),30);
                if($new and $q!=1 and $to==useid)$title=tcolorr(textbr($title),'ff7777');
                ahref($title,"e=content;ee=text-messages;textclass=".$idle,'',true);
                //e("</td><td width=\"5%\">");
                if($count!=1)e('('.$count.')');
                e("</td><td width=\"20%\">");
                ahref($fromto,"e=content;ee=profile;page=profile;id=".$from,'',true);
                e("</td><td width=\"30%\" align=\"right\">");
                timee($time);
                e("</td></tr>");
    }
    echo("</table>");  
}
}elseif($q==5){
//===========================================================
    
    contenu_a();

    $url=("q=text send,".($textclass?$textclass:'0').",[message_to],[message_title],[message_text]");
    //$url=urlr("textclass=aa;q=text");
    form_a(urlr($url),'messages');
    //textb("Nadpis:");
    //input_text("title",1,100,30);
    //br();
    $style='border: 2px solid #333333; background-color: #CCCCCC';
    tableab("{message_to}:",input_textr("message_to",'',100,26,$style),"100%","30%");
    br();
    tableab("{message_subject}:",input_textr("message_title",'',100,26,$style),"100%","30%");
    br();
    input_textarea("message_text",'',52,6,$style);
    br();
    form_sb();
    form_js('content','?e=text-messages&'.$url,array('message_to','message_title','message_text'));

    ?>
    <div style="background:#333333;" >{message_to_info}</div>
    <?php


//===========================================================
}
contenu_b();
?>
