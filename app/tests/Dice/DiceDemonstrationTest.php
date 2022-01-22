<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\DiceDemonstration;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class DiceDemonstration.
 */
class DiceDemonstrationTest extends TestCase
{
    /**
     * Verify the dicedemonstration object
     */
    public function testDiceDemonstration()
    {
        session_start();

        $diceDemonstration = new DiceDemonstration();
        $this->assertInstanceOf("\App\MyClasses\Dice\DiceDemonstration", $diceDemonstration);

        destroySession();
    }

    /**
     * Verify the dicedemonstration rolls are Int.
     */
    public function testDiceDemonstrationIsInt()
    {
        session_start();

        $diceDemonstration = new DiceDemonstration();
        $diceDemonstration->demonstrate();
        $this->assertIsInt($_SESSION["dieLastRoll"]);
        $this->assertIsInt($_SESSION["graphicalDieLastRoll"]);

        destroySession();
    }

    /**
     * Verify the dicedemonstration gives the desired results with controlled inputs.
     */
    public function testDiceDemonstrationIsSet()
    {
        session_start();

        $diceDemonstration = new DiceDemonstration();
        $_SESSION["numberOfFaces"] = 1;
        $_SESSION["numberOfDice"] = 4;
        $diceDemonstration->demonstrate();
        $dieLastRoll = $_SESSION["dieLastRoll"];
        $graphicalDieLastRoll = $_SESSION["graphicalDieLastRoll"];
        $diceHandRoll = $_SESSION["diceHandRoll"];
        $diceHandClass = $_SESSION["diceHandClass"];

        $this->assertIsInt($dieLastRoll);
        $this->assertIsInt($graphicalDieLastRoll);
        $this->assertEquals(1, $dieLastRoll);
        $this->assertEquals("1, 1, 1, 1", $diceHandRoll);
        $this->assertEquals("<i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i>", $diceHandClass);

        destroySession();
    }
}
