<?php

declare(strict_types=1);

namespace App\MyClasses\Dice;

/**
 * Class Dice.
 */
class Dice
{
    private ?int $roll = null;

    public function roll($numberOfSides): int
    {
        $this->roll = rand(1, $numberOfSides);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
