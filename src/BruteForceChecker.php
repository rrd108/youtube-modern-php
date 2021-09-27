<?php

namespace Rrd108\ModernPhp;

class BruteForceChecker
{
    private int $delay;
    private string $fileName;

    public function __construct(string $fileName, int $delay = 20*60)
    {
        $this->delay = $delay;
        $this->fileName = $fileName;
    }

    public function save()
    {
        // mentsük el a user IP címét és az aktuális időpontot
        $fp = fopen($this->fileName, 'a');
        fwrite($fp, $_SERVER['REMOTE_ADDR'] . ',' . time() . "\n");
        fclose($fp);
    }

    public function isUserVotedInDelay(): bool
    {
        $lines = file($this->fileName);
        $lines = array_reverse($lines);
        foreach ($lines as $line) {
            $line = explode(',', $line);
            if ($line[0] == $_SERVER['REMOTE_ADDR'] && (time() - $line[1]) < $this->delay) {
                return true;
            }
        }
        return false;
    }
}
