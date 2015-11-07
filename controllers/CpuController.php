<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Cpu;
use app\models\ContentPages;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
    /*
        Класс для управления и работы с ЧПУ.
        Позволяет редактировать и создавать ЧПУ для страниц сайта.
        Чтобы удалить ЧПУ можно указать пустое значение.
    */
class CpuController extends Controller
{
    
    /*
        Дефолт.
    */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /*
       Выводит все текущие ЧПУ и интерфейс для работы с ними.
    */
    public function actionIndex()
    {

    $dataProvider = new ActiveDataProvider([
        'query' => ContentPages::find()->with('cpu')
                    ,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
        

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /*
      Событие создания ЧПУ для страницы, принимает $idPage (int - required) страницы и $alias (string). 
    */
    public function actionCreate($idPage)
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model = new Cpu;
            $model->page_id = $idPage;
            $model->alias = $request->post('alias');
            $model->save();
            return $this->redirect(array('/cpu'));
        }
        return $this->render('create', ['alias' => $model->alias, 'idPage' => $idPage]);
    }

    /*
      Событие изменения ЧПУ для страницы, принимает $idPage (int - required) страницы $alias (string)
    */
    public function actionEdit($idPage)
    {
        $model = new Cpu;
        $request = Yii::$app->request;
        $model = $model->find()->where(['page_id' => $idPage])->one();
        if ($request->isPost) {
            $alias = $request->post('Cpu')['alias'];
            if (empty($alias)) {
                $model->delete();
                return $this->redirect(array('/cpu'));
            } else {
                $model->alias = $alias;
            }
            
            $model->save();
            return $this->redirect(array('/cpu'));
        }
        
        return $this->render('edit', ['model' => $model]);
    }
    
}
