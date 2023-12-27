<?php

namespace frontend\controllers;

use core\read\cabinet\PurchaseReadRepository;
use yii\filters\AccessControl;
use yii\web\Controller;

class CabinetController extends Controller
{

    public $layout = 'cabinet';
    private $purchases;

    public function __construct($id, $module, PurchaseReadRepository $purchases, $config = [])
    {
        $this->purchases = $purchases;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($page = 1, $perPage = 10)
    {
        $dataProvider = $this->purchases->getAll();

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}