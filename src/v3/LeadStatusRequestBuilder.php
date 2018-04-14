<?php

namespace credy\api\v3;

use yii\base\BaseObject;

/**
 * Class LeadStatusRequestBuilder
 * @package credy\api\v3
 */
class LeadStatusRequestBuilder extends BaseObject implements ILeadStatusRequestBuilder
{
    /**
     * @var string
     */
    public $leadId;

    /**
     * @return string
     */
    public function getLeadId()
    {
        return $this->leadId;
    }
}
