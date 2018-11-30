<?php

namespace credy\api\v3;

use yii\helpers\ArrayHelper;

class CustomerResponse extends Response
{
    /**
     * @return string
     */
    public function getCustomerId()
    {
        return ArrayHelper::getValue($this->getRawData(), 'uuid');
    }
}
