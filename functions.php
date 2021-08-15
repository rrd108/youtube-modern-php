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

function setRankColor($totalVotes, $votesOfItem) {
    $percent = calculatePercent($totalVotes, $votesOfItem);
    switch ($percent) {
        case ($percent < 10):
            return "var(--rank10)";
            break;
        
        case ($percent >= 10 && $percent < 20):
            return "var(--rank9)";
            break;
        
        case ($percent >= 20 && $percent < 30):
            return "var(--rank8)";
            break;
        
        case ($percent >= 30 && $percent < 40):
            return "var(--rank7)";
            break;
        
        case ($percent >= 40 && $percent < 50):
            return "var(--rank6)";
            break;
        
        case ($percent >= 50 && $percent < 60):
            return "var(--rank5)";
            break;
        
        case ($percent >= 60 && $percent < 70):
            return "var(--rank4)";
            break;
        
        case ($percent >= 70 && $percent < 80):
            return "var(--rank3)";
            break;
        
        case ($percent >= 80 && $percent < 90):
            return "var(--rank2)";
            break;
        
        case ($percent >= 90):
            return "var(--rank1)";
            break;
        
        default:
            var_dump('Error: Wrong rank or color!');
            break;
    }
}