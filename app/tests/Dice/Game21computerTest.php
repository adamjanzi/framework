<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\Game21computer;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class Game21computer.
 */
class Game21computerTest extends TestCase
{
    /**
     * Verify the game21computer object
     */
    public function testGame21computer()
    {
        session_start();

        $game21computer = new Game21computer();
        $this->assertInstanceOf("\App\MyClasses\Dice\Game21computer", $game21computer);

        destroySession();
    }

    /**
     * Verify the game21computer rolls return Int
     */
    public function testGame21computerIsInt()
    {
        session_start();

        $game21computer = new Game21computer();
        $game21computer->playGame21();
        $this->assertIsInt($_SESSION["totalScore"]);
        $this->assertIsInt($_SESSION["computerTotalScore"]);
        $this->assertIsInt($_SESSION["roundScore"]);
        $this->assertIsInt($_SESSION["computerRoundScore"]);
        $this->assertIsInt($_SESSION["diceHandRollSum"]);

        destroySession();
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring higher than 21.
     */
    public function testGame21computerScoresOver21()
    {
        session_start();

        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 22;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $game21computer->playGame21();
        $roundScore = $_SESSION["roundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU WON!";
        $roundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($roundScoreExp, $roundScore);

        destroySession();
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring the same as player and not 21.
     */
    public function testGame21computerScoresSameAsPlayerNot21()
    {
        session_start();

        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 2;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 2;
        $game21computer->playGame21();
        $compRoundScore = $_SESSION["computerRoundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU LOSE!";
        $compRoundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($compRoundScoreExp, $compRoundScore);

        destroySession();
    }

     /**
     * Verify that the game21computer scores give the desired results upon computer scoring higher than player and not 21.
     */
    public function testGame21computerScoresHigherThanPlayerNot21()
    {
        session_start();

        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 13;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 3;
        $game21computer->playGame21();
        $compRoundScore = $_SESSION["computerRoundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU LOSE!";
        $compRoundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($compRoundScoreExp, $compRoundScore);

        destroySession();
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring lower than the player.
     */
    public function testGame21computerScoresLowerThanPlayer()
    {
        session_start();

        $game21computer = new Game21computer();
        $_SESSION["scoreTest"] = 1;
        $_SESSION["numberOfComputerDice"] = 2;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 5;
        $game21computer->playGame21();
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "";

        $this->assertEquals($scoreMessageExp, $scoreMessage);

        destroySession();
    }
}
