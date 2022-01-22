<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\GraphicalDice;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class GraphicalDice.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Verify the graphicaldice object
     */
    public function testGraphicalDice()
    {
        session_start();

        $graphicalDice = new GraphicalDice();
        $this->assertInstanceOf("\App\MyClasses\Dice\GraphicalDice", $graphicalDice);

        destroySession();
    }

    /**
     * Verify that it returns the correct string for the graphic with one side.
     */
    public function testDiceGraphicOneSide()
    {
        session_start();

        $graphicalDice = new GraphicalDice();
        $graphicalDice->roll(1);
        $exp = "dice-1";
        $res = $graphicalDice->graphic();
        $this->assertEquals($exp, $res);

        destroySession();
    }

    /**
     * Verify that it returns the correct string for the graphic with multiple sides.
     */
    public function testDiceGraphicMultipleSides()
    {
        session_start();

        $graphicalDice = new GraphicalDice();
        $graphicalDice->roll(6);
        $graphDiceLastRoll = $graphicalDice->getLastRoll();
        $exp = "dice-" . $graphDiceLastRoll;
        $res = $graphicalDice->graphic();
        $this->assertEquals($exp, $res);

        destroySession();
    }
}
