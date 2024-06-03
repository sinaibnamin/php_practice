<?php
function findmin($nums)
{
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


echo(findmin([3,4,5,6,2,2]));
echo "\n";
echo(findmin([10,-12,34,12,-3,123]));
echo "\n";
echo(findmin([-10]));
echo "\n";
echo (findmin([]));

