<?php

namespace backend\controllers;

use backend\models\Item;
use backend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

    /**
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Item();
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->gambar = UploadedFile::getInstance($model, 'gambar'); // Handle uploaded image file
    
            if ($model->validate()) {
                if ($model->save()) {
                    if ($model->gambar && is_uploaded_file($model->gambar->tempName)) {
                        $uploadPath = 'uploads/';
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
    
                        $newImagePath = $uploadPath . $model->gambar->baseName . '.' . $model->gambar->extension;
    
                        if ($model->gambar->saveAs($newImagePath)) {
                            $model->gambar = $model->gambar->baseName . '.' . $model->gambar->extension;
                            $model->save(); // Save the file path (without "uploads/") to the database
                        } else {
                            throw new \Exception('Failed to save file to ' . $uploadPath);
                        }
                    }
    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($this->request->isPost) {
        $model->load($this->request->post());
        $newImage = UploadedFile::getInstance($model, 'gambar'); // Handle uploaded image file

        if ($model->validate()) {
            if ($model->save()) {
                if ($newImage && is_uploaded_file($newImage->tempName)) {
                    $uploadPath = 'uploads/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }

                    $newImagePath = $uploadPath . $newImage->baseName . '.' . $newImage->extension;

                    if ($newImage->saveAs($newImagePath)) {
                        $model->gambar = $newImage->baseName . '.' . $newImage->extension;
                        $model->save(); // Save the file path (without "uploads/") to the database
                    } else {
                        throw new \Exception('Failed to save file to ' . $uploadPath);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
