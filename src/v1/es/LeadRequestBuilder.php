<?php

namespace credy\api\v1\es;

use credy\api\v1\es\models\Customer;
use credy\api\v1\ILeadRequestBuilder;

/**
 * Class LeadRequestBuilder
 * @package credy\api\v1\es
 */
class LeadRequestBuilder implements ILeadRequestBuilder
{
    /**
     * @var Customer
     */
    private $_customer;

    /**
     * LeadRequestBuilder constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->_customer = $customer;
    }

    /**
     * @return array
     */
    public function buildRequestData()
    {
        return [
            'lead' => [
                'first_name' => $this->_customer->firstName,
                'last_name' => $this->_customer->lastName,
                'personal_id' => $this->_customer->personalId,
                'bank_account_number' => $this->_customer->bankAccountNumber,
                'phone' => $this->_customer->phone,
                'phone_plan' => $this->_customer->phonePlan,
                'email' => $this->_customer->email,
                'street' => $this->_customer->street,
                'house_number' => $this->_customer->houseNumber,
                'city' => $this->_customer->city,
                'postal_index' => $this->_customer->postalIndex,
                'occupation' => $this->_customer->occupation,
                'neto_income' => $this->_customer->netoIncome,
                'gender' => $this->_customer->gender,
                'marital_status' => $this->_customer->maritalStatus,
                'loan_sum' => $this->_customer->loanSum,
                'loan_period' => $this->_customer->loanPeriod,
                'nationality' => $this->_customer->nationality,
                'birth_date' => $this->_customer->birthDate,
                'employed_since' => $this->_customer->employedSince,
                'remuneration_deadline' => $this->_customer->remunerationDeadline,
                'dependant_count' => $this->_customer->dependantCount,
                'bad_credit_history' => $this->_customer->hasBadCreditHistory,
                'agree_electronic_services' => $this->_customer->hasAgreeElectronicServices,
                'agree_personal_data_protection' => $this->_customer->hasAgreePersonalDataProtection,
                'agree_data_sharing' => $this->_customer->hasAgreeDataSharing,
            ],
        ];
    }
}
