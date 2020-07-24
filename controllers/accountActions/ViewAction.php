<?php

namespace app\controllers\accountActions;

use Yii;
use yii\rest\Action;

class ViewAction extends Action
{
    use ActionTrait;

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->getAccount(Yii::$app->getRequest()->getQueryParams());
    }

}
