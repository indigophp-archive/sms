<?php

/*
 * This file is part of the Indigo SMS package.
 *
 * (c) IndigoPHP Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Sms\Gateway;

use Indigo\Sms\Exception\ResponseException;
use Indigo\Sms\Message;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

class SeemeGateway extends AbstractGateway
{
    protected $email;
    protected $password;
    protected $callback = array();

    public function __construct(Client $client, $email, $password, $callback = array())
    {
        $this->email = $email;
        $this->password = $password;
        $this->callback = $callback;

        $this->setClient($client);
    }

    public function send(Message $message)
    {
        $params = $message->asArray();

        $params = array_filter($params);

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    public function getBalance()
    {
        $params = array(
            'method' => 'balance',
        );

        $result = $this->call($params);

        return (float) $result['balance'];
    }

    public function setIP($ip)
    {
        $params = array(
            'method' => 'setip',
            'ip' => $ip,
        );

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    protected function call(array $params)
    {
        $request = $this->client->get('', array(), array('query' => $params));

        $response = $request->send();

        return $this->parseResponse($response);
    }

    protected function parseResponse(Response $response)
    {
        $result = $response->json();

        if ($result['result'] == 'ERR') {
            throw new ResponseException($result['message'], $result['code']);
        }

        return $result;
    }

    public function setClient(Client $client)
    {
        $client->setDefaultOption('query', array(
            'email' => $this->email,
            'password' => $this->password,
            'format' => 'json',
            'apiVersion' => '1.0.0',
        ));

        return parent::setClient($client);
    }
}
