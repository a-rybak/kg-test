<?php

namespace app\controllers\accountActions;

use app\models\Account;
use Yii;
use yii\rest\Action;

class CreateAction extends Action
{
    public function run()
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass;

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $hashString = $model->first_name.$model->last_name.time();
        $model->account_number = "UA" . strtoupper(md5($hashString));

        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } else {
            return ["status" => Account::STATUS_FAIL, "result" => $model->errors];
        }

        return ['account_number' => $model->account_number];
    }
}
