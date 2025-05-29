<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Army;
use App\Services\BattlePlanner;

class BattleController extends Controller
{
    public function simulate(Request $request)
    {
        $request->validate([
            'own_platoon' => 'required|string',
            'opponent_platoon'  => 'required|string',
        ]);

        $myArmy = new Army($request->input('own_platoon'));
        $opponentArmy = new Army($request->input('opponent_platoon'));

        $planner = new BattlePlanner();
        $result = $planner->findWinningOrder($myArmy, $opponentArmy);

        if (!$result) {
            return response()->json(['status' => 'error','message' => 'There is no chance of winning']);
        }

        $output = implode(';', array_map(fn($p) => (string) $p, $result));
        return response()->json(['status' => 'success', 'message' => "Winning Order: " .$output]);


    }
}