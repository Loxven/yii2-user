<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Denomination;
use amnah\yii2\user\models\Profile;


/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Edit Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-profile">

    <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <!--    --><?php //$form = ActiveForm::begin([
    //        'id' => 'profile-form',
    //        'options' => ['class' => 'form-horizontal'],
    //        'fieldConfig' => [
    //            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
    //            'labelOptions' => ['class' => 'col-lg-2 control-label'],
    //        ],
    //        'enableAjaxValidation' => true,
    //    ]); ?>

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <legend>Dados</legend>
        <div class="row">

            <div class="col-sm-4">
                <?= $form->field($profile, 'name_church') ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($profile, 'denomination_id')->dropDownList(
                    ArrayHelper::map(Denomination::find()->all(), 'id', 'name'),
                    [
                        'prompt' => 'Select Denomination',
                    ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($profile, 'email_church')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($profile, 'phone_church')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($profile, 'website')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($profile, 'mission')->textInput(['maxlength' => true]); ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Dados para página personalizada da igreja no aplicativo</legend>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($profile, 'title')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($profile, 'initials')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($profile, 'facebook_link')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($profile, 'email_app')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($profile, 'phone_app')->textInput(['maxlength' => true]); ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Disponibilizar a Igreja no Smartphone</legend>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($profile, 'available_app')->dropDownList($profile::statusAvailable()); ?>
            </div>
        </div>
    </fieldset>

    <!--    <fieldset>-->
    <!--        <legend>Dados de Localização</legend>-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm-12">-->
    <!--                --><? //= $form->field($model, 'coordinates')->widget(
    //                    'kolyunya\yii2\widgets\MapInputWidget',
    //                    [
    //                        'model' => $model,
    //                        'form' => $form,
    //                        'field' => 'address_one',
    //                        // Google maps browser key.
    //                        //'key' => $key,
    //
    //                        'latitude' => $model->latitude,
    //                        'longitude' => $model->longitude,
    //                        'zoom' => 12,
    //                        'width' => '100%',
    //                        'height' => '250px',
    //                        'pattern' => '%longitude%/%latitude%',
    //
    //                    ]
    //                ) ?>
    <!--            </div>-->
    <!--            <div class="col-sm-12">-->
    <!--                <div class="form-group">-->
    <!--                    --><? //= $form->field($model, 'address_two')->textInput(['maxlength' => true]) ?>
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </fieldset>-->

    <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>