<?php

const CHARS = [
    '!' => 1,
    '?' => 2
];

function balance($left = '', $right = '') :string
{
    $leftCount = 0;
    $rightCount = 0;
    $res = '';

    foreach (CHARS as $char => $weight){
        $leftCount += substr_count($left, $char) * $weight;
        $rightCount += substr_count($right, $char) * $weight;
    }

    echo 'Left: ' . $leftCount . "\n";
    echo 'Right: ' . $rightCount . "\n";

    switch ($leftCount <=> $rightCount){
        case 0:
            $res = 'Balance';
            break;
        case 1:
            $res = 'Left';
            break;
        case -1:
            $res = 'Right';
            break;
    }

    return $res;
}


echo balance('!?','!??');