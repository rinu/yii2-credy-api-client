<?php

namespace credy\api\v1\es\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class NameValidator
 * @package credy\api\v1\es\validators
 */
class NameValidator extends RegularExpressionValidator
{
    /**
     * @inheritdoc
     */
    public $pattern = '/^[a-zA-ZáéíñóúüÁÉÍÑÓÚÜ \-]+$/';
}
