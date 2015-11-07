<?php
use yii\helpers\Html;
use yii\grid\GridView;


$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1>Добро пожаловать!</h1>
<h3>Список страниц:</h3>

    <div class="body-content">
        <?php 
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                'attribute' => "Number page",
                'value' => 'id'
                ],
                'cpu.alias:text',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{edit}',
                    'buttons' => [
                        'edit'=> function ($url, $model) use ($dataProvider)  {
                            if (empty($model->cpu->id)) {
                                return Html::a('<span class="fa fa-search">Создать</span>', ['cpu/create', 'idPage' => $model->id], [
                                    'title' => Yii::t('app', 'Edit'),
                                    'class'=>'btn btn-primary btn-xs',                                  
                            ]);
                            }
                        return Html::a('<span class="fa fa-search">Отредактировать</span>', ['cpu/edit', 'idPage' => $model->id], [
                                    'title' => Yii::t('app', 'Edit'),
                                    'class'=>'btn btn-primary btn-xs',                                  
                        ]);
                    },
                        
                    ]
                ]
            ],
        ]);
         ?>
    </div>
</div>
