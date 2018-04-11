<?php

namespace credy\api\v1\es\validators;

use Exception;
use IBAN;
use Yii;
use yii\validators\Validator;

/**
 * Class IbanValidator
 * @package credy\api\v1\es\validators
 */
class IbanValidator extends Validator
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->message === null) {
            $this->message = Yii::t('credy', 'Iban is invalid');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function validateValue($value)
    {
        try {
            $iban = new IBAN($value);
            if (strtoupper($iban->Country()) != 'ES') {
                return [$this->message, []];
            }
            if (!$iban->Verify()) {
                return [$this->message, []];
            }
        } catch (Exception $e) {
            return [$this->message, []];
        }
        return null;
    }
}
