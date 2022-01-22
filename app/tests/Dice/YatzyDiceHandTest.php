<?php

namespace Tests\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MyClasses\Dice\YatzyDiceHand;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for class YatzyDiceHand.
 */
class YatzyDiceHandTest extends TestCase
{
    /**
     * Verify the yatzydicehand object
     */
    public function testYatzyDiceHand()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(2);
        $this->assertInstanceOf("\App\MyClasses\Dice\YatzyDiceHand", $yatzyDiceHand);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct last roll, aswell as the correct score.
     */
    public function testYatzyDiceHandGetLastRoll()
    {
        session_start();

        $numberOfSides = 1;
        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyDiceHand->roll($numberOfSides);
        $lastRollRes = $yatzyDiceHand->getLastRoll();
        $exp = [1, 1, 1, 1, 1];
        $res = $lastRollRes;
        $this->assertEquals($exp, $res);

        $_SESSION["rollArray"][0] = 0;
        $_SESSION["rollArray"][1] = 0;
        $_SESSION["rollArray"][2] = 0;
        $_SESSION["rollArray"][3] = 0;
        $_SESSION["rollArray"][4] = 0;
        $_SESSION["yatzyDiceHandRoll"][0] = 9;
        $_SESSION["yatzyDiceHandRoll"][1] = 7;
        $_SESSION["yatzyDiceHandRoll"][2] = 5;
        $_SESSION["yatzyDiceHandRoll"][3] = 9;
        $_SESSION["yatzyDiceHandRoll"][4] = 3;
        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyDiceHand2->roll($numberOfSides);
        $lastRollRes2 = $yatzyDiceHand2->getLastRoll();
        $exp2 = [9, 7, 5, 9, 3];
        $res2 = $lastRollRes2;
        $this->assertEquals($exp2, $res2);

        $_SESSION["rollQueue"] = 3;
        $_SESSION["scoreIndex"] = 0;
        $_SESSION["rollArray"][0] = 0;
        $_SESSION["rollArray"][1] = 0;
        $_SESSION["rollArray"][2] = 0;
        $_SESSION["rollArray"][3] = 0;
        $_SESSION["rollArray"][4] = 0;
        $_SESSION["yatzyDiceHandRoll"][0] = 1;
        $_SESSION["yatzyDiceHandRoll"][1] = 2;
        $_SESSION["yatzyDiceHandRoll"][2] = 2;
        $_SESSION["yatzyDiceHandRoll"][3] = 1;
        $_SESSION["yatzyDiceHandRoll"][4] = 1;
        $_SESSION["yatzyScore"][0] = 0;
        $yatzyDiceHand3 = new YatzyDiceHand(5);
        $yatzyDiceHand3->roll($numberOfSides);
        $yatzyDiceHand3->getLastRoll();
        $yatzyScore = $_SESSION["yatzyScore"][0];
        $this->assertEquals(1, $_SESSION["scoreIndex"]);
        $this->assertEquals(3, $yatzyScore);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct last roll sum.
     */
    public function testYatzyDiceHandGetLastRollSum()
    {
        session_start();

        $numberOfSides = 1;
        $_SESSION["rollQueue"] = 3;
        $_SESSION["scoreIndex"] = 0;
        $_SESSION["rollArray"][0] = 0;
        $_SESSION["rollArray"][1] = 0;
        $_SESSION["rollArray"][2] = 0;
        $_SESSION["rollArray"][3] = 0;
        $_SESSION["rollArray"][4] = 0;
        $_SESSION["yatzyDiceHandRoll"][0] = 1;
        $_SESSION["yatzyDiceHandRoll"][1] = 1;
        $_SESSION["yatzyDiceHandRoll"][2] = 1;
        $_SESSION["yatzyDiceHandRoll"][3] = 1;
        $_SESSION["yatzyDiceHandRoll"][4] = 1;
        $_SESSION["yatzyScore"][0] = 0;
        $_SESSION["yatzyScore"][1] = 0;
        $_SESSION["yatzyScore"][2] = 0;
        $_SESSION["yatzyScore"][3] = 0;
        $_SESSION["yatzyScore"][4] = 0;
        $_SESSION["yatzyScore"][5] = 0;
        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyDiceHand->roll($numberOfSides);
        $yatzyDiceHand->getLastRoll();
        $lastRollSum = $yatzyDiceHand->getLastRollSum();
        $this->assertEquals(5, $lastRollSum);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct last class.
     */
    public function testYatzyDiceHandGetLastClass()
    {
        session_start();

        $numberOfSides = 1;
        $_SESSION["rollArray"][0] = 1;
        $_SESSION["rollArray"][1] = 1;
        $_SESSION["rollArray"][2] = 1;
        $_SESSION["rollArray"][3] = 1;
        $_SESSION["rollArray"][4] = 1;
        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyDiceHand->roll($numberOfSides);
        $yatzyDiceHand->getLastRoll();
        $lastClass = $yatzyDiceHand->getLastClass();
        $exp = ["<i class='dice-1'></i>", "<i class='dice-1'></i>", "<i class='dice-1'></i>", "<i class='dice-1'></i>", "<i class='dice-1'></i>"];
        $res = $lastClass;
        $this->assertEquals($exp, $res);

        $_SESSION["rollArray"][0] = 0;
        $_SESSION["rollArray"][1] = 0;
        $_SESSION["rollArray"][2] = 0;
        $_SESSION["rollArray"][3] = 0;
        $_SESSION["rollArray"][4] = 0;
        $_SESSION["yatzyDiceHandRoll"][0] = 3;
        $_SESSION["yatzyDiceHandRoll"][1] = 5;
        $_SESSION["yatzyDiceHandRoll"][2] = 1;
        $_SESSION["yatzyDiceHandRoll"][3] = 4;
        $_SESSION["yatzyDiceHandRoll"][4] = 6;
        $_SESSION["yatzyDiceHandRollGraphic"][0] = "<i class='dice-3'></i>";
        $_SESSION["yatzyDiceHandRollGraphic"][1] = "<i class='dice-5'></i>";
        $_SESSION["yatzyDiceHandRollGraphic"][2] = "<i class='dice-1'></i>";
        $_SESSION["yatzyDiceHandRollGraphic"][3] = "<i class='dice-4'></i>";
        $_SESSION["yatzyDiceHandRollGraphic"][4] = "<i class='dice-6'></i>";
        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyDiceHand2->roll($numberOfSides);
        $yatzyDiceHand2->getLastRoll();
        $lastClass2 = $yatzyDiceHand2->getLastClass();
        $exp2 = ["<i class='dice-3'></i>", "<i class='dice-5'></i>", "<i class='dice-1'></i>", "<i class='dice-4'></i>", "<i class='dice-6'></i>"];
        $res2 = $lastClass2;
        $this->assertEquals($exp2, $res2);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct bonus
     */
    public function testYatzyDiceHandGetBonus()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyBonus = $yatzyDiceHand->getBonus(30);
        $exp = 0;
        $res = $yatzyBonus;
        $this->assertEquals($exp, $res);

        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyBonus2 = $yatzyDiceHand2->getBonus(70);
        $exp2 = 35;
        $res2 = $yatzyBonus2;
        $this->assertEquals($exp2, $res2);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct total
     */
    public function testYatzyDiceHandGetTotal()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyTotal = $yatzyDiceHand->getTotal(3, 6, 10, 0);
        $exp = 10;
        $res = $yatzyTotal;
        $this->assertEquals($exp, $res);

        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyTotal2 = $yatzyDiceHand2->getTotal(2, 5, 10, 0);
        $exp2 = 0;
        $res2 = $yatzyTotal2;
        $this->assertEquals($exp2, $res2);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct button value.
     */
    public function testYatzyDiceHandGetButtonValue()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyButtonValue = $yatzyDiceHand->getButtonValue(6);
        $exp = "Press To Play Again";
        $res = $yatzyButtonValue;
        $this->assertIsString($res);
        $this->assertEquals($exp, $res);

        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyButtonValue2 = $yatzyDiceHand2->getButtonValue(5);
        $exp2 = "Press To Roll";
        $res2 = $yatzyButtonValue2;
        $this->assertIsString($res2);
        $this->assertEquals($exp2, $res2);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct message.
     */
    public function testYatzyDiceHandGetMessage()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyMessage = $yatzyDiceHand->getMessage(6, 3);
        $exp = "Round finished! Wanna play again? Press the button to play more!";
        $res = $yatzyMessage;
        $this->assertIsString($res);
        $this->assertEquals($exp, $res);

        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyMessage2 = $yatzyDiceHand2->getMessage(5, 3);
        $exp2 = "";
        $res2 = $yatzyMessage2;
        $this->assertIsString($res2);
        $this->assertEquals($exp2, $res2);

        $yatzyDiceHand3 = new YatzyDiceHand(5);
        $yatzyMessage3 = $yatzyDiceHand3->getMessage(5, 2);
        $exp3 = "Select which dice to hold:";
        $res3 = $yatzyMessage3;
        $this->assertIsString($res3);
        $this->assertEquals($exp3, $res3);

        destroySession();
    }

    /**
     * Verify that the yatzydicehand gets the correct checkbox status.
     */
    public function testYatzyDiceHandChangeCheckbox()
    {
        session_start();

        $yatzyDiceHand = new YatzyDiceHand(5);
        $yatzyCheckboxStatus = $yatzyDiceHand->changeCheckbox(6, 2);
        $exp = "disabled";
        $res = $yatzyCheckboxStatus;
        $this->assertIsString($res);
        $this->assertEquals($exp, $res);

        $yatzyDiceHand2 = new YatzyDiceHand(5);
        $yatzyCheckboxStatus2 = $yatzyDiceHand2->changeCheckbox(5, 3);
        $exp2 = "disabled";
        $res2 = $yatzyCheckboxStatus2;
        $this->assertIsString($res2);
        $this->assertEquals($exp2, $res2);

        $yatzyDiceHand3 = new YatzyDiceHand(5);
        $yatzyCheckboxStatus3 = $yatzyDiceHand3->changeCheckbox(5, 2);
        $exp3 = "enabled";
        $res3 = $yatzyCheckboxStatus3;
        $this->assertIsString($res3);
        $this->assertEquals($exp3, $res3);

        destroySession();
    }
}
