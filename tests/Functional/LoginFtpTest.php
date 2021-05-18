<?php
namespace ILDaviz\LaravelPhpseclib\Tests\Functional;

use ILDaviz\LaravelPhpseclib\LaravelPhpseclib;
use ILDaviz\LaravelPhpseclib\Tests\TestCase;

class LoginFtpTest extends TestCase
{
    /**
     * Test connection fail
     * @throws \App\Exceptions\BadLogin
     * @throws \App\Exceptions\CoreException
     */
    public function test_login()
    {
        $LaravelPhpseclib = new LaravelPhpseclib();
        $config = config('sftp.connection.testing');
        $x = $LaravelPhpseclib->login($config['username'],$config['password'],$config['hostname']);
        echo print_r($x, true);
        //$this->assertTrue(true, (string)$config['username']);
    }
}