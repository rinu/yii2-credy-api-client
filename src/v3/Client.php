<?php

namespace credy\api\v3;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;
use yii\httpclient\Exception as HttpClientException;

/**
 * Class Client
 * @package credy\api\v3
 */
class Client extends Component
{
    const PRODUCTION_URL = 'https://api.credy.eu/v3';
    const STAGING_URL = 'http://api.staging.credy.eu/v3';

    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var string
     */
    public $secretKey;

    /**
     * @var array|HttpClient|string
     */
    public $httpClient = [
        'class' => HttpClient::class,
        'baseUrl' => self::PRODUCTION_URL,
    ];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->apiKey === null) {
            throw new InvalidConfigException('`apiKey` is required.');
        }
        if ($this->secretKey === null) {
            throw new InvalidConfigException('`secretKey` is required.');
        }
        parent::init();
    }

    /**
     * @param ICustomerRequestBuilder $builder
     * @return CustomerResponse
     * @throws InvalidConfigException
     */
    public function sendCustomerRequest(ICustomerRequestBuilder $builder)
    {
        /** @var HttpClient $httpClient */
        $httpClient = Instance::ensure($this->httpClient, HttpClient::class);
        $response = Yii::createObject(CustomerResponse::class);

        try {
            $data = ArrayHelper::merge($builder->buildRequestData(), [
                'signature' => [
                    'timestamp' => $builder->getTimestamp(),
                    'api_key' => $this->apiKey,
                    'hash' => $this->createSignature($builder->getTimestamp(), $this->apiKey, $this->secretKey),
                ],
            ]);

            $httpResponse = $httpClient->post('customers', $data)->send();
            $response->setCode($httpResponse->getStatusCode());
            $response->setRawData($httpResponse->getData());
        } catch (HttpClientException $exception) {
            $response->setCode(500);
            $response->setRawData(['message' => $exception->getMessage()]);
        }
        return $response;
    }

    /**
     * @param ILeadRequestBuilder $builder
     * @return LeadResponse
     * @throws InvalidConfigException
     */
    public function sendLeadRequest(ILeadRequestBuilder $builder)
    {
        /** @var HttpClient $httpClient */
        $httpClient = Instance::ensure($this->httpClient, HttpClient::class);
        $response = Yii::createObject(LeadResponse::class);

        try {
            $timestamp = time();
            $data = ArrayHelper::merge($builder->buildRequestData(), [
                'ip_address' => $builder->getIp(),
                'signature' => [
                    'timestamp' => $timestamp,
                    'api_key' => $this->apiKey,
                    'hash' => $this->createSignature($timestamp, $this->apiKey, $this->secretKey),
                ],
            ]);

            $httpResponse = $httpClient->post('leads?customer=' . $builder->getCustomerId(), $data)->send();
            $response->setCode($httpResponse->getStatusCode());
            $response->setRawData($httpResponse->getData());
        } catch (HttpClientException $exception) {
            $response->setCode(500);
            $response->setRawData(['message' => $exception->getMessage()]);
        }
        return $response;
    }

    /**
     * @param integer $timestamp
     * @param string $apiKey
     * @param string $secretKey
     * @return string
     */
    public function createSignature($timestamp, $apiKey, $secretKey)
    {
        return sha1($timestamp . $apiKey . $secretKey);
    }
}
