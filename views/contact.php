<?php

declare(strict_types=1);

/** @var $this View */
/** @var $model ContactForm */

use smysloff\phpmvc\forms\Form;
use smysloff\phpmvc\forms\TextareaField;
use smysloff\phpmvc\View;
use app\models\ContactForm;

$this->title = 'Контакты';

?>
<h1><?= $this->title ?></h1>

<?php $form = Form::begin(['name' => 'contact', 'method' => 'post']) ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'email') ?>
<?= new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Отправить</button>
<?php Form::end() ?>
