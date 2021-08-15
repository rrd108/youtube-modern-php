<?php
use \Waavi\Sanitizer\Sanitizer;

require './vendor/autoload.php';
require './functions.php';

//$dayOfYear = date('z') + 1;   // TODO amint van minden napra kérdés ezt cseréljük vissza
$dayOfYear = 213;
$data = json_decode(
    file_get_contents('./' . $dayOfYear . '.json'),
    true
);

$totalVotes = array_sum($data['answers']);

// jött-e új option
if ($_POST['new-option']) {
    /**
     * TODO lehetséges problémák
     *      bug: felülírás
     *      brute force
     *      káromkodás szűrés
     *      hülyeség szűrő
     */
    
    $sanitizer  = new Sanitizer($_POST, ['new-option' => 'trim|escape|capitalize']);
    $cleanedPost = $sanitizer->sanitize();
    $data['answers'][$cleanedPost['new-option']] = 1;
    $totalVotes++;
    saveVotes($dayOfYear, $data);
}

if ($_POST['vote']) {
    if (in_array($_POST['vote'], array_keys($data['answers']))) {
        // növeljük a kiválasztott választ 1-gyel
        $data['answers'][$_POST['vote']]++;
        $totalVotes++;
        saveVotes($dayOfYear, $data);
    }
    // TODO ha olyanra szavazott ami nem létezik akkor loggoljuk a választ és az IP címet és a timestampet
}

require './template.php';
