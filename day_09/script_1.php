<?php
$input = '2199943210
3987894921
9856789892
8767896789
9899965678';

$input_array = explode( "\n", $input);

foreach( $input_array as $key_1 => $input_line ) {

    $input_line = preg_replace( "/\r|\n/", "", $input_line );
    $input_digits = str_split( $input_line );

    $input_array[$key_1] = $input_digits;
}

$low_list = array();
foreach( $input_array as $key_1 => $input_line ) {

    foreach( $input_line as $key_2 => $input_cell ) {
        if( $input_cell == 9 ) { continue; }

        // Assume it's low
        $low = true;        
        
        // Look Right
        if( isset( $input_array[$key_1][$key_2 + 1] ) ) {
            if( $input_array[$key_1][$key_2 + 1] < $input_cell ) {
                continue;
            }
        }
        
        // Look Left
        if( isset( $input_array[$key_1][$key_2 - 1] ) ) {
            if( $input_array[$key_1][$key_2 - 1] < $input_cell ) {
                continue;
            }
        }
        
        // Look Up
        if( isset( $input_array[$key_1 - 1][$key_2] ) ) {
            if( $input_array[$key_1 - 1][$key_2] < $input_cell ) {
                continue;
            }
        }
        
        // Look Down
        if( isset( $input_array[$key_1 + 1][$key_2] ) ) {
            if( $input_array[$key_1 + 1][$key_2] < $input_cell ) {
                continue;
            }
        }
        
        // Passed All Tests
        $low_list[]   = $input_cell;
        $basin        = [$key_1,$key_2];
        $basin_list[] = $basin;
    }

}

echo "Risk Level: ". array_sum( $low_list ) + count( $low_list );
?>
