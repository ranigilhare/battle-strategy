<?php

namespace App\Models;

class PlatoonAdvantages
{
    public static array $advantages = [
        'Militia' => ['Spearmen', 'LightCavalry'],
        'Spearmen' => ['LightCavalry', 'HeavyCavalry'],
        'LightCavalry' => ['FootArcher', 'CavalryArcher'],
        'HeavyCavalry' => ['Militia', 'FootArcher', 'LightCavalry'],
        'CavalryArcher' => ['Spearmen', 'HeavyCavalry'],
        'FootArcher' => ['Militia', 'CavalryArcher'],
    ];

    public static function getAdvantages(string $type): array
    {
        return self::$advantages[$type] ?? [];
    }
}
