<?php

use smysloff\phpmvc\forms\Form;
use app\models\User;

/**
 * @var User $model
 */

?><h1>Авторизация</h1>

<?php $form = Form::begin(['name' => 'login', 'method' => 'post']) ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Войти</button>
<?php Form::end() ?>
