<?php
$list = '3,4,3,1,2';

function init_array( $max ) {
    
    $array_tmp = array();
    for( $i = 0; $i < $max; $i++ )
    {
        $array_tmp[$i] = 0;
    }
    
    return $array_tmp;
}

$fish_list = init_array( 10 );

$list_array = explode(",", $list);
foreach( $list_array as $line ) {
  $fish_list[$line]++;  
}

for( $day = 0; $day < 256; $day++ ) {

  $fish_list_new = init_array( 10 );
  for( $i = 0; $i < 8; $i++ )
  {
      $fish_list_new[$i] = $fish_list[$i+1];
  }
  $fish_list_new[6] = $fish_list_new[6] + $fish_list[0];
  $fish_list_new[8] = $fish_list[0];

    $fish_list = $fish_list_new;
}

echo array_sum( $fish_list_new );
?>
