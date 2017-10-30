<?php
	error_reporting(1);
	$url = $_GET['action'];
	require_once("./config.php");
	$url = explode("/", $url);
	// $paySystem = (empty($_GET['paySystem'])) ? "unitpay" : $_GET['paySystem'];
	$param = array(
		"paySystem" => $_GET['paySystem'],
		"account" => $_GET['account'],
		"sum" => $_GET['sum'],
		"desc" => $_GET['desc'],
		"public_key" => $_GET['public_key'],
		"sign" => $_POST['sign']
	);

	if($url[0] == "pay"){
		if($shop = getShop($param['public_key'])){
			if($shop['shop_status'] == 1){	
				if($param['sum'] >= 1){
					if(!empty($param['account'])){
						if($param['paySystem'] == "unitpay"){
							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$account = $newPaymentID;
								header("Location: https://unitpay.ru/pay/".$config['unitpay']['public_key']."?sum=".$param['sum']."&account=".$account."&desc=".$param['desc']);
								exit();
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "robokassa" && $shop['shop_robokassa']){
							$server = "https://auth.robokassa.ru/Merchant";
							$login = "gdonateru";
							$password1 = "NxV0x1OU5Oq4zUqiR8hb";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$login:".$param['sum'].":$newPaymentID:$password1");
								$url = "$server/Index.aspx";
								/* Параметры: */
								$url .= "?MrchLogin=$login";
								$url .= "&OutSum=".$param['sum'];
								$url .= "&InvId=$newPaymentID";
								$url .= "&SignatureValue=$signature";
								$url .= "&Desc=".$param['desc'];

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=unitpay&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "yandex"  && $shop['shop_yandex']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=45";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=yandex&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "qiwi" && $shop['shop_qiwi']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=63";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=qiwi&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "visa" && $shop['shop_visa']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=94";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=visa&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "master-card" && $shop['shop_master_card']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=94";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=master-card&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "ooopay" && $shop['shop_ooopay']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=106";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=ooopay&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "tinkoff" && $shop['shop_tinkoff']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=112";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=tinkoff&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "w1" && $shop['shop_w1']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=74";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=w1&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "payeer" && $shop['shop_payeer']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=114";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=payeer&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "okpay" && $shop['shop_okpay']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=60";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=okpay&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "alpha-bank" && $shop['shop_alpha_bank']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=79";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=alpha-bank&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "sberbank" && $shop['shop_sberbank']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=80";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=sberbank&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "vtb" && $shop['shop_vtb']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=81";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=vtb&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "promsvyazbank" && $shop['shop_promsvyazbank']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=110";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=promsvyazbank&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "rus-standart" && $shop['shop_rus_standart']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=113";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=rus-standart&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "mts" && $shop['shop_mts']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=84";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=mts&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "tele2" && $shop['shop_tele2']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=132";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=tele2&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "beline" && $shop['shop_beline']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=83";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=beline&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "terminal-ru" && $shop['shop_terminal_ru']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=99";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=terminal-ru&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "terminal-ua" && $shop['shop_terminal_ua']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=98";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=terminal-ua&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "mykassa" && $shop['shop_mykassa']){
							$server = "http://www.free-kassa.ru/merchant/cash.php";
							$id = "33794";
							$password1 = "84rvygb9";

							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5("$id:".$param['sum'].":$password1:$newPaymentID");
								$url = $server;
								/* Параметры: */
								$url .= "?m=$id";
								$url .= "&oa=".$param['sum'];
								$url .= "&o=$newPaymentID";
								$url .= "&s=$signature";
								$url .= "&i=125";

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=mykassa&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "webmoney" && $shop['shop_webmoney'] == 1){
							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$bill = $newPaymentID;
								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=unitpay&paymentID=".$newPaymentID)){
					            	header("Location: https://api.gdonate.ru/bill?id=".$bill."&desc=".$param['desc']);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} elseif($param['paySystem'] == "zpayment" && $shop['shop_zpayment']){
							if($newPaymentID = newPayment($param, $shop['shop_id'])){
								$signature = md5($newPaymentID."18654".$param['sum']."Brxqdlv89TrDBcU");
								$url = "https://z-payment.com/merchant.php";
								/* Параметры: */
								$url .= "?LMI_PAYMENT_NO=$newPaymentID";
								$url .= "&LMI_PAYMENT_AMOUNT=".$param['sum'];
								$url .= "&LMI_PAYEE_PURSE=18654";
								$url .= "&ZP_SIGN=$signature";
								$url .= "&LMI_PAYMENT_DESC=".$param['desc'];

								if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shop['shop_id']."&paymentType=unitpay&paymentID=".$newPaymentID)){
					            	header("Location: ".$url);
					            	exit();
					            } else {
					            	$error = "Character not found!";
					            	require_once("./error.php");
									exit();
					            } 
							} else {
								$error = "Внутреняя ошибка! Произошла ошибка при создании платежа, попробуйте попытку позже!";
							}
						} else {
							if($_SERVER['REMOTE_ADDR'] != "176.241.133.1236"){
								require_once("./paysystem.php");
								exit();
							} else {
								require_once("./error.php");
								exit();
							}
						}
					} else {
						$error = "Не указан идентификатор абонента в системе партнера!";
					}
				} else {
					$error = "Минимальная сумма оплаты 1 рубль!";
				}
			} else {
				$error = "Магазин ещё не прошел этап модерации, оплата невозможна!";
			}
		} else {
			$error = "Магазин не найден, обратитесь к администрации магазина!";
		}
		require_once("./error.php");
		exit();
	} elseif($url[0] == "bill"){
		$error = false;
		$success = false;
		$servererror = false;
		$sumerror = false;
		$id = (int) $_GET['id'];
		if($payment = getPaymentID($id)){
			if($payment['log_payments_status'] == 0){
				$hash = md5("gdonate".$id.$payment['log_payments_time'].$payment['log_payments_sum']);
				createHash($id, $hash);
				if($_GET['check'] == "pay"){
					$result = @file_get_contents("https://api.gdonate.ru/wm.php?hash=".$hash);
					$result = explode("_", $result);

					if($result[0] == "False"){
						$error = true;
						require_once("./webmoney.php");
						exit();
					} elseif($result[0] == "OK"){
						$sum = $result[1];
						$wmid = $result[2];
						if($sum == $payment['log_payments_sum']){
							if(confirmPaymentByPaymentIdWM($id, $sum, $wmid)){
								$shopid = getShopByPaymentID($id);
						        addShopBalance($shopid, $sum);
						        newUserBalance($shopid, $sum);

						        $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=webmoney&paymentID=".$id);

						        $success = true;
								require_once("./webmoney.php");

						        $shop = getShopByID($shopid);
								$userid = $shop['user_id'];
						        $user = getUserByID($userid);
						        $payment = getPaymentID($invid);
						        if($shop['shop_notify']){
							        $from = "no-reply@gdonate.ru";
								    $topic = "Зачислен платеж #".$invid.". Сумма платежа: ".$ammount." руб.";
								    $message .= "Уважаемый партнер, <br>";
								    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
								    $message .= "<br><strong>Номер платежа:</strong> ".$invid."<br>";
								    $message .= "<strong>Сумма платежа:</strong> ".$ammount."<br>";
								    $message .= "<strong>Метод оплаты:</strong> Робокасса<br>";
								    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
								    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
								    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


								    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
								    $headers .= "MIME-Version: 1.0\r\n";
								    $headers .= "Content-Type: text/html; charset=utf-8;";
								    $mbody .= $message."\r\n\r\n";
								    $result = mail($user['user_email'], $topic, $mbody, $headers);
								}

								exit();
							} else {
								$servererror = true;
								require_once("./webmoney.php");
								exit();
							}
						} else {
							$sumerror = true;
							canselPayment($id);
							require_once("./webmoney.php");
							exit();
						}
					} else {
						$servererror = true;
						require_once("./webmoney.php");
						exit();
					}
				}
				require_once("./webmoney.php");
				exit();
			} else {
				require_once("./error.php");
				exit();
			}
		}
		exit();
	} elseif($url[0] == "handlerZP"){
		$HTTP = $_POST;

		foreach ($HTTP as $Key=>$Value) { $$Key = $Value; }
		if($LMI_PAYEE_PURSE != "18654") {
			die("ERR: ID магазина не соответсвует настройкам сайта!");
		}
		
		if(!getPaymentID($LMI_PAYMENT_NO)) {	
			die("ERR: Номер счета не соответсвует заказу!");
		}
		
		if(isset($LMI_SECRET_KEY)) {
			// Если ключ совпадает, занчит все ОК, проводим заказ 
			if($LMI_SECRET_KEY == "Brxqdlv89TrDBcU") {
				$shopid = getShopByPaymentID($LMI_PAYMENT_NO);
		        addShopBalance($shopid, $LMI_PAYMENT_AMOUNT);
		        newUserBalance($shopid, $LMI_PAYMENT_AMOUNT);
		        confirmPaymentByPaymentId($LMI_PAYMENT_NO, $LMI_PAYMENT_AMOUNT);

		        $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=robokassa&paymentID=".$LMI_PAYMENT_NO);
				
				$shop = getShopByID($shopid);
				$userid = $shop['user_id'];
		        $user = getUserByID($userid);
		        $payment = getPaymentID($LMI_PAYMENT_NO);
		        if($shop['shop_notify']){
			        $from = "no-reply@gdonate.ru";
				    $topic = "Зачислен платеж #".$LMI_PAYMENT_NO.". Сумма платежа: ".$LMI_PAYMENT_AMOUNT." руб.";
				    $message .= "Уважаемый партнер, <br>";
				    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
				    $message .= "<br><strong>Номер платежа:</strong> ".$LMI_PAYMENT_NO."<br>";
				    $message .= "<strong>Сумма платежа:</strong> ".$LMI_PAYMENT_AMOUNT."<br>";
				    $message .= "<strong>Метод оплаты:</strong> Z-Payment<br>";
				    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
				    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
				    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


				    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=utf-8;";
				    $mbody .= $message."\r\n\r\n";
				    $result = mail($user['user_email'], $topic, $mbody, $headers);
				}

				exit("YES");
			} else {
				exit("Error: Произошла ошибка!");
			}
		} else {
			$signature = md5($newPaymentID."18654".$param['sum']."Brxqdlv89TrDBcU");

			if($LMI_HASH == strtoupper($signature)) {
				$shopid = getShopByPaymentID($LMI_PAYMENT_NO);
		        addShopBalance($shopid, $LMI_PAYMENT_AMOUNT);
		        newUserBalance($shopid, $LMI_PAYMENT_AMOUNT);
		        confirmPaymentByPaymentId($LMI_PAYMENT_NO, $LMI_PAYMENT_AMOUNT);

		        $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=robokassa&paymentID=".$LMI_PAYMENT_NO);
				
				$shop = getShopByID($shopid);
				$userid = $shop['user_id'];
		        $user = getUserByID($userid);
		        $payment = getPaymentID($LMI_PAYMENT_NO);
		        if($shop['shop_notify']){
			        $from = "no-reply@gdonate.ru";
				    $topic = "Зачислен платеж #".$LMI_PAYMENT_NO.". Сумма платежа: ".$LMI_PAYMENT_AMOUNT." руб.";
				    $message .= "Уважаемый партнер, <br>";
				    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
				    $message .= "<br><strong>Номер платежа:</strong> ".$LMI_PAYMENT_NO."<br>";
				    $message .= "<strong>Сумма платежа:</strong> ".$LMI_PAYMENT_AMOUNT."<br>";
				    $message .= "<strong>Метод оплаты:</strong> Z-Payment<br>";
				    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
				    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
				    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


				    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=utf-8;";
				    $mbody .= $message."\r\n\r\n";
				    $result = mail($user['user_email'], $topic, $mbody, $headers);
				}

				exit("YES");
			} else {
				exit("Error: Произошла ошибка!");
			}
		}
	} elseif($url[0] == "handlerRB"){

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$ammount = $_POST['OutSum'];
			$invid = $_POST['InvId'];
			$signature = $_POST['SignatureValue'];
			
			$password2 = "kAqEu5Sbw99I6h0SbKzQ";
			
			if(!getPaymentID($invid)) {
				$errorPOST = "Invalid invoice!";
			}
			elseif(strtoupper($signature) != strtoupper(md5("$ammount:$invid:$password2"))) {
				$errorPOST = "Invalid signature!";
			}

			if(!$errorPOST) {

				$shopid = getShopByPaymentID($invid);
		        addShopBalance($shopid, $ammount);
		        newUserBalance($shopid, $ammount);
		        confirmPaymentByPaymentId($invid, $ammount);

		        $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=robokassa&paymentID=".$invid);
				
				$shop = getShopByID($shopid);
				$userid = $shop['user_id'];
		        $user = getUserByID($userid);
		        $payment = getPaymentID($invid);
		        if($shop['shop_notify']){
			        $from = "no-reply@gdonate.ru";
				    $topic = "Зачислен платеж #".$invid.". Сумма платежа: ".$ammount." руб.";
				    $message .= "Уважаемый партнер, <br>";
				    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
				    $message .= "<br><strong>Номер платежа:</strong> ".$invid."<br>";
				    $message .= "<strong>Сумма платежа:</strong> ".$ammount."<br>";
				    $message .= "<strong>Метод оплаты:</strong> Робокасса<br>";
				    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
				    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
				    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


				    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=utf-8;";
				    $mbody .= $message."\r\n\r\n";
				    $result = mail($user['user_email'], $topic, $mbody, $headers);
				}

				exit("OK$invid\n");
			} else {
				exit("Error: $errorPOST");
			}
		} else {
			exit("Error: Invalid request!");
		}
	} elseif($url[0] == "handlerFK"){

		// if($_SERVER['REQUEST_METHOD'] == 'GET') {
		// 	$ammount = $_GET['AMOUNT'];
		// 	$invid = $_GET['MERCHANT_ORDER_ID'];
		// 	$signature = $_GET['SIGN'];

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$ammount = $_POST['AMOUNT'];
			$invid = $_POST['MERCHANT_ORDER_ID'];
			$signature = $_POST['SIGN'];
			
			$password2 = "fftro1or";
			
			if(!getPaymentID($invid)) {
				$errorPOST = "Invalid invoice!";
			}
			elseif(strtoupper($signature) != strtoupper(md5("33794:$ammount:$password2:$invid"))) {
				$errorPOST = "Invalid signature!";
			}

			if(!$errorPOST) {

				$shopid = getShopByPaymentID($invid);
		        addShopBalance($shopid, $ammount);
		        newUserBalance($shopid, $ammount);
		        confirmPaymentByPaymentId($invid, $ammount);

		        $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=freekassa&paymentID=".$invid);
				
				$shop = getShopByID($shopid);
				$userid = $shop['user_id'];
		        $user = getUserByID($userid);
		        $payment = getPaymentID($invid);
		        if($shop['shop_notify']){
			        $from = "no-reply@gdonate.ru";
				    $topic = "Зачислен платеж #".$invid.". Сумма платежа: ".$ammount." руб.";
				    $message .= "Уважаемый партнер, <br>";
				    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
				    $message .= "<br><strong>Номер платежа:</strong> ".$invid."<br>";
				    $message .= "<strong>Сумма платежа:</strong> ".$ammount."<br>";
				    $message .= "<strong>Метод оплаты:</strong> Free Kassa<br>";
				    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
				    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
				    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


				    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=utf-8;";
				    $mbody .= $message."\r\n\r\n";
				    $result = mail($user['user_email'], $topic, $mbody, $headers);
				}

				exit("YES");
			} else {
				exit("Error: $errorPOST");
			}
		} else {
			exit("Error: Invalid request!");
		}
	} elseif($url[0] == "handler"){ 
		require_once("./gdonate.php");

		class gdonateEvent {
		    public function check($params)
		    {    
		         $gdonateModel = gdonateModel::getInstance();         
		         $shopid = getShopByPaymentID($params['account']);

		         if ($gdonateModel->getAccountByName($params['account'])) {
		            
		            if(file_get_contents("https://api.gdonate.ru/handlerMaksa988/check?shopid=".$shopid."&paymentType=unitpay&paymentID=".$params['account'])){
		            	return true; 
		            } else {
		            	return 'Character not found!';
		            }    
		         }  
		         return 'Character not found';
		    }

		    public function pay($params)
		    {
		         $gdonateModel = gdonateModel::getInstance();
		         $shopid = getShopByPaymentID($params['account']);
		         $newBalanceShop = $gdonateModel->addShopBalance($shopid, $params['profit']);
		         $newBalanceUser = newUserBalance($shopid, $params['profit']);
		         $response = @file_get_contents("https://api.gdonate.ru/handlerMaksa988/pay?shopid=".$shopid."&paymentType=unitpay&paymentID=".$params['account']);
				
				$shop = getShopByID($shopid);
				$userid = $shop['user_id'];
		        $user = getUserByID($userid);
		        $payment = getPaymentID($params['account']);
		        if($shop['shop_notify']){
			        $from = "no-reply@gdonate.ru";
				    $topic = "Зачислен платеж #".$params['account'].". Сумма платежа: ".$params['profit']." руб.";
				    $message .= "Уважаемый партнер, <br>";
				    $message .= "<br>В пользу проекта «<a href='https://cp.gdonate.ru/project/".$shopid."'>".$shop['shop_name']."</a>» зачислен новый платеж: <br>";
				    $message .= "<br><strong>Номер платежа:</strong> ".$params['account']."<br>";
				    $message .= "<strong>Сумма платежа:</strong> ".$params['profit']."<br>";
				    $message .= "<strong>Метод оплаты:</strong> UnitPay<br>";
				    $message .= "<strong>Номер счета:</strong> ".$payment['user_id']."<br>";
				    $message .= "<strong>Дата платежа:</strong> ".$payment['log_payments_time_complete']."<br>";
				    $message .= "<br><small>Письмо было сгенерировано автоматически, просим не отвечать на него.</small>";


				    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=utf-8;";
				    $mbody .= $message."\r\n\r\n";
				    $result = mail($user['user_email'], $topic, $mbody, $headers);
				}
		    }
		}

		$payment = new gdonateHandler(
		    new gdonateEvent()
		);

		echo $payment->getResult();
	} elseif($url[0] == "handlerMaksa988"){
		$method = $url[1];
		$shopid = $_GET['shopid'];
		$paymentID = $_GET['paymentID'];
		$paymentType = $_GET['paymentType'];

		$shop = getShopByID($shopid);
		$payment = getPaymentID($paymentID);
		$sign = md5($payment['user_id'].$payment['log_payments_sum'].$shop['shop_secret_key']);
		
		file_get_contents($shop['shop_url']."?method=".$method."&params[account]=".$payment['user_id']."&params[projectId]=".$shopid."&params[sum]=".$payment['log_payments_sum']."&params[paymentType]=".$paymentType."&params[sign]=".$sign."&params[gdonateId]=".$paymentID);
		echo $shop['shop_url']."?method=".$method."&params[account]=".$payment['user_id']."&params[projectId]=".$shopid."&params[sum]=".$payment['log_payments_sum']."&params[sign]=".$sign."&params[gdonateId]=".$paymentID;
	} elseif($url[0] == "success"){
		require_once("./gdonate.php");

		// ?paymentId=39239140&account=1
		
		$unitpayID = $_GET['paymentId'];
		$paymentID = $_GET['account'];
		$zpaymentID = $_GET['LMI_PAYMENT_NO'];
		
		if(!empty($paymentID)){
			$shopid = getShopByPaymentID($paymentID);
		} elseif(!empty($zpaymentID)) {
			$shopid = getShopByPaymentID($zpaymentID);
		}

		$shop = getShopByID($shopid);

		if(empty($shop['shop_success_url'])){
			header("Location: http://".$shop['shop_domain']);
		} else {
			header("Location: ".$shop['shop_success_url']);
		}
	} elseif($url[0] == "error"){
		$error = "При оплате произошла ошибка, повторите попытку!";
		require_once("./error.php");
		exit();
	} else {
		$error = "Запрос составлен неверно!";
		require_once("./error.php");
		exit();
	}
?>