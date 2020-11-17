<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $photo
 * @property float|null $price
 *
 * @property ItemLink[] $itemLinks
 */
class Items extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'photo'], 'string'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'photo' => 'Photo',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[ItemLinks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemLinks()
    {
        return $this->hasMany(ItemLink::className(), ['product_id' => 'id']);
    }


}
