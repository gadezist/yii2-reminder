<?php

use hipanel\widgets\IndexPage;
use hipanel\widgets\Pjax;
use hiqdev\yii2\reminder\grid\ReminderGridView;

$this->title = Yii::t('hipanel/reminder', 'Reminders');
$this->params['subtitle'] = array_filter(Yii::$app->request->get($model->formName(), [])) ? Yii::t('hipanel', 'filtered list') : Yii::t('hipanel', 'full list');
$this->params['breadcrumbs'][] = $this->title;

$representation = Yii::$app->request->get('representation');

?>

<?php Pjax::begin(array_merge(Yii::$app->params['pjax'], ['enablePushState' => true])) ?>
<?php $page = IndexPage::begin([
    'model' => $model,
    'dataProvider' => $dataProvider,
    'searchView' => '@hipanel/views/reminder/_search',
]) ?>
    <?php $page->setSearchFormData(compact([])) ?>

    <?php $page->beginContent('show-actions') ?>
        <?= $page->renderLayoutSwitcher() ?>
        <?= $page->renderSorter([
            'attributes' => [
                'id',
            ],
        ]) ?>
        <?= $page->renderPerPage() ?>
    <?php $page->endContent() ?>

    <?php $page->beginContent('bulk-actions') ?>
        <?= $page->renderBulkButton(Yii::t('hipanel', 'Delete'), '/reminder/delete', 'danger') ?>
    <?php $page->endContent() ?>

    <?php $page->beginContent('table') ?>
        <?php $page->beginBulkForm() ?>
        <?= ReminderGridView::widget([
            'boxed' => false,
            'dataProvider' => $dataProvider,
            'filterModel' => $model,
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-condensed'
            ],
            'columns' => [
                'checkbox',
                'periodicity', 'next_time',
                'actions',
            ],
        ]) ?>
        <?php $page->endBulkForm() ?>
    <?php $page->endContent() ?>
<?php $page->end() ?>
<?php Pjax::end() ?>
