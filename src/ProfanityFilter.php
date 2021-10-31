<?php

namespace Rrd108\ModernPhp;

class ProfanityFilter
{
    private $stopWords = ['fehér', 'fekete'];

    public function __construct(array $stopWords = [])
    {
        $this->stopWords = array_merge($this->stopWords, $stopWords);
    }

    public function isBanned(string $text): bool
    {
        if (in_array($text, $this->stopWords)) {
            return true;
        }
        return false;
    }

    public function filter(string $text): string
    {
        return str_replace($this->stopWords, '*', $text);
    }
}
