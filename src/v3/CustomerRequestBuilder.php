<?php

namespace credy\api\v3;

use yii\base\BaseObject;

/**
 * Class CustomerRequestBuilder
 * @package credy\api\v3
 */
class CustomerRequestBuilder extends BaseObject implements ICustomerRequestBuilder
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @var integer
     */
    public $timestamp;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->timestamp === null) {
            $this->timestamp = time();
        }
        parent::init();
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
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
