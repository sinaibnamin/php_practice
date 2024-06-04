<?php


$line = '';
$space = '';
$star = "*";
$input_num = 6;

for($i = 1; $i <= $input_num; $i++){
    $num_of_space = $input_num-$i;
    for($j = 1; $j <= $num_of_space; $j++){
        $space = $space." ";
    }
    $line = $space.$star.$space;
    echo $line;
    $space = '';
    $line = '';
    $star = $star."**";
    echo "\n";
}