<?php 
	require_once('flyFunc.php');
	
	require_once('flyDb.php');

	require_once('flyDbTableQuery.php');
	
	if (get_magic_quotes_gpc()) {
		new flyError("Magic quotes are on!");
	}
?>