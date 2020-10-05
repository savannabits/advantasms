# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/savannabits/advantasms.svg?style=flat-square)](https://packagist.org/packages/savannabits/advantasms)
[![Build Status](https://img.shields.io/travis/savannabits/advantasms/master.svg?style=flat-square)](https://travis-ci.org/savannabits/advantasms)
[![Quality Score](https://img.shields.io/scrutinizer/g/savannabits/advantasms.svg?style=flat-square)](https://scrutinizer-ci.com/g/savannabits/advantasms)
[![Total Downloads](https://img.shields.io/packagist/dt/savannabits/advantasms.svg?style=flat-square)](https://packagist.org/packages/savannabits/advantasms)

The PHP SDK for the [AdvantaSMS BulkSMS API](https://advantasms.com/bulksms-api)
## Requirements
- PHP ^7.1
- PHP json extension
- PHP Curl extension

## Installation

You can install the package via composer:

```bash
composer require savannabits/advantasms
```

## Usage
### Credentials
Ensure you have thhe following required credentials from AdvantaSMS:
 - apiKey
 - Partner ID (e.g 2030)
 - Shortcode (e.g SAVBITS)
 
### Sending SMS
```php
use \Savannabits\Advantasms\Advantasms;
$apiKey = "";
$partnerId = "";
$shortcode = "";
$mobile = "254xxxxxxxxx";
//instantiate
$sms = new Advantasms($apiKey,$partnerId,$shortcode);

//Send and receive response
$response = $sms->to($mobile)->message("Your message right here...")->send();

//Schedule sms to be sent at a specific time
$time = "2020-10-01 18:00"; // Y-m-d H:i
$response = $sms->to($mobile)->message("Your message right here")->schedule($time);
```

If you don't like instantiating class into variables, you can use the init static method instead:
```php
use \Savannabits\Advantasms\Advantasms;
$apiKey = "";
$partnerId = "";
$shortcode = "";
$mobile = "254xxxxxxxxx";

//Send and receive response
$response = Advantasms::init($apiKey,$partnerId,$shortcode)->to($mobile)->message("Your message right here...")->send();

//Schedule sms to be sent at a specific time
$time = "2020-10-01 18:00"; // Y-m-d H:i
$response = Advantasms::init($apiKey,$partnerId,$shortcode)->to($mobile)->message("Your message right here...")->schedule($time);
```

### Sample responses

#### Error
```json
{
  "success":false,
  "message":"Low credit units to send message, Current balance 0.00, Required 1",
  "payload":[
        {
          "response-code":1004,
          "response-description":"Low credit units to send message, Current balance 0.00, Required 1",
          "mobile":"0708467001"
        }
     ],
  "code":1004
}
```
#### Success
```json
{
  "success":true,
  "message":"Success",
  "payload":[
        {
            "respose-code": 200,
            "response-description": "Success",
            "mobile": 254712345678,
            "messageid": 8290842,
            "networkid": "1"
        }
    ],
  "code":200
}
```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email maosa.sam@gmail.com instead of using the issue tracker.

## Credits

- [Sam Maosa](https://github.com/savannabits)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
