<?php

use Rrd108\PhpCliCrypto\Requester;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

$requester = new Requester($config);
$rates = $requester->getRates('ETH', 'HUF');

//var_dump($rates);

$fp = fopen(__DIR__ . '/data.csv', 'a');
fputcsv($fp, [date('Y-m-d H:i:s'), $rates['HUF']]);
fclose($fp);
