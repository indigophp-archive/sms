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
 * Message
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
     * @codeCoverageIgnore
     */
    public function __construct($number, $message, $sender = null)
    {
        $this->number = $number;
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Get number
     *
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number
     *
     * @param  mixed   $number
     * @return Message
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param  string  $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get sender
     *
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @param  mixed   $sender
     * @return Message
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Return object vars as array
     *
     * @return array
     */
    public function asArray()
    {
        return get_object_vars($this);
    }

    /**
     * Return message
     *
     * @return string
     */
    public function __tostring()
    {
        return $this->getMessage();
    }

    /**
     * {@inheritdocs}
     */
    public function serialize()
    {
        return json_encode($this->asArray());
    }

    /**
     * {@inheritdocs}
     */
    public function unserialize($data)
    {
        $vars = json_decode($data, true);

        foreach ($vars as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
