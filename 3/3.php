<?php

$grid = file_get_contents(__DIR__ . '/list.txt');
$lines = explode("\n", $grid);

$vert_pos = array(1, 3, 5, 7);
$hor_pos = array(1, 2);
var_dump($vert_pos);
foreach ($lines as $key => $line) {
    $lines[$key] = str_repeat($line, 1000);
}

$pos = 0;
$lanes = array();

foreach ($lines as $key => $line) {
    $line = str_split($line);

    foreach ($vert_pos as $key => $value) {
        if (!isset($lanes[$key])) {
            $lanes[$key] = 0;
        }

        $cur_pos = $pos * $value;
        $cur_char = $line[$cur_pos];

        if ($cur_char == '#') {
            $trees_num = $lanes[$key];
            $lanes[$key] = $trees_num + 1;
        }
    } 
    $pos++;
}


$hor_pos = 0;
$pos = 0;
$row_skip = array('trees' => 0);

foreach ($lines as $row_key => $row_line) {
    $row_line = str_split($row_line);
    if ($row_key == $hor_pos) {
        $cur_char = $row_line[$pos];
        if ($cur_char == '#') {
            echo $cur_char . " ";
            $row_skip['trees'] = $row_skip['trees'] + 1;
        }
        $hor_pos = $hor_pos + 2;
        $pos++;
    } 
    
}

foreach ($lanes as $key => $value) {
    
echo "Number of trees hit for lane $vert_pos[$key]: " .  $value . "\n";

}

echo "Row Skip: " . $row_skip['trees'];

?>