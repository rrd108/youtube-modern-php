<?php

namespace Rrd108\ModernPhp;

class BruteForceChecker
{
    private int $delay;
    private \PDO $pdo;

    public function __construct(\PDO $pdo, int $delay = 20*60)
    {
        $this->pdo = $pdo;
        $this->delay = $delay;
    }

    public function save()
    {
        $stmt = $this->pdo->prepare('INSERT INTO votelogs
            (ip) VALUES (?)');
        $stmt->bindValue(1, $_SERVER['REMOTE_ADDR']);
        $stmt->execute();
    }

    public function isUserVotedInDelay(): bool
    {
        $stmt = $this->pdo->prepare('SELECT NOW() - MAX(id) AS diff FROM votelogs WHERE ip = ?');
        $stmt->execute([$_SERVER['REMOTE_ADDR']]);
        $result = $stmt->fetch();
        return $result['diff'] < $this->delay;
    }
}
