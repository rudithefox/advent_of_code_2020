<?php

$lines = file_get_contents(__DIR__ . '/list.txt');
$lines = explode("\n", $lines);

$valid_count = 0;

foreach ($lines as $line) {
    $sections = explode(" ", $line);
    $req_range = $sections[0];
    $req_range = explode("-", $req_range);
    $req_char = $sections[1];
    $req_char = str_replace(':', '', $req_char) ;
    $password = $sections[2];

    $count = substr_count($password, $req_char);

    if ($count >= $req_range[0] && $count <= $req_range[1]) {
        $valid_count++;
    } else {
    }
}

echo "Part 1: " . $valid_count . "\n";

$valid_count = 0;

foreach ($lines as $line) {
    $sections = explode(" ", $line);
    $req_range = $sections[0];
    $req_range = explode("-", $req_range);
    $req_char = $sections[1];
    $req_char = str_replace(':', '', $req_char) ;
    $password = $sections[2];
    $password = str_split($password);

    $first_pos = $req_range[0] -1;
    $second_pos = $req_range[1] -1;

    $first_pos = (isset($password[$first_pos]) && substr_count($password[$first_pos], $req_char) > 0) ? TRUE : FALSE;
    $second_pos = (isset($password[$second_pos]) && substr_count($password[$second_pos], $req_char) > 0) ? TRUE : FALSE;

    if ($first_pos || $second_pos) {
        if ($first_pos && $second_pos) {
            echo "Not Valid " . $line . "\n";
            echo "First_Pos: " . $first_pos . "\n";
            echo "Second_Pos: " . $second_pos . "\n";
            echo "=============\n";
        } else {
            echo "Valid: " . $line . "\n";
            echo "First_Pos: " . $first_pos . "\n";
            echo "Second_Pos: " . $second_pos . "\n";
            echo "=============\n";
            $valid_count++;
        }
    } else {
        echo "Not Valid " . $line . "\n";
        echo "First_Pos: " . $first_pos . "\n";
        echo "Second_Pos: " . $second_pos . "\n";
        echo "=============\n";
    }
}

echo "Part 2: " . $valid_count . "\n";

?>