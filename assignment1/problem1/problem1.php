<?php



   function findmin($string)
      {
         $string = trim($string);
         if(!$string){
            return 'null';
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


echo findmin('5 6 1 3');
echo "\n";
echo findmin('55 6 2 3');
echo "\n";
echo findmin('5 6 -11 3');
echo "\n";
