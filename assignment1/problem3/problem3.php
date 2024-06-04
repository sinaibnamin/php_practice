<?php


function reverse_word($sentence){

    if(empty($sentence)){
        return 'null';
    }
 
    preg_match_all('/\w+|[^\w\s]+|\s+/', $sentence, $matches);
    $words = $matches[0];

    $reverse_words_array = array();

    foreach($words as $word){
        $r_w = strrev($word);
        array_push($reverse_words_array, $r_w);
    }

    $final_string = implode("", $reverse_words_array);
    return $final_string;

   
}

echo reverse_word('I love programming');
echo "\n";
echo reverse_word('I love, programming.');
echo "\n";
echo reverse_word('I');
echo "\n";
echo reverse_word('');
echo "\n";






























