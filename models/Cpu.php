<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "cpu".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $alias
 */
class Cpu extends ActiveRecord
{
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
        ['alias', 'validateAlias']
       ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
       return array(
            'id'           => 'id',
            'page_id'           => 'Номер страницы',
            'alias'           => 'Алиас для страницы',
        );
    }

    public function validateAlias($attribute, $params)
    {
        $valis = preg_match('~^[a-z0-9]+$~', $this->$attribute);
        if (empty($valis) and (mb_strlen($this->$attribute)>255)) {
            $this->addError($attribute, 'NOT VALID');
        }
    }
}
