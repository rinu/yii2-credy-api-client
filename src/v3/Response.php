<?php

namespace credy\api\v3;

use yii\base\BaseObject;

class Response extends BaseObject
{
    /**
     * @var integer
     */
    private $_code;

    /**
     * @var mixed
     */
    private $_rawData;

    /**
     * @return mixed
     */
    public function getRawData()
    {
        return $this->_rawData;
    }

    /**
     * @param mixed $data
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
}
