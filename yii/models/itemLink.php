<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "item_link".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $property_item_id
 *
 * @property Items $product
 * @property PropertyItem $propertyItem
 */
class ItemLink extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'property_item_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['property_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyItem::className(), 'targetAttribute' => ['property_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'property_item_id' => 'Property Item ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Items::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[PropertyItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyItem()
    {
        return $this->hasOne(PropertyItem::className(), ['id' => 'property_item_id']);
    }
}
