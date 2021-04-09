<?php

namespace Abstractapi\EmailValidation\Tests;

use PHPUnit\Framework\TestCase;
use Abstractapi\EmailValidation\AbstractEmailValidation;
use Abstractapi\EmailValidation\Common\Exception\InvalidArgumentException;

class AbstractEmailValidationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testInvalidAPIKey()
    {
        $this->expectException('\Exception');
        AbstractEmailValidation::configure('');
    }

      /**
     * @throws \Exception
     */
    public function testInstantiation()
    {
        $API_KEY = getenv('EMAIL_VALIDATION_API_KEY');

        AbstractEmailValidation::configure($API_KEY);     

        $this->assertSame('https://emailvalidation.abstractapi.com/v1', AbstractEmailValidation::getApiEndpoint());

        $this->assertFalse(AbstractEmailValidation::success());

        $this->assertFalse(AbstractEmailValidation::getLastError());

        $this->assertSame(array('headers' => null, 'body' => null), AbstractEmailValidation::getLastResponse());

        $this->assertSame(array(), AbstractEmailValidation::getLastRequest());
    }

    public function testResponseState()
    {
        $API_KEY = getenv('EMAIL_VALIDATION_API_KEY');

        AbstractEmailValidation::configure($API_KEY);  
        
        $email = 'domain@domain.com';

        $info = AbstractEmailValidation::verify($email);
  
        $this->assertTrue(AbstractEmailValidation::success());  

        $this->assertEquals($email, $info->email);  
    }

    public function testArgValidation()
    { 
        $this->expectException('Abstractapi\EmailValidation\Common\Exception\InvalidArgumentException'); 
        AbstractEmailValidation::verify('');  
    }
}