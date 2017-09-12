<?php session_start(); ?>

<?php
		$uid = $_SESSION["uid"];
?>
<?php
	/************** SQL CONNECTION **************/
	
		$servername = "localhost";
		$username = "mundo";
		$password = "udaondo1288";
		$dbname = "mundo";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->set_charset("utf8");

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	/************** SQL CONNECTION **************/

	//data: 'uid='+uid+'&higienolNivel='+higienolNivel+'&starsCant='+starsCant,
	
	$higienolNivel = "l".$_POST["higienolNivel"];
	$starsCant = $_POST["starsCant"];
	
	$sql="SELECT * FROM diamanduo WHERE uid = '$uid'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
		if($row[higienolNivel] < $starsCant)
		{
			$sqlBis = "UPDATE diamanduo SET $higienolNivel='$starsCant' where uid = '$uid'";
			$resultBis = $conn->query($sqlBis);
		}
	}
	
	echo $uid;
	
	$conn->close();
?>