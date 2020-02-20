<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsDirectoryRegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Ins Directory Regions');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body">
        <div class="ins-directory-regions-index">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php

            echo \kartik\tree\TreeView::widget([
                'query' => \app\modules\icase\models\InsDirectoryRegions::find()->addOrderBy('root, lft'),
                'headingOptions' => ['label' => 'Store'],
                'rootOptions' => ['label'=>'<span class="text-primary">'.Yii::t('messages','Regions').'</span>'],
                'topRootAsHeading' => true, // this will override the headingOptions
                'fontAwesome' => true,
                'isAdmin' => false,
                'nodeLabel' => function ($node) {
                    return Yii::$app->language == 'uz' ? $node->name : $node->name_ru;
                },
                'iconEditSettings' => [
//            'show' => 'list',
//            'listData' => [
//                'folder' => 'Folder',
//                'file' => 'File',
//                'mobile' => 'Phone',
//                'bell' => 'Bell',
//            ]
                    'show' => 'none',
                ],
                'softDelete' => true,
                'cacheSettings' => ['enableCache' => false],
                'nodeAddlViews' => [
                    \kartik\tree\Module::VIEW_PART_2 => '@app/modules/icase/views/ins-directory-regions/_form',
                ]
            ]);

            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
