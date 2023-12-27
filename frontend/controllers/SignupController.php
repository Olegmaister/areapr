<?php

namespace frontend\controllers;

use core\forms\users\SignupForm;
use core\services\users\SignupService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignupController extends Controller
{
    private $service;
    public function __construct(
        $id,
        $module,
        SignupService $service,
        $config = [])
    {
        $this->service = $service;
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
                'only' => ['signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->signup($form);
                Yii::$app->user->login($user,3600 * 24 * 30);
                Yii::$app->session->setFlash('success', 'Thank you for registration.');
            }catch (\DomainException $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }


}