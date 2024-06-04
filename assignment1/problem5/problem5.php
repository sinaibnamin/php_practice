<?php


function reverse_number($num){
  
    $rev_num = 0;
    
    while($num > 0){
        $rem = $num % 10;
        $rev_num = ($rev_num * 10) + $rem;
        $num = ($num - $rem) / 10;
    }
    
    return $rev_num;
}

echo reverse_number(56);