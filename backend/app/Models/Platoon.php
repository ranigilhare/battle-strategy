<?php

namespace App\Models;

class Platoon
{
    public string $type;
    public int $count;

    public function __construct(string $type, int $count)
    {
        $this->type = $type;
        $this->count = $count;
    }

    public function effectivePowerAgainst(Platoon $opponent): float
    {
        if (in_array($opponent->type, PlatoonAdvantages::getAdvantages($this->type))) {
            return $this->count * 2;
        }
        return $this->count;
    }

    public function resultAgainst(Platoon $opponent): string
    {
        $power = $this->effectivePowerAgainst($opponent);
        if ($power > $opponent->count) return 'win';
        if ($power < $opponent->count) return 'lose';
        return 'draw';
    }

    public function __toString(): string
    {
        return "{$this->type}#{$this->count}";
    }
}
