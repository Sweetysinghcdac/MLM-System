<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
   protected function setUp(): void
    {
        parent::setUp();

        // Disable CSRF for all tests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

}
