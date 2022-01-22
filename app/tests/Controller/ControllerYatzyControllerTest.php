<?php

declare(strict_types=1);

namespace Tests\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\YatzyController;

use function App\Functions\{
    destroySession
};

/**
 * Test cases for the controller YatzyController.
 */
class ControllerYatzyControllerTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        session_start();

        $controller = new YatzyController();
        $this->assertInstanceOf("\App\Http\Controllers\YatzyController", $controller);

        destroySession();
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerReturnsResponse()
    {
        session_start();

        $controller = new YatzyController();
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
        $_SESSION["scoreIndex"] = 1;
        $controller = new YatzyController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(1, $_SESSION["rollArray"][0]);
        $this->assertEquals(1, $_SESSION["rollArray"][1]);
        $this->assertEquals(1, $_SESSION["rollArray"][2]);
        $this->assertEquals(1, $_SESSION["rollArray"][3]);
        $this->assertEquals(1, $_SESSION["rollArray"][4]);
        $_SESSION["scoreIndex"] = 6;
        $controller->process();
        $this->assertEmpty($_SESSION);
    }

    /**
     * Check the controller destroy action.
     */
    public function testControllerDestroyAction()
    {
        session_start();
        $controller = new YatzyController();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
