<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Remove the middleware that interfere with testings
     * @return void
     */
    public function removeBadTestingMiddleware(){
        
        $this->withoutMiddleware([
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            ]);

    }
}
