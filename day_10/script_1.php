<?php
$input = '[({(<(())[]>[[{[]{<()<>>
[(()[<>])]({[<{<<[]>>(
{([(<{}[<>[]}>{[]{[(<()>
(((({<>}<{<{<>}{[]{[]{}
[[<[([]))<([[{}[[()]]]
[{[{({}]{}}([{[{{{}}([]
{<[[]]>}<{[{[{[]{()[[[]
[<(<(<(<{}))><([]([]()
<{([([[(<>()){}]>(<<{{
<{([{{}}[<[[[<>{}]]]>[]]';

// digest the list as array
$input_array = explode("\n", $input);
foreach( $input_array as $key => $line )
{
    $input_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// [ = 0
// ] = 1
// ( = 2
// ) = 3
// { = 4
// } = 5
// < = 6
// > = 7

$chars = array('[',']','(',')','{','}','<','>');
$chars_o = array('[','(','{','<');
$chars_c = array(']',')','}','>');
$chars_p = array('57','3','1197','25137');
$chars_2 = array('/\[\]/','/\(\)/','/\{\}/','/\<\>/');

function init_chunck( ) {
    $chunck[0] = 0;
    $chunck[1] = 0;
    $chunck[2] = 0;
    $chunck[3] = 0;
    $chunck[4] = 0;
    $chunck[5] = 0;
    $chunck[6] = 0;
    $chunck[7] = 0;    
    return $chunck;
}

$score = 0;
// Remove valid combinations
foreach( $input_array as $input_line ) {

    $input_tmp = $input_line;
    $done = false;
    while( $done == false ) {
        
        $input_tmp_2 = $input_tmp;
        foreach( $chars_2 as $key ) {
            $input_tmp_2 = preg_replace( $key, "", $input_tmp_2 );
        }
        
        if( $input_tmp_2 == $input_tmp ) {
            $done = true; // no more changes
        } else {
            $input_tmp = $input_tmp_2;
        }
    }

    $list_tmp = str_split( $input_tmp );
    foreach( $list_tmp as $key => $char_tmp ) {
        $id = array_search( $char_tmp, $chars_c );
        if( $id === false ) {
            continue;
        }
        
        echo "Before: $input_line \r\n";
        echo "After:  $input_tmp \r\n";
        echo "Error: $char_tmp \r\n";
        echo "Points: ".$chars_p[$id]."\r\n";
        echo "\r\n";
        
        $score += $chars_p[$id];
        break 1;
    }

}

echo "Score: $score";
