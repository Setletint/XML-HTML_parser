<?php
$input = trim(fgets(STDIN));
$tagPattern = "/(<[^>]*>)/";
$inputArray = preg_split($tagPattern, $input, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

print_r($inputArray);
