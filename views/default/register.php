<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\User $profile
 * @var string $userDisplayName
 */

$this->title = Yii::t('user', 'Register');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Título página -->
<section class="banner conheca titulo-page">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>faça seu cadastro</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cadastre -->
<section class="contato cadastre">
    <div class="container ">
        <div class="row">
            <div class="">
                <h1>cadastre sua igreja</h1>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>Quer que sua igreja tenha um espaço no Churches?</h2>

                    <p>Peça ao responsável da sua igreja para se cadastrar e conecte milhares de pessoas a ela.</p>
                </div>
                <div class="">

                    <?php if ($flash = Yii::$app->session->getFlash("Register-success")): ?>

                        <div class="alert alert-success">
                            <p><?= $flash ?></p>
                        </div>

                    <?php else: ?>

                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'enableAjaxValidation' => true,
                    ]); ?>

                    <?= $form->field($user, 'full_name')->textInput() ?>

                    <?php if (Yii::$app->getModule("user")->requireEmail): ?>
                        <?= $form->field($user, 'email') ?>
                    <?php endif; ?>

                    <?php if (Yii::$app->getModule("user")->requireUsername): ?>
                        <?= $form->field($user, 'username') ?>
                    <?php endif; ?>

                    <?= $form->field($user, 'newPassword')->passwordInput() ?>

                    <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= Html::submitButton(Yii::t('user', 'Register'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</section>

<?php if (Yii::$app->get("authClientCollection", false)): ?>
    <div class="col-lg-offset-2 col-lg-10">
        <?= yii\authclient\widgets\AuthChoice::widget([
            'baseAuthUrl' => ['/user/auth/login']
        ]) ?>
    </div>
<?php endif; ?>

<?php endif; ?>

