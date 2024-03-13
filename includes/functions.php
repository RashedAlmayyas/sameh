<?php
	include_once("includes/config.php"); 
	$query = "SELECT * FROM ***";
	$result = mysqli_query($conn, $query);
	
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	echo json_encode($data);
	
	mysqli_close($conn);
	?>