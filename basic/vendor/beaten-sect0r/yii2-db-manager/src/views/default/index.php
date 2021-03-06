<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;
use bs\dbManager\models\BaseDumpManager;

/* @var $this yii\web\View */
/* @var array $dbList */
/* @var array $activePids */
/* @var \bs\dbManager\models\Dump $model */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->title = Yii::t('dbManager', 'Copias de seguridad');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbManager-default-index">

    <div class="well">
        <?php $form = ActiveForm::begin([
            'action' => ['create'],
            'method' => 'post',
            'layout' => 'inline',
        ]) ?>

        <?= $form->field($model, 'db')->dropDownList(array_combine($dbList, $dbList), ['prompt' => ''])/* ?>

        <?= $form->field($model, 'isArchive')->checkbox() */?>

        <?= $form->field($model, 'schemaOnly')->checkbox() ?>

        <?php if (!BaseDumpManager::isWindows()) {
            echo $form->field($model, 'runInBackground')->checkbox();
        } ?>

        <?php if ($model->hasPresets()): ?>
            <?= $form->field($model, 'preset')->dropDownList($model->getCustomOptions(), ['prompt' => '']) ?>
        <?php endif ?>

        <?= Html::submitButton(Yii::t('dbManager', 'Crear copia de seguridad'), ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>

    <?php if (!empty($activePids)): ?>
        <div class="well">
            <h4><?= Yii::t('dbManager', 'Procesos activos:') ?></h4>
            <?php foreach ($activePids as $pid => $cmd): ?>
                <b><?= $pid ?></b>: <?= $cmd ?><br>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <p>
        <?= Html::a(Yii::t('dbManager', 'Eliminar todo'),
            ['delete-all'],
            [
                'class' => 'btn btn-danger',
                'data-method' => 'post',
                'data-confirm' => Yii::t('dbManager', '¿Estás seguro?'),
            ]
        ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'type',
                'label' => Yii::t('dbManager', 'Tipo'),
            ],
            [
                'attribute' => 'name',
                'label' => Yii::t('dbManager', 'Nombre'),
            ],
            [
                'attribute' => 'size',
                'label' => Yii::t('dbManager', 'Tamaño'),
            ],
            [
                'attribute' => 'create_at',
                'label' => Yii::t('dbManager', 'Fecha de creación'),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{download} {restore} {storage} {delete}',
                'buttons' => [
                    'download' => function ($url, $model) {
                        return Html::a('<i class="fas fa-download"></i>',
                            [
                                'download',
                                'id' => $model['id'],
                            ],
                            [
                                'title' => Yii::t('dbManager', 'Descargar'),
                                'class' => 'btn btn-sm btn-default',
                            ]);
                    },
                    'restore' => function ($url, $model) {
                        return Html::a('<i class="fas fa-file-import"></i>',
                            [
                                'restore',
                                'id' => $model['id'],
                            ],
                            [
                                'title' => Yii::t('dbManager', 'Restaurar'),
                                'class' => 'btn btn-sm btn-default',
                            ]);
                    },
                    'storage' => function ($url, $model) {
                        if (Yii::$app->has('backupStorage')) {
                            $exists = Yii::$app->backupStorage->has($model['name']);

                            return Html::a('<span class="glyphicon glyphicon-cloud-upload"></span>',
                                [
                                    'storage',
                                    'id' => $model['id'],
                                ],
                                [
                                    'title' => $exists ? Yii::t('dbManager', 'Eliminar todo desde el almacenamiento') : Yii::t('dbManager', 'Subir desde el almacenamiento'),
                                    'class' => $exists ? 'btn btn-sm btn-danger' : 'btn btn-sm btn-success',
                                ]);
                        }
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="far fa-trash-alt"></i>',
                            [
                                'delete',
                                'id' => $model['id'],
                            ],
                            [
                                'title' => Yii::t('dbManager', 'Eliminar'),
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('dbManager', '¿Estás seguro?'),
                                'class' => 'btn btn-sm btn-danger',
                            ]);
                    },
                ],
            ],
        ],
    ]) ?>

</div>
