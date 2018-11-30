<?php

namespace credy\api\v3;

use yii\helpers\ArrayHelper;

class LeadResponse extends Response
{
    /**
     * @return string
     */
    public function getLeadId()
    {
        return ArrayHelper::getValue($this->getRawData(), 'uuid');
    }
}
