<?php

declare(strict_types=1);

namespace Tests\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\Game21ComputerController;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for the controller Game21ComputerController.
 */
class ControllerGame21ComputerControllerTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21ComputerController();
        $this->assertInstanceOf("\App\Http\Controllers\Game21ComputerController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerReturnsResponse()
    {
        session_start();

        $controller = new Game21ComputerController();
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
        $controller = new Game21ComputerController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(2, $_SESSION["numberOfFaces"]);
        $this->assertEquals(5, $_SESSION["numberOfDice"]);

        destroySession();
    }

    /**
     * Check the controller destroy action.
     */
    public function testControllerDestroyAction()
    {
        session_start();
        $controller = new Game21ComputerController();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }

    /**
     * Check the controller newround action.
     */
    public function testControllerNewRoundAction()
    {
        session_start();

        $controller = new Game21ComputerController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_SESSION["totalScore"] = 1;
        $res = $controller->newround();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(0, $_SESSION["totalScore"]);

        destroySession();
    }
}
