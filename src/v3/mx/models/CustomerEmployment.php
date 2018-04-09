<?php

namespace credy\api\mx\models;

use yii\base\Model;

/**
 * Class CustomerEmployment
 * @package credy\api\mx\models
 */
class CustomerEmployment extends Model
{
    const TYPE_EMPLOYED_INDEFINITE_PERIOD = 'EMPLOYED_INDEFINITE_PERIOD';
    const TYPE_EMPLOYED_SPECIFIED_PERIOD = 'EMPLOYED_SPECIFIED_PERIOD';
    const TYPE_WRITTEN_CONTRACT_OR_ORDER = 'WRITTEN_CONTRACT_OR_ORDER';
    const TYPE_PENSIONER1 = 'PENSIONER1';
    const TYPE_STUDENT = 'STUDENT';
    const TYPE_UNEMPLOYED = 'UNEMPLOYED';
    const TYPE_SELF_EMPLOYED = 'SELF_EMPLOYED';
    const TYPE_FARMER = 'FARMER';
    const TYPE_FREELANCER = 'FREELANCER';
    const TYPE_OWN_BUSINESS = 'OWN_BUSINESS';
    const TYPE_OTHER = 'OTHER';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $employer;

    /**
     * @var string
     */
    public $employerPhone;

    /**
     * @var string
     */
    public $currentJobPosition;

    /**
     * @var string
     */
    public $remunerationDeadline;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'employer', 'employerPhone', 'currentJobPosition', 'remunerationDeadline'], 'trim'],
            [['type'], 'required'],
            [['type'], 'in', 'range' => [
                self::TYPE_EMPLOYED_INDEFINITE_PERIOD,
                self::TYPE_EMPLOYED_SPECIFIED_PERIOD,
                self::TYPE_WRITTEN_CONTRACT_OR_ORDER,
                self::TYPE_PENSIONER1,
                self::TYPE_STUDENT,
                self::TYPE_UNEMPLOYED,
                self::TYPE_SELF_EMPLOYED,
                self::TYPE_FARMER,
                self::TYPE_FREELANCER,
                self::TYPE_OWN_BUSINESS,
                self::TYPE_OTHER,
            ]],
            [['employer', 'employerPhone', 'currentJobPosition', 'remunerationDeadline'], 'required', 'when' => function (CustomerEmployment $model) {
                return in_array($model->type, [
                    self::TYPE_EMPLOYED_INDEFINITE_PERIOD,
                    self::TYPE_EMPLOYED_SPECIFIED_PERIOD,
                    self::TYPE_WRITTEN_CONTRACT_OR_ORDER,
                ]);
            }],
        ];
    }
}
