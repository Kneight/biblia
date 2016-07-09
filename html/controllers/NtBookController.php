<?php

namespace app\controllers;

use Yii;
use app\models\NtBook;
use app\models\NtBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * NtBookController implements the CRUD actions for NtBook model.
 */
class NtBookController extends Controller
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
//                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'update', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['api'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all NtBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NtBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NtBook model.
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
     * Finds the NtBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NtBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NtBook::findOne($id)) !== null) {
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
        $searchModel = new NtBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //we want it all
        $dataProvider->pagination = false;
        $results = $dataProvider->getModels();
        $output = array();
        foreach( $results as $model )
        {
            /* @var app/models/NtBook $model */
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
