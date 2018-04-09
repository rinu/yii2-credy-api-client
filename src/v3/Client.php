<?php

namespace credy\api\v3;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\httpclient\Client as HttpClient;

class Client extends Component
{
    const PRODUCTION_URL = 'https://api.credy.eu/v3/';
    const STAGING_URL = 'http://api.staging.credy.eu/v3/';

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

    public function send(Request $request)
    {

    }
}
