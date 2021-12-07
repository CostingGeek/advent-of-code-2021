<?php
$list = '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7';


// digest the list as arrays
$list_array = explode("\n", $list);

$draw_list  = preg_replace( "/\r|\n/", "", $list_array[0] );
$draw_array = explode(",", $draw_list);

$list_tmp = array();
for( $i = 2; $i < count( $list_array ); $i++ )
{
    $list_tmp[$i - 2] = preg_replace( "/\r|\n/", "", $list_array[$i] );
}

$grid_list  = array();
$grid_score = array();
$grid       = array();
$score_list = array();
$score      = array(0,0,0,0,0);
$i = 0;
foreach( $list_tmp as $line )
{
    unset($line_array);
    $line_array = explode(" ", $line);
    $line_array = array_values(array_filter($line_array, 'strlen' ));
    
    if( $line_array == null ) { continue; };

    $grid[] = $line_array;
    $grid_score[] = $score;
    
    $i++;    
    if( $i == 5 ) {
        $grid_list[]  = $grid;
        $score_list[] = $grid_score;
        unset($grid);
        unset($grid_score);
        $i = 0;
    }

}

// match the grids to the draw and record the score
function score_grid( $grid_list, $score_list, $draw )
{
    $score_tmp = $score_list;
    
    foreach( $grid_list as $key_1 => $grid ) {
        foreach( $grid as $key_2 => $grid_line ) {
            foreach( $grid_line as $key_3 => $cell ) {
                
                if( $cell == $draw ) { 
                    $score_tmp[$key_1][$key_2][$key_3] = 1;
                }
            }
        }
    }
    
    return $score_tmp;
}

function check_winner( $score_list ) {
    
    $winner = null;
    foreach( $score_list as $key_1 => $score_grid ) {
        foreach( $score_grid as $key_2 => $score_line ) {
            if( array_sum( $score_line ) == 5 ) {
                return $key_1;
            }
        }
    }
    
    return $winner;
}

function unmarked_numbers( $grid, $score ) {
    
    $sum = 0;
    foreach( $score as $key_2 => $score_line ) {
        foreach( $score_line as $key_3 => $score ) {
            if( $score == 0 ) {
                $sum += $grid[$key_2][$key_3];
            }
        }
    }
    return $sum;
}

$winner = null;
foreach( $draw_array as $draw ) {

    echo $draw."-";
    $score_list = score_grid( $grid_list, $score_list, $draw );
    
    $winner = check_winner( $score_list );
    if( $winner != null ) { break; }
    
}

$grid_sum = unmarked_numbers( $grid_list[$winner], $score_list[$winner] );

echo "\n\r".'Winning Grid: '.$winner;
echo "\r\n".'Unmarked Numbers: '.$grid_sum;
echo "\r\n"."Last Draw: ".$draw;
echo "\r\n"."Final Score: ".$grid_sum * $draw;

?>
