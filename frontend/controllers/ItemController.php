<?php

namespace frontend\controllers;

use frontend\models\Item;
use frontend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    // /**
    //  * @inheritDoc
    //  */
    // public function beforeAction($action)
    // {
    //     try {
    //         if ($action->id == 'index' || $action->id == 'view') {
    //             $data['access_time'] = date('Y-m-d H:i:s');
    //             $data['user_ip'] = $this->request->userIP ?? '0';
    //             $data['user_host'] = $this->request->userHost ?? '0';
    //             $data['path_info'] = $this->request->pathInfo ?? '0';
    //             $data['query_string'] = $this->request->queryString ?? '0';

    //             $query = Yii::$app->db->createCommand()->insert('statistic', $data)->execute();
    //             Yii::info('Berhasil menyimpan data statistik', 'application');
    //         }
    //         return parent::beforeAction($action);
    //     } catch (\Exception $e) {
    //         Yii::error('Gagal menyimpan data statistik: ' . $e->getMessage(), 'application');
    //     }        
    // }

    /**
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
       // Membuat instance model Item
        $item = new Item();
        // Memanggil metode recordStatistic() yang akan mengaktifkan event
        $item->recordStatistic();

        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       // Membuat instance model Item
        $item = new Item();
        // Memanggil metode recordStatistic() yang akan mengaktifkan event
        $item->recordStatistic();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }
    }
}

