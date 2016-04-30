<?php

namespace app\controllers;

use Yii;
use app\models\OtBook;
use app\models\OtBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OtBookController implements the CRUD actions for OtBook model.
 */
class OtBookController extends Controller
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
     * Lists all OtBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OtBook model.
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
     * Finds the OtBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OtBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OtBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Output JSON array, Just give all the books
     * Needs to take Organization and language
     */
    public function actionApi()
    {
        $searchModel = new OtBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //we want it all
        $results = $dataProvider->getModels();
        $output = array();
        foreach( $results as $model )
        {
            /* @var app/models/OtBook $model */
            $output[] = [
                'Index'         => $model->getAttribute( 'id' ),
                'bookEN'        => $model->getAttribute( 'book_en' ),
                'bookPT'        => $model->getAttribute( 'book_pt' ),
                'bookCode'      => $model->getAttribute( 'book_code' ),
                'numChapters'   => $model->getAttribute( 'num_chapters' ),
            ];
        }
        echo json_encode( $output, JSON_UNESCAPED_UNICODE );

    }
}
