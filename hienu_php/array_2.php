<?php

$arr2 = [

    'address1' => [
        'name' => [
            'Ho' => 'Pham',
            'Ten' => 'Hung'
        ],
        'email' => 'hungngoc2103@gmail.com'
    ],
    'address2' =>  [
        'name' => 'Hoang',
        'email' => 'hoang@gmail.com'
    ],
    'address3' => 'PHP'
];

if (!empty($arr2)) {
    foreach ($arr2 as $item) {
        if (is_array($item)) {
            if (!empty($item)) {
                foreach ($item as $subArr) {
                    if (is_array($subArr)) {
                        if (!empty($subArr)) {
                            foreach ($subArr as $subArr2) {
                                echo $subArr2 . '<br>';
                            }
                        }
                    } else {
                        echo $subArr . '<br>';
                    }
                }
            }
        } else {
            echo $item . '<br>';
        }
    }
}



// echo $arr2['address1']['name']['Ho'].'<br>';
// echo $arr2['address2']['email'].'<br>';

// $arr2['address1']['name']['Ten'] = 'Ngoc';
// echo $arr2['address1']['name']['Ten'].'<br>';

$arr = array(
    [
        'soMot',
        'soHai',
        'soBa'
    ],
    'JS',
    'PHP'
);


    // dùng for

    // if(!empty($arr)){
    //     for($i = 0; $i < count($arr) ; $i++){
    //         if(is_array($arr[$i])){
    //             if(!empty($arr[$i])){
    //                 for($j =0; $j < count($arr[$i]); $j++){
    //                     echo $arr[$i][$j].'<br>';
    //                 }
    //             }
    //         }
    //         else {
    //             echo $arr[$i].'<br>';
    //         }
    //     }
    // }

    // echo '<pre>';
    // print_r($arr);
    // echo '</pre>';