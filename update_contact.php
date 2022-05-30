<?php
	require "connection.php";

	if (!empty($_POST["update-id"]) && !empty($_POST["updated-name"]) && !empty($_POST["updated-sim_number"])) {
		if (isset($_POST['update-id'], $_POST["updated-name"], $_POST["updated-sim_number"])) {
			$id = $_POST['update-id'];
			$name = $_POST["updated-name"];
			$simNumber = $_POST["updated-sim_number"];
	
			$sql = "UPDATE customer_info SET sim_number = '{$simNumber}', name = '{$name}' WHERE id = '{$id}';";
			$result = mysqli_query($dbConnect, $sql);
	
			header("Location: index.php");
		}
	}
?>