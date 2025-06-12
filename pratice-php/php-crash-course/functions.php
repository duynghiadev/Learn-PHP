<?php
    echo "<h2>PHP Functions & Array Utilities</h2>";

    // 1. Hàm đơn giản có tham số
    $y = 22;
    function sayHello($name) {
        global $y;
        echo "<h3>1. Function sayHello</h3>";
        echo "y = $y<br>";
        echo "Hello $name<br>";
    }
    sayHello("Hoang");

    // 2. Hàm tính tổng với tham số mặc định
    function sum($a = 0, $b = 0) {
        return $a + $b;
    }
    echo "<h3>2. Function sum</h3>";
    echo "Sum of 2 and 3: " . sum(2, 3) . "<br>";

    // 3. Gán biến là function (anonymous function)
    $multiply = function ($a, $b) {
        return $a * $b;
    };
    echo "<h3>3. Anonymous Function</h3>";
    echo "Multiply 3 x 4 = " . $multiply(3, 4) . "<br>";

    // 4. Arrow function
    $substract = fn($a, $b) => $a - $b;
    echo "<h3>4. Arrow Function</h3>";
    echo "Subtract 6 - 2 = " . $substract(6, 2) . "<br>";

    // 5. Các hàm xử lý array
    $names = ['john', 'anna', 'hoang', 'tony'];
    echo "<h3>5. Array Functions</h3>";

    // Thêm phần tử vào mảng
    array_push($names, 'elon', 'tom');
    array_unshift($names, 'satoshi');

    // Xóa phần tử
    array_pop($names);
    array_shift($names);
    // unset($names[3]); // xóa phần tử theo index

    echo "<strong>Current Names:</strong><pre>";
    print_r($names);
    echo "</pre>";

    // Chunk array
    $chunked_array = array_chunk($names, 3);
    echo "<strong>Chunked Array:</strong><pre>";
    print_r($chunked_array);
    echo "</pre>";

    // Gộp mảng
    $array_one = [1, 3, 5];
    $array_two = [2, 4, 6];
    $merged_array = array_merge($array_one, $array_two);

    // Clone bằng spread operator
    $array_three = [...$merged_array];
    $merged_array[0] = 111;

    echo "<strong>Merged Array:</strong><pre>";
    print_r($merged_array);
    echo "</pre>";

    echo "<strong>Cloned Array (Before Modification):</strong><pre>";
    print_r($array_three);
    echo "</pre>";

    // Gộp và clone cùng lúc
    $array_four = [...$array_one, ...$array_two];
    echo "<strong>Merged with Spread:</strong><pre>";
    print_r($array_four);
    echo "</pre>";

    // Kết hợp 2 mảng thành associative array
    $a = ['name', 'email', 'age'];
    $b = ['Hoang', 'sunlight4d@gmail.com', 18];
    $c = array_combine($a, $b);
    echo "<strong>Combined Array:</strong><pre>";
    print_r($c);
    echo "</pre>";

    echo "<strong>Flipped Array:</strong><pre>";
    print_r(array_flip($c));
    echo "</pre>";

    // Lấy keys và values
    echo "<strong>Array Keys:</strong><pre>";
    print_r(array_keys($c));
    echo "</pre>";

    echo "<strong>Array Values:</strong><pre>";
    print_r(array_values($c));
    echo "</pre>";

    // Range
    $numbers = range(0, 10);
    echo "<h3>6. Array Range & Higher-Order Functions</h3>";
    echo "<strong>Numbers (0-10):</strong><pre>";
    print_r($numbers);
    echo "</pre>";

    // Map - bình phương
    $squared_numbers = array_map(fn($n) => $n * $n, $numbers);
    echo "<strong>Squared Numbers:</strong><pre>";
    print_r($squared_numbers);
    echo "</pre>";

    // Filter - lấy số chẵn
    $filtered_numbers = array_filter($numbers, fn($n) => $n % 2 == 0);
    echo "<strong>Even Numbers:</strong><pre>";
    print_r($filtered_numbers);
    echo "</pre>";
?>