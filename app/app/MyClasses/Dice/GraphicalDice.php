<?php

declare(strict_types=1);

namespace App\MyClasses\Dice;

/**
 * Class GraphicalDice.
 */
class GraphicalDice extends Dice
{
    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
