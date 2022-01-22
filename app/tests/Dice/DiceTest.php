<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\Dice;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Verify the dice object
     */
    public function testDice()
    {
        session_start();

        $dice = new Dice();
        $this->assertInstanceOf("\App\MyClasses\Dice\Dice", $dice);

        destroySession();
    }
    /**
     * Verify that the rolling returns an int.
     */
    public function testDiceIntRoll()
    {
        session_start();

        $dice = new Dice();
        $this->assertIsInt($dice->roll(6));

        destroySession();
    }

    /**
     * Verify that the rolling doesn't return a number too high
     */
    public function testDiceRoll()
    {
        session_start();

        $dice = new Dice();
        $this->assertLessThanOrEqual(6, $dice->roll(6));

        destroySession();
    }

    /**
     * Verify that we can get the last roll
     */
    public function testDiceLastRoll()
    {
        session_start();

        $dice = new Dice();
        $dice->roll(1);
        $this->assertEquals(1, $dice->getLastRoll());

        destroySession();
    }
}
