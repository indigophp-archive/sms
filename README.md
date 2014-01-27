# Indigo Queue


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