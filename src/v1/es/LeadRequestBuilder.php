<?php

namespace credy\api\v1\es;

use credy\api\v1\ILeadRequestBuilder;

/**
 * Class LeadRequestBuilder
 * @package credy\api\v1\es
 */
class LeadRequestBuilder implements ILeadRequestBuilder
{
    /**
     * @return array
     */
    public function buildRequestData()
    {
        return [
            'lead' => [
                'first_name' => '',
                'last_name' => '',
                'university_name' => '',
                'university_city' => '',
                'id_card_number' => '',
                'personal_id' => '',
                'bank_account_number' => '',
                'phone' => '',
                'employer_phone' => '',
                'email' => '',
                'street' => '',
                'house_number' => '',
                'city' => '',
                'postal_index' => '',
                'lives_at_registered_address' => '',
                'secondary_city' => '',
                'secondary_street' => '',
                'secondary_house_number' => '',
                'secondary_postal_index' => '',
                'occupation' => '',
                'maternity_leave' => '',
                'employer' => '',
                'employer_work_city' => '',
                'neto_income' => '',
                'monthly_expenses' => '',
                'gender' => '',
                'marital_status' => '',
                'education' => '',
                'housing_type' => '',
                'housing_type_lived_months' => '',
                'housing_type_lived_years' => '',
                'affiliate' => '',
                'loan_sum' => '',
                'loan_period' => '',
                'agree_electronic_services' => '',
                'agree_personal_data_protection' => '',
                'agree_data_sharing' => '',
                'tax_id_number' => '',
            ],
        ];
    }
}
