<?php

   function findmin($string)
      {
         if (!preg_match('/^(?=.*[0-9])[0-9 -]+$/', $string)) {
            return "The string contains wrong value";
         } 
      
         $nums = (explode(" ",$string));

         if (count($nums) === 0) {
            return 'null';
         }

         $min = abs($nums[0]);
         for ($i = 1; $i < count($nums); $i++) {
            if (abs($nums[$i - 1]) > abs($nums[$i])) {
                  $min = abs($nums[$i]);
            }
         }
         return $min;
      };


echo findmin('5 6 1 -3');
echo "<br>";
echo findmin('55 6 2 3');
echo "<br>";
echo findmin('5 6 -11 3');
echo "<br>";
echo findmin('0');
echo "<br>";
echo findmin(' ');
echo "<br>";
echo findmin('');
echo "<br>";
echo findmin('hello 56 78');
echo "<br>";

