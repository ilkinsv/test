<?php


namespace app\models\search;


use app\models\ItemLink;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class searchItemLink extends ItemLink
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['id, product_id, property_item_id', 'integer'],
        ]);
    }

    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            return $dataProvider;
        }

        $query->filterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'property_item_id' => $this->property_item_id,
            ]);

        return $dataProvider;
    }
}