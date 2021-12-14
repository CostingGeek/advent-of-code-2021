<?php
$input = '5483143223
2745854711
5264556173
6141336146
6357385478
4167524645
2176841721
6882881134
4846848554
5283751526';

// digest the list as grid
$input_array = explode("\n", $input);
foreach( $input_array as $key => $line )
{
    $line_list = preg_replace( "/\r|\n/", "", $line );
    $input_array[$key] = str_split( $line_list );
}

$flash_upd_list = array();
$flash_total = 0;

function octopus_step( ) {
    
    global $input_array;
    global $flash_upd_list;
    $flash_upd_list = array();
    
    $flash_list = array();
    foreach( $input_array as $i => $input_line ) {
        foreach( $input_line as $j => $input_cell ) {
            
            if( $input_cell < 9 ) {
                $input_array[$i][$j]++;
            } else {
                $input_array[$i][$j] = 0;
                $flash_list[]     = array( $i, $j );
            }
        }
    }

    $flash_upd_list = $flash_list;
    
    octopus_flash( $flash_list );
}

function octopus_flash( $flash_list ) {
    
    global $flash_total;

    $flash_tmp_list = array();
    foreach( $flash_list as $flash ) {
        
        $x = $flash[0];
        $y = $flash[1];
        $flash_total ++;
        
        $flash_tmp_list[] = octopus_flash_cell( $x - 1, $y - 1 ); // Top Left
        $flash_tmp_list[] = octopus_flash_cell( $x - 1, $y     ); // Top Center
        $flash_tmp_list[] = octopus_flash_cell( $x - 1, $y + 1 ); // Top Right
        $flash_tmp_list[] = octopus_flash_cell( $x    , $y - 1 ); // Middle Left
        //$flash_tmp_list[] = octopus_flash_cell( $x    , $y     ); // Middle Center
        $flash_tmp_list[] = octopus_flash_cell( $x    , $y + 1 ); // Middle Right
        $flash_tmp_list[] = octopus_flash_cell( $x + 1, $y - 1 ); // Bottom Left
        $flash_tmp_list[] = octopus_flash_cell( $x + 1, $y     ); // Bottom Center
        $flash_tmp_list[] = octopus_flash_cell( $x + 1, $y + 1 ); // Bottom Right
    }
    
    $flash_tmp_list = array_filter($flash_tmp_list);

    if( count( $flash_tmp_list ) > 0 ) {
        octopus_flash( $flash_tmp_list );
    }
    
}

function octopus_flash_cell( $x, $y ) {

    global $input_array;
    global $flash_upd_list;

    if( !isset( $input_array[$x][$y] ) )
    { return false; }

    $array_tmp = array( $x, $y );
    if( in_array( $array_tmp, $flash_upd_list ) ) {
        return false;
    }

    if( $input_array[$x][$y] <  9 ) {
        $input_array[$x][$y]++;
        return false;
    } else {
        $input_array[$x][$y] = 0;
        $flash_upd_list[] = array( $x, $y );
        return $array_tmp;
    }
}

function octopus_print( ) {
    
    global $input_array;
    $sum = 0;

    foreach( $input_array as $i => $input_line ) {
//        foreach( $input_line as $j => $input_cell ) {
 
        $sum += array_sum( $input_line );
//        echo $input_cell;
        
//        }
        
//        echo "\r\n";
    }

    return $sum;
}

echo "--- Sprint 0 : ";
echo octopus_print( )."\r\n";


for( $i = 1; $i <= 200; $i++ )
{
    octopus_step( );
    $sum = octopus_print( );
    echo "--- Sprint $i : $sum \r\n";
    if( $sum == 0 ) { break; }
    
}
?>
