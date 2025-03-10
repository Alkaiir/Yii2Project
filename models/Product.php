<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string $file
 * @property int $count
 * @property float $price
 * @property int $year
 * @property string $model
 * @property string $country
 * @property int $cetegory_id
 *
 * @property Cart[] $carts
 * @property Category $cetegory
 * @property ProductOrder[] $productOrders
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
            [['date', 'name', 'file', 'count', 'price', 'year', 'model', 'country', 'cetegory_id'], 'required'],
            [['date'], 'safe'],
            [['count', 'year', 'cetegory_id'], 'integer'],
            [['price'], 'number'],
            [['name', 'file', 'model', 'country'], 'string', 'max' => 255],
            [['cetegory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['cetegory_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'name' => 'Name',
            'file' => 'File',
            'count' => 'Count',
            'price' => 'Price',
            'year' => 'Year',
            'model' => 'Model',
            'country' => 'Country',
            'cetegory_id' => 'Cetegory ID',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Cetegory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCetegory()
    {
        return $this->hasOne(Category::class, ['id' => 'cetegory_id']);
    }

    /**
     * Gets query for [[ProductOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::class, ['product_id' => 'id']);
    }
}
