<?php

declare(strict_types=1);

namespace app\models;

use smysloff\phpmvc\Model;

/**
 * Class ContactForm
 *
 * @author Alexander Smyslov <smyslov@selby.su>
 * @package app\models
 */
class ContactForm extends Model
{
    /**
     * @var string
     */
    public string $subject = '';

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $body = '';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * @return array
     */
    public function labels(): array
    {
        return [
            'subject' => 'Тема письма',
            'email' => 'Почта',
            'body' => 'Текст письма',
        ];
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        return true;
    }
}
