<?php
	error_reporting(1);
	$url = $_GET['action'];
	require_once("./config.php");

	function getUsers($param = "") {
		global $db;
		$sql .= "SELECT `user_email` FROM `gd_users` ".$param;
		$result = $db->query($sql);

		$items = array();
		
		if($result->num_rows >= 1){
			while($data = $result->fetch_assoc())
			$items[] = $data;
			
			return $items;
		}
		return false;
	}

	$from = "no-reply@gdonate.ru";
    $topic = "Game Donate | Уведомление";
	   $message = file_get_contents("./mail/news.php");
    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8;";
    $mbody .= $message."\r\n\r\n";

	foreach(getUsers() as $item){
		$i++;
	}
				echo $i;