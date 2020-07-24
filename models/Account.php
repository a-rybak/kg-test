<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\Request;

/**
 * This is the model class for table "account".
 *
 * @property int|null $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $account_number
 * @property int|null $available_amount
 * @property int|null $locked_amount
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Account extends \yii\db\ActiveRecord
{
    CONST STATUS_OK     = 'success';
    CONST STATUS_FAIL   = 'failed';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function fields()
    {
        return [
            'first_name',
            'last_name',
            'available_amount',
            'locked_amount'
        ];
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            $this->available_amount = 0;
            $this->locked_amount = 0;
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'available_amount', 'locked_amount'], 'integer'],
            [['available_amount', 'locked_amount'], 'required'],
            [['available_amount', 'locked_amount'], 'default', 'value' => 0],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['account_number'], 'string', 'max' => 34],
            [['account_number'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'account_number' => 'Account Number',
            'available_amount' => 'Available Amount',
            'locked_amount' => 'Locked Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findByAccountNumber($iban)
    {
        return self::find()->where(['account_number' => $iban])->limit(1)->one();
    }

}
