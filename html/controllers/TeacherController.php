<?php

namespace app\controllers;

use Yii;
use app\models\Teacher;
use app\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'view', 'update', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'update', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teacher model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();

        $result = $model->load(Yii::$app->request->post());

        $model->file_upload = UploadedFile::getInstance($model, 'file_upload');
        if( $result && isset( $_FILES ) )
            $result = $result && $model->upload();

        if ( $result ) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $result = $model->load(Yii::$app->request->post());

        $model->file_upload = UploadedFile::getInstance($model, 'file_upload');
        if( $result && isset( $_FILES ) )
            $result = $result && $model->upload();

        if ( $result ) {
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Output JSON array,
     * Needs to take Organization and language
     */
    public function actionApi()
    {
        header('Access-Control-Allow-Origin: *');
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //we want it all
        $dataProvider->setPagination( [ 'pageSize' => 1000 ] );
        $results = $dataProvider->getModels();
        $output = array();
        foreach( $results as $model )
        {
            /* @var app/models/Organization $model
             * @property integer id
             * @property string en_name
             * @property string en_description
             * @property string pt_name
             * @property string pt_description
             * @property string location
             * @property string photo
             * @property integer organization_id
             */
            $output[] = [
                'id'                => $model->getAttribute( 'id' ),
                'en_name'           => $model->getAttribute( 'en_name' ),
                'en_description'    => $model->getAttribute( 'en_description' ),
                'pt_name'           => $model->getAttribute( 'pt_name' ),
                'pt_description'    => $model->getAttribute( 'pt_description' ),
                'photo'             => $model->getAttribute( 'photo' ),
                'location'          => $model->getAttribute( 'location' ),
                'organization_id'   => $model->getAttribute( 'organization_id' ),
            ];
        }
        echo json_encode( $output, JSON_UNESCAPED_UNICODE );
    }
}
