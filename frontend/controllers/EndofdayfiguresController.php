<?php
namespace frontend\controllers;

use backend\models\Endofdayfigures;
use backend\models\EndofdayfiguresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;

/**
 * EndofdayfiguresController implements the CRUD actions for Endofdayfigures model.
 */
class EndofdayfiguresController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    //'only' => ['logout', 'signup', 'index'],
                    'rules' => [
                        [
                            'actions' => ['create', 'update', 'view', 'delete', 'index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Endofdayfigures models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EndofdayfiguresSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Endofdayfigures model.
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
     * Creates a new Endofdayfigures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Endofdayfigures();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $model->timestamp = date("Y-m-d h:i:s");
            if($model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['/', 'active_tab' =>'endofday']);
            }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', ['model' => $model]);
    }
    
    
    public function actionCreate1()
    {
        $model = new Endofdayfigures();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
            if ($model->load(Yii::$app->request->post())){
                $model->timestamp = date("Y-m-d h:i:s");
             if($model->save()) {
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'message' => 'Data has been saved.',
                    ],
                    'code' => 0,
                ];
                }
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'model' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
        }
    }
    
    /**
     * Updates an existing Endofdayfigures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($this->request->isPost && $model->load($this->request->post())){
          $model->timestamp = date("Y-m-d h:i:s");  
         if($model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['/', 'active_tab' =>'endofday']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Endofdayfigures model.
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
     * Finds the Endofdayfigures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Endofdayfigures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Endofdayfigures::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
