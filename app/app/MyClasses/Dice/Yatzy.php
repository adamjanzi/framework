<?php

declare(strict_types=1);

namespace App\MyClasses\Dice;

use App\MyClasses\Dice\Dice;
use App\MyClasses\Dice\GraphicalDice;
use App\MyClasses\Dice\YatzyDiceHand;

use function App\Functions\{
    renderView,
    url
};

/**
 * Class Yatzy.
 */
class Yatzy
{
    public function playYatzy(): void
    {
        //$data = [
        //    "header" => "Game 21",
        //    "message" => "Welcome to Game 21!",
        //    "action" => url("/game21/process"),
        //    "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
        //    "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
        //    "totalScore" => $_SESSION["totalScore"] ?? 0
        //];

        $graphicalDiceSides = 6;
        $scoreMessage = "";
        if (!isset($_SESSION["yatzyScore"])) {
            $_SESSION["yatzyScore"][0] = 0;
            $_SESSION["yatzyScore"][1] = 0;
            $_SESSION["yatzyScore"][2] = 0;
            $_SESSION["yatzyScore"][3] = 0;
            $_SESSION["yatzyScore"][4] = 0;
            $_SESSION["yatzyScore"][5] = 0;
        }
        if (!isset($_SESSION["scoreIndex"])) {
            $_SESSION["scoreIndex"] = 0;
        }
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
        if (!isset($_SESSION["scoreIndexMessage"])) {
            $_SESSION["scoreIndexMessage"] = "Ones";
        } else if ($_SESSION["scoreIndex"] == 1) {
            $_SESSION["scoreIndexMessage"] = "Twos";
        } else if ($_SESSION["scoreIndex"] == 2) {
            $_SESSION["scoreIndexMessage"] = "Threes";
        } else if ($_SESSION["scoreIndex"] == 3) {
            $_SESSION["scoreIndexMessage"] = "Fours";
        } else if ($_SESSION["scoreIndex"] == 4) {
            $_SESSION["scoreIndexMessage"] = "Fives";
        } else if ($_SESSION["scoreIndex"] == 5) {
            $_SESSION["scoreIndexMessage"] = "Sixes";
        }
        if (!isset($_SESSION["bonus"])) {
            $_SESSION["bonus"] = 0;
        }

        $die = new Dice();
        $graphicalDie = new GraphicalDice();

        $die->roll(6);

        $graphicalDie->roll($graphicalDiceSides);

        $diceHand = new YatzyDiceHand(5);

        $diceHand->roll(6);

        $_SESSION["rollQueue"] += 1;

        if ($_SESSION["rollQueue"] == 4) {
            $_SESSION["rollQueue"] = 1;
        }


        $_SESSION["dieLastRoll"] = $die->getLastRoll();
        $_SESSION["graphicalDieLastRoll"] = $graphicalDie->getLastRoll();
        $_SESSION["class"] = $graphicalDie->graphic();
        $_SESSION["yatzyDiceHandRoll"] = $diceHand->getLastRoll();
        $_SESSION["yatzyDiceHandRollGraphic"] = $diceHand->getLastClass();
        $_SESSION["diceHandClass"] = $diceHand->getLastClass();
        $_SESSION["diceHandRollSum"] = $diceHand->getLastRollSum();
        $_SESSION["scoreMessage"] = $scoreMessage;
        $_SESSION["bonus"] = $diceHand->getBonus($_SESSION["diceHandRollSum"]);
        $_SESSION["yatzyTotalScore"] = $diceHand->getTotal(
            $_SESSION["rollQueue"],
            $_SESSION["scoreIndex"],
            $_SESSION["diceHandRollSum"],
            $_SESSION["bonus"]
        );
        $_SESSION["buttonValue"] = $diceHand->getButtonValue($_SESSION["scoreIndex"]);
        $_SESSION["message"] = $diceHand->getMessage($_SESSION["scoreIndex"], $_SESSION["rollQueue"]);
        $_SESSION["checkboxStatus"] = $diceHand->changeCheckbox($_SESSION["scoreIndex"], $_SESSION["rollQueue"]);

        //$body = renderView("layout/game21.php", $data);
        //sendResponse($body);
    }
}
