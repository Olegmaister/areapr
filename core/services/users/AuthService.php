<?php

namespace core\services\users;

use core\entities\users\User;
use core\forms\users\LoginForm;
use core\repositories\users\UserRepository;
use yii\base\Exception;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByEmail($form->email);

        if (!$user || !$user->validatePassword($form->password)) {
            throw new Exception('Undefined user or password.');
        }

        return $user;
    }
}
