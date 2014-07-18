<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Sms\Exception;

use UnexpectedValueException;

/**
 * Thrown in case of faulty response
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ResponseException extends UnexpectedValueException
{
}
