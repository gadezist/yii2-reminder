<?php

namespace hiqdev\yii2\reminder\models;

use hipanel\base\SearchModelTrait;
use hipanel\helpers\ArrayHelper;

class ReminderSearch extends Reminder
{
    use SearchModelTrait
    {
        searchAttributes as defaultSearchAttributes;
    }

    public function searchAttributes()
    {
        return ArrayHelper::merge($this->defaultSearchAttributes(), []);
    }
}
