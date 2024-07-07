<?php

function calc(){
    echo "from calc";
}
function createTwoLetter($first_name, $last_name){
    $firstCharacter = $first_name[0];
    $secondCharacter = $last_name[0];
    return $firstCharacter.$secondCharacter;
}