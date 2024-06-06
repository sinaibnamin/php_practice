<?php


function sum_of_digits($num){
  
    $sum = 0;
    
    while($num > 0){
        $rem = $num % 10;
        $sum = $sum + $rem;
        $num = ($num - $rem) / 10;
    }
    
    return $sum;
}

echo sum_of_digits(623004300);
echo "\n";