<?php

namespace App\Services;

use App\Models\Army;
use App\Services\BattleEvaluator;

class BattlePlanner
{
    protected BattleEvaluator $evaluator;

    public function __construct()
    {
        $this->evaluator = new BattleEvaluator();
    }

    public function findWinningOrder(Army $myArmy, Army $enemyArmy): ?array
    {
        $enemyPlatoons = $enemyArmy->platoons;

        foreach ($myArmy->getPermutations() as $myPlatoons) {
            if ($this->evaluator->evaluate($myPlatoons, $enemyPlatoons) >= 3) {
                return $myPlatoons;
            }
        }

        return null;
    }
}
