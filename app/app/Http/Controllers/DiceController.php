<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MyClasses\Dice\DiceDemonstration;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function App\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the dice route.
 */
class DiceController extends Controller
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new DiceDemonstration();
        $callable->demonstrate();

        $body = view("dice", [
            "header" => "Dice",
            "message" => "Here's a demonstration of my Dice-classes",
            "action" => url("/dice/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
            "diceHandRoll" => $_SESSION["diceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null
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
            ->withHeader("Location", url("/dice"));
    }
}
