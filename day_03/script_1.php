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

// initial parameters
$rate_g = '';
$rate_e = '';
$col_1 = array();
$col_2 = array();
$col_3 = array();
$col_4 = array();
$col_5 = array();
$col_list = array();


// analyze patterns
foreach( $list_array as $line )
{

  $col_1[] = $line[0];
  $col_2[] = $line[1];
  $col_3[] = $line[2];
  $col_4[] = $line[3];
  $col_5[] = $line[4];

}

$col_list[] = $col_1;
$col_list[] = $col_2;
$col_list[] = $col_3;
$col_list[] = $col_4;
$col_list[] = $col_5;

foreach( $col_list as $col_array )
{

  $array_values = array_count_values( $col_array );
  arsort( $array_values );
  
  $i = 0;
  foreach( $array_values as $key => $value ) {
      if( $i == 0 ) {
        $rate_g .= $key;  
      } else {
        $rate_e .= $key;  
      }
      $i++;
  }
  
}

// Output the ship's depth measurement variations
echo 'The ship\'s power consumption is:'."\r\n";
echo 'Gamma Rate: '.$rate_g.' => '.bindec($rate_g)."\r\n";
echo 'Gamma Espilon: '.$rate_g.' => '.bindec($rate_e)."\r\n";
echo 'Power Consumption: '.bindec($rate_g) * bindec($rate_e)."\r\n";
?>
