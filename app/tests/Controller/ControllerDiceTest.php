<?php

declare(strict_types=1);

namespace Tests\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\DiceController;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for the controller Dice.
 */
class ControllerDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        session_start();

        $controller = new DiceController();
        $this->assertInstanceOf("\App\Http\Controllers\DiceController", $controller);

        destroySession();
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerReturnsResponse()
    {
        session_start();

        $controller = new DiceController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);

        destroySession();
    }

    /**
     * Check the controller process action.
     */
    public function testControllerProcessAction()
    {
        session_start();

        $_POST["content"] = 2;
        $_POST["content1"] = 5;
        $controller = new DiceController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(2, $_SESSION["numberOfFaces"]);
        $this->assertEquals(5, $_SESSION["numberOfDice"]);

        destroySession();
    }
}
