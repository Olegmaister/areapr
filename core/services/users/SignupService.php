<?php

namespace core\services\users;

use core\entities\users\User;
use core\forms\users\SignupForm;
use core\repositories\users\UserRepository;
use Yii;


class SignupService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function signup(SignupForm $form) : User
    {
        $user = User::signup(
            $form->firstName,
            $form->lastName,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        return $user;
    }
}

