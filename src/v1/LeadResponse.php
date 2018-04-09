<?php

namespace credy\api\v1;

use yii\base\BaseObject;

/**
 * Class LeadResponse
 * @package credy\api\v1
 */
class LeadResponse extends BaseObject
{
    const ERROR_UNKNOWN = 0;
    const ERROR_HASH_MISMATCH = 1;
    const ERROR_DUPLICATE = 2;
    const ERROR_INVALID_API_KEY = 3;

    const STATUS_UNDER_INVESTIGATION = 'under_investigation';
    const STATUS_FAILED = 'failed';

    /**
     * @var string
     */
    private $_status;

    /**
     * @var string
     */
    private $_leadId;

    /**
     * @var integer
     */
    private $_error;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return string
     */
    public function getLeadId()
    {
        return $this->_leadId;
    }

    /**
     * @param string $id
     */
    public function setLeadId($id)
    {
        $this->_leadId = $id;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * @param int $error
     */
    public function setError($error)
    {
        $this->_error = $error;
    }
}
