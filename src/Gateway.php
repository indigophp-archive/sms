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
 * Gateway interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Gateway
{
    /**
     * Sends a message
     *
     * @param Message $message
     *
     * @return boolean
     */
    public function send(Message $message);
}
