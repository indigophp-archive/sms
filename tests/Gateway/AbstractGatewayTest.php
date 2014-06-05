<?php

namespace Indigo\Sms\Test\Gateway;

abstract class AbstractGatewayTest extends \PHPUnit_Framework_TestCase
{
    protected $gateway;

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @covers ::getClient
     * @covers ::setClient
     * @group  Sms
     */
    public function testClient()
    {
        $client = $this->gateway->getClient();

        $this->assertInstanceOf(
            'Guzzle\\Http\\Client',
            $client
        );

        $this->assertInstanceOf(
            'Indigo\\Sms\\Gateway\\GatewayInterface',
            $this->gateway->setClient($client)
        );
    }
}
