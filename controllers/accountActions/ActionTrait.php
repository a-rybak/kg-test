<?php
namespace app\controllers\accountActions;

use app\models\Account;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

trait ActionTrait {

    /**
     * Searches the account in table by given account number
     *
     * @param string $search_parameter_name the name of attribute to search with in query array (default is "account_number")
     * @param array $parameters input parameters' array
     * @throws ServerErrorHttpException if account was not finded
     * @return ActiveRecord|null|array
     */
    public function getAccount($parameters, $search_parameter_name = 'account_number'){
        if (empty($parameters))
            return null;

        if (!empty($parameters[$search_parameter_name])) {
            $model = Account::findByAccountNumber($parameters[$search_parameter_name]);
        } else {
            throw new ServerErrorHttpException('Parameter "'.$search_parameter_name.'" is not specified');
        }

        if (empty($model)) {
            \Yii::$app->getResponse()->setStatusCode(404);
            return ['status' => Account::STATUS_FAIL, 'reason' => 'Unable to find an account with [' . $parameters[$search_parameter_name] . '] number'];
        }

        return $model;
    }
}