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

echo $search = $_GET['search'] ?? 'all';       // ha létezik - null coalescing 

// optional chaning / null safe operator
$users = [
    [
        'name' => 'rrd',
        'stack' => [
            'frontend' => 'js'
        ]
    ],
    [
        'name' => 'lame',
        'stack' => null
    ]
];
$users = json_decode(json_encode($users));

echo "\n\n";
foreach ($users as $user) {
    //echo $user->name . ': ' . $user->stack ? $user->stack->frontend : null . "\n";
    echo $user->name . ': ' . $user->stack?->frontend . "\n";
}
