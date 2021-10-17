<?php
error_reporting(E_ALL);

$name = 'Gauranga';
// ternary operator
/*if ($name == 'rrd') {
    $channel = 'webmania';
} else {
    $channel = null;
}*/

$channel = ($name == 'rrd') ? 'webmania' : null;

//if (isset($_GET['search'])) {...}
echo $search = $_GET['search'] ?: 'all';       // ha "igazi" / truely - shorthand ternary 
