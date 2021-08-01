<?php
//$dayOfYear = date('z') + 1;   // TODO amint van minden napra kérdés ezt cseréljük vissza
$dayOfYear = 213;
$data = json_decode(file_get_contents('./' . $dayOfYear . '.json'));
// a $data->answers-t tömbbé alakítjuk
$answers = (array) $data->answers;
$data = (array) $data;
$data['answers'] = $answers;
$totalVotes = array_sum($data['answers']);

if ($_POST['vote']) {
    if (in_array($_POST['vote'], array_keys($data['answers']))) {
        // növeljük a kiválasztott választ 1-gyel
        $data['answers'][$_POST['vote']]++;
        // adat mentése a fileba // TODO a file jogosultság 666-on van, kell egy jobb megoldás
        $fp = fopen('./' . $dayOfYear . '.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }
    // TODO ha olyanra szavazott ami nem létezik akkor loggoljuk a választ és az IP címet és a timestampet
}

require './template.php';
