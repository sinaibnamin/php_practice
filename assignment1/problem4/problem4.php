<?php


function make_piramid($input_num){

    if($input_num == 0){
        return "null";
    }
  
    $piramid = '';
    $line = '';
    $space = '';
    $star = "*";
    
    for($i = 1; $i <= $input_num; $i++){
        $num_of_space = $input_num-$i;
        for($j = 1; $j <= $num_of_space; $j++){
            $space = $space." ";
        }
        $line = $space.$star.$space;
        $piramid = $piramid.$line."\n";
        $space = '';
        $star = $star."**";
    }

    return $piramid;
}

echo make_piramid(6);