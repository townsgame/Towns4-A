<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/output.php

   Tento soubor slouží k finální úpravě souboru před odesláním do prohlížeče, nahrzení {lang} proměnných.
*/
//==============================





function contentantisvin($buffer){
    $kde=strpos($buffer,"<body>")+6;
    $kde2=strpos($buffer,"</body>");
    $zac=(substr($buffer,0,$kde));
    $kon=(substr($buffer,$kde2));
    $buffer=(substr($buffer,$kde,$kde2-$kde));
    //-------------
    $bufferx="";
    foreach(str_split($buffer) as $char){
        if(strtr($char,"ěščřžýáíéúůĚŠČŘŽÝÁÍÉÚŮqwertyuiopasdfghjkl","0000000000000000000000000000000000000000000000000000000000")==$char){
            $char=dechex(ord($char));
            if(strlen($char)==1){ $char=("0".$char); }
            $char="%".$char;
        }
        $bufferx=$bufferx.$char;
    }
    $buffer='<script language="javascript">
    document.write(unescape("'.$bufferx.'"));
    </script>'; 
    //-------------
    $nln="
    ";
    $buffer=$zac.$buffer.$kon;
    $buffer=str_replace($nln,"",$buffer);
    return($buffer);
}
//===============================================================================================================
//------------
function contentlang($buffer){//if(rr())r();
    if(1){
        $file=("data/lang/".$GLOBALS['ss']["lang"].".txt");
        $stream=file_get_contents($file);
        //$buffer=$stream.$file.$buffer;
        //$buffer=$stream.$file.$buffer;
        $GLOBALS['ss']["langdata"]=(astream($stream));
        $buffer=str_replace(array("{0}","{}"),"",$buffer);
        $buffer=str_replace("x{","languageprotectiona",$buffer);
        $buffer=str_replace("}x","languageprotectionb",$buffer);
        $addtoend='';
        //-------------
        for($i=0;$tmp=substr2($buffer,"{","}",$i);$i++){
            if(rr())r($tmp);
            list($key,$params)=explode(";",$tmp,2);
            //$buffer=$key.'<br>'.$buffer;
            if($GLOBALS['ss']["langdata"][$key]){
                $text=valsintext($GLOBALS['ss']["langdata"][$key],$params);
                $size=strlen($text);
                $text=$text;//tr($text);
                //$text="{".$text.$i."}";
                //$text="{".$i."}";TV
                if(rr())r($text);
                if(rr())r($buffer);
                if(rr())r();
            }else{
                $size=5;
                $text="languageprotectiona".$key.$params."languageprotectionb";
                
                $add='//'.$key.'=;';
                if(!strpos($stream,$add) and !strpos($addtoend,$add))$addtoend.=nln.$add;
                
            }
            if(lem){
                //$text='#'.$text;
                $text='<a href="lem.php" target="_blank">#</a>'.$text;
                //$text='<input type="input" name="move_y" value="'.$text.'" size="'.$size.'"  style="border:  1px solid #333333; background-color: #000000; color: #ffffff;" onBlur="" />';
                //<form id="form" name="form" method="POST" action="http://localhost/4/?w=228720"><input type="input" name="move_y" value="" /></form>
            }
            $buffer=substr2($buffer,"{","}",$i,$text);
        }
        $buffer=str_replace(array("{",";}","}"),"",$buffer);
        $buffer=str_replace("languageprotectiona","{",$buffer);
        $buffer=str_replace("languageprotectionb","}",$buffer);


        if($addtoend)file_put_contents2($file,file_get_contents($file).$addtoend);
    }else{
        //$buffer="contentlang".$buffer;
        $buffer=str_replace("x{","{",$buffer);
        $buffer=str_replace("}x","}",$buffer);
    }
    return($buffer);
}
/*function contentlang($buffer){
    return(contentlang_(contentlang_($buffer)));
}*/
//===============================================================================================================
function contentzprac($buffer){
    ///if(nob!==true){
        chdir(dirname($_SERVER['SCRIPT_FILENAME']));
        //$buffer="contentzprac".$buffer;
        //if(strpos("<body>")){
            if(!$_GET["e"]){
                list($start,$buffer,$end)=part3($buffer,"<body>","</body>");
                $buffer=contentlang($buffer);
                $buffer=$start."<body>".$buffer."</body>".$end;
            }else{
                $buffer=contentlang($buffer);
            }
            
        //}
    //}
    return($buffer);
}
//-------------
ob_start("contentzprac");
?>
