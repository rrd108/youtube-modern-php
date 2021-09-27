<?php
declare(strict_types=1);

use Rrd108\ModernPhp\BruteForceChecker;
use Rrd108\ModernPhp\Db;
use \Waavi\Sanitizer\Sanitizer;

require './vendor/autoload.php';
require './config/config.php';

//$dayOfYear = date('z') + 1;   // TODO amint van minden napra kérdés ezt cseréljük vissza
$dayOfYear = 213;

$db = new Db($config['mysql']['host'], $config['mysql']['db'], $config['mysql']['user'], $config['mysql']['pass']);

$_data = $db->getQuestionWithAnswers($dayOfYear);

$data['question'] = $_data[0]['question'];
foreach ($_data as $d) {
    $data['answers'][$d['answer']] = $d['votes'];
    $data['answer_ids'][$d['answer']] = (int) $d['id'];
}
unset($_data);

$totalVotes = array_sum($data['answers']);

// jött-e új option
if ($_POST['new-option']) {
    /**
     * TODO lehetséges problémák
     *      bug: felülírás
     *      káromkodás szűrés
     *      hülyeség szűrő
     */
    
    $sanitizer  = new Sanitizer($_POST, ['new-option' => 'trim|escape|capitalize']);
    $cleanedPost = $sanitizer->sanitize();
    $data['answers'][$cleanedPost['new-option']] = 1;
    $totalVotes++;
    $db->saveNewAnswer($dayOfYear, $cleanedPost['new-option']);
}

if ($_POST['vote']) {
    // brute force check
    $bruteForceChecker = new BruteForceChecker($db->pdo);
    $userVoted = $bruteForceChecker->isUserVotedInDelay();
    $bruteForceChecker->save();

    if (!$userVoted) {
        if (in_array($_POST['vote'], array_keys($data['answers']))) {
            // növeljük a kiválasztott választ 1-gyel
            $data['answers'][$_POST['vote']]++;
            $totalVotes++;
            $db->saveVote($data['answer_ids'][$_POST['vote']]);
        }
    }
    // TODO ha olyanra szavazott ami nem létezik akkor loggoljuk a választ és az IP címet és a timestampet
}

require './template.php';
