<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Sms\Test\Gateway;

use Codeception\TestCase\Test;

/**
 * Tests for Gateways
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractGatewayTest extends Test
{
    /**
     * Gateway object
     *
     * @var Gatewaynterface
     */
    protected $gateway;

    /**
     * Client mock
     *
     * @var Client
     */
    protected $client;

    /**
     * @covers ::getClient
     * @covers ::setClient
     */
    public function testClient()
    {
        $client = $this->gateway->getClient();

        $this->assertInstanceOf(
            'GuzzleHttp\\Client',
            $client
        );

        $this->assertSame(
            $this->gateway,
            $this->gateway->setClient($client)
        );

        $this->assertSame(
            $client,
            $this->gateway->getClient()
        );
    }
}
