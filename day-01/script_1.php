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
$pre = 0;
$inc = 0;
$dec = 0;

// check depth measurement variations
foreach( $list_array as $line )
{
    if( $pre == 0 ) {
        $variation = '(N/A - no previous measurement)';
    } elseif ($line > $pre) {
        $variation = '(increased)';
        $inc++;
    } else {
        $variation = '(decreased)';
        $dec++;
    }
    
    $pre = $line;
    
    echo $line.' '.$variation."\r\n";
}

// Output the ship's depth measurement variations
echo 'The ship\'s variations are:'."\r\n";
echo "Increase = ".$inc."\r\n";
echo "Decrease = ".$dec."\r\n";
?>
