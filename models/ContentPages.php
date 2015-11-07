<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $content
 */
class ContentPages extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
       return [
            'id'           => 'id',
            'contant'      => 'Контент',
            
        ];
    }

    public function getCpu()
    {
        return $this->hasOne(Cpu::className(), ['page_id' => 'id']);
    }
}
