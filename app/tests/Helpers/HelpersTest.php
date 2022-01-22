<?php

declare(strict_types=1);

namespace Tests\Helpers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function App\Functions\{
    getRoutePath,
    url,
    getBaseUrl,
    destroySession
};

/**
 * Test cases for the functions in helpers.php.
 */
class HelpersTest extends TestCase
{
    /**
     * Test the function getRoutePath().
     */
    public function testGetRoutePath()
    {
        $res = getRoutePath();
        $this->assertEmpty($res);
    }



    /**
     * Test the function url().
     */
    public function testUrl()
    {
        $res = url("/");
        $this->assertIsString($res);
    }



    /**
     * Test the function getBaseUrl().
     */
    public function testGetBaseUrl()
    {
        $res = getBaseUrl();
        $this->assertIsString($res);
    }



    /**
     * Test the function destroySession().
     */
    public function testDestroySession()
    {
        session_start();

        $_SESSION = [
            "key" => "value"
        ];

        destroySession();
        $this->assertEmpty($_SESSION);
    }
}
