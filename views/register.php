<?php

use smysloff\phpmvc\forms\Form;
use app\models\User;

/**
 * @var User $model
 */

?><h1>Регистрация</h1>

<?php $form = Form::begin(['name' => 'register', 'method' => 'post']) ?>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'lastname') ?>
    </div>
</div>
<?= $form->field($model, 'email') ?>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'password')->passwordField() ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'confirm')->passwordField() ?>
    </div>
</div>
<?= $form->submit('Создать') ?>
<?php Form::end() ?>
