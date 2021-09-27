<?php

namespace Rrd108\ModernPhp;

use PDO;

class Db
{
    private $pdo;

    public function __construct($host, $dbName, $mysqlUser, $mysqlPass) {
        // TODO named arguments php 8
        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $mysqlUser, $mysqlPass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getQuestionWithAnswers(int $dayOfYear) {
        $stmt = $this->pdo->prepare('SELECT * FROM questions 
            INNER JOIN answers 
            ON answers.question_id = questions.id 
            WHERE questions.id = ?');
        $stmt->execute([$dayOfYear]);
        return $stmt->fetchAll();
    }
}