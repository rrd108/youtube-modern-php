<?php

namespace Rrd108\ModernPhp;

class BruteForceChecker
{
    private $delay;
    private $fileName;

    public function __construct($fileName, $delay = 20*60)
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

    public function check()
    {
        $lines = file($this->fileName);
        $lines = array_reverse($lines);
        foreach ($lines as $line) {
            $line = explode(',', $line);
            if ($line[0] == $_SERVER['REMOTE_ADDR'] && (time() - $line[1]) < $this->delay) {
                $error = 'Jelenleg nem tudsz új szavazatot leadni, kérlek próbáld meg később!';
            }
        }
        return $error;
    }
}
