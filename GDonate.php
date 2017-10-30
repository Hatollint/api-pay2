<?php 

class GDonateHandler {
	private $event;

    public function __construct(GDonateEvent $event)
    {
        $this->event = $event;
    }

    public function getResult() {
    	global $config;

        $request = $_GET;

        if (empty($request['method'])
            || empty($request['params'])
            || !is_array($request['params'])
        )
        {
            return $this->getResponseError('Invalid request');
        }

        $method = $request['method'];
        $params = $request['params'];

        if ($params['sign'] != $this->getMd5Sign($params, $config['unitpay']['secret_key']))
        {
            return $this->getResponseError('Incorrect digital signature');
        }

        $GDonateModel = GDonateModel::getInstance();

        if ($method == 'check')
        {
            if ($GDonateModel->getPaymentByUnitpayId($params['unitpayId']))
            {
                // Платеж уже существует
                return $this->getResponseSuccess('Payment already exists');
            }

            $itemsCount = $params['sum'];

            if ($itemsCount <= 0)
            {
                return $this->getResponseError('Суммы ' . $params['sum'] . ' руб. не достаточно для оплаты');
            }

            if (!$GDonateModel->createPayment(
                $params['unitpayId'],
                $params['account'],
                $params['sum'],
                $itemsCount
            ))
            {
                return $this->getResponseError('Unable to create payment database');
            }

            $checkResult = $this->event->check($params);
            if ($checkResult !== true)
            {
                return $this->getResponseError($checkResult);
            }

            return $this->getResponseSuccess('CHECK is successful');
        }

        if ($method == 'pay')
        {
            $payment = $GDonateModel->getPaymentByUnitpayId(
                $params['unitpayId']
            );

            if ($payment && $payment->status == 1)
            {
                return $this->getResponseSuccess('Payment has already been paid');
            }

            if (!$GDonateModel->confirmPaymentByUnitpayId($params['unitpayId']))
            {
                return $this->getResponseError('Unable to confirm payment database');
            }

            if(!$GDonateModel->confirmPaymentByPaymentId($params['account'], $params['unitpayId'], $params['profit'])){
                return $this->getResponseError('Unable to confirm payment database');
            }

           $this->event
                ->pay($params);

            // var_dump($GDonateModel->confirmPaymentByPaymentId($params['account'], $params['unitpayId']));
            return $this->getResponseSuccess('PAY is successful');
        }

		return $this->getResponseError($method.' not supported');
    }

    private function getResponseSuccess($message)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }

    private function getResponseError($message)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "error" => array(
                "code" => -32000,
                "message" => $message
            ),
            'id' => 1
        ));
    }

    private function getMd5Sign($params, $secretKey)
    {
        ksort($params);
        unset($params['sign']);
        return md5(join(null, $params).$secretKey);
    }
}

class GDonateModel {

	private $mysqli;

    static function getInstance()
    {
        return new self();
    }

    private function __construct(){
    	global $config;
        $this->mysqli = @new mysqli (
            $config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['base']
        );
        /* проверка подключения */
        if (mysqli_connect_errno()) {
            throw new Exception('Не удалось подключиться к бд');
        }
    }

    function createPayment($unitpayId, $account, $sum, $itemsCount)
    {
        $query = '
            INSERT INTO
                unitpay_payments (unitpayId, account, sum, itemsCount, dateCreate, status)
            VALUES
                (
                    "'.$this->mysqli->real_escape_string($unitpayId).'",
                    "'.$this->mysqli->real_escape_string($account).'",
                    "'.$this->mysqli->real_escape_string($sum).'",
                    "'.$this->mysqli->real_escape_string($itemsCount).'",
                    NOW(),
                    0
                )
        ';

        return $this->mysqli->query($query);
    }

    function getPaymentByUnitpayId($unitpayId)
    {
        $query = '
                SELECT * FROM
                    unitpay_payments
                WHERE
                    unitpayId = "'.$this->mysqli->real_escape_string($unitpayId).'"
                LIMIT 1
            ';
            
        $result = $this->mysqli->query($query);
        return $result->fetch_object();
    }

    function confirmPaymentByUnitpayId($unitpayId)
    {
        $query = '
                UPDATE
                    unitpay_payments
                SET
                    status = 1,
                    dateComplete = NOW()
                WHERE
                    unitpayId = "'.$this->mysqli->real_escape_string($unitpayId).'"
                LIMIT 1
            ';
        return $this->mysqli->query($query);
    }
    
    function getAccountByName($log_payments_id) {
        $sql = "
            SELECT
                *
            FROM
               `gd_log_payments`
            WHERE
               `log_payments_id` = '".$this->mysqli->real_escape_string($log_payments_id)."'
            LIMIT 1
         ";
         
        $result = $this->mysqli
            ->query($sql);
        // var_dump($sql);
        // die();
        return $result->fetch_object();
    }
    
    function addShopBalance($shopid, $count) {
        $query = "
            UPDATE
                `gd_shops`
            SET
                `shop_balance` = shop_balance + ".$this->mysqli->real_escape_string($count)."
            WHERE
                `shop_id` = '".$this->mysqli->real_escape_string($shopid)."'
        ";
        
        return $this->mysqli->query($query);
    }

    function confirmPaymentByPaymentId($paymentID, $unitpayId, $sum) {
        $query = '
                UPDATE
                    `gd_log_payments`
                SET
                    log_payments_status = 2,
                    log_payments_time_complete = NOW(),
                    log_payments_sum_client = "'.$this->mysqli->real_escape_string($sum).'",
                    unitpay_id = '.$this->mysqli->real_escape_string($unitpayId).'
                WHERE
                    `log_payments_id` = "'.$this->mysqli->real_escape_string($paymentID).'"
                LIMIT 1
            ';
       return $this->mysqli->query($query);
    }
}