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
    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';

    const PHONE_PLAN_PREPAID = 'PREPAID';
    const PHONE_PLAN_CONTRACT = 'CONTRACT';

    const EMPLOYMENT_EMPLOYED_INDEFINITE_PERIOD = 'EMPLOYED_INDEFINITE_PERIOD';
    const EMPLOYMENT_EMPLOYED_SPECIFIED_PERIOD = 'EMPLOYED_SPECIFIED_PERIOD';
    const EMPLOYMENT_WRITTEN_CONTRACT_OR_ORDER = 'WRITTEN_CONTRACT_OR_ORDER';
    const EMPLOYMENT_ECONOMIC_ACTIVITY = 'ECONOMIC_ACTIVITY';
    const EMPLOYMENT_UNEMPLOYED = 'UNEMPLOYED';
    const EMPLOYMENT_MATERNITY_LEAVE = 'MATERNITY_LEAVE';
    const EMPLOYMENT_BENEFITS = 'BENEFITS';
    const EMPLOYMENT_STUDENT = 'STUDENT';
    const EMPLOYMENT_PENSIONER1 = 'PENSIONER1';
    const EMPLOYMENT_PENSIONER2 = 'PENSIONER2';
    const EMPLOYMENT_OTHER = 'OTHER';

    const MARITAL_STATUS_SINGLE = 'SINGLE';
    const MARITAL_STATUS_MARRIED = 'MARRIED';
    const MARITAL_STATUS_DIVORCED = 'DIVORCED';
    const MARITAL_STATUS_WITH_PARTNER = 'WITH_PARTNER';
    const MARITAL_STATUS_WIDOW = 'WIDOW';

    const HOUSING_TYPE_RENTED_ROOM = 'RENTED_ROOM';
    const HOUSING_TYPE_RENTED_APARTMENT_OR_HOUSE = 'RENTED_APARTMENT_OR_HOUSE';
    const HOUSING_TYPE_OWN_HOUSE_OR_APARTMENT = 'OWN_HOUSE_OR_APARTMENT';
    const HOUSING_TYPE_WITH_PARENTS = 'WITH_PARENTS';

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

    public $housingType;

    public $netoIncome;

    public $occupation;

    public $employedSince;

    public $remunerationDeadline;

    public $bankAccountNumber;

    public $loanSum;

    public $loanPeriod;

    public $maritalStatus;

    public $dependantCount;

    public $hasBadCreditHistory = false;

    public $hasAgreeElectronicServices = true;

    public $hasAgreePersonalDataProtection = true;

    public $hasAgreeDataSharing = true;

    public $hasLivingAtRegisteredAddress = true;

    public $monthlyExpenses;

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
                    'housingType',
                    'monthlyExpenses',
                ],
                'trim',
            ],
            ['personalId', 'filter', 'filter' => 'strtoupper'],
            [['bankAccountNumber', 'postalIndex'], 'filter', function ($value) {
                return preg_replace('/\s/', '', $value);
            }],
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
                    'housingType',
                    'monthlyExpenses',
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
                    'hasAgreeElectronicServices',
                    'hasAgreePersonalDataProtection',
                    'hasAgreeDataSharing',
                    'hasLivingAtRegisteredAddress',
                ],
                'default',
                'value' => true,
            ],
            [
                [
                    'hasBadCreditHistory',
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
                    'hasLivingAtRegisteredAddress',
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
            [['monthlyExpenses', 'netoIncome'], 'integer', 'min' => 1],
            [['birthDate', 'remunerationDeadline'], 'date', 'format' => 'php:Y-m-d'],
            ['employedSince', 'date', 'format' => 'php:Y-m-d', 'max' => (string)(new DateTime())->format('Y-m-d')],
            ['postalIndex', PostalIndexValidator::class],
            ['housingType', 'in', 'range' => [
                self::HOUSING_TYPE_RENTED_ROOM,
                self::HOUSING_TYPE_RENTED_APARTMENT_OR_HOUSE,
                self::HOUSING_TYPE_OWN_HOUSE_OR_APARTMENT,
                self::HOUSING_TYPE_WITH_PARENTS,
            ]],
        ];
    }
}
