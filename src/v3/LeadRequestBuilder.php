<?php

namespace credy\api\v3;

use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\web\Request;

/**
 * Class LeadRequestBuilder
 * @package credy\api\v3
 */
class LeadRequestBuilder extends BaseObject implements ILeadRequestBuilder
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @var string
     */
    public $ip;

    /**
     * @var string
     */
    public $customerId;

    /**
     * @var integer
     */
    public $timestamp;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->ip === null) {
            /** @var Request $request */
            $request = Instance::ensure('request', Request::class);
            $this->ip = $request->getUserIP();
        }
        if ($this->timestamp === null) {
            $this->timestamp = time();
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @inheritdoc
     */
    public function buildRequestData()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @inheritdoc
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
