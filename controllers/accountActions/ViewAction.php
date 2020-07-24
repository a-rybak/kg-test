<?php

namespace app\controllers\accountActions;

use app\models\Account;
use Yii;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class ViewAction extends Action
{

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }


        $params = Yii::$app->getRequest()->getQueryParams();

        if (!empty($params['account_number'])) {
            $model = Account::findByAccountNumber($params['account_number']);
        } else {
            throw new ServerErrorHttpException('Unable to find the account');
        }

        return $model;
    }

}
