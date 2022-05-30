<?php
	require "connection.php";
    if (!empty($_POST["name"]) && !empty($_POST["sim_number"])) {
    	if (isset($_POST["name"], $_POST["sim_number"])) {
    		$name = $_POST["name"];
    		$simNumber = $_POST["sim_number"];
    
    		$sql = "INSERT INTO customer_info(sim_number, name) VALUES('{$simNumber}', '{$name}');";
    		$result = mysqli_query($dbConnect, $sql);
    
    		header("Location: index.php");
    	}
    } else {
        header("Location: index.php");
    }
?>