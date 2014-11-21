<?php

namespace spec\Indigo\Sms;

use PhpSpec\ObjectBehavior;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(null, null);

        $this->shouldHaveType('Indigo\Sms\Message');
    }

    function it_should_have_a_number()
    {
        $this->beConstructedWith(1234, null);

        $this->getNumber()->shouldReturn(1234);

        $this->setNumber(5678);

        $this->getNumber()->shouldReturn(5678);
    }

    function it_should_have_a_message()
    {
        $this->beConstructedWith(null, 'message');

        $this->getMessage()->shouldReturn('message');

        $this->setMessage('not a message');

        $this->getMessage()->shouldReturn('not a message');
        $this->__toString()->shouldReturn('not a message');
    }

    function it_should_allow_to_have_a_sender()
    {
        $this->beConstructedWith(null, null, 'sender');

        $this->getSender()->shouldReturn('sender');

        $this->setSender('not a sender');

        $this->getSender()->shouldReturn('not a sender');
    }

    function it_should_have_data()
    {
        $this->beConstructedWith(1234, 'message');

        $this->getData()->shouldReturn([
            'number'  => 1234,
            'message' => 'message',
            'sender'  => null,
        ]);

        $this->setData(['sender' => 'sender']);

        $this->getData()->shouldReturn([
            'number'  => 1234,
            'message' => 'message',
            'sender'  => 'sender',
        ]);
    }
}
