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

$sql = "INSERT INTO weixin_table (Mac_ID, created_at)
VALUES ('John', date('Y-m-d'))";

if ($conn->query($sql) === TRUE) {
   // echo "�¼�¼����ɹ�";
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 