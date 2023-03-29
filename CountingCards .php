<?php

$plusOne = [
    2,3,4,5,6
];
$zeroBase = [
    7,8,9
];
$minusOne = [
    10,'J','Q','K','A'
];

$testCase = [
    $plusOne,
    $zeroBase,
    $minusOne,
    [
        3, 7, 'Q', 8, 'A'  
    ],
    [
        2, 'J', 9, 2, 7
    ],
    [
        2, 2, 10
    ],
    [
        3, 2, 'A', 10, 'K'
    ]
];

    function betFunction(array $cards){
        global $plusOne;
        global $minusOne;

        $points = 0;

        foreach ($cards as $card) {

            if (in_array($card, $plusOne)) {
                $points ++;
            } elseif (in_array($card, $minusOne)) {
                $points --;
            } else{
                $points += 0;
            }
        }
        echo nl2br($points . ($points > 0 ? ' Bet' : ' Hold') . "\r\n");
    }

    foreach ($testCase as $case) {
        betFunction($case);
    }
    
