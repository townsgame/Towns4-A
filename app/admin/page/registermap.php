<h3>Registace míst na mapě</h3>
<?php
require2("/func_map.php");

$file=tmpfile2("register_list","txt","text");
$array=unserialize(file_get_contents($file));    

//r($array);

e('<img id="minimap" src="'.worldmap(700,50,NULL,NULL,$array).'" width="700"/>');
?>
