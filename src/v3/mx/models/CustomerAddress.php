<?php

namespace credy\api\mx\models;

use Yii;
use yii\base\Model;

/**
 * Class CustomerAddress
 * @package credy\api\mx\models
 */
class CustomerAddress extends Model
{
    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $houseNumber;

    /**
     * @var string
     */
    public $flatNumber;

    /**
     * @var string
     */
    public $postalCode;

    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $county;

    /**
     * @var string
     */
    public $district;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'city',
                    'street',
                    'houseNumber',
                    'flatNumber',
                    'postalCode',
                    'region',
                    'county',
                    'district'
                ],
                'trim'
            ],
            [
                [
                    'city',
                    'street',
                    'houseNumber',
                    'postalCode',
                    'region',
                    'county',
                    'district'
                ],
                'required'
            ],
            ['postalCode', 'match', 'pattern' => '/^\d{5}$/'],
            ['flatNumber', 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city' => Yii::t('credy', 'City'),
            'street' => Yii::t('credy', 'Street'),
            'houseNumber' => Yii::t('credy', 'House number'),
            'flatNumber' => Yii::t('credy', 'Flat number'),
            'postalCode' => Yii::t('credy', 'Postal code'),
            'region' => Yii::t('credy', 'Region'),
            'county' => Yii::t('credy', 'County'),
            'district' => Yii::t('credy', 'District'),
        ];
    }
}
