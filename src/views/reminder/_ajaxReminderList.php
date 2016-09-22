<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var array $remindInOptions */
/* @var array $reminders */
/* @var string $offset */

?>
<ul class="menu">
    <?php if (!empty($reminders)) : ?>
        <?php foreach ($reminders as $reminder) : ?>
            <li id="reminder-<?= $reminder->id ?>">
                <div>
                    <h4>
                        <?= Html::beginTag('a', ['href' => Url::toRoute([sprintf("@%s/view", $reminder->objectName), 'id' => $reminder->object_id])]) ?>
                        <?= Yii::t('hipanel/reminder', "{0} ID #{1}", [Yii::t('hipanel/reminder', ucfirst($reminder->objectName)), $reminder->object_id]) ?>
                        <small><?= Yii::t('hipanel/reminder', 'Next time') ?>
                            : <?= $reminder->calculateClientNextTime($offset) ?></small>
                        <?= Html::endTag('a') ?>
                    </h4>
                    <p>
                        <?= StringHelper::truncateWords(Html::encode($reminder->message), 3) ?>
                    </p>
                    <small>
                        <?= Yii::t('hipanel/reminder', 'Remind in') ?>:
                        <?php foreach ($remindInOptions as $time => $label) : ?>
                            <?= Html::button(
                                Yii::t('hipanel/reminder', $label),
                                [
                                    'class' => 'btn btn-xs btn-link reminder-update',
                                    'data' => [
                                        'reminder-id' => $reminder->id,
                                        'reminder-action' => $time,
                                    ],
                                ]
                            ) ?>
                        <?php endforeach ?>
                        <br>
                        <?= Html::button(Yii::t('hipanel/reminder', 'Don\'t remind'), [
                            'class' => 'btn btn-xs btn-block btn-danger reminder-delete lg-mt-10 md-mt-10',
                            'data' => [
                                'reminder-id' => $reminder->id,
                            ],
                        ]) ?>
                    </small>
                </div>
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        <li class="margin text-muted" style="font-size: small"><?= Yii::t('hipanel/reminder', 'You have no reminders') ?></li>
    <?php endif ?>
</ul>
