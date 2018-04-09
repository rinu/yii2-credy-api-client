<?php

namespace credy\api\v1\es\models;

use yii\base\Model;

/**
 * Class Customer
 * @package credy\api\v1\es\models
 */
class Customer extends Model
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const PHONE_PLAN_PREPAID = 'prepaid';
    const PHONE_PLAN_CONTRACT = 'contract';

    const EMPLOYMENT_EMPLOYED_INDEFINITE_PERIOD = 'employed_indefinite_period';
    const EMPLOYMENT_EMPLOYED_SPECIFIED_PERIOD = 'employed_specified_period';
    const EMPLOYMENT_WRITTEN_CONTRACT_OR_ORDER = 'written_contract_or_order';
    const EMPLOYMENT_ECONOMIC_ACTIVITY = 'economic_activity';
    const EMPLOYMENT_UNEMPLOYED = 'unemployed';
    const EMPLOYMENT_MATERNITY_LEAVE = 'maternity_leave';
    const EMPLOYMENT_BENEFITS = 'benefits';
    const EMPLOYMENT_STUDENT = 'student';
    const EMPLOYMENT_PENSIONER1 = 'pensioner1';
    const EMPLOYMENT_PENSIONER2 = 'pensioner2';
    const EMPLOYMENT_OTHER = 'other';

    const MARITAL_STATUS_SINGLE = 'single';
    const MARITAL_STATUS_MARRIED = 'married';
    const MARITAL_STATUS_DIVORCED = 'divorced';
    const MARITAL_STATUS_WITH_PARTNER = 'with_partner';
    const MARITAL_STATUS_WIDOW = 'widow';

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

    public $loanPeriod;

    public $maritalStatus;

    public $dependantCount;

    public $hasBadCreditHistory;

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
