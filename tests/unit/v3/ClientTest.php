<?php

namespace tests\unit\v3;

use Codeception\Stub\Expected;
use credy\api\v3\Client;
use credy\api\v3\CustomerResponse;
use credy\api\v3\ICustomerRequestBuilder;
use credy\api\v3\ILeadRequestBuilder;
use credy\api\v3\LeadResponse;
use yii\base\InvalidConfigException;
use yii\httpclient\Client as HttpClient;
use yii\httpclient\Request as HttpClientRequest;
use yii\httpclient\Response as HttpClientResponse;

/**
 * Class ClientTest
 * @package tests\unit\v3
 */
class ClientTest extends \Codeception\Test\Unit
{
    public function testApiKeyIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new Client([
            'secretKey' => 'whatever',
        ]);
    }

    public function testSecretKeyIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new Client([
            'apiKey' => 'whatever',
        ]);
    }

    public function testBothApiAndSecretKeysRequired()
    {
        new Client([
            'apiKey' => 'whatever',
            'secretKey' => 'whatever',
        ]);
    }

    public function testSendCustomerRequestWithSpecifiedLanguage()
    {
        /** @var Client $client */
        $client = $this->make(Client::class, [
            'language' => 'ru-UA',
            'httpClient' => $this->makeEmpty(HttpClient::class, [
                'post' => $this->make(HttpClientRequest::class, [
                    'send' => $this->makeEmpty(HttpClientResponse::class),
                    'addHeaders' => Expected::once(function ($headers) {
                        $this->assertArrayHasKey('Accept-Language', $headers);
                        $this->assertEquals('ru-UA', $headers['Accept-Language']);
                    })
                ]),
            ]),
        ]);
        $response = $client->sendCustomerRequest($this->makeEmpty(ICustomerRequestBuilder::class));
        $this->assertInstanceOf(CustomerResponse::class, $response);
    }

    public function testLeadRequestWithDefaultLanguage()
    {
        /** @var Client $client */
        $client = $this->make(Client::class, [
            'httpClient' => $this->makeEmpty(HttpClient::class, [
                'post' => $this->make(HttpClientRequest::class, [
                    'send' => $this->makeEmpty(HttpClientResponse::class),
                    'addHeaders' => Expected::once(function ($headers) {
                        $this->assertArrayHasKey('Accept-Language', $headers);
                        $this->assertEquals('en-US', $headers['Accept-Language']);
                    })
                ]),
            ]),
        ]);
        $response = $client->sendLeadRequest($this->makeEmpty(ILeadRequestBuilder::class));
        $this->assertInstanceOf(LeadResponse::class, $response);
    }
}
