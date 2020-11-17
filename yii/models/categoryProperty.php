<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category_property".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property PropertyItem[] $propertyItems
 */
class CategoryProperty extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
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
        ];
    }

    /**
     * Gets query for [[PropertyItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyItems()
    {
        return $this->hasMany(PropertyItem::className(), ['category_id' => 'id']);
    }
}
