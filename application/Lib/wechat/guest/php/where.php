<?php

$servername = "192.168.0.134";
$username = "root";
$password = "123";
$dbname = "unifi";

// ��������
$conn = new mysqli($servername, $username, $password, $dbname);
// �������
if ($conn->connect_error) {
    die("����ʧ��: " . $conn->connect_error);
}
$macid = $_SESSION['macid'];

if (0) {
	
	$sql = "INSERT INTO weixin_table (Mac_ID, created_at,fromUserName)VALUES ('".$_SESSION['macid']."',now(),'".$_SESSION['ap'] ."')";

	if ($conn->query($sql) === TRUE) {
	   // echo "�¼�¼����ɹ�";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}else{
	
	$sql = "SELECT * FROM weixin_table where Mac_ID='". $macid ."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// ���ÿ������
		while($row = $result->fetch_assoc()) {
			echo "<br> Host: ". $row["id"];
			echo "<br>".$sql;
		}
	} else {
		echo "false";
	}	
	
}


$conn->close();
?>