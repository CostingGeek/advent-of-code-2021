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
echo "\r\n\r\n";

$basin_final = array();
function calc_basin( $basin ) {
    
    global $input_array;
    global $basin_final;
    
        $x = $basin[0];
        $y = $basin[1];
        $value = $input_array[$x][$y];

        //echo "Test: $x / $y = $value \r\n";

        $basin_tmp = array();

        // Look Right
        if( isset( $input_array[$x][$y + 1] ) ) {
            if( $input_array[$x][$y + 1] == $value + 1 
             && $input_array[$x][$y + 1] != 9 ) {
                 
                // avoid double-checks
                $key = $x.",".( $y + 1 );
                if( in_array( $key, $basin_final ) )
                {
                    //echo "Found: ".$key."\r\n";
                } else {
                    // save new position
                    $basin_l       = [$x,$y + 1];
                    $basin_tmp[]   = $basin_l;
                    $basin_final[] = $basin_l[0].",".$basin_l[1];

                    //echo "Right: ".$input_array[$x][$y + 1]." = Yes\r\n";
                }
             }
        }

        // Look Left
        if( isset( $input_array[$x][$y - 1] ) ) {
            if( $input_array[$x][$y - 1] == $value + 1 
             && $input_array[$x][$y - 1] != 9 ) {
                 
                // avoid double-checks
                $key = $x.",".( $y - 1 );
                if( in_array( $key, $basin_final ) )
                {
                    //echo "Found: ".$key."\r\n";
                } else {
                    // save new position
                    $basin_l       = [$x,$y - 1];
                    $basin_tmp[]   = $basin_l;
                    $basin_final[] = $basin_l[0].",".$basin_l[1];
                
                    //echo "Left: ".$input_array[$x][$y - 1]." = Yes\r\n";
                }
             }
        }
        
        // Look Up
        if( isset( $input_array[$x - 1][$y] ) ) {
            if( $input_array[$x - 1][$y] == $value + 1 
             && $input_array[$x - 1][$y] != 9 ) {
                 
                // avoid double-checks
                $key = ($x - 1).",".$y;
                if( in_array( $key, $basin_final ) )
                {
                    //echo "Found: ".$key."\r\n";
                } else {
                    // save new position
                    $basin_l       = [$x - 1,$y];
                    $basin_tmp[]   = $basin_l;
                    $basin_final[] = $basin_l[0].",".$basin_l[1];

                    //echo "Up: ".$input_array[$x - 1][$y]." = Yes\r\n";
                }
             }
        }
        
        // Look Down
        if( isset( $input_array[$x + 1][$y] ) ) {
            if( $input_array[$x + 1][$y] == $value + 1 
             && $input_array[$x + 1][$y] != 9 ) {
                 
                // avoid double-checks
                $key = ($x + 1).",".$y;
                if( in_array( $key, $basin_final ) )
                {
                    //echo "Found: ".$key."\r\n";
                } else {
                    // save new position
                    $basin_l       = [$x + 1,$y];
                    $basin_tmp[]   = $basin_l;
                    $basin_final[] = $basin_l[0].",".$basin_l[1];
                
                    //echo "Down: ".$input_array[$x + 1][$y]." = Yes\r\n";
                }
             }
        }
        
        foreach( $basin_tmp as $basin_l ) {
            $basin_tmp_2 = array();
            $basin_tmp_2 = calc_basin( $basin_l );
        }

        
        return $basin_tmp;
}

$basin_count = array();
foreach( $basin_list as $key => $basin )
{
    $value = $input_array[$basin[0]][$basin[1]];
    echo "Test: ".$basin[0].",".$basin[1]." = ".$value."\r\n";
    $basin_final = array( $basin[0].",".$basin[1]);

    $basin_tmp = array();
    $basin_tmp = calc_basin( $basin, $low_list[$key] );
    
    echo "Basin Size: ". count($basin_final);
    echo "\r\n\r\n";
    
    $basin_count[] = count($basin_final);
//    print_r( $basin_final );
}

rsort( $basin_count );
$result = 1;
for( $i = 0; $i < 3; $i++ )
{
    $result = $result * $basin_count[$i];
}
print_r( $result );
