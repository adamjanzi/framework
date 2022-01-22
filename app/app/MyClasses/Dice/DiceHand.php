<?php

declare(strict_types=1);

namespace App\MyClasses\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private $dices = [];
    private int $sum;
    private $classSum = [];

    public function __construct($numberOfDice)
    {
        for ($i = 0; $i < $numberOfDice; $i++) {
            $this->dices[$i] = new GraphicalDice();
        }
    }

    public function roll($numberOfSides): void
    {
        $len = count($this->dices);

        $this->sum = 0;
        $this->classSum = [];
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->dices[$i]->roll($numberOfSides);
            $this->classSum = $this->dices[$i]->graphic();
        }
    }

    public function getLastRoll(): string
    {
        $len = count($this->dices);
        $res = "";

        for ($i = 0; $i < $len; $i++) {
            if ($i == ($len - 1)) {
                $res .= $this->dices[$i]->getLastRoll();
            } else if ($i != $len) {
                $res .= $this->dices[$i]->getLastRoll() . ", ";
            }
        }

        return $res;
    }

    public function getLastRollSum(): int
    {
        return $this->sum;
    }

    public function getLastClass(): string
    {
        $len = count($this->dices);
        $classRes = "";

        for ($i = 0; $i < $len; $i++) {
            $classRes .= "<i class='" . $this->dices[$i]->graphic() . "'></i>";
        }

        return $classRes;
    }
}
