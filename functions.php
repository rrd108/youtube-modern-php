<?php

function saveVotes(int $dayOfYear, array $data): void
{
    // adat mentése a fileba // TODO a file jogosultság 666-on van, kell egy jobb megoldás
    $fp = fopen('./' . $dayOfYear . '.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}
