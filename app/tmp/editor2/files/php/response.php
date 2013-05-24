<?php
function response(array $response)
{
    $response = json_encode($response);

    // save
    $dir = "files/saved/";
    $filename = "editor_" . time() . ".json";
    $file = fopen($dir . $filename, "w+");
    fwrite($file, (string)$response);
    fclose($file);
    
    // response
    header('Content-Type: application/download');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Length: " . sizeof($response));
    echo $response;
    
    // no page
    exit;        
}
?>