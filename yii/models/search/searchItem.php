<?php


namespace app\models\search;

use app\models\itemLink;
use app\models\Items;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class searchItem extends Items
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['id', 'integer'],
            ['name', 'string']
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

        $query->filterWhere(['id' => $this->id]);

        $query->andFilterWhere(['LIKE' , 'product_id', $this->name]);

        return $dataProvider;
    }
}