<?php

declare(strict_types=1);

namespace app\models;

use smysloff\phpmvc\Application;
use smysloff\phpmvc\Model;

/**
 * Class LoginForm
 *
 * @author Alexander Smyslov <smyslov@selby.su>
 * @package app\models
 */
class LoginForm extends Model
{
    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $password = '';

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return  [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    /**
     * @return string[]
     */
    public function labels(): array
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        Application::$app->login($user);
        return true;
    }
}
