<?php

namespace App\Models;

class Army
{
    /** @var Platoon[] */
    public array $platoons;

    public function __construct(string $input)
    {
        $this->platoons = [];
        $units = explode(';', $input);
        foreach ($units as $unit) {
            [$type, $count] = explode('#', $unit);
            $this->platoons[] = new Platoon($type, (int) $count);
        }
    }

    public function getPermutations(): array
    {
        return $this->permute($this->platoons);
    }

    private function permute(array $items): array
    {
        if (count($items) <= 1) {
            return [$items];
        }

        $permutations = [];
        foreach ($items as $index => $item) {
            $remaining = $items;
            unset($remaining[$index]);
            foreach ($this->permute(array_values($remaining)) as $permutation) {
                array_unshift($permutation, $item);
                $permutations[] = $permutation;
            }
        }
        return $permutations;
    }
}
