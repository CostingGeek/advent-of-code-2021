<?php
$list = '3,4,3,1,2';

$list_array = explode(",", $list);

$day = 0;
echo $day.": ".$list."\r\n";

function next_day( $day, $list_array ) {

    echo $day.": ";

    $list_tmp = array();
    $list_new = array();
    foreach( $list_array as $key => $line ) {
        $list_tmp[$key] = $line - 1;  
        
        if( $list_tmp[$key] < 0 ) {
            $list_tmp[$key] = 6;
            $list_new[] = 8;
        }
        
        echo $list_tmp[$key].","; 
    }

    foreach( $list_new as $key => $line ) {
        echo $line.","; 
    }
    
    echo "\r\n";
    
    $list_tmp = array_merge( $list_tmp, $list_new );
    return $list_tmp;
}

for( $i = 0; $i < 80; $i++ ) {
    $day++;
    $list_array = next_day( $day, $list_array );
}

echo 'Nb Fish: '.count( $list_array )."\r\n";
