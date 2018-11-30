<?php

namespace credy\api\v3;

use yii\helpers\ArrayHelper;

class LeadStatusResponse extends Response
{
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_ACCEPTED = 'ACCEPTED';
    const STATUS_INTERACTION = 'INTERACTION';

    /**
     * @return string
     */
    public function getStatus()
    {
        return ArrayHelper::getValue($this->getRawData(), 'status');
    }
}
