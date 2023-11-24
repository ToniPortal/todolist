<?php

// var_dump($_REQUEST);

// header('Content-Type: text/csv');
// header('Content-Disposition: attachment; filename="sample.csv"');

// $user_CSV[0] = array('ID', 'Task', '');

// $nb = 1;

// foreach($_REQUEST AS $key => $value) {

// $user_CSV[$nb] = array($key, "".$value."");
// $nb++;
// }

// var_dump($user_CSV);

// $user_CSV[2] = array('Antoine', 'Del Torro', 55);
// $user_CSV[3] = array('Arthur', 'Vincente', 15);

// $fp = fopen('php://output', 'wb');
// foreach ($user_CSV as $line) {
//     // though CSV stands for "comma separated value"
//     // in many countries (including France) separator is ";"
//     fputcsv($fp, $line, ';');
// }
// fclose($fp);