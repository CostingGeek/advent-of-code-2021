<?php
$list = '0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2';


// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// initialize
$line_list = array();
$line      = array();
$grid      = array();
$max_x     = 0;
$max_y     = 0;

// parse coordinates into lines
foreach( $list_array as $list_line ) {
    $line_split = explode( " -> ", $list_line );

    $split_1 = explode( ",", $line_split[0] );
    $split_2 = explode( ",", $line_split[1] );

    // remove diagonals
    if( $split_1[0] != $split_2[0] && $split_1[1] != $split_2[1] )
    {
        continue;
    }

    unset( $point );
    unset( $line );
    
    if( $split_1[0] <= $split_2[0] && $split_1[1] <= $split_2[1] ) {
        $point['x']  = $split_1[0];
        $point['y']  = $split_1[1];
        $line[]      = $point;
        $point['x']  = $split_2[0];
        $point['y']  = $split_2[1];
        $line[]      = $point;
    } else {
        $point['x']  = $split_2[0];
        $point['y']  = $split_2[1];
        $line[]      = $point;
        $point['x']  = $split_1[0];
        $point['y']  = $split_1[1];
        $line[]      = $point;
    }
    $line_list[] = $line;
    
    if( $split_1[0] > $max_x ) { $max_x = $split_1[0]; }
    if( $split_2[0] > $max_x ) { $max_x = $split_2[0]; }
    if( $split_1[1] > $max_y ) { $max_y = $split_1[1]; }
    if( $split_2[1] > $max_y ) { $max_y = $split_2[1]; }
}

// Initialize grid
for( $i = 0; $i <= $max_y; $i++ ) {
    for( $j = 0; $j <= $max_x; $j++ ) {
        $grid[$i][$j] = 0;
    }
}

// Mark the grid with the lines
foreach( $line_list as $line ) {
    
    for( $i = $line[0]['x']; $i <= $line[1]['x']; $i++ ) {
        for( $j = $line[0]['y']; $j <= $line[1]['y']; $j++ ) {
        $grid[$j][$i] += 1;
        }
    }
    
    //break;
}

function print_grid( $grid_list ) {
    
    foreach( $grid_list as $grid_line ) {
        foreach( $grid_line as $cell ) {
            if( $cell == 0 ) { 
                echo '.';
            } else {
                echo $cell;
            }
        }
        echo " \r\n";
    }
    
}

function filter_grid( $grid_list ) {
    
    $i = 0;
    foreach( $grid_list as $grid_line ) {
        foreach( $grid_line as $cell ) {
            if( $cell > 1 ) { 
                $i++;
            }
        }
    }
    
    return $i;
}

print_grid( $grid );
echo filter_grid( $grid );
?>
