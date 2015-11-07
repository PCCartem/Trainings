<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ContentPages;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/*
    Класс сайта в котором содержится логика контентных страниц.
*/

class SiteController extends Controller
{
    /*
        Дефолтное поведение. Над доступом я не стал работать особо.
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /*
        Дефолтный метод.
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
        Action Index - выводит список страниц сайта.
    */
    public function actionIndex()
    {
        $model = new ContentPages;
        $pages = $model->find()->with([
              'cpu' => function(ActiveQuery $q) use ($id) {
                $q->where('alias = "'.$id.'"');
              }
            ])->all();

        return $this->render('index', [ 'pages' => $pages]);
    }
    /*
        Action Content - выводит одну страницу сайта. 
        В нем заключена логика по которой преобразуется url.
    */
    public function actionContent($id)
    {
        $model = new ContentPages;
        // Если число то ищет страницу с таким числом, если у этой страницы есть алиас, делает редирект.
        // Иначе выводит контент этой страницы.
        if (is_numeric($id)) {
            $page = $model->find()
            ->with('cpu')
            ->where('id='.$id)
            ->one();
            if ($page['cpu']['page_id'] == $id) {
                return $this->redirect(array('/page/'.$page['cpu']['alias']));
            } elseif ($page['id'] == $id) {
                return $this->render('content', [ 'page' => $page]);
            }

        }
        // Выводит контент страницы с указаным алиасом.
        $page = $model->find()
            ->joinWith([
                'cpu' => function(ActiveQuery $q) use ($id) {
                    $q->where('alias = "'.$id.'"');
                  }
                ])
            ->one();
        
        if ($page['cpu']) {
                return $this->render('content', [ 'page' => $page]);
            }
            // Если ни одно из условий не верно перекидывает на страницу с ошибкой.
         throw new NotFoundHttpException('Page not found');
        
                
    }
    // Дефолтное событие авторизации
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    // Дефолтное событие выхода
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*
        Action новая страница - создает новую страницу с указанным контентом. 
    */
    public function actionNewPage()
    {
        
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model = new ContentPages;
            $model->content = $request->post('content');
            $model->save();
            return $this->redirect(array('/site'));
        }
        return $this->render('new-page', ['content' => $model->content]);

    }

    
}
