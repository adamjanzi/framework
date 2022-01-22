<?php

declare(strict_types=1);

namespace App\MyClasses\Dice;

use App\MyClasses\Dice\Dice;
use App\MyClasses\Dice\GraphicalDice;
use App\MyClasses\Dice\DiceHand;

//use function Adja20\Functions\{
//    renderView,
//    url
//};

/**
 * Class DiceDemonstration.
 */
class DiceDemonstration
{
    public function demonstrate(): void
    {
        //$data = [
        //    "header" => "Dice",
        //    "message" => "Here's a demonstration of my Dice-classes",
        //    "action" => url("/dice/process"),
        //    "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
        //    "numberOfDice" => $_SESSION["numberOfDice"] ?? null
        //];

        $graphicalDiceSides = 6;
        $diceHand = "";

        $die = new Dice();
        $graphicalDie = new GraphicalDice();

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

        $_SESSION["dieLastRoll"] = $die->getLastRoll();
        $_SESSION["graphicalDieLastRoll"] = $graphicalDie->getLastRoll();
        $_SESSION["class"] = $graphicalDie->graphic();
        $_SESSION["diceHandRoll"] = $diceHand->getLastRoll();
        $_SESSION["diceHandClass"] = $diceHand->getLastClass();

        //$body = renderView("layout/dice.php", $data);
        //sendResponse($body);
    }
}
