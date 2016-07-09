<?php

namespace app\controllers;

use Yii;
use app\models\Resource;
use app\models\ResourceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ResourceController implements the CRUD actions for Resource model.
 */
class ResourceController extends Controller
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
     * Lists all Resource models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resource model.
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
     * Creates a new Resource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resource();

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
     * Updates an existing Resource model.
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

        if ( $result && $model->save() ) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Resource model.
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
     * Finds the Resource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resource::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * API call to increase hit counter.  Call it on a download
     */
    public function actionHit( $id )
    {
        if (($model = Resource::findOne($id)) !== null) {
            $model->hit_counter ++;
            $model->save();
        }
    }

    /**
     * Put in new resource controller
     * Output JSON array,
     * Needs to take Organization and language
     */
    public function actionApi( $limit = 1000, $language = 'pt', $organization = array(), $options = array() )
    {
        header('Access-Control-Allow-Origin: *');
        $searchModel = new ResourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //we want it all
        $dataProvider->setPagination( [ 'pageSize' => $limit ] );
        $results = $dataProvider->getModels();
        $output = array();
        foreach( $results as $model )
        {
            /* @var app/models/Resource $model
             * @property integer $id
             * @property integer $resource_type_id
             * @property integer $organization_id
             * @property integer $hit_counter
             * @property integer $teacher_id
             * @property integer $primary_language_id
             * @property integer $secondary_language_id
             * @property string $en_name
             * @property string $pt_name
             * @property string $en_description
             * @property string $pt_description
             * @property string $resource_url
             */
            $output[] = [
                'id'                    => $model->getAttribute( 'id' ),
                'resource_type'         => !is_null($model->resourceType->name) ? $model->resourceType->name : '',
                'organization_id'       => $model->getAttribute( 'organization_id' ),
                'teacher_id'            => $model->getAttribute( 'teacher_id' ),
                'primary_language_id'   => $model->getAttribute( 'primary_language_id' ),
                'secondary_language_id' => $model->getAttribute( 'secondary_language_id' ),
                'en_name'               => $model->getAttribute( 'en_name' ),
                'pt_name'               => $model->getAttribute( 'pt_name' ),
                'en_description'        => $model->getAttribute( 'en_description' ),
                'pt_description'        => $model->getAttribute( 'pt_description' ),
                'resource_url'          => $model->getAttribute( 'resource_url' ),
                'hit_counter'           => $model->getAttribute( 'hit_counter' ),
                'created_at'            => $model->getAttribute( 'created_at' ),
            ];
        }
        echo json_encode( $output, JSON_UNESCAPED_UNICODE );
    }
}
