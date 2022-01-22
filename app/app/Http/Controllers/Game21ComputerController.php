<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MyClasses\Dice\Game21computer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function App\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the game21computer route.
 */
class Game21ComputerController extends Controller
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game21computer();
        $callable->playGame21();

        $body = view("game21computer", [
            "header" => "Game 21",
            "action" => url("/game21computer/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
            "totalScore" => $_SESSION["totalScore"] ?? 0,
            "diceHandRoll" => $_SESSION["diceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null,
            "computerTotalScore" => $_SESSION["computerTotalScore"] ?? 0,
            "scoreMessage" => $_SESSION["scoreMessage"] ?? null
            ]);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        $_SESSION["numberOfFaces"] = $_POST["content"] ?? null;
        $_SESSION["numberOfDice"] = $_POST["content1"] ?? null;

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21computer"));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21computer"));
    }

    public function newround(): ResponseInterface
    {
        $_SESSION["totalScore"] = 0;

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }
}
