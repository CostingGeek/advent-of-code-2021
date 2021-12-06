<?php
$list = 'forward 5
down 5
forward 8
up 3
down 8
forward 2';


// digest the list as array
$list_array = explode("\n", $list);
foreach( $list_array as $key => $line )
{
    $list_array[$key] = preg_replace( "/\r|\n/", "", $line );
}

// initial parameters
$pos_x = 0;
$pos_y = 0;

// analyze patterns
foreach( $list_array as $line )
{

  // Separate command and digits
  $list_array = explode(" ", $line);
  
  switch( $list_array[0] )
  {
    case 'forward':
        $pos_x += $list_array[1];
        break;
          
    case 'backward':
        $pos_x -= $list_array[1];
        break;
          
    case 'up':
        $pos_y -= $list_array[1];
        break;
          
    case 'down':
        $pos_y += $list_array[1];
        break;
  }

}

// Output the ship's depth measurement variations
echo 'The ship\'s position is:'."\r\n";
echo "Horizontal = ".$pos_x."\r\n";
echo "Vertical   = ".$pos_y."\r\n";
echo "Multiply   = ".$pos_x * $pos_y;
?>
