<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Indigo\Sms\Gateway\GatewayInterface;
use Indigo\Sms\Message;
use Monolog\Logger;

/**
 * Monolog SMS Handler
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @codeCoverageIgnore
 */
class SmsHandler extends AbstractProcessingHandler
{
    protected $gateway;
    protected $number;
    protected $sender;

    public function __construct(
        GatewayInterface $gateway,
        $number,
        $sender = null,
        $level = Logger::CRITICAL,
        $bubble = true
    ) {
        parent::__construct($level, $bubble);

        $this->gateway = $gateway;
        $this->number = $number;
        $this->sender = $sender;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        $message = new Message($this->number, $record['formatted']);
        $message->setSender($this->sender);

        $this->gateway->send($message);
    }
}
