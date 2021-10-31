<?php

use PHPUnit\Framework\TestCase;
use Rrd108\ModernPhp\ProfanityFilter;

class ProfanityFilterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->filter = new ProfanityFilter();
    }

    protected function tearDown(): void
    {
        $this->filter = null;
    }

    public function testAllowForBannedWords()
    {

        $actual = $this->filter->isBanned('fehér');
        $this->assertTrue($actual);

        $actual = $this->filter->isBanned('fekete');
        $this->assertTrue($actual);

        $actual = $this->filter->isBanned('piros');
        $this->assertFalse($actual);
    }

    public function testAllowForOkWords()
    {

        $actual = $this->filter->isBanned('piros');
        $this->assertFalse($actual);
    }

    public function testFilterForMixedContent()
    {

        $actual = $this->filter->filter('fehér fekete piros');
        $this->assertEquals('* * piros', $actual);
    }

    public function testAllowWithExtraStopWords()
    {
        $filter = new ProfanityFilter(['zöld']);
        $actual = $filter->isBanned('zöld');
        $this->assertTrue($actual);

        $actual = $filter->isBanned('fehér');
        $this->assertTrue($actual);
    }
}
