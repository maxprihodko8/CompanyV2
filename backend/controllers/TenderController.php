<?php

namespace backend\controllers;

use common\models\db\search\BidSearch;
use common\models\helpers\ArrayHelper;
use common\models\service\BidService;
use common\models\service\CompanyService;
use Yii;
use common\models\db\Tender;
use common\models\db\search\TenderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TenderController implements the CRUD actions for Tender model.
 */
class TenderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tender models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TenderSearch();
        if ($searchModel->load(Yii::$app->request->post())) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tender model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModelBid = new BidSearch();
        $dataProviderBid = $searchModelBid->search(Yii::$app->request->queryParams);
        $dataProviderBid->query->where(['tender_id' => $id]);
        $dataProviderBid->query->orderBy('(UNIX_TIMESTAMP(bid.end_time) - UNIX_TIMESTAMP(bid.begin_time)) * bid.price');

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderBid' => $dataProviderBid,
            'searchModelBid' => $searchModelBid,
        ]);
    }

    /**
     * Creates a new Tender model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tender();

        $bids_list = BidService::getBidsListAssocArray();
        $company_list = CompanyService::getCompaniesAssocArray();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'bids_list' => $bids_list,
                'company_list' => $company_list,
            ]);
        }
    }

    /**
     * Updates an existing Tender model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $bids_list = ArrayHelper::setValueAtBeginning($model->winner_bid_id, BidService::getBidsListAssocArray());
        $company_list = ArrayHelper::setValueAtBeginning($id, CompanyService::getCompaniesAssocArray());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'bids_list' => $bids_list,
                'company_list' => $company_list,
            ]);
        }
    }

    /**
     * Deletes an existing Tender model.
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
     * Finds the Tender model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tender the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tender::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
