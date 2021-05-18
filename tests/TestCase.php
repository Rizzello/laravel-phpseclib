<?php

namespace ILDaviz\LaravelPhpseclib\Tests;

use ILDaviz\LaravelPhpseclib\LaravelPhpseclibServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
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
        $app['config']->set('sftp.connection.testing', [
            'username' => env('SFTP_USERNAME','username'),
            'password' => env('SFTP_PASSWORD', 'password'),
            'hostname' => env('SFTP_HOSTNAME', 'hostname'),
            'port'     => env('SFTP_PORT', '22')

        ]);
    }
}