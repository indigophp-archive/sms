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

use GuzzleHttp\Client;

/**
 * Abstract Gateway
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractGateway implements GatewayInterface
{
    /**
     * HTTP Client
     *
     * @var Client
     */
    protected $client;

    /**
     * Returns the HTTP client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the HTTP client
     *
     * @param Client $client
     *
     * @return this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
