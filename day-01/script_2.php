<?php
$list = '199
200
208
210
200
207
240
269
260
263';


// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// initial parameters
$set_1 = array();
$set_2 = array();
$set_3 = array();
$set_list = array();
$pre = 0;
$inc = 0;
$dec = 0;

// check depth measurement variations
$i = 0;
foreach( $list_array as $line )
{
    $i++;
    
    // fill the sets
    $set_1[] = $line; 
    
    if( $i > 1 ) {
      $set_2[] = $line;
    }
    
    if( $i > 2 ) {
      $set_3[] = $line;
    }
    
    if( count( $set_1 ) == 3 ) {
        $set_list[] = $set_1;
        $set_1 = array();
    } 

    if( count( $set_2 ) == 3 ) {
        $set_list[] = $set_2;
        $set_2 = array();
    } 
    
    if( count( $set_3 ) == 3 ) {
        $set_list[] = $set_3;
        $set_3 = array();
    } 
}

foreach( $set_list as $set_line )
{
    $line = array_sum( $set_line );
    
  // check depth measurement variations
  if( $pre == 0 ) {
        $variation = '(N/A - no previous measurement)';
    } elseif ($line > $pre) {
        $variation = '(increased)';
        $inc++;
    } elseif ($line < $pre) {
        $variation = '(decreased)';
        $dec++;
    } else {
        $variation = '(no change)';
    }
    
    $pre = $line;
    
    echo $line.' '.$variation."\r\n";
}

// Output the ship's depth measurement variations
echo 'The ship\'s variations are:'."\r\n";
echo "Increase = ".$inc."\r\n";
echo "Decrease = ".$dec."\r\n";
?>
