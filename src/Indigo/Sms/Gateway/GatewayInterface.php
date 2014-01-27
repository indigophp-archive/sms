<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) IndigoPHP Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Sms\Gateway;

use Indigo\Sms\Message;

/**
 * Gateway Interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface GatewayInterface
{
    /**
     * Send a message
     *
     * @param  Message $message
     * @return boolean True on success
     */
    public function send(Message $message);

    /**
     * Return balance
     *
     * @return float
     */
    public function getBalance();
}
