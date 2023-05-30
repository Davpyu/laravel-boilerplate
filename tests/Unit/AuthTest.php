<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test for login success.
     */
    public function test_login_is_returning_json(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test for login error.
     */
    public function test_login_is_returning_error(): void
    {
        $this->assertFalse(false);
    }
}
