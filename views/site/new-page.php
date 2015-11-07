<?php
use yii\helpers\Html;


$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1>Добро пожаловать!</h1>
<h3>Список страниц:</h3>

    <div class="body-content">
        <?php echo Html::beginForm(['site/new-page'])  ?>
        <table>
            <tr><div class="row">
    
                <?php echo "<td>Контент: </td><td>". Html::textarea('content', $content, ['class' => 'title', ]). "</td>"; 
                
                
                ?>
                
            </div></tr>
            
            </table
        
            
                <div class="buttons">
                <?php 
                echo Html::submitButton('Создать страницу'); 
                echo Html::endForm();
                ?>
            </div>

</div>
