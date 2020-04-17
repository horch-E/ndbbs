<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel common\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Create Test', ['create'], [
        'class' => 'btn btn-success',
        'id' => 'create',
        'data-toggle' => 'modal',
        'data-target' => '#operate-modal',
    ]) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => '操作',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a("详细", $url, [
                                'title' => '栏目详细', 
                                // btn-update 目标class
                                'class' => 'btn btn-info btn-view',
                                // 固定写法
                                'data-toggle' => 'modal',
                                // 指向modal中begin设定的id
                                'data-target' => '#operate-modal',
                        ]); 
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a("更新", $url, [
                                'title' => '栏目信息', 
                                // btn-update 目标class
                                'class' => 'btn btn-primary btn-update',
                                'data-toggle' => 'modal',
                                'data-target' => '#operate-modal',
                        ]); 
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', $url, [
                            'title' => '删除',
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => '确定要删除么?',
                                'method' => 'post',
                            ],
                        ]); 
                    },
                ],
            ],

        ],
    ]); ?>


</div>

<?php
// 创建modal

Modal::begin([
    'id' => 'operate-modal',
    'header' => '<h4 class="modal-title"></h4>',
]); 
Modal::end();
// 创建
$requestCreateUrl = Url::toRoute('create');
// 更新
$requestUpdateUrl = Url::toRoute('update');
// 详细
$requestViewUrl = Url::toRoute('view');
$js = <<<JS
    // 创建操作
    $('#create').on('click', function () {
        $('.modal-title').html('创建');
        $.get('{$requestCreateUrl}',
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
    // 更新操作
    $('.btn-update').on('click', function () {
        $('.modal-title').html('信息');
        $.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
    // 查看详细操作
    $('.btn-view').on('click', function () {
        $('.modal-title').html('详细');
        $.get('{$requestViewUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
JS;
$this->registerJs($js);
?>
