<?php
$list = '111010111011
001011110010
000110111100
110101110001
101110011111
110011111001
100000110011
011100101100
111111000111';


// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// initial parameters
$rate_g = '';
$rate_e = '';
$col_01 = array();
$col_02 = array();
$col_03 = array();
$col_04 = array();
$col_05 = array();
$col_06 = array();
$col_07 = array();
$col_08 = array();
$col_09 = array();
$col_10 = array();
$col_11 = array();
$col_12 = array();
$col_list = array();


// analyze patterns
foreach( $list_array as $line )
{
  $col_01[] = $line[0];
  $col_02[] = $line[1];
  $col_03[] = $line[2];
  $col_04[] = $line[3];
  $col_05[] = $line[4];
  $col_06[] = $line[5];
  $col_07[] = $line[6];
  $col_08[] = $line[7];
  $col_09[] = $line[8];
  $col_10[] = $line[9];
  $col_11[] = $line[10];
  $col_12[] = $line[11];
}

$col_list[] = $col_01;
$col_list[] = $col_02;
$col_list[] = $col_03;
$col_list[] = $col_04;
$col_list[] = $col_05;
$col_list[] = $col_06;
$col_list[] = $col_07;
$col_list[] = $col_08;
$col_list[] = $col_09;
$col_list[] = $col_10;
$col_list[] = $col_11;
$col_list[] = $col_12;

foreach( $col_list as $col_array )
{

  $array_values = array_count_values( $col_array );
  arsort( $array_values );
  
  $i = 0;
  foreach( $array_values as $key => $value ) {
//      echo $key." => ".$value."\r\n";
      
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
