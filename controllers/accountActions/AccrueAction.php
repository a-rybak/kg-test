<?php

namespace app\controllers\accountActions;

use app\models\Account;
use Yii;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class AccrueAction extends Action
{
    use ActionTrait;

    public function run()
    {
        $params = Yii::$app->getRequest()->getBodyParams();

        /* @var $model Account|array */
        $model = $this->getAccount($params);
        if (is_array($model))
            return $model;

        // if amount is not empty and valid value - increase available user's amount
        if (!empty($params['amount']) && intval($params['amount'])){
            $model->available_amount += intval($params['amount']);
        } else {
            throw new ServerErrorHttpException('Amount is missing');
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
