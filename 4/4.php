<?php

function validate($passport) {
    $sections = explode(" ", $passport);
    
    switch (count($sections)) {
        case 8:
        case 7:
            if (preg_match("/cid:/i",$passport)) {
                $response = FALSE;
                break;
            } else {
                foreach ($sections as $key => $section) {
                    $section_value = substr($section, 4);
                    switch (substr($section, 0, 3)) {
                        case 'eyr':
                            echo "this is one!";
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }
            }
        
        default:
            $response = FALSE;
            break;
    }
    return $response;
}

$input = file_get_contents(__DIR__ . '/list.txt');
$lines = explode("\n", $input);
$entry = 0;
$passports = array();

foreach ($lines as $key => $line) {
    if (empty($line)) {
        $entry++;
    } else {
        if (!empty($passports[$entry])) {
            $passports[$entry] .= " $line";
        } else {
            $passports[$entry] = $line;
        }
    }
}

$valid_passports = 0;

foreach ($passports as $key => $passport) {
    $validity = validate($passport);
    if ($validity) {
        $valid_passports++;
    }
}

echo "Part 1 - Valid Passports: $valid_passports \n";

echo "Part 1 - Valid Passports: $valid_passports \n";

?>