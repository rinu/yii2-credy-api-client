<?php

namespace credy\api\v3\mx;

use credy\api\v3\ICustomerRequestBuilder;
use credy\api\v3\mx\models\Customer;
use credy\api\v3\mx\models\CustomerAddress;
use credy\api\v3\mx\models\CustomerEmployment;

/**
 * Class CustomerRequestBuilder
 * @package credy\api\mx
 */
class CustomerRequestBuilder implements ICustomerRequestBuilder
{
    /**
     * @var Customer
     */
    private $_customer;

    /**
     * @var CustomerAddress
     */
    private $_address;

    /**
     * @var CustomerEmployment
     */
    private $_employment;

    /**
     * CustomerRequestBuilder constructor.
     * @param Customer $customer
     * @param CustomerAddress $address
     * @param CustomerEmployment $employment
     */
    public function __construct(Customer $customer, CustomerAddress $address, CustomerEmployment $employment)
    {
        $this->_customer = $customer;
        $this->_address = $address;
        $this->_employment = $employment;
    }

    /**
     * @return array
     */
    public function buildRequestData()
    {
        return [
            'first_name' => $this->_customer->firstName,
            'last_name' => $this->_customer->lastName,
            'second_last_name' => $this->_customer->secondName,
            'email' => $this->_customer->email,
            'personal_id' => $this->_customer->personalId,
            'remuneration_deadline' => $this->_employment->remunerationDeadline,
            'bank_account' => $this->_customer->bankAccount,
            'phone' => $this->_customer->phone,
            'neto_income' => $this->_customer->netoIncome,
            'address' => [
                'city' => $this->_address->city,
                'street' => $this->_address->street,
                'house_number' => $this->_address->houseNumber,
                'flat_number' => $this->_address->flatNumber,
                'postal_code' => $this->_address->postalCode,
                'region' => $this->_address->region,
                'county' => $this->_address->county,
                'district' => $this->_address->district,
            ],
            'occupation' => $this->_employment->type,
            'employer_phone' => $this->_employment->employerPhone,
            'tax_id_number' => $this->_customer->taxIdNumber,
            'nationality' => $this->_customer->nationality,
            'has_beneficiary' => $this->_customer->hasBeneficiary,
            'has_carloan' => $this->_customer->hasCarLoan,
            'has_mortgage' => $this->_customer->hasMortgage,
            'credit_card_verification' => $this->_customer->creditCardVerification,
            'employer' => $this->_employment->employer,
            'current_job_position' => $this->_employment->currentJobPosition,
        ];
    }
}
