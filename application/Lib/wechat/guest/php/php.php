<?php
$servername = "192.168.0.134";
$username = "abc";
$password = "123";
$dbname = "mysql";

// ��������
$conn = new mysqli($servername, $username, $password, $dbname);
// �������
if ($conn->connect_error) {
    die("����ʧ��: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ���ÿ������
    while($row = $result->fetch_assoc()) {
        echo "<br> Host: ". $row["Host"]. " - Name: ". $row["User"]. "- Password: " . $row["Password"];
    }
} else {
    echo "0 �����";
}
$conn->close();
?>