<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $supplier_id
 * @property string $name
 * @property string $address
 * @property string $contact_person
 * @property string $item_supplied
 * @property string $distributor_name
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'contact_person', 'item_supplied', 'distributor_name'], 'required'],
            [['contact_person'], 'integer'],
            [['name', 'address', 'item_supplied', 'distributor_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'Supplier ID',
            'name' => 'Name',
            'address' => 'Address',
            'contact_person' => 'Contact Person',
            'item_supplied' => 'Item Supplied',
            'distributor_name' => 'Distributor Name',
        ];
    }
}
