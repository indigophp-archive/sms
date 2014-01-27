<?php

namespace Indigo\Sms\Test;

use Indigo\Sms\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function provider()
    {
        return array(
            array(
                '+1234567890',
                'Hi there, this is a short-message aka SMS.',
                'John Doe',
            ),
        );
    }

    /**
     * @dataProvider provider
     */
    public function testMessage($sender, $number, $message)
    {
        $msg = new Message($number, $message, $sender);

        $this->assertEquals($number, $msg->getNumber());
        $this->assertInstanceOf('Indigo\\Sms\\Message', $msg->setNumber($number));

        $this->assertEquals($message, $msg->getMessage());
        $this->assertInstanceOf('Indigo\\Sms\\Message', $msg->setMessage($message));

        $this->assertEquals($sender, $msg->getSender());
        $this->assertInstanceOf('Indigo\\Sms\\Message', $msg->setSender($sender));

        $this->assertEquals($message, (string)$msg);

        $this->assertEquals($msg, unserialize(serialize($msg)));
    }
}
