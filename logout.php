<?php
	require('functions.php');

	if ($_GET['exit'] === 'true') {
		unset ($_SESSION['user']);
		header( 'Location: index.php' ); 
	}

	