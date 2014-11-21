# Indigo SMS

[![Latest Version](https://img.shields.io/github/release/indigophp/sms.svg?style=flat-square)](https://github.com/indigophp/sms/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/sms/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/sms)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/sms)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/sms)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/sms.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/sms)
[![Dependency Status](http://www.versioneye.com/user/projects/53c8e3beb47c315d0f000039/badge.svg?style=flat)](http://www.versioneye.com/user/projects/53c8e3beb47c315d0f000039)

**SMS Gateway Abstraction Layer.**


## Install

Via Composer

``` bash
$ composer require indigophp/sms
```


## Usage

``` php
use Indigo\Sms\Message;
use MyGateway;

$gateway = new MyGateway;

$message = new Message(123456789, 'This is a message', OPTIONAL_SENDER_OR_SENDER_ID);

$gateway->send($message);
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/sms/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
