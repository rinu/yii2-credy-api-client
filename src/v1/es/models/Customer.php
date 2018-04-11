<?php

namespace credy\api\v1\es\models;

use credy\api\v1\es\validators\IbanValidator;
use credy\api\v1\es\validators\NameValidator;
use credy\api\v1\es\validators\PersonalIdValidator;
use credy\api\v1\es\validators\PostalIndexValidator;
use DateTime;
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

    public $secondName;

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

    public $remunerationDeadline;

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
                    'secondName',
                    'gender',
                    'email',
                    'phone',
                    'phonePlan',
                    'nationality',
                    'birthDate',
                    'personalId',
                    'city',
                    'street',
                    'houseNumber',
                    'postalIndex',
                    'netoIncome',
                    'occupation',
                    'employedSince',
                    'remunerationDeadline',
                    'bankAccountNumber',
                    'loanSum',
                    'loanPeriod',
                    'maritalStatus',
                    'dependantCount',
                ],
                'trim',
            ],
            ['personalId', 'filter', 'filter' => 'strtoupper'],
            [
                [

                    'firstName',
                    'lastName',
                    'secondName',
                    'gender',
                    'email',
                    'phone',
                    'phonePlan',
                    'nationality',
                    'birthDate',
                    'personalId',
                    'city',
                    'street',
                    'houseNumber',
                    'postalIndex',
                    'netoIncome',
                    'occupation',
                    'bankAccountNumber',
                    'loanSum',
                    'loanPeriod',
                    'maritalStatus',
                    'dependantCount',

                    //'housing_type',
                    //'monthly_expenses'
                ],
                'required',
            ],
            [
                [
                    'firstName',
                    'lastName',
                    'secondName',
                ],
                NameValidator::class,
            ],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE]],
            [
                [
                    'hasBadCreditHistory',
                    'hasAgreeElectronicServices',
                    'hasAgreePersonalDataProtection',
                    'hasAgreeDataSharing',
                ],
                'default',
                'value' => false,
            ],
            [
                [
                    'hasBadCreditHistory',
                    'hasAgreeElectronicServices',
                    'hasAgreePersonalDataProtection',
                    'hasAgreeDataSharing',
                ],
                'boolean'
            ],
            ['personalId', PersonalIdValidator::class],
            ['email', 'email', 'checkDNS' => true],
            [
                [
                    'loanSum',
                    'loanPeriod',
                    'netoIncome',
                ],
                'integer',
            ],
            ['bankAccountNumber', IbanValidator::class],
            ['phonePlan', 'in', 'range' => [self::PHONE_PLAN_PREPAID, self::PHONE_PLAN_CONTRACT]],
            ['maritalStatus', 'in', 'range' => [
                self::MARITAL_STATUS_SINGLE,
                self::MARITAL_STATUS_MARRIED,
                self::MARITAL_STATUS_DIVORCED,
                self::MARITAL_STATUS_WITH_PARTNER,
                self::MARITAL_STATUS_WIDOW,
            ]],
            ['occupation', 'in', 'range' => [
                self::EMPLOYMENT_EMPLOYED_INDEFINITE_PERIOD,
                self::EMPLOYMENT_EMPLOYED_SPECIFIED_PERIOD,
                self::EMPLOYMENT_WRITTEN_CONTRACT_OR_ORDER,
                self::EMPLOYMENT_ECONOMIC_ACTIVITY,
                self::EMPLOYMENT_UNEMPLOYED,
                self::EMPLOYMENT_MATERNITY_LEAVE,
                self::EMPLOYMENT_BENEFITS,
                self::EMPLOYMENT_STUDENT,
                self::EMPLOYMENT_PENSIONER1,
                self::EMPLOYMENT_PENSIONER2,
                self::EMPLOYMENT_OTHER,
            ]],
            [
                [
                    'remunerationDeadline',
                    'employedSince'
                ],
                'required',
                'when' => function () {
                    return in_array($this->occupation, [
                        self::EMPLOYMENT_EMPLOYED_INDEFINITE_PERIOD,
                        self::EMPLOYMENT_ECONOMIC_ACTIVITY,
                        self::EMPLOYMENT_STUDENT,
                        self::EMPLOYMENT_MATERNITY_LEAVE,
                        self::EMPLOYMENT_PENSIONER1,
                    ]);
                },
            ],
            [['birthDate', 'remunerationDeadline'], 'date', 'format' => 'php:Y-m-d'],
            ['employedSince', 'date', 'format' => 'php:Y-m-d', 'max' => (string)(new DateTime())->format('Y-m-d')],
            ['postalIndex', PostalIndexValidator::class],
        ];
    }
}
