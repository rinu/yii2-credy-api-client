<?php

namespace credy\api\mx\models;

use yii\base\Model;

/**
 * Class Customer
 * @package credy\api\mx\models
 */
class Customer extends Model
{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $secondName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $personalId;

    /**
     * @var string
     */
    public $bankAccount;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $netoIncome;

    /**
     * @var string
     */
    public $taxIdNumber;

    /**
     * @var string
     */
    public $nationality;

    /**
     * @var boolean
     */
    public $hasBeneficiary;

    /**
     * @var boolean
     */
    public $hasCarLoan;

    /**
     * @var boolean
     */
    public $hasMortgage;

    /**
     * @var string
     */
    public $creditCardVerification;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'secondName',
                    'email',
                    'personalId',
                    'bankAccount',
                    'phone',
                    'netoIncome',
                    'taxIdNumber',
                    'nationality',
                    'creditCardVerification',
                ],
                'trim',
            ],
            [
                [
                    'firstName',
                    'lastName',
                    'secondName',
                    'email',
                    'personalId',
                    'bankAccount',
                    'phone',
                    'netoIncome',
                    'taxIdNumber',
                    'nationality',
                    'hasBeneficiary',
                    'hasCarLoan',
                    'hasMortgage',
                ],
                'required',
            ],
            [
                [
                    'hasBeneficiary',
                    'hasCarLoan',
                    'hasMortgage',
                ],
                'boolean',
            ],
        ];
    }
}
