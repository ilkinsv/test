<?php

use app\models\Items;
use yii\helpers\Html;

$this->title = 'Catalog';

/* @var $category array */
/* @var $property array
 * @var Items[] $products
 * @var $filters array
 */
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
Html::csrfMetaTags()

?>
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Каталог</h2>
        </div>
    </div>
    <?= var_dump($_GET) ?>
    <div class="wrap">
        <div class="container">
            <div class="columns">
                <div class="column col-3">
                    <div class="filter">
                        <?= Html::beginForm('test', 'get'); ?>
                        <!-- filter-item -->
                        <?php foreach ($category as $categories): ?>
                            <div class="filter-item">
                                <div class="filter-title"> <?= $categories->name ?>
                                </div>
                                <div class="filter-content">
                                    <ul class="filter-list">
                                            <?php foreach ($property as $propertys)
                                                if ($propertys->category_id == $categories->id):?>
                                                <?php
                                                $checked = ($filters[$categories->id] && in_array($propertys->id, $filters[$categories->id]));
                                                ?>
                                                    <li>
                                                        <input type="checkbox"
                                                               id="filter_<?= $propertys->id ?>"
                                                               name="filter[<?= $categories->id ?>][]"
                                                               value="<?= $propertys->id ?>"
                                                               <?= $checked ? ' checked' : '' ?>
                                                        >
                                                        <label for="filter<?= $propertys->id ?>">
                                                            <?= $propertys->property ?>
                                                        </label>
                                                    </li>
                                                <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-title">Цена</div>
                            <div class="filter-content">
                                <div class="price">
                                    <input type="text" id="filter_price_min" class="price-input ui-slider-min" value="0">
                                    <span class="price-sep"></span>
                                    <input type="text" id="filter_price_max" class="price-input ui-slider-max" value="2000">
                                </div>
                                <div class="ui-slider"></div>
                                <script>
                                    $('document').ready(function () {

                                        $('.ui-slider').slider({
                                            animate: false,
                                            range: true,
                                            values: [0, 2000],
                                            min: 0,
                                            max: 2000,
                                            step: 1,
                                            slide: function (event, ui) {
                                                if (ui.values[1] - ui.values[0] < 1) return false;
                                                 $('.ui-slider-min').val(ui.values[0]);
                                                 $('.ui-slider-max').val(ui.values[1]);

                                                $.ajax({
                                                    url:'test',
                                                    type: "GET",
                                                    data: {price_min:ui.values[0], price_max:ui.values[1],
                                            },

                                                })
                                            }
                                        })

                                    });
                                </script>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-content">
                                <!--<button id="sendfilter" class="btn" type="submit">Применить фильтр</button>
                                --><br>
                                <br>
                                <button class="btn" type="reset">Сбросить фильтр</button>
                            </div>
                        </div>
                        <?= Html::endForm(); ?>
                    </div>
                </div>
                <div class="column col-9">
                    <div class="columns">
                        <?php foreach ($products as $product):  ?>
                            <div class="column col-4">

                                <div class="element">
                                    <div class="element-image">
                                        <img src="<?= $product->photo ?>" alt="">
                                    </div>
                                    <div class="element-title">
                                        <a href=""><?= $product->name ?></a>
                                    </div>
                                    <div class="element-price"><?= $product->price; ?> ₽</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>