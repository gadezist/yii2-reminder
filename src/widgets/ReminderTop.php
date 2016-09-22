<?php

namespace hiqdev\yii2\reminder\widgets;

use hipanel\models\Reminder;
use hiqdev\yii2\reminder\assets\ReminderTopAsset;
use Yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\Url;

class ReminderTop extends Widget
{
    public $loaderTemplate = '<div class="reminder-ajax-loader text-center text-muted"><i class="fa fa-refresh fa-2x fa-spin fa-fw"></i></div>';

    public function init()
    {
        parent::init();
        Yii::$app->assetManager->forceCopy = true;
        $reminderOptions = Json::encode([
            'listUrl' => Url::to('@reminder/ajax-reminders-list'),
            'deleteUrl' => Url::to('@reminder/delete'),
            'updateUrl' => Url::to('@reminder/update'),
            'getCountUrl' => Url::to('@reminder/get-count'),
            'loaderTemplate' => $this->loaderTemplate,
        ]);
        $this->registerClientScript($reminderOptions);
    }

    public function run()
    {
        $count = Reminder::find()->toSite()->count();
        $remindInOptions = Reminder::reminderNextTimeOptions();
        return $this->render('ReminderTop', [
            'count' => $count,
            'remindInOptions' => $remindInOptions,
            'loaderTemplate' => $this->loaderTemplate
        ]);
    }

    public function registerClientScript($options)
    {
        $view = $this->getView();
        ReminderTopAsset::register($view);
        $view->registerJs("$('#reminders').reminder({$options});");
    }
}
