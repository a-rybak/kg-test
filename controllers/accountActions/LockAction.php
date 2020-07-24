<?php

namespace app\controllers\accountActions;

use app\models\Account;
use Yii;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class LockAction extends Action
{
    public function run()
    {
        $params = Yii::$app->getRequest()->getBodyParams();

        if (!empty($params['account_number'])) {
            $model = Account::findByAccountNumber($params['account_number']);
        } else {
            throw new ServerErrorHttpException('Unable to find the account');
        }

        // if amount is not empty and valid value - increase locked user's amount and decrease the available one
        if (!empty($params['amount']) && intval($params['amount'])){
            $model->locked_amount += intval($params['amount']);
            $model->available_amount -= intval($params['amount']);
        }

        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            return ["status" => Account::STATUS_FAIL, "result" => $model->errors];
        }

        return [
                'total' => $model->available_amount + $model->locked_amount,
                'available' => $model->available_amount,
                'locked' => $model->locked_amount
            ];
    }
}
