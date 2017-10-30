<?php 
/*
* @GDonate
* @Developed by Maksa988
* @Copyright (C) 2015
*/

$config = array(
	'db' => array(
		'host' => "localhost",
		'user' => 'u0218813_default',
		'pass' => 'i!C0a8_H',
		'base' => 'u0218813_default',
		'prefix' => 'gd_',
	),
	
	'unitpay' => array(
		'public_key' => '23958-c9659', // не робит
		'secret_key' => 'b7b182f0dde9e02a4295d31a2360d8f4' // не робит
	)
);

$db = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['base']);
$db->set_charset("utf8");

if($db->connect_errno) {
    exit('<center>Идут технические работы.</center>');
}

//Functions

function getShop($public_key, $joins = array()) {
	global $db;
	$param = explode("-", $public_key);
	$shopid = $param[1];

	$sql = "SELECT * FROM `gd_shops`";
	$sql .=  " WHERE `shop_id` = '" . (int)$shopid . "' LIMIT 1";
	$result = $db->query($sql);
	if($result->num_rows == 1){
		return $result->fetch_assoc();
	}
	return false;
}

function newPayment($params, $shopid){
	global $db;
	$sql = "INSERT INTO `gd_log_payments` 
	(	shop_id, 
		user_id, 
		log_payments_system, 
		log_payments_sum, 
		log_payments_sum_client, 
		log_payments_time
	) VALUES (
		'{$shopid}', 
		'{$params['account']}',
		'{$params['paySystem']}',
		'{$params['sum']}', 
		'0', 
		NOW())";
	$db->query($sql);
	
	if(!$db->error) {
		return $db->insert_id;
	}
	return false;
}

function getShopByPaymentID($paymentID){
	global $db;

	$sql = "SELECT * FROM `gd_log_payments`";
	$sql .=  " WHERE `log_payments_id` = '" . (int)$paymentID . "' LIMIT 1";

	$result = $db->query($sql);
	if($result->num_rows == 1){
		$paymentInfo = $result->fetch_assoc();
		return $paymentInfo['shop_id'];
	} else {
		return false;
	}
}

function getPaymentID($paymentID) {
	global $db;
	$sql = "SELECT * FROM `gd_log_payments`";
	$sql .=  " WHERE `log_payments_id` = '" . (int)$paymentID . "' LIMIT 1";
	$result = $db->query($sql);
	if($result->num_rows == 1){
		return $result->fetch_assoc();
	}
	return false;
}

function getShopByID($shopid) {
	global $db;
	$sql = "SELECT * FROM `gd_shops`";
	$sql .=  " WHERE `shop_id` = '" . (int)$shopid . "' LIMIT 1";
	$result = $db->query($sql);
	if($result->num_rows == 1){
		return $result->fetch_assoc();
	}
	return false;
}

function getUserByID($userid) {
	global $db;
	$sql = "SELECT * FROM `gd_users`";
	$sql .=  " WHERE `user_id` = '" . (int)$userid . "' LIMIT 1";
	$result = $db->query($sql);
	if($result->num_rows == 1){
		return $result->fetch_assoc();
	}
	return false;
}

function newUserBalance($shopid, $sum){
	global $db;

	$shop = getShopByID($shopid);
	$userid = $shop['user_id'];

	$sql = "UPDATE  `gd_users` SET  `user_balance` =  user_balance + ". (float)$sum ." WHERE  `user_id` = '{$userid}'";
	return $db->query($sql);
}

function addShopBalance($shopid, $count) {
	global $db;
    
    $query = "
        UPDATE
            `gd_shops`
        SET
            `shop_balance` = shop_balance + ".$db->real_escape_string($count)."
        WHERE
            `shop_id` = '".$db->real_escape_string($shopid)."'
    ";
    
    return $db->query($query);
}

function confirmPaymentByPaymentId($paymentID, $sum) {
	global $db;
    $query = '
            UPDATE
                `gd_log_payments`
            SET
                log_payments_status = 2,
                log_payments_time_complete = NOW(),
                log_payments_sum_client = "'.$db->real_escape_string($sum).'"
            WHERE
                `log_payments_id` = "'.$db->real_escape_string($paymentID).'"
            LIMIT 1
        ';
   return $db->query($query);
}

function confirmPaymentByPaymentIdWM($paymentID, $sum, $wm) {
	global $db;
    $query = '
            UPDATE
                `gd_log_payments`
            SET
                log_payments_status = 2,
                log_payments_time_complete = NOW(),
                log_payments_sum_client = "'.$db->real_escape_string($sum).'",
                webmoney_id = '.$wm.'
            WHERE
                `log_payments_id` = "'.$db->real_escape_string($paymentID).'"
            LIMIT 1
        ';
   return $db->query($query);
}

function canselPayment($paymentID) {
	global $db;
    $query = '
            UPDATE
                `gd_log_payments`
            SET
                `log_payments_status` = 1
            WHERE
                `log_payments_id` = "'.$db->real_escape_string($paymentID).'"
            LIMIT 1
        ';
   return $db->query($query);
}

function createHash($paymentID, $hash) {
	global $db;
    $query = '
            UPDATE
                `gd_log_payments`
            SET
                `log_hash` = "'.$hash.'"
            WHERE
                `log_payments_id` = "'.$db->real_escape_string($paymentID).'"
            LIMIT 1
        ';
   return $db->query($query);
}