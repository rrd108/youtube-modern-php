<?php
use \Waavi\Sanitizer\Sanitizer;

require './vendor/autoload.php';
require './functions.php';

//$dayOfYear = date('z') + 1;   // TODO amint van minden napra kérdés ezt cseréljük vissza
$dayOfYear = 213;
$data = json_decode(file_get_contents('./' . $dayOfYear . '.json'));


// a $data->answers-t tömbbé alakítjuk
$answers = (array) $data->answers;
$data = (array) $data;
$data['answers'] = $answers;
$totalVotes = array_sum($data['answers']);
$possibleAnswers = [
    'Ember',
    'Backbone',
    'Semantic-UI',
    'Foundation',
    'Preact',
    'LitElement',
    'Alpine',
    'Flutter',
    'Stencil',
    'AppRun',
    'Dojo',
    'HyperApp',
    'Elm',
    'Imba',
    'CrizmasMVC',
    'Aurelia',
    'Re-frame',
    'Redux',
    'Mobx',
    'Keechma'
];

// jött-e új option
if (isset($_POST['new-option']) && in_array($_POST['new-option'], $possibleAnswers)) {
    /**
     * TODO lehetséges problémák
     *      brute force
     */
    $filters = [
        'new-option'    =>  'trim|escape|capitalize',
    ];
    $sanitizer  = new Sanitizer($_POST, $filters);
    $newOption = $sanitizer->sanitize();
    $data['answers'][$newOption['new-option']] = 1;
    saveVotes($dayOfYear, $data);
} else {
    // TODO ha olyanra szavazott ami nem létezik akkor loggoljuk a választ és az IP címet és a timestampet
}

if (isset($_POST['vote']) && in_array($_POST['vote'], array_keys($data['answers']))) {
    // növeljük a kiválasztott választ 1-gyel
    $data['answers'][$_POST['vote']]++;
    saveVotes($dayOfYear, $data);
    // Az oldal frissítésekor felmerülő szavazatküldés elkerülése, így nem kerülnek be fantom adatok a fájlba
    if ( isset( $_POST ) ){
        header( 'location:'.$_SERVER['PHP_SELF'] );
        die();
       }
}
// TODO ha olyanra szavazott ami nem létezik akkor loggoljuk a választ és az IP címet és a timestampet
require './template.php';
