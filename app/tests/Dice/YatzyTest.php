<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\Yatzy;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class Yatzy.
 */
class YatzyTest extends TestCase
{
    /**
     * Verify the yatzy object
     */
    public function testYatzy()
    {
        session_start();

        $yatzy = new Yatzy();
        $this->assertInstanceOf("\App\MyClasses\Dice\Yatzy", $yatzy);

        destroySession();
    }

    /**
     * Verify that the yatzy scoreindexmessage gives you the correct output depending on the scoreindex.
     */
    public function testYatzyScoreIndexMessage()
    {
        session_start();

        $yatzy = new Yatzy();
        $yatzy->playYatzy();
        $this->assertIsInt($_SESSION["scoreIndex"]);
        $this->assertEquals(0, $_SESSION["scoreIndex"]);
        $this->assertIsString($_SESSION["scoreIndexMessage"]);
        $this->assertEquals("Ones", $_SESSION["scoreIndexMessage"]);

        $_SESSION["scoreIndex"] = 1;
        $yatzy2 = new Yatzy();
        $yatzy2->playYatzy();
        $this->assertEquals("Twos", $_SESSION["scoreIndexMessage"]);

        $_SESSION["scoreIndex"] = 2;
        $yatzy3 = new Yatzy();
        $yatzy3->playYatzy();
        $this->assertEquals("Threes", $_SESSION["scoreIndexMessage"]);

        $_SESSION["scoreIndex"] = 3;
        $yatzy4 = new Yatzy();
        $yatzy4->playYatzy();
        $this->assertEquals("Fours", $_SESSION["scoreIndexMessage"]);

        $_SESSION["scoreIndex"] = 4;
        $yatzy5 = new Yatzy();
        $yatzy5->playYatzy();
        $this->assertEquals("Fives", $_SESSION["scoreIndexMessage"]);

        $_SESSION["scoreIndex"] = 5;
        $yatzy6 = new Yatzy();
        $yatzy6->playYatzy();
        $this->assertEquals("Sixes", $_SESSION["scoreIndexMessage"]);

        destroySession();
    }

    /**
     * Verify that the yatzy rollqueue gives you the correct output depending on the rollqueue value.
     */
    public function testYatzyRollQueue()
    {
        session_start();

        $yatzy = new Yatzy();
        $_SESSION["rollQueue"] = 3;
        $yatzy->playYatzy();
        $this->assertEquals(1, $_SESSION["rollQueue"]);

        destroySession();
    }
}
