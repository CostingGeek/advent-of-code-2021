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

// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// Process each line
$count = 0;
foreach( $list_array as $key => $list_line )
{
    $list_tmp = explode( " | ", $list_line );
    $list_tmp1 = explode( " ", $list_tmp[0] );
    $list_tmp2 = explode( " ", $list_tmp[1] );
    
    $count += count_ouput( $list_tmp2 );
}

echo "Total => ".$count."\r\n";

// Output Function
function count_ouput( $list_tmp2 ) {

    $count = 0;
    foreach( $list_tmp2 as $key => $segment )
    {
        switch( strlen($segment) ) {
            case 2:
                $count++;
                break;
            
            case 3:
                $count++;
                break;
            
            case 4 :
                $count++;
                break;
            
            case 7 :
                $count++;
                break;
     }
    
    }

    return $count;
}

?>
