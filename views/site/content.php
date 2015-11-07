<?php
use yii\helpers\Html;


$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1><?php echo 'Страница номер ' . $page['id']; ?></h1>
    

    <div class="body-content">
        <?php 
        if (!empty($page)) {
            echo $page['content']."<br>";
        }
         ?>
    </div>
</div>
