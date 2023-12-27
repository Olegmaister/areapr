<?php

namespace frontend\controllers;

use core\entities\cabinet\Purchase;
use Yii;
use core\read\cabinet\PurchaseReadRepository;
use yii\filters\AccessControl;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller
{

    private $purchases;

    public function __construct(
        $id,
        $module,
        PurchaseReadRepository $purchases,
        $config = [])
    {
        $this->purchases = $purchases;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['purchase'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['purchase'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionPurchase($page = 1, $perPage = 10)
    {
        $dataProvider = $this->purchases->getList();
        return $this->render('list',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            $errorMessage = $exception->getMessage();
            // Добавьте сообщение об ошибке в Flash сообщения
            Yii::$app->session->setFlash('error', $errorMessage);
        }

        return $this->render('error');
    }

}
