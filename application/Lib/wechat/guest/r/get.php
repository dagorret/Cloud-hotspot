﻿<?php
 // 第一次使用时，注册一下
 
session_start();
require_once("../unifi/controller.php");
require_once('../config/mysql.php');
header("Content-Type: text/html;charset=utf-8");



if($_SERVER['REQUEST_METHOD'] != 'POST'){
	// die("only allow post method");
}

$macid = $_SESSION['macid'];


//$myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile,  date("Y-m-d h:i:sa"). "\n".$_GET['u']. "\n".$_SESSION['ssid']. "\n".$_SESSION['ap']. "\n". $_SESSION['macid']."\n");
fclose($myfile);


// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysql_query("set character set 'utf8'");
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

	$sql = "INSERT INTO weixin_table (Mac_ID, created_at,fromUserName)VALUES ('".$_SESSION['macid']."',now(),'".$_GET['u'] ."')";

	if ($conn->query($sql) === TRUE) {
	   // echo "注册插入成功";

			$controller = new Controller();
			$controller->sendAuthorization($macid, 2);

			echo json_encode(array('success' => true));

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

