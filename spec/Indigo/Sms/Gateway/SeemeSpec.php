<?php

namespace spec\Indigo\Sms\Gateway;

use Indigo\Sms\Message;
use Indigo\Http\Client;
use Indigo\Sms\GatewayException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SeemeSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client, '1234');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Sms\Gateway\Seeme');
        $this->shouldImplement('Indigo\Sms\Gateway');
    }

    function it_should_allow_to_send_a_message(Client $client, Message $message)
    {
        $result = ['result' => 'OK'];

        $client->get(Argument::type('string'))->willReturn(json_encode($result));
        $message->getData()->willReturn([
            'number'  => 1234,
            'message' => 'message',
            'sender'  => null,
        ]);

        $this->send($message)->shouldReturn(true);
    }

    function it_should_throw_an_exception_when_sending_message_fails(Client $client, Message $message)
    {
        $result = [
            'result'  => 'ERR',
            'code'    => 1,
            'message' => 'Error',
        ];

        $client->get(Argument::type('string'))->willReturn(json_encode($result));
        $message->getData()->willReturn([]);

        $exception = new GatewayException('Error', 1);

        $this->shouldThrow($exception)->duringSend($message);
    }

    function it_should_allow_to_get_balance(Client $client)
    {
        $result = [
            'result'  => 'OK',
            'balance' => 1234,
        ];

        $client->get(Argument::type('string'))->willReturn(json_encode($result));

        $this->getBalance()->shouldReturn(1234.0);
    }

    function it_should_allow_to_set_ip(Client $client)
    {
        $result = ['result' => 'OK'];

        $client->get(Argument::type('string'))->willReturn(json_encode($result));

        $this->setIp('123.456.789.1')->shouldReturn(true);
    }
}
