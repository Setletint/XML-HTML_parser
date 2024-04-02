<?php
$input = trim(fgets(STDIN));
$tagPattern = "/(<[^>]*>)/";
$inputArray = preg_split($tagPattern, $input, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

$result = "";
$amountOfTags = 0;
$spaceLevel = 0;

$isNotClosing = true;
$isPrevText = false;
$isPrevOpeningTag = false;

foreach ($inputArray as $v) {
    $v = ltrim($v);
    if (preg_match("#<[^>/]*>#", $v)) {
        $result .= str_repeat("  ", $spaceLevel) . $v . "\n";
        $spaceLevel++;
        $openingTags = $v;
        $isNotClosing = true;
        $isPrevOpeningTag = true;
    } else if (preg_match("/(<[^>]*>)/", $v) && $isNotClosing) {
        $spaceLevel--;
        $result .= str_repeat("  ", $spaceLevel) . $v . "\n";
        $isPrevOpeningTag = false;
    } else if (!$isNotClosing) {
        $spaceLevel--;
        $result .= $v . "\n";
        $isNotClosing = true;
        $isPrevOpeningTag = false;
    } else {
        if ($isPrevOpeningTag) {
            $result = rtrim($result, "\n");
            $result .= $v;
            $isNotClosing = false;
        } else {
            $result .= str_repeat("  ", $spaceLevel) . $v . "\n";
        }
    }
}
echo ($result);