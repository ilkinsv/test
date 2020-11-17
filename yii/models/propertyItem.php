<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "property_item".
 *
 * @property int $id
 * @property string $property
 * @property int|null $category_id
 *
 * @property ItemLink[] $itemLinks
 * @property CategoryProperty $category
 */
class PropertyItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property'], 'required'],
            [['property'], 'string'],
            [['category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryProperty::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property' => 'Property',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[ItemLinks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemLinks()
    {
        return $this->hasMany(ItemLink::className(), ['property_item_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryProperty::className(), ['id' => 'category_id']);
    }
}
