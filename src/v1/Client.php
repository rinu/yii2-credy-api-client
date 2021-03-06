<?php

namespace credy\api\v1;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;
use yii\httpclient\Exception as HttpClientException;
use yii\httpclient\Response as HttpClientResponse;
use yii\i18n\I18N;
use yii\i18n\PhpMessageSource;

/**
 * Class Client
 * @package credy\api\v1
 */
class Client extends Component
{
    const STAGING_URL = 'http://staging.credy.eu/api';
    const PRODUCTION_URL = 'https://credy.eu/api';

    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var HttpClient|array|string
     */
    public $httpClient = [
        'class' => HttpClient::class,
        'baseUrl' => self::PRODUCTION_URL,
    ];

    /**
     * @var string|array|I18N
     */
    public $i18n = 'i18n';

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->initTranslations();
        if ($this->apiKey === null) {
            throw new InvalidConfigException('`apiKey` is required');
        }
        parent::init();
    }

    /**
     * @param ILeadRequestBuilder $builder
     * @return LeadResponse
     * @throws InvalidConfigException
     */
    public function sendLeadRequest(ILeadRequestBuilder $builder)
    {
        $data = $builder->buildRequestData();
        ArrayHelper::setValue($data, 'lead.ip_address', Yii::$app->request->getUserIP());
        ArrayHelper::setValue($data, 'api_key', $this->apiKey);
        ArrayHelper::setValue($data, 'timestamp', time());
        ArrayHelper::setValue($data, 'hash', $this->calculateHash($data));

        $response = Yii::createObject(LeadResponse::class);

        try {
            /** @var HttpClientResponse $httpResponse */
            $httpResponse = Instance::ensure($this->httpClient, HttpClient::class)->post('lead', $data)->send();
        } catch (HttpClientException $e) {
            Yii::$app->errorHandler->logException($e);
            $response->setStatus(LeadResponse::STATUS_FAILED);
            return $response;
        }

        if (ArrayHelper::getValue($httpResponse->getData(), 'status') == LeadResponse::STATUS_UNDER_INVESTIGATION) {
            $response->setStatus(LeadResponse::STATUS_UNDER_INVESTIGATION);
            $response->setLeadId(ArrayHelper::getValue($httpResponse->getData(), 'lead_id'));
        } else {
            $response->setStatus(LeadResponse::STATUS_FAILED);
            $response->setError(ArrayHelper::getValue($httpResponse->getData(), 'error'));
        }

        return $response;
    }

    /**
     * @param array $data
     * @return string
     */
    protected function calculateHash(array $data)
    {
        $string = '';
        foreach (ArrayHelper::getValue($data, 'lead', []) as $key => $value) {
            $string .= $key . $value;
        }

        $string .= ArrayHelper::getValue($data, 'api_key');
        $string .= ArrayHelper::getValue($data, 'timestamp');
        return sha1($string);
    }

    /**
     * Initializes translations for component
     * @throws InvalidConfigException
     */
    protected function initTranslations()
    {
        /** @var I18N $i18n */
        $i18n = Instance::ensure($this->i18n, I18N::class);
        $i18n->translations['credy*'] = [
            'class' => PhpMessageSource::class,
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'messages',
            'sourceLanguage' => 'en',
            'fileMap' => [
                'credy' => 'credy.php',
            ],
        ];
    }
}
