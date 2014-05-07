<?php

namespace Indigo\Sms\Test\Gateway;

use Indigo\Sms\Message;
use Indigo\Sms\Gateway\SeemeGateway;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

/**
 * @coversDefaultClass \Indigo\Sms\Gateway\SeemeGateway
 */
class SeemeGatewayTest extends AbstractGatewayTest
{
    public function setUp()
    {
        $client = \Mockery::mock(new Client('https://seeme.hu/gateway'));

        $client->shouldReceive('get')
            ->andReturnUsing(function ($url, array $header, array $params) use ($client) {
                $request = \Mockery::mock($client->createRequest($url, $header, $params));

                $request->shouldReceive('send')
                    ->andReturnUsing(function () {
                        return new Response(
                            200,
                            array(),
                            '{"result":"OK","code":"0","message":"10000.000","balance":"10000.000","currency":"HUF","balance-currency":"10000.000 HUF","custom-services":"0.000","monthlySpentBalance":"5000.000"}'
                        );
                    });

                return $request;
            });

        $this->gateway = new SeemeGateway($client, 'email@email.com', 'your_password');
    }

    /**
     * @covers ::getBalance
     * @group  Sms
     */
    public function testBalance()
    {
        $balance = $this->gateway->getBalance();

        $this->assertTrue(is_float($balance));
        $this->assertEquals(10000.000, $balance);
    }

    /**
     * @group  Sms
     */
    public function testMessage()
    {
        $message = new Message(123456789, 'This is a test message');

        $result = $this->gateway->send($message);

        $this->assertTrue($result);
    }

    /**
     * @covers ::setIp
     * @group  Sms
     */
    public function testSetip()
    {
        $result = $this->gateway->setIP('127.0.0.1');

        $this->assertTrue($result);
    }

    /**
     * @expectedException        \Indigo\Sms\Exception\ResponseException
     * @expectedExceptionMessage Your email or password is wrong
     * @expectedExceptionCode    4
     * @group                    Sms
     */
    public function testFaultyResponse()
    {
        $client = \Mockery::mock(new Client('https://seeme.hu/gateway'));

        $client->shouldReceive('get')
            ->andReturnUsing(function ($url, array $header, array $params) use ($client) {
                $request = \Mockery::mock($client->createRequest($url, $header, $params));

                $request->shouldReceive('send')
                    ->andReturnUsing(function () {
                        return new Response(
                            200,
                            array(),
                            '{"result":"ERR","code":"4","message":"Your email or password is wrong"}'
                        );
                    });

                return $request;
            });

        $gateway = clone $this->gateway;

        $gateway->setClient($client);

        $gateway->getBalance();
    }
}
