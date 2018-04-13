<?php

namespace credy\api\v3;

use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * Class LeadResponse
 * @package credy\api\v3
 */
class LeadResponse extends BaseObject
{
    /**
     * @var integer
     */
    private $_code;

    /**
     * @var array
     */
    private $_rawData;

    /**
     * @return array
     */
    public function getRawData()
    {
        return $this->_rawData;
    }

    /**
     * @param array $data
     */
    public function setRawData($data)
    {
        $this->_rawData = $data;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    /**
     * @return string
     */
    public function getLeadId()
    {
        return ArrayHelper::getValue($this->getRawData(), 'uuid');
    }
}
