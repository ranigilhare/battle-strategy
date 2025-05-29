<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Army;
use App\Services\BattlePlanner;

class BattleCommand extends Command
{
    protected $signature = 'battle:simulate 
        {myArmy : Your platoons (e.g. Spearmen#10;Militia#30;...)} 
        {opponentArmy : Opponent platoons (e.g. Militia#10;Spearmen#10;...)}';

    protected $description = 'Simulate battle and find optimal attack order';

    public function handle()
    {
        $myArmyInput = $this->argument('myArmy');
        $opponentArmyInput = $this->argument('opponentArmy');

        $myArmy = new Army($myArmyInput);
        $opponentArmy = new Army($opponentArmyInput);

        $planner = new BattlePlanner();
        $result = $planner->findWinningOrder($myArmy, $opponentArmy);

        if ($result === null) {
            $this->error('There is no chance of winning');
        } else {
            $output = implode(';', array_map(fn($platoon) => (string) $platoon, $result));
            $this->info($output);
        }
    }
}
