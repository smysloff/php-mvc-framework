<?php

declare(strict_types=1);

namespace app\models;

use smysloff\phpmvc\UserModel;

/**
 * Class RegisterModel
 *
 * @author Alexander Smyslov <smyslov@selby.su>
 * @package smysloff\phpmvc\models
 */
class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    /**
     * @var string
     */
    public string $firstname = '';

    /**
     * @var string
     */
    public string $lastname = '';

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $password = '';

    /**
     * @var string
     */
    public string $confirm = '';

    /**
     * @var int
     */
    public int $status = self::STATUS_INACTIVE;

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    /**
     * @return string
     */
    public static function primaryKey(): string
    {
        return 'id';
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [
                self::RULE_REQUIRED
            ],
            'lastname' => [
                self::RULE_REQUIRED
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 8],
                [self::RULE_MAX, 'max' => 24]
            ],
            'confirm' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password',
            'status'
        ];
    }

    /**
     * @return array
     */
    public function labels(): array
    {
        return [
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'email' => 'Электронный адрес',
            'password' => 'Пароль',
            'confirm' => 'Подтверждение пароля',
        ];
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
