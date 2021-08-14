<?php

function saveVotes($dayOfYear, $data)
{
    // adat mentése a fileba // TODO a file jogosultság 666-on van, kell egy jobb megoldás
    $fp = fopen('./' . $dayOfYear . '.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}

function calculatePercent($totalVotes, $votesOfItem) 
{
    // 0-val való osztás elkerülése
    if ($totalVotes < 1) {
        return 0;
    }
    $result = $votesOfItem * 100  / $totalVotes;
    return round($result);
}