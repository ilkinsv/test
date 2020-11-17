<?php


namespace app\controllers;

use app\models\CategoryProperty;
use app\models\ItemLink;
use app\models\Items;
use app\models\PropertyItem;

use Yii;
use yii\web\Controller;


class CatalogController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $filters = $request->get('filter', []);
        $category = CategoryProperty::find()->all();
        $property = PropertyItem::find()->alias('property')
            ->innerJoin(['productProperty' => 'item_link'], 'productProperty.property_item_id = property.id')
            ->all();


        $query = Items::find()->alias('product');
        if (is_array($filters) && count($filters)) {
            $query->innerJoin(['productProperty' => 'item_link'], 'product.id = productProperty.product_id');
        }
        foreach ($filters as $catalog => $catalogitems) {
            $query->andWhere(['in', 'productProperty.property_item_id', $catalogitems]);
        }

        $models = $query->all();

        return $this->render('index',
            [
                'category' => $category,
                'property' => $property,
                'products' => $models,
                'filters' => $filters
            ]);

    }

    public function actionTest()
    {
        $request = Yii::$app->request;
        $filters = $request->get('filter', []);
        $filter_price_min = $request->get('price_min');
        $filter_price_max = $request->get('price_max');
        $category = CategoryProperty::find()->all();
        $property = PropertyItem::find()->alias('property')
            ->innerJoin(['productProperty' => 'item_link'], 'productProperty.property_item_id = property.id')
            ->all();



        $query = Items::find()->alias('product');



     //   var_dump($query); die;
    /*    if (is_array($filters) && count($filters)) {
            $query->innerJoin(['productProperty' => 'item_link'], 'product.id = productProperty.product_id');
        }
        foreach ($filters as $catalog => $catalogs) {
            $query->andWhere(['in', 'productProperty.property_item_id', $catalogs]);
        }*/



        $models = $query->all();

        return $this->render('test',
            [
                'category' => $category,
                'property' => $property,
                'products' => $models,
                'filters' => $filters,
                'filter_price' => $filter_price,
            ]);
    }
}