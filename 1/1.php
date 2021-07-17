<?php

$numbers = file_get_contents(__DIR__ . '/list.txt');
$numbers = explode("\n", $numbers);

foreach ($numbers as $first_number) {
    foreach ($numbers as $second_number) {
        foreach ($numbers as $third_number) {
            $number = $first_number + $second_number + $third_number;
            if ($first_number != $second_number && $second_number != $third_number && $number == 2020) {
                echo "First Number: " . $first_number;
                echo "\n";
                echo "Second Number: " . $second_number;
                echo "\n";                
                echo "Third Number: " . $third_number;
                echo "\n";
                echo "Multiplied Number: " . $first_number * $second_number * $third_number;
                exit;
            }
            unset($number);
        }
    }
}

?>