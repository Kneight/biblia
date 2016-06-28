<?php

namespace app\controllers;

use Yii;
use app\models\Teaching;
use app\models\TeachingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeachingController implements the CRUD actions for Teaching model.
 */
class TeachingController extends Controller
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
        ];
    }

    /**
     * Lists all Teaching models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teaching model.
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
     * Creates a new Teaching model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teaching();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teaching model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teaching model.
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
     * Finds the Teaching model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teaching the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teaching::findOne($id)) !== null) {
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
        if (($model = Teaching::findOne($id)) !== null) {
            $model->hit_counter ++;
            $model->save();
        }
    }

    /**
     * Put in new resource controller
     * Output JSON array,
     * Needs to take Organization and language
     */
    public function actionApi( $language = 'pt', $organization = array(), $options = array() )
    {
        $searchModel = new TeachingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //we want it all
        $dataProvider->setPagination( [ 'pageSize' => 1000 ] );
        $results = $dataProvider->getModels();
        $output = array();
        foreach( $results as $model )
        {
            /* @var app/models/Teaching $model
             * @property integer $id
             * @property integer $primary_language_id
             * @property integer $secondary_language_id
             * @property string $en_title
             * @property string $pt_title
             * @property string $url
             * @property integer $teacher_id
             * @property string $length
             * @property integer $organization_id
             * @property integer $hit_counter
             */
            $output[] = [
                'id'                    => $model->getAttribute( 'id' ),
                'primary_language_id'   => $model->getAttribute( 'primary_language_id' ),
                'secondary_language_id' => $model->getAttribute( 'secondary_language_id' ),
                'en_title'              => $model->getAttribute( 'en_title' ),
                'pt_title'              => $model->getAttribute( 'pt_title' ),
                'teaching_url'          => $model->getAttribute( 'url' ),
                'teacher_id'            => $model->getAttribute( 'teacher_id' ),
                'length'                => $model->getAttribute( 'length' ),
                'organization_id'       => $model->getAttribute( 'organization_id' ),
                'hit_counter'           => $model->getAttribute( 'hit_counter' ),
                'created_at'            => $model->getAttribute( 'created_at' ),
            ];
        }
        echo json_encode( $output, JSON_UNESCAPED_UNICODE );
    }
}
