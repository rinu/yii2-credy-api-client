<?php

namespace credy\api\v1\es\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class PersonalIdValidator
 * @package credy\api\v1\es\validators
 */
class PersonalIdValidator extends RegularExpressionValidator
{
    /**
     * @inheritdoc
     */
    public $pattern = '/((^[A-Za-z]{1}[0-9]{7}[A-Za-z0-9]{1}$|^[T]{1}[A-Za-z0-9]{8}$)|^[0-9]{8}[A-Za-z]{1}$)/';
}
