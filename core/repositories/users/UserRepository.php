<?php

namespace core\repositories\users;

use core\entities\users\User;
use yii\base\Exception;

class UserRepository
{
    public function findByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new Exception('Saving error');
        }
    }

    private function getBy($condition): User
    {
        if (!$user = User::find()->where($condition)->andWhere(['status' => User::STATUS_ACTIVE])->one()) {
            throw new Exception('User not found.');
        }

        return $user;
    }
}