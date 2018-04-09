<?php

namespace credy\api\v1\es\models;

use yii\base\Model;

class Customer extends Model
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const PHONE_PLAN_PREPAID = 'prepaid';
    const PHONE_PLAN_CONTRACT = 'contract';

    public $firstName;

    public $lastName;

    public $gender;

    public $email;

    public $phone;

    public $phonePlan;

    public $nationality;

    public $birthDate;

    public $personalId;

    public $city;

    public $street;

    public $houseNumber;

    public $postalIndex;

    public $netoIncome;

    public $occupation;

    public $employedSince;

    public $renumerationDeadline;

    public $bankAccountNumber;

    public $loanSum;

    public $loadPeriod;

    public $maritalStatus;

    public $dependantCount;

    public $hasBadCreditStory;

    public $hasAgreeElectronicServices;

    public $hasAgreePersonalDataProtection;

    public $hasAgreeDataSharing;

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
                ],
                'trim',
            ],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE]],
        ];
    }
}
