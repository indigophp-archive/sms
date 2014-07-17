<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) Indigo Development Team
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
     * Sends a message
     *
     * @param Message $message
     *
     * @return boolean True on success
     */
    public function send(Message $message);

    /**
     * Returns the balance
     *
     * @return float|null Must return null if not available
     */
    public function getBalance();
}
