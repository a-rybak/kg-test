<?php

namespace app\controllers\accountActions;

use app\models\Account;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class TransferAction extends Action
{
    public function run()
    {
        $params = Yii::$app->getRequest()->getBodyParams();

        if (!empty($params['donor'])) {
            $modelDonor = Account::findByAccountNumber($params['donor']);
        } else {
            throw new ServerErrorHttpException('Unable to find the donor\'s account');
        }

        if (!empty($params['recipient'])) {
            $modelRecipient = Account::findByAccountNumber($params['recipient']);
        } else {
            throw new ServerErrorHttpException('Unable to find the recipient\'s account');
        }

        // if amount is not empty and valid value - increase recipient's  available amount and decrease the donor's available one
        if (!empty($params['amount']) && intval($params['amount'])){

            $amount = intval($params['amount']);

            if ($modelDonor->available_amount < $amount) {
                return ['status' => Account::STATUS_FAIL, 'reason' => 'Not enough money on donor\'s account'];
            } else {
                $modelRecipient->available_amount += $amount;
                $modelDonor->available_amount -= $amount;
            }
        }

        if ($modelDonor->save() && $modelRecipient->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            return ["status" => Account::STATUS_FAIL, "result" => ArrayHelper::merge($modelDonor->errors, $modelRecipient->errors)];
        }

        return ['status' => Account::STATUS_OK];
    }
}
