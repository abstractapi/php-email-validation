<?php

require_once("../src/AbstractEmailValidation/autoload.php");

use Abstractapi\EmailValidation\AbstractEmailValidation;
use Abstractapi\EmailValidation\Common\Exception\AbstractHttpErrorException;

AbstractEmailValidation::configure($api_key = "YOUR_API_KEY");

try
{
    $info = AbstractEmailValidation::verify('email@domain.com');
}
catch (AbstractHttpErrorException $e)
{
    echo "Message:          ". $e->getMessage().     "; <br>";
    echo "Code:             ". $e->code.             "; <br>";
    echo "HttpStatusCode:   ". $e->http_code. "; <br>";
    echo "Details:          ";
    print_r($e->details);

    echo "<pre>";
    print_r(AbstractEmailValidation::getLastResponse());
    echo "</pre>";
}
catch (InvalidArgumentException $e)
{
    // Handle somehow
}
