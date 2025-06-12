<?php
$full_name = 'Nguyen Duc Hoang';

echo "<h2 style='color: #2c3e50;'>PHP String Functions Demo</h2>";

echo "<h3 style='color: #3498db;'>1. Basic Info</h3>";
echo "Full Name: <strong>$full_name</strong><br>";
echo "Length: " . strlen($full_name) . "<br>";
echo "Reversed: " . strrev($full_name) . "<br>";
echo "Lowercase: " . strtolower($full_name) . "<br>";
echo "Uppercase: " . strtoupper($full_name) . "<br>";
echo "Replace spaces with hyphens: " . str_replace(' ', '-', $full_name) . "<br>";

echo "<h3 style='color: #e67e22;'>2. Check Start/End</h3>";
if (str_starts_with(strtolower($full_name), 'nguyen')) {
    echo "✔️ Name starts with <strong>nguyen</strong><br>";
}
if (str_ends_with(strtolower($full_name), 'hoang')) {
    echo "✔️ Name ends with <strong>hoang</strong><br>";
}

echo "<h3 style='color: #27ae60;'>3. HTML String Handling</h3>";
echo "Rendered HTML: <br><h1>html string</h1>";
echo "Escaped HTML (safe for display): <br>";
echo htmlspecialchars("<h1>html string</h1>") . "<br>";

echo "Escaped JavaScript (to prevent XSS): <br>";
echo htmlspecialchars("<script>alert('This is javascript code')</script>") . "<br>";

echo "<h3 style='color: #8e44ad;'>4. String Formatting (printf)</h3>";
printf('%s likes %s<br>', 'Hoang', 'Mercedes G63');
printf('pi = %.2f', 3.14);  // formatted with 2 decimal places