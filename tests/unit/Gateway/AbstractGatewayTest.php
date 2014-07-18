<?php

namespace Indigo\Sms\Test\Gateway;

use Codeception\TestCase\Test;

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
     * @group  Sms
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
