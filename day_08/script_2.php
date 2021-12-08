<?php
$list = 'be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe
edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc
fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg
fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb
aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea
fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb
dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe
bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef
egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb
gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce';

//$list = 'acedgfb cdfbe gcdfa fbcad dab cefabd cdfgeb eafb cagedb ab | cdfeb fcadb cdfeb cdbaf';

// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

$digit_map = array();
$digit_map[0] = 'abcefg';
$digit_map[1] = 'cf';
$digit_map[2] = 'acdeg';
$digit_map[3] = 'acdfg';
$digit_map[4] = 'bcdf';
$digit_map[5] = 'abdfg';
$digit_map[6] = 'abdefg';
$digit_map[7] = 'acf';
$digit_map[8] = 'abcdefg';
$digit_map[9] = 'abcdfg';
$digit_map_r = array_flip( $digit_map );

// Process each line
$out_sum = 0;
foreach( $list_array as $key => $list_line )
{
    $list_tmp = explode( " | ", $list_line );
    $list_tmp1 = explode( " ", $list_tmp[0] );
    $list_tmp2 = explode( " ", $list_tmp[1] );
    
    $out = calc_ouput( $list_tmp1, $list_tmp2, $digit_map_r );
    echo $key." => ".$out."\r\n";
    
    $out_sum += $out;
}

echo "Total => ".$out_sum."\r\n";

// Output Function
function calc_ouput( $list_tmp1, $list_tmp2, $digit_map_r ) {

    $list_out = array();
    foreach( $list_tmp1 as $key => $segment )
    {
        if( $segment == null ) { continue; }
    
        switch( strlen($segment) ) {
            case 2:
                $list_out[1] = $segment;
                break;
            
            case 3:
                $list_out[7] = $segment;
                break;
            
            case 4 :
                $list_out[4] = $segment;
                break;
            
            case 7 :
                $list_out[8] = $segment;
                break;
            
            default:
                $list_zzz[strlen($segment)][] = $segment;
     }
    
    }

    // Start the mapping process
    $chr_map = array();

    // Search for Character A
    // Difference between 7 and 1
    $chr_tmp = array_diff( str_split($list_out[7]), str_split($list_out[1]) );
    $chr_map['a'] = implode( $chr_tmp );

    // Temp for Characters C and F
    // Common parts between 7 and 1
    $chr_c1 = str_split($list_out[1]);
    $chr_f1 = str_split($list_out[1]);

    // Temp for B and D
    // Parts of 4 than are not in 1
    $chr_b1 = $chr_d1 = array_diff( str_split($list_out[4]), str_split($list_out[1]) );

    // Temp for D and G
    // Common parts between 2, 3, and 5
    // All have length of 5
    // And A is already known
    $tmp1 = str_split( $list_zzz[5][0] );
    $tmp2 = str_split( $list_zzz[5][1] );
    $tmp3 = str_split( $list_zzz[5][2] );

    $tmp_list = array();
    foreach( $tmp1 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    foreach( $tmp2 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    foreach( $tmp3 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    // Looking for D and G, that appear 3 times
    foreach( $tmp_list as $key => $tmp )
    {
        if( $tmp < 3 ) { continue; }
        if( $key == $chr_map['a'] ) { continue; }
        $chr_d2[] = $chr_g1[] = $key;
    }

    // Looking for B and E, that appear 1 time
    foreach( $tmp_list as $key => $tmp )
    {
        if( $tmp > 1 ) { continue; }
        $chr_b2[] = $chr_e1[] = $key;
    }

    // Deduce D from D1 and D2
    $chr_tmp = array_intersect( $chr_d1, $chr_d2 );
    $chr_map['d'] = implode( $chr_tmp );

    // Deduce B from B1 and B2
    $chr_tmp = array_intersect( $chr_b1, $chr_b2 );
    $chr_map['b'] = implode( $chr_tmp );

    // Deduce G from G1 and D
    $chr_tmp = array_diff( $chr_g1, array($chr_map['d']) );
    $chr_map['g'] = implode( $chr_tmp );

    // Temp for C and E
    // Unique parts between 0, 6, and 9
    // All have length of 6
    // And D is already known
    $tmp1 = str_split( $list_zzz[6][0] );
    $tmp2 = str_split( $list_zzz[6][1] );
    $tmp3 = str_split( $list_zzz[6][2] );

    $tmp_list = array();
    foreach( $tmp1 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    foreach( $tmp2 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    foreach( $tmp3 as $tmp ) {
        if( isset( $tmp_list[$tmp] ) ) {
            $tmp_list[$tmp]++; 
        } else {
            $tmp_list[$tmp] = 1;
        }
    }

    // Looking for C and E, that appear 2 times
    // And different from D
    foreach( $tmp_list as $key => $tmp )
    {
        if( $tmp > 2 ) { continue; }
        if( $key == $chr_map['d'] ) { continue; }
        $chr_c2[] = $chr_e2[] = $key;
    }

    // Deduce C from C1 and C2
    $chr_tmp = array_intersect( $chr_c1, $chr_c2 );
    $chr_map['c'] = implode( $chr_tmp );

    // Deduce E from E1 and E2
    $chr_tmp = array_intersect( $chr_e1, $chr_e2 );
    $chr_map['e'] = implode( $chr_tmp );

    // Deduce F from F1 and C
    $chr_tmp = array_diff( $chr_f1, array($chr_map['c']) );
    $chr_map['f'] = implode( $chr_tmp );

    ksort( $chr_map );
    $chr_map_r = array_flip( $chr_map );

    // Return output
    $output = '';
    foreach( $list_tmp2 as $list_tmp ) {
        if( $list_tmp == null ) { continue; }
    
        $str_tmp = str_split( $list_tmp );
        foreach( $str_tmp as $key => $str ) {
            $str_tmp[$key] = $chr_map_r[$str];
        }
        sort($str_tmp);
        $list_tmp = implode( $str_tmp );
        $output .= $digit_map_r[$list_tmp];
    }

    return $output;
}

?>
