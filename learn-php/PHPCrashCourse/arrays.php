<?php
    echo "<h2>PHP Arrays Demo</h2>";

    // 1. Numeric Array
    $some_numbers = [1, 3, 4, 6];
    echo "<h3>Numeric Array</h3>";
    echo "<pre>";
    print_r($some_numbers);
    echo "</pre>";

    // 2. Indexed Array
    $fruits = array('Pineapple', 'Melon', 'Apple');
    echo "<h3>Fruits Array</h3>";
    echo "<pre>";
    print_r($fruits);
    echo "Favorite fruit: " . $fruits[2] . "\n";
    echo "</pre>";

    // 3. Associative Array with Integer Keys
    $colors = [
        3 => 'Red',
        5 => 'Green',
        7 => 'Blue'
    ];
    echo "<h3>Colors (Associative with Int Keys)</h3>";
    echo "<pre>";
    print_r($colors);
    echo "Color with key 7: " . $colors[7] . "\n";
    echo "</pre>";

    // 4. Associative Array with String Keys
    $hex_colors = [
        'red' => '#FF0000',
        'green' => '#00FF00',
        'blue' => '#0000FF'
    ];
    echo "<h3>Hex Colors</h3>";
    echo "<pre>";
    print_r($hex_colors);
    echo "Green Hex Code: " . $hex_colors['green'] . "\n";
    echo "</pre>";

    // 5. Associative Array representing a Person
    $person = [
        'full_name' => 'Nguyen Duc Hoang',
        'age' => 43,
        'email' => 'sunlight4d@gmail.com'
    ];
    echo "<h3>Person Info</h3>";
    echo "<pre>";
    print_r($person);
    echo "Email: " . $person['email'] . "\n";
    echo "</pre>";

    // 6. Multidimensional Array (Array of Persons)
    $persons = [
        [
            'full_name' => 'Nguyen Duc Hoang',
            'age' => 43,
            'email' => 'sunlight4d@gmail.com'
        ],
        [
            'full_name' => 'John Dang',
            'age' => 18,
            'email' => 'john@gmail.com'
        ],
        [
            'full_name' => 'Kelly',
            'age' => 40,
            'email' => 'kelly123@gmail.com'
        ]
    ];
    echo "<h3>List of Persons</h3>";
    echo "<pre>";
    print_r($persons);
    echo "Email of 3rd person: " . $persons[2]['email'] . "\n";
    echo "</pre>";
?>