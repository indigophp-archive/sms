<?php

namespace Indigo\Sms\Test\Gateway;

use Indigo\Sms\Message;
use Indigo\Sms\Gateway\SeemeGateway;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream;

/**
 * Tests for Seeme Gateway
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Sms\Gateway\SeemeGateway
 */
class SeemeGatewayTest extends AbstractGatewayTest
{
    public function _before()
    {
        $this->client = \Mockery::mock('GuzzleHttp\\Client');

        $this->client->shouldReceive('get')
            ->andReturn(
                new Response(
                    200,
                    array(),
                    Stream\create('{"result":"OK","code":"0","message":"10000.000","balance":"10000.000","currency":"HUF","balance-currency":"10000.000 HUF","custom-services":"0.000","monthlySpentBalance":"5000.000"}')
                )
            )
            ->byDefault();

        $this->client->shouldReceive('setDefaultOption')->andReturn($this->client);

        $this->gateway = new SeemeGateway($this->client, 'email@email.com', 'your_password');
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
     * @covers ::send
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
    public function testSetIp()
    {
        $result = $this->gateway->setIp('127.0.0.1');

        $this->assertTrue($result);
    }

    /**
     * @expectedException        Indigo\Sms\Exception\ResponseException
     * @expectedExceptionMessage Your email or password is wrong
     * @expectedExceptionCode    4
     * @group                    Sms
     */
    public function testFaultyResponse()
    {
        $this->client->shouldReceive('get')
            ->andReturn(
                new Response(
                    200,
                    array(),
                    Stream\create('{"result":"ERR","code":"4","message":"Your email or password is wrong"}')
                )
            );

        $this->gateway->getBalance();
    }
}
