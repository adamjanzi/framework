<?php

declare(strict_types=1);

namespace Adja20\Dice;

/**
 * Class YatzyDiceHand.
 */
class YatzyDiceHand
{
    private $dices = [];
    private int $sum;
    private $classSum = [];
    private $rollArray = [0, 1, 2, 3, 4];
    private $rollResult = [];
    private int $yatzySum = 0;

    public function __construct($numberOfDice)
    {
        for ($i = 0; $i < $numberOfDice; $i++) {
            $this->dices[$i] = new GraphicalDice();
        }
    }

    public function roll($numberOfSides): void
    {
        if (!isset($_SESSION["rollArray"])) {
            $_SESSION["rollArray"][0] = 1;
            $_SESSION["rollArray"][1] = 1;
            $_SESSION["rollArray"][2] = 1;
            $_SESSION["rollArray"][3] = 1;
            $_SESSION["rollArray"][4] = 1;
        }

        if (!isset($_SESSION["rollQueue"])) {
            $_SESSION["rollQueue"] = 0;
        }

        $len = 5;
        $rollArray[0] = $_SESSION["rollArray"][0];
        $rollArray[1] = $_SESSION["rollArray"][1];
        $rollArray[2] = $_SESSION["rollArray"][2];
        $rollArray[3] = $_SESSION["rollArray"][3];
        $rollArray[4] = $_SESSION["rollArray"][4];

        $this->sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $this->dices[$this->rollArray[$i]]->roll($numberOfSides);
            $this->classSum[$i] = $this->dices[$this->rollArray[$i]]->graphic();
        }
    }

    public function getLastRoll(): array
    {
        for ($i = 0; $i < 5; $i++) {
            if ($_SESSION["rollArray"][$i] == 1) {
                $this->rollResult[$i] = $this->dices[$i]->getLastRoll();
            } else if ($_SESSION["rollArray"][$i] == 0) {
                $this->rollResult[$i] = $_SESSION["yatzyDiceHandRoll"][$i];
            }
        }

        if ($_SESSION["rollQueue"] == 3) {
            for ($i = 0; $i < 5; $i++) {
                if ($this->rollResult[$i] == ($_SESSION["scoreIndex"] + 1)) {
                    $this->sum += $this->rollResult[$i];
                }
            }
            $_SESSION["yatzyScore"][$_SESSION["scoreIndex"]] = $this->sum;
            $_SESSION["scoreIndex"] += 1;
        }

        return $this->rollResult;
    }

    public function getLastRollSum(): int
    {
        for ($i = 0; $i < 6; $i++) {
            $this->yatzySum += $_SESSION["yatzyScore"][$i];
        }
        return intval($this->yatzySum);
    }

    public function getLastClass(): array
    {
        $classRes = [];

        for ($i = 0; $i < 5; $i++) {
            if ($_SESSION["rollArray"][$i] == 1) {
                $classRes[$i] = "<i class='" . $this->dices[$i]->graphic() . "'></i>";
            } else if ($_SESSION["rollArray"][$i] == 0) {
                $classRes[$i] = $_SESSION["yatzyDiceHandRollGraphic"][$i];
            }
        }

        return $classRes;
    }
    public function getBonus($score): int
    {
        $bonus = 0;
        if ($score > 62) {
            $bonus = 35;
        }

        return $bonus;
    }

    public function getTotal($queue, $index, $rollSum, $bonus): int
    {
        $total = 0;
        if ($index == 6 && $queue == 3) {
            $total = $rollSum + $bonus;
        }

        return $total;
    }

    public function getButtonValue($index): string
    {
        $buttonValue = "Press To Roll";
        if ($index == 6) {
            $buttonValue = "Press To Play Again";
        }

        return $buttonValue;
    }

    public function getMessage($index, $queue): string
    {
        $message = "Select which dice to hold:";

        if ($index == 6) {
            $message = "Round finished! Wanna play again? Press the button to play more!";
        } else if ($queue == 3) {
            $message = "";
        }

        return $message;
    }

    public function changeCheckbox($index, $queue): string
    {
        $checkboxStatus = "enabled";
        if ($index == 6 || $queue == 3) {
            $checkboxStatus = "disabled";
        } else if ($index != 6 && $queue != 3){
            $checkboxStatus = "enabled";
        }

        return $checkboxStatus;
    }
}
