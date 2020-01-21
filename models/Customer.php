<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property string $name
 * @property string $address
 * @property string $gender
 * @property string $contact_person
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'gender', 'contact_person'], 'required'],
            [['contact_person'], 'integer'],
            [['name', 'address'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 36],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'name' => 'Name',
            'address' => 'Address',
            'gender' => 'Gender',
            'contact_person' => 'Contact Person',
        ];
    }
}
