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

use Guzzle\Http\Client;

abstract class AbstractGateway implements GatewayInterface
{
    /**
     * HTTP Client
     *
     * @var Client
     */
    protected $client;

    /**
     * Get HTTP client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set HTTP client
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
