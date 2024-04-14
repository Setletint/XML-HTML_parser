<?php

$inputString = trim(fgets(STDIN));

print(format_XML_HTML($inputString));

function custom_split($input)
{
    $result = [];
    $tag = '';
    $currentText = '';
    $insideTag = false;

    for ($i = 0; $i < strlen($input); $i++) {
        if ($input[$i] === '<') {
            $insideTag = true;
            if ($currentText !== '') {
                $result[] = $currentText;
                $currentText = '';
            }
            $tag = '<';
        } elseif ($input[$i] === '>') {
            $insideTag = false;
            $tag .= '>';
            $result[] = $tag;
            $tag = '';
        } else {
            if ($insideTag) {
                $tag .= $input[$i];
            } else {
                $currentText .= $input[$i];
            }
        }
    }

    if ($currentText !== '') {
        $result[] = $currentText;
    }

    return $result;
}


function format_XML_HTML($input)
{
    $inputArray = custom_split($input);
    $result = "";
    $spaceLevel = 0;
    $isNotClosing = true;
    $shouldMakeSpace = false;
    $isPrevOpeningTag = false;

    foreach ($inputArray as $v) {
        $v = ltrim($v);

        // Check if $v starts with '<' and ends with '>'
        if ($v[0] === '<' && $v[strlen($v) - 1] === '>') {
            // Opening tag
            if ($v[1] !== '/') {
                $result .= str_repeat("  ", $spaceLevel) . $v . "\n";
                $spaceLevel++;
                $isNotClosing = true;
                $isPrevOpeningTag = true;
            }
            // Closing tag
            else {
                $spaceLevel--;
                if ($shouldMakeSpace) {
                    $result .= $v . "\n";
                    $shouldMakeSpace = false;
                } else {
                    $result .= str_repeat("  ", $spaceLevel) . $v . "\n";
                }
                $isPrevOpeningTag = false;
            }
        } else {
            // Text between tags
            if ($isPrevOpeningTag) {

                $result = rtrim($result, "\n");
                $result .= $v;
                $isNotClosing = false;
                $shouldMakeSpace = true;
            } else {
                $result .= $v . "\n";
            }
        }
    }
    return $result;
}
