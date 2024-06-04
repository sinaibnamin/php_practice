<?php

function wordcount(){
    $text = '';
    $filename = "paragraph.txt";
    $fp = fopen($filename, "r");
    
    if(filesize($filename) > 0){
        $text = fread($fp, filesize($filename));
        fclose($fp);
    }else{
        return 0;
    }
    
    preg_match_all("/\b\w+\b/", $text, $matches);
    return count($matches[0]);
}


echo wordcount();
echo "\n";