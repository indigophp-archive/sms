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

use Serializable;

/**
 * Message class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Message implements Serializable
{
    /**
     * Phone number
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
     *
     * @return this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
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
     *
     * @return this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
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
     *
     * @return this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
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
     *
     * @return this
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * Alias to getMessage()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }

    /**
     * {@inheritdocs}
     */
    public function serialize()
    {
        return json_encode($this->getData());
    }

    /**
     * {@inheritdocs}
     */
    public function unserialize($data)
    {
        $data = json_decode($data, true);

        $this->setData($data);
    }
}
