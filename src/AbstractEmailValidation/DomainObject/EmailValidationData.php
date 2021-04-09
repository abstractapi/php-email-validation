<?php

namespace Abstractapi\EmailValidation\DomainObject;

use Abstractapi\EmailValidation\Common\Extension\StringExtension;

class EmailValidationData
{
    /**
     * Will map succes request result to EmailValidationData
     * 
     * @param array $succesResult 
     */
    public function __construct(array $succesResult = [])
    {
        foreach($succesResult as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                if(is_array($val) && array_key_exists("value", $val))
                {
                    $this->$key = $val['value'];   
                }
                else{
                    $this->$key = $val;
                }                
            }
        }
    } 
    
    /**
     * The value for "email" that was entered into the request.
     * 
     * @var string 
     */
    public $email;

    /**
     * If a typo has been detected then this parameter returns a suggestion
     * of the correct email (e.g., johnsmith@gmial.com => johnsmith@gmail.com). 
     * If no typo is detected then this is empty.
     * 
     * @var string 
     */
    public $autocorrect;
    
    /**
     * Abstract's evaluation of the deliverability of the email. 
     * Possible values are: DELIVERABLE, UNDELIVERABLE, RISKY, and UNKNOWN.
     * 
     * @var string 
     */
    public $deliverability;
    
    /**
     * An internal decimal score between 0.01 and 0.99 reflecting Abstract's 
     * confidence in the quality and deliverability of the submitted email.
     * 
     * @var decimal 
     */
    public $quality_score;
     
    /**
     * Is true if the email follows the format of "address @ domain . TLD". 
     * If any of those elements are missing or if they contain extra or 
     * incorrect special characters, then it returns false. 
     * 
     * @var bool 
     */
    public $is_valid_format;
     
    /**
     * Is true if the email's domain is found among Abstract's list 
     * of free email providers (e.g., Gmail, Yahoo, etc). 
     * 
     * @var bool 
     */ 
    public $is_free_email;
     
    /**
     * Is true if the email's domain is found among Abstract's list of 
     * disposable email providers (e.g., Mailinator, Yopmail, etc).
     * 
     * @var bool 
     */ 
    public $is_disposable_email;
     
    /**
     * Is true if the email's local part (e.g., the "to" part) appears to be 
     * for a role rather than individual. Examples of this include "team@", 
     * "sales@", info@", etc.
     * 
     * @var bool 
     */ 
    public $is_role_email;
     
    /**
     * Is true if the domain is configured to catch all email. 
     * 
     * @var bool 
     */ 
    public $is_catchall_email;
     
    /**
     * Is true if MX Records for the domain can be found. Only available 
     * on paid plans. Will return null and UNKNOWN on free plans.
     * 
     * @var bool 
     */ 
    public $is_mx_found;
     
    /**
     * Is true is the SMTP check of the domain was successful. Only 
     * available on paid plans. Will return null and UNKNOWN on free plans.  
     * 
     * @var bool 
     */ 
    public $is_smtp_valid;
}