<?php

function validate($passport) {
    $sections = explode(" ", $passport);
    
    switch (count($sections)) {
        case 8:
            $response = TRUE;
        case 7:
            if (preg_match("/cid:/i",$passport)) {
                $response = FALSE;
                break;
            }
        default:
            $response = FALSE;
            break;
    }
    foreach ($sections as $key => $section) {
        $section_value = substr($section, 4);
        switch (substr($section, 0, 3)) {
            case 'byr':
                // Birth Year
                if (strlen($section_value) == 4 && $section_value >= 1920 && $section_value <= 2002) {
                    $response = TRUE;
                }
                break;

            case 'iyr':
                // Issue Year
                if (strlen($section_value) == 4 && $section_value >= 2010 && $section_value <= 2020) {
                    $response = TRUE;
                }
                break;

            case 'eyr':
                // Expiration Year
                if (strlen($section_value) == 4 && $section_value >= 2020 && $section_value <= 2030) {
                    $response = TRUE;
                }
                break;
            
            case 'hgt':
                // Height
                $len_type = str_split($string, strlen($string) - 2);
                if ($len_type[1] == 'in') {
                    ($len_type[0] >= 59 && $len_type[0] <= 76) ? $response = TRUE : $response = FALSE;
                }
                if ($len_type[1] == 'cm') {
                    ($len_type[0] >= 150 && $len_type[0] <= 193) ? $response = TRUE : $response = FALSE;
                }
                break;
            
            case 'hcl':
                // Hair Color
                $hash_check = strpos($section_value, '#');
                if ($hash_check && $hash_check == '0' && preg_match()) {
                    preg_match('/^[a-f0-9]+$/', substr($section_value, 1), $matches);
                    ;

                    # code...
                }
                break;
            
            case 'ecl':
                // Eye Color
                break;
            
            case 'pid':
                // Passport ID
                break;
               
            default:
                # code...
                break;
        }
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