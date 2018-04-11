<?php

namespace credy\api\v1\es\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class PostalIndexValidator
 * @package credy\api\v1\es\validators
 */
class PostalIndexValidator extends RegularExpressionValidator
{
    /**
     * @inheritdoc
     */
    public $pattern = '/^(0[1-9]|[1-4][0-9]|5[0-2])\d{3}$/';
}
