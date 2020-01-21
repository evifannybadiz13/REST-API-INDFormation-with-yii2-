<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property string $name
 * @property int $price
 * @property int $amount
 * @property string $type
 * @property string $expired
 *
 * @property Transaction[] $transactions
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'amount', 'type', 'expired'], 'required'],
            [['price', 'amount'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['type', 'expired'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'amount' => 'Amount',
            'type' => 'Type',
            'expired' => 'Expired',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['product_id' => 'product_id']);
    }
}
