<?php

use yii\helpers\Html;
//use  yii\widgets\ListView;
use  yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'topic.name',
            [
                'attribute' => 'msg',
                'format' => 'html'
            ],

//            'file_name',

            [
                'label' => 'Прикреплённый файл',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(basename($data->file_name), URL::to($data->file_name, true),
                        [
                            'target' => '_blank'
                        ]
                    );
                }
            ]   ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
