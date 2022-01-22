<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\DiceHand;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Verify the dicehand object
     */
    public function testDiceHand()
    {
        session_start();

        $diceHand = new DiceHand(2);
        $this->assertInstanceOf("\App\MyClasses\Dice\DiceHand", $diceHand);

        destroySession();
    }
    /**
     * Verify that the dicehand gets the last roll.
     */
    public function testDiceHandGetLastRoll()
    {
        session_start();

        $numberOfDice = 1;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastRollRes = $diceHand->getLastRoll();
        $exp = "1";
        $res = $lastRollRes;
        $this->assertEquals($exp, $res);

        $numberOfDice = 2;
        $numberOfSides = 1;
        $diceHand2 = new DiceHand($numberOfDice);
        $diceHand2->roll($numberOfSides);
        $lastRollRes2 = $diceHand2->getLastRoll();
        $exp2 = "1, 1";
        $res2 = $lastRollRes2;
        $this->assertEquals($exp2, $res2);

        destroySession();
    }

    /**
     * Verify that the dicehand gets the last roll sum.
     */
    public function testDiceHandGetLastRollSum()
    {
        session_start();

        $numberOfDice = 7;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastRollSumRes = $diceHand->getLastRollSum();
        $exp = 7;
        $res = $lastRollSumRes;
        $this->assertEquals($exp, $res);

        destroySession();
    }

    /**
     * Verify that the dicehand gets the correct graphic class.
     */
    public function testDiceHandGetLastClass()
    {
        session_start();

        $numberOfDice = 3;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastClassRes = $diceHand->getLastClass();
        $exp = "<i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i>";
        $res = $lastClassRes;
        $this->assertEquals($exp, $res);

        destroySession();
    }
}
