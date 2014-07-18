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

use Indigo\Sms\Exception\ResponseException;
use Indigo\Sms\Message;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;

class SeemeGateway extends AbstractGateway
{
    /**
     * Email address
     *
     * @var string
     */
    protected $email;

    /**
     * Password
     *
     * @var string
     */
    protected $password;

    /**
     * Callback options
     *
     * @var array
     */
    protected $callback = array();

    /**
     * Creates new SeemeeGateway
     *
     * @param Client $client
     * @param string $email
     * @param string $password
     * @param array  $callback
     */
    public function __construct(Client $client, $email, $password, $callback = array())
    {
        $this->email = $email;
        $this->password = $password;
        $this->callback = $callback;

        $this->setClient($client);
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(Client $client)
    {
        $client->setDefaultOption('query', array(
            'email'      => $this->email,
            'password'   => $this->password,
            'format'     => 'json',
            'apiVersion' => '1.0.0',
        ));

        return parent::setClient($client);
    }

    /**
     * {@inheritdoc}
     */
    public function send(Message $message)
    {
        $params = $message->getData();

        $params = array_filter($params);

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    /**
     * {@inheritdoc}
     */
    public function getBalance()
    {
        $params = array(
            'method' => 'balance',
        );

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
        $params = array(
            'method' => 'setip',
            'ip'     => $ip,
        );

        $result = $this->call($params);

        return $result['result'] == 'OK';
    }

    /**
     * Sends a request to server
     *
     * @param array $params Query parameters
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    protected function call(array $params)
    {
        $response = $this->client->get(null, array('query' => $params));

        $result = $response->json();

        if ($result['result'] == 'ERR') {
            throw new ResponseException($result['message'], $result['code']);
        }

        return $result;
    }
}
