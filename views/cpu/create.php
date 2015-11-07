<?php
use yii\helpers\Html;


$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1>Добро пожаловать!</h1>
<h3>Список страниц:</h3>

    <div class="body-content">
        <?php echo Html::beginForm(['cpu/create', 'idPage' => $idPage])  ?>
        <table>
            <tr><div class="row">
    
                <?php echo "<td>Алиас: </td><td>". Html::input('text', 'alias', $alias, ['class' => 'title', 'size'=>50]). "</td>"; 
                
                
                ?>
                
            </div></tr>
            
            </table
        
            
                <div class="buttons">
                <?php 
                echo Html::submitButton('Создать алиас', ['idPage' => $idPage], 'get'); 
                echo Html::endForm();
                ?>
            </div>

</div>
