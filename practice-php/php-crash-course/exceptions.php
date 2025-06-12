<?php

declare(strict_types=1);

/**
 * Division operation with robust exception handling
 *
 * @param float $dividend The number to be divided
 * @param float $divisor The number to divide by
 * @return float
 * @throws InvalidArgumentException If divisor is zero
 * @throws ArithmeticError For other math-related errors
 */
function divide(float $dividend, float $divisor): float
{
    if ($divisor == 0) {
        throw new InvalidArgumentException("Division by zero is not allowed");
    }

    if (!is_finite($dividend)) {
        throw new ArithmeticError("Dividend must be a finite number");
    }

    $result = $dividend / $divisor;

    if (!is_finite($result)) {
        throw new ArithmeticError("Division resulted in non-finite value");
    }

    return $result;
}

/**
 * Application entry point for division demonstration
 */
function runDivisionExample(): void
{
    $testCases = [
        ['dividend' => 10, 'divisor' => 2, 'expected' => 'Success'],
        ['dividend' => 5, 'divisor' => 0, 'expected' => 'Division by zero'],
        ['dividend' => PHP_FLOAT_MAX, 'divisor' => 0.1, 'expected' => 'Possible overflow'],
        ['dividend' => NAN, 'divisor' => 2, 'expected' => 'Invalid input']
    ];

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Exception Handling</title>
        <style>
            body {
                font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 900px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f5f7fa;
            }

            h1 {
                color: #2c3e50;
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #3498db;
                padding-bottom: 10px;
            }

            .test-case {
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 20px;
                overflow: hidden;
            }

            .test-header {
                background: #3498db;
                color: white;
                padding: 12px 15px;
                font-weight: bold;
                display: flex;
                justify-content: space-between;
            }

            .test-content {
                padding: 15px;
            }

            .success {
                color: #27ae60;
                background-color: #e8f5e9;
                padding: 8px 12px;
                border-radius: 4px;
                font-weight: bold;
            }

            .error {
                color: #e74c3c;
                background-color: #fdedec;
                padding: 8px 12px;
                border-radius: 4px;
                font-weight: bold;
            }

            .warning {
                color: #f39c12;
                background-color: #fef5e7;
                padding: 8px 12px;
                border-radius: 4px;
                font-weight: bold;
            }

            .divider {
                border-top: 1px dashed #ddd;
                margin: 15px 0;
            }

            .footer {
                text-align: center;
                margin-top: 30px;
                color: #7f8c8d;
                font-size: 0.9em;
            }

            pre {
                background: #f8f9fa;
                padding: 10px;
                border-radius: 4px;
                overflow-x: auto;
            }
        </style>
    </head>
    <body>
        <h1>PHP Exception Handling Demo</h1>';

    foreach ($testCases as $index => $case) {
        $caseNumber = $index + 1;
        echo "<div class='test-case'>
                <div class='test-header'>
                    <span>Test Case #{$caseNumber}</span>
                    <span>Expected: {$case['expected']}</span>
                </div>
                <div class='test-content'>";

        try {
            $result = divide($case['dividend'], $case['divisor']);
            echo "<p class='success'>✓ Success</p>
                  <p>Operation: {$case['dividend']} / {$case['divisor']}</p>
                  <p>Result: <strong>{$result}</strong></p>";
        } catch (InvalidArgumentException $e) {
            echo "<p class='error'>✗ Invalid Argument</p>
                  <p>{$e->getMessage()}</p>
                  <pre>Exception type: " . get_class($e) . "\n" .
                "File: {$e->getFile()}\nLine: {$e->getLine()}</pre>";
        } catch (ArithmeticError $e) {
            echo "<p class='warning'>⚠ Arithmetic Error</p>
                  <p>{$e->getMessage()}</p>
                  <pre>Exception type: " . get_class($e) . "\n" .
                "File: {$e->getFile()}\nLine: {$e->getLine()}</pre>";
        } catch (Throwable $e) {
            echo "<p class='error'>✗ Unexpected Error</p>
                  <p>{$e->getMessage()}</p>
                  <pre>" . $e->getTraceAsString() . "</pre>";
        }

        echo "<div class='divider'></div>
              <p><em>Test completed</em></p>
              </div></div>";
    }

    echo '<div class="footer">
            Program execution completed at ' . date('Y-m-d H:i:s') . '
          </div>
        </body>
        </html>';
}

// Run the example
runDivisionExample();
