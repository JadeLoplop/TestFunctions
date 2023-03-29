<?php

$testCase = [
    2,
    3,
    9,
    45,
    83,
    99,
    400,
    2014,
    3999
];

    function changeNumber($number) {
        $origin = $number;

        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];

        $returnValue = '';
        
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }

        echo nl2br($origin . " converted to roman numeral = {$returnValue}". "\r\n");
    }

    foreach ($testCase as $case) {
        changeNumber($case);
    }
    