<?php
use yii\helpers\Html;


$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1>Добро пожаловать!</h1>
<h3>Список страниц:</h3>

    <div class="body-content">
        <?php 
        if (!empty($pages)) {
           foreach ($pages as $page) {
            if ($page['cpu']['alias']) {
                echo "<br/>".Html::a('Страница номер ' . $page['id'], ['/site/content', 'id' => $page['cpu']['alias']]);
            }
            echo "<br/>".Html::a('Страница номер ' . $page['id'], ['/site/content', 'id' => $page['id']]);  
               
            }
        }
        ?>
        <br>
        <?php
        if (!Yii::$app->user->isGuest) {
            echo Html::a('<span class="fa fa-search">Добавить страницу</span>', ['site/new-page'], [
                                    'class'=>'btn btn-primary btn-xs',                                  
                        ]);
        }
         ?>
    </div>
</div>
