<?php


function reverse_word($sentence){

    if(empty($sentence)){
        return 'null';
    }

    $sentence_to_array = explode(' ',$sentence);

    $result = "";
    
    for($i = 0; $i < count($sentence_to_array); $i++){
        $word = strrev ( $sentence_to_array[$i] );
        if($i == count($sentence_to_array) - 1){
            $result = $result.$word;
        }else{
            $result = $result.$word." ";
        }
        
    }
    
    return $result;
}

echo reverse_word('I love programming');
echo "\n";
echo reverse_word('I');
echo "\n";
echo reverse_word('');
echo "\n";