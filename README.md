# AbstractAPI php-email-validation library

[![Packagist](https://img.shields.io/packagist/v/abstractapi/php-email-validation.svg)](https://packagist.org/packages/abstractapi/php-email-validation)
[![Packagist](https://img.shields.io/packagist/dt/abstractapi/php-email-validation.svg)](https://packagist.org/packages/abstractapi/php-email-validation)

Integrate the powerful [email validation API from Abstract](https://www.abstractapi.com/email-verification-validation-api) in your PHP project in a few lines of code.

Abstract's Email Validation and Verification API is a fast, lightweight, modern, and RESTful JSON API for determining the validity and other details of email addresses.

It's very simple to use: you only need to submit your API key and an email address, and the API will respond an assessment of its validity, as well as additional details like quality score if it's a disposable email, a catchall address, and more.

Validating and verifying email addresses is a critical step to reducing the chances of low-quality data and fraudulent or risky users in your website or application.

# Documentation

## Supported PHP Versions

This library supports the **PHP version 5.6** and higher.

## Installation

You can install **php-email-validation** via composer or by downloading the source.

### Via Composer:

**php-email-validation** is available on Packagist as the
[`abstractapi/php-email-validation`](https://packagist.org/packages/abstractapi/php-email-validation) package:

```bash
composer require abstractapi/php-email-validation
```

## API key

Get your API key for free and without hassle from the [Abstact website](https://app.abstractapi.com/users/signup?target=/api/email-validation/pricing/select).

## Quickstart

### Verify email

```php
// Verify email using Abstract's Email Validation and Verification API and PHP
<?php
$api_key = "YYYYYY"; // Get your API Key from https://app.abstractapi.com/api/email-validation/documentation

Abstractapi\EmailValidation\AbstractEmailValidation::configure($api_key);

$info = Abstractapi\EmailValidation\AbstractEmailValidation::verify('email@domain.com');

print $info->quality_score;
```

## API response

The API response is returned in a `EmailValidationData` object.

| PARAMETER | TYPE | DETAILS |
| - | - | - |
| email | String | The value for "email" that was entered into the request. |
| auto_correct | String | If a typo has been detected then this parameter returns a suggestion of the correct email (e.g., johnsmith@gmial.com => johnsmith@gmail.com). If no typo is detected then this is empty. |
| deliverability | String | Abstract's evaluation of the deliverability of the email. Possible values are: DELIVERABLE, UNDELIVERABLE, RISKY, and UNKNOWN |
| quality_score | Number | An internal decimal score between 0.01 and 0.99 reflecting Abstract's confidence in the quality and deliverability of the submitted email. |
| is_valid_format | Boolean | Is true if the email follows the format of "address @ domain . TLD". If any of those elements are missing or if they contain extra or incorrect special characters, then it returns false. |
| is_free_email | Boolean | Is true if the email's domain is found among Abstract's list of free email providers (e.g., Gmail, Yahoo, etc). |
| is_disposable_email | Boolean | Is true if the email's domain is found among Abstract's list of disposable email providers (e.g., Mailinator, Yopmail, etc). |
| is_role_email | Boolean | Is true if the email's local part (e.g., the "to" part) appears to be for a role rather than individual. Examples of this include "team@", "sales@", info@", etc. |
| is_catchall_email | Boolean | Is true if the domain is configured to catch all email. |
| is_mx_found | Boolean | Is true if MX Records for the domain can be found. Only available on paid plans. Will return null and UNKNOWN on free plans. |
| is_smtp_valid | Boolean | Is true is the SMTP check of the domain was successful. Only available on paid plans. Will return null and UNKNOWN on free plans. |

## Detailed documentation

You will find additional information and request examples in the [Abstract help page](https://app.abstractapi.com/api/email-validation/documentation).

## Getting help

If you need help installing or using the library, please contact [Abstract's Support](https://app.abstractapi.com/api/email-validation/support).

For bug report and feature suggestion, please use [this repository issues page](https://github.com/abstractapi/php-email-validation/issues).

# Contribution

Contributions are always welcome, as they improve the quality of the libraries we provide to the community.

Please provide your changes covered by the appropriate unit tests, and post them in the [pull requests page](https://github.com/abstractapi/php-email-validation/pulls).

## Composer

To work on the source code, you need to install composer on your local computer. At the time of writing, the latest version of composer is v2.0.12. The installation instructions can be found here: https://getcomposer.org/download/.

## Setup

To install the requirements, run:

```bash
composer install --prefer-source --no-interaction --ignore-platform-reqs
```

Once you implementer all your changes and the unit tests, run the following command to run the tests:

```bash
php vendor/bin/phpunit
```
