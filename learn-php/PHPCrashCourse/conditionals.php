<?php
    echo "<h2>Conditional Statements in PHP</h2>";

    // 1. Age Check
    $age = 15;
    echo "<h3>1. Age Check</h3>";
    if ($age >= 18) {
        echo "You are 18 years old or older.";
    } else {
        echo "You are so young.";
    }

    // 2. Greeting Based on Time
    echo "<h3>2. Greeting Based on Time</h3>";
    // $hours = date("H");
    $hours = 18;
    echo "Current hour: $hours<br>";

    if ($hours < 12) {
        echo "Good morning!";
    } elseif ($hours >= 12 && $hours <= 17) {
        echo "Good afternoon!";
    } else {
        echo "Good evening!";
    }

    // 3. Comments Check (Ternary & Null Coalescing)
    $comments = [
        'Good question', 'I like it', 'How are you?'
    ];

    echo "<h3>3. Comments Check</h3>";

    // Using ternary operator
    echo !empty($comments)
        ? "There are comments.<br>"
        : "No comments.<br>";

    // Using null coalescing operator
    $first_comment = $comments[0] ?? 'No comments';
    echo "First comment: $first_comment";

    // 4. Favorite Color with switch
    echo "<h3>4. Favorite Color</h3>";
    $favorite_color = 'red';

    switch ($favorite_color) {
        case 'red':
            echo "You chose <strong>RED</strong>.";
            break;
        case 'green':
            echo "You chose <strong>GREEN</strong>.";
            break;
        case 'blue':
            echo "You chose <strong>BLUE</strong>.";
            break;
        default:
            echo "You did not choose red, green, or blue.";
    }
?>