<?php
// ��¼ÿ�εĵ�¼��־�����м���Ƿ��еǼǼ�¼�����ã�

session_start();

require_once("unifi/controller.php");
require_once('config/mysql.php');


if($_SERVER['REQUEST_METHOD'] != 'POST'){
	// die("only allow post method");
}

$macid = $_SESSION['macid'];


//$myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//fwrite($myfile,  date("Y-m-d h:i:sa"). "\n".$_SESSION['id']. "\n".$_SESSION['ssid']. "\n".$_SESSION['ap']. "\n". $_SESSION['macid']."\n");
//fclose($myfile);




// ��������
$conn = new mysqli($servername, $username, $password, $dbname);
// �������
if ($conn->connect_error) {
    die("����ʧ��: " . $conn->connect_error);
}

	
	$sql = "SELECT * FROM weixin_table where Mac_ID='". $macid ."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {		
		$n =null;
		while($row = $result->fetch_assoc()) {
			$n=$row["fromUserName"];
		}
	
		//$sql = "INSERT INTO log (Mac_ID, created_at,fromUserName)VALUES ('".$_SESSION['macid']."',now(),'".$n."')";
		$sql = "INSERT INTO log (Mac_ID, created_at,fromUserName,ap)VALUES ('".$_SESSION['macid']."',now(),'".$n."','".$_SESSION['ap']."')";
		if ($conn->query($sql) === TRUE) {
					//echo $sql;
					
			//������UniFi Guest Control ��¼		
			$controller = new Controller();
			$controller->sendAuthorization($macid, 2);
			
			// ת��΢����Ȩҳ��
			echo json_encode(array('success' => true));			
		}

	} else {
		//echo "no data";
		//weixin_table û�м�¼ ת�� �Ǽ�ҳ��
		echo json_encode(array('success' => false));
	}	
	

$conn->close();


