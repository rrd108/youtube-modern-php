<?php

// ternary operator
/*if ($name == 'rrd') {
    $channel = 'webmania';
} else {
    $channel = null;
}*/

$channel = ($name == 'rrd') ? 'webmania' : null;
