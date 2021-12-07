<?php
$list = '00100
11110
10110
10111
10101
01111
00111
11100
10000
11001
00010
01010';


// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// initialize parameters
$rate_o = 0;
$rate_c = 0;

// function to identify most occurence in a bit
function find_common_bit( $list, $pos ) {

  $bit_array = array();
  $bit_array[0] = 0;
  $bit_array[1] = 0;

  foreach( $list as $line )    
  {
    if( $line[$pos] == 0 ) {
      $bit_array[0]++;
    } else {
      $bit_array[1]++;
    }
  }
  
  // return the digit with most occurence
  if( $bit_array[0] > $bit_array[1] ) { 
      return 0;
  } else {
      return 1;
  }

}

// function to remove non-compliant entries
function filter_array( $list, $pos, $value )
{
    $list_tmp = array();
    foreach( $list as $line )
    {
      if( $line[$pos] == $value ) {
          $list_tmp[] = $line;
      }
    }
    return $list_tmp;
}

// check each bit for oxygen rate
$list_tmp = $list_array;
for( $i = 0; $i < strlen( $list_tmp[0] ); $i++ ) {

  $bit = find_common_bit( $list_tmp, $i ); 
  $list_tmp = filter_array( $list_tmp, $i, $bit );

  if( count($list_tmp) == 1 ) { break; }
}

$rate_o = $list_tmp[0];

// check each bit for oxygen rate
$list_tmp = $list_array;
for( $i = 0; $i < strlen( $list_tmp[0] ); $i++ ) {

  $bit = find_common_bit( $list_tmp, $i ); 
  $list_tmp = filter_array( $list_tmp, $i, (1 - $bit) );

  if( count($list_tmp) == 1 ) { break; }
}

$rate_c = $list_tmp[0];

// Output the ship's depth measurement variations
echo 'The ship\'s life support rating is:'."\r\n";
echo 'Oxygen Generator Rating: '.$rate_o.' => '.bindec($rate_o)."\r\n";
echo 'CO2 scrubber rating: '.$rate_c.' => '.bindec($rate_c)."\r\n";
echo 'Life support rating: '.bindec($rate_o) * bindec($rate_c)."\r\n";
//echo 'Gamma Espilon: '.$rate_g.' => '.bindec($rate_e)."\r\n";
//echo 'Power Consumption: '.bindec($rate_g) * bindec($rate_e)."\r\n";
?>
