<?php

if( ! $_POST['pattern'] ) return;
$offset = ( $_POST['page'] ) ? ( $_POST['page'] -1 ) * 10 : 0;
echo file_get_contents( 'http://weber.ir/patterns/list.php?page=' . $offset );