<?php

use Rrd108\ModernPhp\Db;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    public function testConnect()
    {
        $this->expectException(Exception::class);
        $db = new Db('a', 'b', 'c', 'd');
    }
}
