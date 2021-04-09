<?php

namespace Abstractapi\EmailValidation;

use Abstractapi\EmailValidation\Common\AbstractEndpointBase;
use Abstractapi\EmailValidation\Common\Extension\StringExtension;
use Abstractapi\EmailValidation\DomainObject\EmailValidationData;
use Abstractapi\EmailValidation\Common\DomainObject\HttpErrorDetail;
use Abstractapi\EmailValidation\Common\Exception\InvalidArgumentException;
use Abstractapi\EmailValidation\Common\Exception\AbstractHttpErrorException;

/** 
 * Email Validation
 */
class AbstractEmailValidation extends AbstractEndpointBase
{
    /** 
     * @var string api_endpoint  Email Validation and Verification API endpoint.
     */
    const API_ENDPOINT = "https://emailvalidation.abstractapi.com/v1";

    /**
     * Configure Email Validation and Verification API.
     * 
     * @param string $api_key This is your private API key, specific to the Email validation API.
     */
    public static function configure($api_key)
    {
        parent::configureEndpoint(self::API_ENDPOINT, $api_key);
    }

    /**
     * Make an HTTP GET request to Abstract's Email Validation and Verification API,
     * for retrieving all available details about requested email.
     * 
     * @param   string  $email          The email address to validate.
     * @param   bool    $auto_correct   You can chose to disable auto correct so Abstract will perform all check, even if the email seem to be incorrectly formatted. To do so, just input false for the auto_correct param. By default, auto_correct is turned on.
     * @return  EmailValidationData
     * 
     * @throws  InvalidArgumentException
     * @throws  AbstractHttpErrorException
     */
    public static function verify($email, $auto_correct = true)
    {
        // Ensures that the email parameter is not empty.
        if (StringExtension::isNullOrEmpty($email)) {
            throw new InvalidArgumentException("Email is a required argument.");
        }

        // Will make a GET request for email verification.
        $result = parent::client()->get(
            '',
            [
                'email' => $email,
                'auto_correct' => $auto_correct ? 'true' : 'false'
            ]
        );

        // Will check the status of the request response, 
        // if successful returns a filled EmailValidationData.
        if (parent::client()->success()) {
            return new EmailValidationData($result);
        }

        // Get the status code of the last request.
        $http_status_code = self::client()->getLastResponse()['headers']['http_code'];

        // When there is no network or the wrong endpoint address is set.
        if ($http_status_code === 0) {
            throw new \Exception("Check network connection.");
        }

        throw new AbstractHttpErrorException(
            $result['error']['message'],
            $result['error']['code'],
            $http_status_code,
            $result['error']['details']
        );
    }
}
