# Indigo SMS

[![Build Status](https://travis-ci.org/indigophp/sms.png?branch=develop)](https://travis-ci.org/indigophp/sms)
[![Code Coverage](https://scrutinizer-ci.com/g/indigophp/sms/badges/coverage.png?s=0d5f65443b870a598e6e297a9cc0f92149061ace)](https://scrutinizer-ci.com/g/indigophp/sms/)
[![Latest Stable Version](https://poser.pugx.org/indigophp/sms/v/stable.png)](https://packagist.org/packages/indigophp/sms)
[![Total Downloads](https://poser.pugx.org/indigophp/sms/downloads.png)](https://packagist.org/packages/indigophp/sms)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/indigophp/sms/badges/quality-score.png?s=a6bcf87f48200f7997cd159cdef527d1b2bbcfb8)](https://scrutinizer-ci.com/g/indigophp/sms/)
[![License](https://poser.pugx.org/indigophp/sms/license.png)](https://packagist.org/packages/indigophp/sms)


**SMS Gateway Abstraction Layer.**


## Install

Via Composer

``` json
{
    "require": {
        "indigophp/sms": "@stable"
    }
}
```

**Note**: Package now uses PSR-4 autoloader, make sure you have a fresh version of Composer.


## Usage

``` php
$gateway = new Indigo\Sms\Gateway\MyGateway;

$message = new Indigo\Sms\Message(123456789, 'This is a message', OPTIONAL_SENDER_OR_SENDER_ID);

$gateway->send($message);
```


## Testing

``` bash
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/sms/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/sms/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/sms/blob/develop/LICENSE) for more information.
