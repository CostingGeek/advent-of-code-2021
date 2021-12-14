<?php
$input_1 = 'NNCB';
$input_2 = 'CH -> B
HH -> N
CB -> H
NH -> C
HB -> C
HC -> B
HN -> C
NN -> C
BH -> H
NC -> B
NB -> B
BN -> B
BB -> N
BC -> B
CC -> N
CN -> C';

// digest the list as grid
$input_array = explode("\n", $input_2);
$input_map = array();
$input_out = array();
foreach( $input_array as $key => $line )
{
    // Separate input and output
    $line = preg_replace( "/\r|\n/", "", $line );
    list( $input_map[$key], $input_out[$key] ) = explode(" -> ", $line);
}

function build_polymer( $char ) {
    
    global $input_map, $input_out;
    
    $out = '';
    $out = array_search( $char, $input_map );

    if( $out == '' ) {
        return false;
    }
    
    // echo "Map $char -> ".$input_out[$out]."\r\n";
    return $input_out[$out];

}

function parse_polymer( $polymer ) { 
    
    $output = array();
    $list = str_split( $polymer );
    
    for( $i = 0; $i < count( $list ) - 1; $i++) {
        $output[] = $list[$i];
        $output[] = build_polymer( $list[$i].$list[$i + 1] );
    }
    
    $output[] = $list[$i];

    $previous = '';
    return array_reduce( $output, function ($previous, $current) {

        return $previous .= $current;
    });

}

$input = $input_1;
echo "$input \r\n";
for( $i = 1; $i <= 10; $i++ ){
    $input = parse_polymer( $input );
}

$char_list = str_split( $input );


$pile = array();
$pile['N'] = $pile['C'] = $pile['B'] = $pile['H'] = 0;
foreach( $char_list as $char ) {
    $pile[$char] = $pile[$char] + 1;
}

sort( $pile );
print_r( $pile );

echo "Result: ".$pile[3]." - ".$pile[0]." = ".( $pile[3] - $pile[0] );
?>
