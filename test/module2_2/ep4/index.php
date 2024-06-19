#!/usr/bin/env php

<?php

$longOptions = [
    "min::",
    "max::"
];

$options = getopt("", $longOptions);

$min = $options["min"];
$max = $options["max"];

