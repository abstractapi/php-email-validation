<?php

require_once("../src/AbstractEmailValidation/autoload.php");

use Abstractapi\EmailValidation\AbstractEmailValidation;


AbstractEmailValidation::configure($api_key = "YOUR_API_KEY");

$info = AbstractEmailValidation::verify('email@domain.com');


echo "<pre>";
print_r($info);
echo "</pre>";

echo $info->quality_score;
echo "</br>";
echo var_export($info->is_catchall_email);
echo "</br>";
echo var_export($info->is_valid_format);
echo "</br>";
echo var_export($info->is_mx_found);
echo "</br>";
echo var_export($info->is_smtp_valid);