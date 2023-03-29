<?php
    
    class Response{
        public $status;
        public $change;
    }

    $testCase = [
        [
            3.26,
            100,
            [
                ["PENNY", 1.01], 
                ["NICKEL", 2.05], 
                ["DIME", 3.1], 
                ["QUARTER", 4.25], 
                ["ONE", 90], 
                ["FIVE", 55], 
                ["TEN", 20], 
                ["TWENTY", 60], 
                ["ONE HUNDRED", 100]
            ]
        ],
        [
            19.5,
            20,
            [
                ["PENNY", 1.01],
                ["NICKEL", 2.05],
                ["DIME", 3.1],
                ["QUARTER", 4.25],
                ["ONE", 90],
                ["FIVE", 55],
                ["TEN", 20],
                ["TWENTY", 60],
                ["ONE HUNDRED", 100]
            ]
        ],
        [
            19.5,
            20,
            [
                ["PENNY", 0.01],
                ["NICKEL", 0],
                ["DIME", 0],
                ["QUARTER", 0],
                ["ONE", 0],
                ["FIVE", 0],
                ["TEN", 0],
                ["TWENTY", 0],
                ["ONE HUNDRED", 0]
            ]
        ],
        [
            19.5,
            20,
            [
                ["PENNY", 0.01],
                ["NICKEL", 0],
                ["DIME", 0],
                ["QUARTER", 0],
                ["ONE", 1],
                ["FIVE", 0],
                ["TEN", 0],
                ["TWENTY", 0],
                ["ONE HUNDRED", 0]
            ]
        ],
        [
            19.5,
            20,
            [
                ["PENNY", 0.5],
                ["NICKEL", 0],
                ["DIME", 0],
                ["QUARTER", 0],
                ["ONE", 0],
                ["FIVE", 0],
                ["TEN", 0],
                ["TWENTY", 0],
                ["ONE HUNDRED", 0]
            ]
        ]
    ];

    function checkCashRegister($price, $cash, $cid){
        $cashOnHand = 0;
        $change = number_format($cash - $price, 2);

        $dictionary =  [
            "PENNY" => 0.01,
            "NICKEL" => 0.05,
            "DIME" => 0.1,
            "QUARTER" => 0.25,
            "ONE" => 1,
            "FIVE" => 5,
            "TEN" => 10,
            "TWENTY" => 20,
            "ONE HUNDRED" => 100
        ];
        
        foreach ($cid as $value) {
            $cashOnHand += $value[1];
        }

        if ($cashOnHand == $change) {

            $response = new Response();
            $response->status = 'CLOSED';
            $response->change = $cid;
            return $response;

        } else if($cashOnHand < $change){

            $response = new Response();
            $response->status = 'INSUFFICIENT_FUNDS';
            $response->change = [];
            return $response;

        } else {
            $response = new Response();
            $response->status = 'OPEN';

            $resChange = [];

            $cidCount = count($cid) - 1;

            for ($i= $cidCount; $i >= 0 ; $i--) { 
                $currency = $cid[$i][0];
                $coinTotal = $cid[$i][1];
                $coinValue = $dictionary[$currency];
                $coinAmount = number_format( ($coinTotal / $coinValue), 2);
                $cointoReturn = 0;

                while ($change >= $coinValue && $coinAmount > 0) {
                    $change -= $coinValue;
                    $change = round($change * 100) / 100;
                    $coinAmount--;
                    $cointoReturn++;
                }

                if($cointoReturn > 0){
                    $resChange[$currency] = $cointoReturn * $coinValue;

                 }
            }
            // var_dump($change);
            $response->change = $resChange;

            if($change  != 0){
                $response = new Response();
                $response->status = 'INSUFFICIENT_FUNDS';
                $response->change = [];
              }

            return $response;

        }

    }


    for ($i=0; $i < count($testCase); $i++) { 
        $val = checkCashRegister($testCase[$i][0], $testCase[$i][1], $testCase[$i][2]);
        echo '<br>';
        var_dump($val);
        echo '<br>';
    }

  