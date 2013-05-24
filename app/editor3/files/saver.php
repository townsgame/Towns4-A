<?php
// AJAX version
if (isset($_GET["res"]))
{       
    $res = (string)htmlspecialchars($_GET["res"]);
    $title = (string)htmlspecialchars($_GET["title"]);
    $desc = (string)htmlspecialchars($_GET["desc"]);
    $attack = (int)htmlspecialchars($_GET["attack"]);
    $speed = (int)htmlspecialchars($_GET["attack"]);
    $building = (int)htmlspecialchars($_GET["building"]);
    $strength = (int)htmlspecialchars($_GET["strength"]);
    $distance = (int)htmlspecialchars($_GET["distance"]);
    
    // xml
    $str = "<object type=\"o_building\">\n" .
              "<function class=\"main\">\n" .
              "<profile>\n" .
              "<param type=\"name\" value=\"" . $title . "\" />\n" .
              "<param type=\"description\" value=\"" . $desc . "\" />\n" .
              "</profile>\n" . 
              "<params>\n" .
              "<param type=\"resource\" value=\"" . $res . "\" />\n" .
              "</params>\n" .
              "</function>\n" . 
              "<function name=\"attack1\" class=\"attack\">\n" . 
              "<params>\n" .
              "<param type=\"attack\" value=\"" . $attack . "\" />\n" .
              "</params>\n" .
              "</function>\n" . 
              "<function name=\"speed1\" class=\"speed\">\n" . 
              "<params>\n" .
              "<param type=\"speed\" value=\"" . $speed . "\" />\n" .
              "</params>\n" .
              "</function>\n" . 
              "<function name=\"building1\" class=\"building\">\n" . 
              "<params>\n" .
              "<param type=\"building\" value=\"" . $building . "\" />\n" .
              "</params>\n" .
              "</function>\n" . 
              "<function name=\"strength1\" class=\"strength\">\n" . 
              "<params>\n" .
              "<param type=\"strength\" value=\"" . $strength . "\" />\n" .
              "</params>\n" .
              "</function>\n" . 
              "<function name=\"distance1\" class=\"distance\">\n" . 
              "<params>\n" .
              "<param type=\"distance\" value=\"" . $distance . "\" />\n" .
              "</params>\n" .
              "</function>\n" .
              "</object>";
               
    // create
    $dir = "created/";
    $filename = "editor_" . time() . ".xml";
    $file = fopen($dir . $filename, "w+");
    fwrite($file, (string)$str);
    fclose($file);
    
    echo "";
    exit;
}
?>