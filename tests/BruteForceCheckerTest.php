<?php

use PHPUnit\Framework\TestCase;
use Rrd108\ModernPhp\BruteForceChecker;

class BruteForceCheckerTest extends TestCase
{
    public function testIsUserVotedInDelay()
    {
        $_SERVER['REMOTE_ADDR'] = '1.2.3.4';
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('execute')->willReturn(true);
        $stmt->method('fetch')->willReturn(['diff' => 100]);

        $pdo = $this->createMock(PDO::class);
        $pdo->method('prepare')->willReturn($stmt);

        $bfc = new BruteForceChecker($pdo);
        $actual = $bfc->isUserVotedInDelay();
        $this->assertTrue($actual);
    }
}
