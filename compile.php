<?php
$source='core';
$destfile='bin/towns.php';
$index='index.php';
//$core='compile';
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
//-------
$push_slave='http://test.towns.cz/';
$push_pass='attlvuamhb';
//===========================================================================================================================================
//==================================
function post_request($url, $data, $session='') {
 
    // Convert the data array into URL Parameters like a=b&foo=bar etc.
    $data = http_build_query($data);
 
    // parse the given URL
    $url = parse_url($url);
 
    if ($url['scheme'] != 'http') { 
        die('Error: Only HTTP request are supported !');
    }
 
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
 
    // open a socket connection on port 80 - timeout: 30 sec
    $fp = fsockopen($host, 80, $errno, $errstr, 30);
 
    if ($fp){
 
        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "User-Agent: Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.2.24) Gecko/20111107 Ubuntu/10.10 (maverick) Firefox/3.6.24\r\n");

 
        if ($referer != '')
            fputs($fp, "Referer: $referer\r\n");
 
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Cookie: PHPSESSID=$session \r\n");
        //Cookie: $Version=1; Skin=new;
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
 
        $result = ''; 
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
    }
    else { 
        return array(
            'status' => 'err', 
            'error' => "$errstr ($errno)"
        );
    }
 
    // close the socket connection:
    fclose($fp);
 
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
 
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
 
    // return as structured array:
    return array(
        'status' => 'ok',
        'header' => $header,
        'content' => $content
    );
}
//===========================================================================================================================================


function str_replace_first($search, $replace, $subject) {return implode($replace, explode($search, $subject, 2));}

//$core.='/';
define('nln','
');
define('select',md5('select'));
function getstream($source,$base){
	$stream='';
	foreach(glob($source.'/*') as $file){
	if(is_dir($file)){$stream.=getstream($file,$base);}
	elseif(!strpos($file,'~') and !strpos($file,'.old.')){
		$contents=file_get_contents($file);
		//$contents=dropcomments($contents);
		$contents=str_replace('include','require',$contents);
		$contents=str_replace('require','require2',$contents);
		
		$file=substr(str_replace_first($base,'',$file),1);
			
		$stream.='if($file==\''.$file.'\'){';
		$stream.=nln.'define(\''.md5($file).'\',true);';
		$stream.=nln.'?>'.$contents.'<?php';
		$stream.=nln.'}else';

	}}
	return($stream);
}
$stream='';
$stream.='<?php';
$stream.=nln.'function str_replace_first($search, $replace, $subject) {return implode($replace, explode($search, $subject, 2));}';
$stream.=nln.'function parsef($file){';
//$stream.=nln.'if(strpos($file,\''.$core.'\')!==false){';
//$stream.=nln.'$file=substr($file,strpos($file,\''.$core.'\')+'.strlen($core).');}';
$stream.=nln.'if(defined(\'root\'))$file=str_replace_first(root.core,\'\',$file);';
$stream.=nln.'while(substr($file,0,1)==\'/\')$file=substr($file,1);';
$stream.=nln.'return($file);';
$stream.=nln.'}';
$stream.=nln.'function require2($file){';
$stream.=nln.'$file=parsef($file);';
//$stream.=nln.'foreach($GLOBALS as $key=>$value){eval("global \\$$key;");}';
$stream.=nln.getstream($source,$source).'{}';//'{echo("notfound-".$file);}';
//$stream.=nln.'foreach(get_defined_vars() as $key=>$value){eval("global \\$$key;");}';
$stream.=nln.'}';
$stream.=nln.'function require2_once($file){';
$stream.=nln.'if(!defined(md5(parsef($file)))){';
$stream.=nln.'require2($file);';
$stream.=nln.'}}';
$stream.=nln.'require2(\''.$index.'\');';
$stream.=nln.'?>';
//===================================================OPTIMALIZACE
/*$array=str_split($stream);
$stream='';
$buffer='';$block='';$pchar='';
foreach($array as $char){
	$buffer.=$char;
	if($block==$char or $block==$pchar.$char){
		//echo('<hr/>blocked');
		//echo(nl2br(htmlspecialchars($buffer)));
		if($block!=nln and $block!='*-/'){
			
			$stream.=$buffer;
			//echo(htmlspecialchars($buffer));
		}else{
			//echo('<br/>drop('.$block.'): '.htmlspecialchars($buffer));
		}
		//echo('<br/>unblocking by '.htmlspecialchars($block).'<hr/>');
		$buffer='';$block='';
	}elseif(!$block){
		if($char=='"' or $char=='\'' or $pchar.$char=='//' or $pchar.$char=='/*'){
			if($char=='"'){$block='"';}
			if($char=='\''){$block='\'';}
			if($pchar.$char=='//'){$block=nln; $buffer=substr($buffer,0,strlen($buffer)-2);}
			if($pchar.$char=='/*'){$block='*-/';$buffer=substr($buffer,0,strlen($buffer)-2);}
			//-----SELECT
			//$buffer=str_replace('//','//'.select,$buffer);
			//$buffer=str_replace('/*','/*'.select,$buffer);
			//-----
			//echo(nl2br(htmlspecialchars($buffer)));
			//echo('<br/>blocking by '.htmlspecialchars($block).'<hr/>');
			$stream.=$buffer;
			$buffer='';
		}
	}
$pchar=$char;}
$stream.=$buffer;*/
//===============================
$fileStr=$stream;
$stream='';
$commentTokens = array(T_COMMENT);

if (defined('T_DOC_COMMENT'))
    $commentTokens[] = T_DOC_COMMENT; // PHP 5
if (defined('T_ML_COMMENT'))
    $commentTokens[] = T_ML_COMMENT;  // PHP 4

$tokens = token_get_all($fileStr);

foreach ($tokens as $token) {    
    if (is_array($token)) {
        if (in_array($token[0], $commentTokens))
            continue;

        $token = $token[1];
    }

    $stream .= $token;
}
//===============================
function dropcomments($stream){
//-----delete //
/*$stream=str_replace('http://',select,$stream);
//$stream=str_replace('//',' //',$stream);
while($pos=strpos($stream,'//')){
	$a=substr($stream,0,$pos+1);
	$b=substr($stream,$pos);
	$b=substr($b,strpos($b,nln)+1);
	$stream=$a.$b;
}
$stream=str_replace(select,'http://',$stream);*/
//-----delete 
while($pos=strpos($stream,'/*')){
	$a=substr($stream,0,$pos);
	$b=substr($stream,$pos);
	$b=substr($b,strpos($b,'*/')+2);
	$stream=$a.$b;
}
//-----delete 
/*while($pos=strpos($stream,'<!--')){
	$a=substr($stream,0,$pos);
	$b=substr($stream,$pos);
	$b=substr($b,strpos($b,'-->')+3);
	$stream=$a.$b;
}*/
return($stream);
}
//===============================
$fileStr=$stream;
$stream='';
$commentTokens = array(T_INLINE_HTML);

$tokens = token_get_all($fileStr);

foreach ($tokens as $token) {    
    if (is_array($token)) {
        if (in_array($token[0], $commentTokens)){
			$stream .= dropcomments($token[1]);
            continue;
			}

        $token = $token[1];
    }

    $stream .= $token;
}
//===============================

//-----delete nln
/*$stream=str_replace(nln,' ',$stream);
$stream=str_replace("\r",' ',$stream);
$stream=str_replace("\n",' ',$stream);*/
//-----delete space
while(strpos($stream,'  '))$stream=str_replace('  ',' ',$stream);
//-----delete php
$stream=str_replace('<?php ?>','',$stream);
$stream=str_replace('?><?php','',$stream);
$stream=str_replace('?><?','',$stream);
//===============================
file_put_contents($destfile,$stream);
chmod($destfile,0777);
//===============================HELPLINES
if($_GET['return'] or ($_GET['push'] and $push_slave)){
if($_GET['return']){
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
//===============================PUSH
if($_GET['push'] and $push_slave){
    //$slave=slave;
	//$pass=substr2($slave,'http://','@');
	//list($tmp,$pass)=split(':',$pass);
	$push_slave=$push_slave.'/app/admin/res.php';
	echo($push_slave);    

    $data=array(//'page'=>'res',
				'password_new'=>$push_pass,
                'contents'=>$stream);
    $stream=post_request($push_slave,$data);
	echo(print_r($stream));
}
exit;
}
//===============================
//-----
$stream=nl2br(htmlspecialchars($stream));
$stream=split('<br />',$stream);
$i=0;
while($stream[$i]){
	$stream[$i]='<b>'.($i+1).':</b> '.$stream[$i];
$i++;}
$stream=join('<br />',$stream);
//===================================================
echo($stream);

?>
