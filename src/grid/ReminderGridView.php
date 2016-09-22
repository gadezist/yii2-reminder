<?php

namespace hiqdev\yii2\reminder\grid;

use hipanel\grid\ActionColumn;
use hipanel\grid\BoxedGridView;
use Yii;

class ReminderGridView extends BoxedGridView
{
    public static function defaultColumns()
    {
        return [
            'periodicity' => [
                'filter' => false,
            ],
            'message' => [
                'filter' => false,
            ],
            'next_time' => [
                'filter' => false,
                'contentOptions' => [
                    'class' => 'reminder-next-time-modify'
                ]
            ],
            'actions' => [
                'class' => ActionColumn::class,
                'template' => '{view} {delete}',
                'header' => Yii::t('hipanel', 'Actions'),
            ],
        ];
    }
}
