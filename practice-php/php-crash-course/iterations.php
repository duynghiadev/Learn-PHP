<?php
    echo "<h2>PHP Loops and Iterations</h2>";

    // 1. For Loop
    echo "<h3>1. For Loop (0 → 10)</h3>";
    for ($i = 0; $i <= 10; $i++) {
        echo "i = $i<br>";
    }

    // 2. While Loop
    echo "<h3>2. While Loop (starting from i = 31, should not run)</h3>";
    $i = 31;
    while ($i < 20) {
        echo "i = $i<br>"; // this won't run
        $i++;
    }

    // 3. Do...While Loop
    echo "<h3>3. Do...While Loop (run once even if condition false)</h3>";
    do {
        echo "i (do-while) = $i<br>";
        $i++;
    } while ($i < 30);

    // 4. For Loop with Array
    $fruits = ['apple', 'pineapple', 'orange', 'lemon'];
    echo "<h3>4. For Loop with Fruit Array</h3>";
    for ($j = 0; $j < count($fruits); $j++) {
        echo $fruits[$j] . "<br>";
    }

    // 5. Foreach Loop with Index
    echo "<h3>5. Foreach Loop with Index (Fruits)</h3>";
    foreach ($fruits as $index => $fruit) {
        echo "$index - $fruit<br>";
    }

    // 6. Foreach Loop with Associative Array
    echo "<h3>6. Foreach Loop with Associative Array (Person Info)</h3>";
    $person = [
        'full_name' => 'Nguyen Duc Hoang',
        'email' => 'sunlight4d@gmail.com',
        'age' => 43
    ];
    foreach ($person as $key => $value) {
        echo "<strong>$key</strong>: $value<br>";
    }
?>