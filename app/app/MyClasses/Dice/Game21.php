<?php

declare(strict_types=1);

namespace Adja20\Dice;

use Adja20\Dice\Dice;
use Adja20\Dice\GraphicalDice;
use Adja20\Dice\DiceHand;

use function Adja20\Functions\{
    renderView,
    url
};

/**
 * Class Game21.
 */
class Game21
{
    public function playGame21(): void
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
        $diceHand = "";

        $die = new Dice();
        $graphicalDie = new GraphicalDice();

        if (!isset($_SESSION["totalScore"])) {
            $_SESSION["totalScore"] = 0;
        }

        if (!isset($_SESSION["roundScore"])) {
            $_SESSION["roundScore"] = 0;
        }

        if (!isset($_SESSION["computerRoundScore"])) {
            $_SESSION["computerRoundScore"] = 0;
        }


        if (isset($_SESSION["numberOfFaces"])) {
            $die->roll(intval($_SESSION["numberOfFaces"]));
        }

        if (!isset($_SESSION["numberOfFaces"])) {
            $die->roll(6);
        }

        $graphicalDie->roll($graphicalDiceSides);

        if (isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(intval($_SESSION["numberOfDice"]));
        }

        if (!isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(1);
        }

        if (isset($_SESSION["numberOfFaces"])) {
            $diceHand->roll(intval($_SESSION["numberOfFaces"]));
        }

        if (!isset($_SESSION["numberOfFaces"])) {
            $diceHand->roll(6);
        }

        $_SESSION["totalScore"] += $diceHand->getLastRollSum();

        if ($_SESSION["totalScore"] > 21) {
            $scoreMessage = "YOU LOST! Roll to start again.";
            $_SESSION["computerRoundScore"] += 1;
            $_SESSION["totalScore"] = 0;
            $_SESSION["computerTotalScore"] = 0;
        } else if ($_SESSION["totalScore"] == 21) {
            $scoreMessage = "CONGRATULATIONS! Roll to start again.";
            $_SESSION["roundScore"] += 1;
            $_SESSION["totalScore"] = 0;
            $_SESSION["computerTotalScore"] = 0;
        } else if ($_SESSION["totalScore"] < 21) {
            $scoreMessage = "";
            $_SESSION["computerTotalScore"] = 0;
        }

        $_SESSION["dieLastRoll"] = $die->getLastRoll();
        $_SESSION["graphicalDieLastRoll"] = $graphicalDie->getLastRoll();
        $_SESSION["class"] = $graphicalDie->graphic();
        $_SESSION["diceHandRoll"] = $diceHand->getLastRoll();
        $_SESSION["diceHandClass"] = $diceHand->getLastClass();
        $_SESSION["diceHandRollSum"] = $diceHand->getLastRollSum();
        $_SESSION["scoreMessage"] = $scoreMessage;

        //$body = renderView("layout/game21.php", $data);
        //sendResponse($body);
    }
}
