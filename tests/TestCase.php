<?php

namespace ILDaviz\LaravelPhpseclib\Tests;

use ILDaviz\LaravelPhpseclib\LaravelPhpseclibServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelPhpseclibServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}