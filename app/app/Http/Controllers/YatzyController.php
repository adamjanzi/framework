<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MyClasses\Dice\Yatzy;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function App\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the yatzy route.
 */
class YatzyController extends Controller
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $callable->playYatzy();

        $body = view("yatzy", [
            "header" => "Yatzy",
            "message" => $_SESSION["message"] ?? null,
            "action" => url("/yatzy/process"),
            "yatzyDiceHandRoll" => $_SESSION["yatzyDiceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null,
            "diceHandRollSum" => $_SESSION["diceHandRollSum"] ?? null,
            "yatzyDiceHandRollGraphic" => $_SESSION["yatzyDiceHandRollGraphic"] ?? null,
            "bonus" => $_SESSION["bonus"] ?? null,
            "yatzyTotalScore" => $_SESSION["yatzyTotalScore"] ?? null,
            "buttonValue" => $_SESSION["buttonValue"] ?? null,
            "checkboxStatus" => $_SESSION["checkboxStatus"] ?? null
            ]);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        if ($_SESSION["scoreIndex"] == 6) {
            destroySession();
        } else if ($_SESSION["scoreIndex"] != 6) {
            $_SESSION["rollArray"][0] = $_POST["roll1"] ?? 1;
            $_SESSION["rollArray"][1] = $_POST["roll2"] ?? 1;
            $_SESSION["rollArray"][2] = $_POST["roll3"] ?? 1;
            $_SESSION["rollArray"][3] = $_POST["roll4"] ?? 1;
            $_SESSION["rollArray"][4] = $_POST["roll5"] ?? 1;
        }

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
