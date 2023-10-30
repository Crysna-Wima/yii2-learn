<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use backend\models\Item;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'], // Apply the rules to the 'index' action
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        // Allow users, authenticated and guests, to access the 'index' action
                        'roles'=> ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Create a query for the 'item' table
        $query = (new \yii\db\Query())
            ->select(['item.*', 'item_category.name AS category_name', 'item_category.id AS category_id'])
            ->from('item')
            ->join('INNER JOIN', 'item_category', 'item.category_id = item_category.id')
            ->orderBy('id DESC');
    
        // Create a data provider with the query and configure pagination
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3, // Set the number of items per page
            ],
        ]);
    
        // Load the categories from the database and pass them to the view
        $categories = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from('item_category')
            ->all();
    
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories, // Pass the categories to the view
        ]);
    }
    

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
