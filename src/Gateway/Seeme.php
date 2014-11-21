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

use Indigo\Sms\Gateway;
use Indigo\Sms\Message;
use Indigo\Http\Client;
use Indigo\Http\Message\Request;
use Indigo\Sms\GatewayException;
use League\Url\Url;

/**
 * Seeme gateway
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Seeme implements Gateway
{
    /**
     * API Endpoint
     */
    const ENDPOINT = 'https://seeme.hu/gateway';

    /**
     * HTTP Client
     *
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @param Client $client
     * @param string  $apiKey
     */
    public function __construct(Client $client, $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * Creates an URL
     *
     * @param array $queryParams
     *
     * @return string
     */
    private function createUrl(array $params = [])
    {
        $url = Url::createFromUrl(self::ENDPOINT);

        $defaultParams = [
            'key'        => $this->apiKey,
            'format'     => 'json',
            'apiVersion' => '2.0.1',
        ];

        $query = $url->getQuery();

        $query->modify($params);
        $query->modify($defaultParams);

        return $url;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Message $message)
    {
        $params = $message->getData();

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    /**
     * {@inheritdoc}
     */
    public function getBalance()
    {
        $params = ['method' => 'balance'];

        $balance = null;

        $result = $this->call($params);

        if (isset($result['balance'])) {
            $balance = (float) $result['balance'];
        }

        return $balance;
    }

    /**
     * Sets the sending IP address
     *
     * @param string $ip
     *
     * @return boolean
     */
    public function setIp($ip)
    {
        $params = [
            'method' => 'setip',
            'ip'     => $ip,
        ];

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    /**
     * Sends a request to server
     *
     * @param array $params Query parameters
     *
     * @return mixed
     */
    private function call(array $params)
    {
        $params = array_filter($params);

        $url = $this->createUrl($params);

        $response = $this->client->get((string) $url);

        $result = json_decode($response, true);

        if ($result['result'] == 'ERR') {
            throw new GatewayException($result['message'], $result['code']);
        }

        return $result;
    }
}
