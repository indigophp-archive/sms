<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Sms;

/**
 * Message
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Message
{
    /**
     * Phone number
     *
     * Format depends on the gateway
     *
     * @var mixed
     */
    protected $number;

    /**
     * Message
     *
     * @var string
     */
    protected $message;

    /**
     * Sender name, id, etc
     *
     * @var mixed
     */
    protected $sender;

    /**
     * Creates new Message
     *
     * @param mixed  $number
     * @param string $message
     * @param mixed  $sender
     */
    public function __construct($number, $message, $sender = null)
    {
        $this->number = $number;
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Returns the number
     *
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets the number
     *
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Returns the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Returns the sender
     *
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets the sender
     *
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * Returns object vars as array
     *
     * @return array
     */
    public function getData()
    {
        return get_object_vars($this);
    }

    /**
     * Sets object vars from array
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Returns the message
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
