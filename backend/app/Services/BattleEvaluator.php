<?php

namespace App\Services;

use App\Models\Platoon;

class BattleEvaluator
{
    public function evaluate(array $myPlatoons, array $enemyPlatoons): int
    {
        $wins = 0;
        for ($i = 0; $i < 5; $i++) {
            $result = $myPlatoons[$i]->resultAgainst($enemyPlatoons[$i]);
            if ($result === 'win') $wins++;
        }
        return $wins;
    }
}
