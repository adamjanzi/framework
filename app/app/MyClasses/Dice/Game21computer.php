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
 * Class Game21computer.
 */
class Game21computer
{
    public function playGame21(): void
    {
        //$data = [
        //    "header" => "Game 21",
        //    "action" => url("/game21computer/process"),
        //    "computerTotalScore" => $_SESSION["computerTotalScore"] ?? 0
        //];

        $scoreMessage = "";
        $diceHand = "";

        if (!isset($_SESSION["scoreTest"])) {
            $_SESSION["scoreTest"] = 0;
        }

        $scoreTest = $_SESSION["scoreTest"];

        if (!isset($_SESSION["computerTotalScore"])) {
            $_SESSION["computerTotalScore"] = 0;
        }

        if (!isset($_SESSION["totalScore"])) {
            $_SESSION["totalScore"] = 0;
        }

        if (!isset($_SESSION["computerRoundScore"])) {
            $_SESSION["computerRoundScore"] = 0;
        }

        if (!isset($_SESSION["roundScore"])) {
            $_SESSION["roundScore"] = 0;
        }

        if (isset($_SESSION["numberOfComputerDice"])) {
            $diceHand = new DiceHand($_SESSION["numberOfComputerDice"]);
        }

        if (!isset($_SESSION["numberOfComputerDice"])) {
            $diceHand = new DiceHand(1);
        }

        for ($_SESSION["computerTotalScore"] = 0; $_SESSION["computerTotalScore"] < 21; $_SESSION["computerTotalScore"] += $diceHand->getLastRollSum()) {
            if (isset($_SESSION["numberOfComputerDiceFaces"])) {
                $diceHand->roll($_SESSION["numberOfComputerDiceFaces"]);
            } else if (!isset($_SESSION["numberOfComputerDiceFaces"])) {
                $diceHand->roll(6);
            }
            $_SESSION["computerTotalScore"] += $diceHand->getLastRollSum();

            if ($_SESSION["computerTotalScore"] == $_SESSION["totalScore"]) {
                break;
            } else if ($_SESSION["computerTotalScore"] > $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] < 21) {
                break;
            } else if ($_SESSION["computerTotalScore"] > 21) {
                break;
            } else if ($scoreTest == 1) {
                break;
            }
        }

        $scoreMessage = "";

        if ($_SESSION["computerTotalScore"] > 21) {
            $scoreMessage = "YOU WON!";
            $_SESSION["roundScore"] += 1;
        } else if ($_SESSION["computerTotalScore"] == $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] != 21) {
            $scoreMessage = "YOU LOSE!";
            $_SESSION["computerRoundScore"] += 1;
        } else if ($_SESSION["computerTotalScore"] > $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] < 21) {
            $scoreMessage = "YOU LOSE!";
            $_SESSION["computerRoundScore"] += 1;
        }

        $_SESSION["diceHandRollSum"] = $diceHand->getLastRollSum();
        $_SESSION["scoreMessage"] = $scoreMessage;


        //$body = renderView("layout/game21computer.php", $data);
        //sendResponse($body);
    }
}
