<?php

namespace frontend\controllers;

use core\forms\cabinet\PurchaseEditForm;
use core\forms\users\PurchaseCreateForm;
use core\forms\users\PurchaseItemForm;
use core\read\cabinet\PurchaseReadRepository;
use core\services\cabinet\PurchaseService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class PurchaseController extends Controller
{
    public $layout = 'cabinet';
    private $service;
    private $purchases;

    public function __construct(
        $id,
        $module,
        PurchaseService $service,
        PurchaseReadRepository $purchases,
        $config = []
    )
    {
        $this->service = $service;
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
                'only' => ['create','edit'],
                'rules' => [
                    [
                        'actions' => ['create','edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $form = new PurchaseCreateForm();

        if (Yii::$app->request->isPost) {
            $form->items = $this->recalculationOfForms();
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $this->service->create($form);
                    return $this->redirect(['cabinet/index']);
                } catch (\Exception $e) {
                    //flashSession =>
                }
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionEdit(int $id)
    {
        $purchase = $this->purchases->find($id);

        if (!$purchase) {
            return $this->redirect(['cabinet/index']);
        }

        $form = new PurchaseEditForm($purchase);

        if (Yii::$app->request->isPost) {
            $form->items = $this->recalculationOfForms();
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $this->service->edit($purchase, $form);
                    return $this->redirect(['cabinet/index']);
                } catch (\Exception $e) {
                    //flashSession =>
                }
            }
        }

        return $this->render('edit', [
            'purchase' => $purchase,
            'model' => $form,
        ]);
    }

    public function recalculationOfForms()
    {
        $count = count(Yii::$app->request->post('PurchaseItemForm'));
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = new PurchaseItemForm();
        }

        return $data;
    }


}

