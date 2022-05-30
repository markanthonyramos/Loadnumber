<?php
	require "connection.php";

	if (isset($_POST['delete-id'])) {
		$id = $_POST['delete-id'];

		$sql = "DELETE FROM customer_info WHERE id = '{$id}';";
		$result = mysqli_query($dbConnect, $sql);

		header("Location: index.php");
	}
?>