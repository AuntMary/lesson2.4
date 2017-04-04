<?php

	ini_set('display_errors',1);
	error_reporting(E_ALL);

	require('functions.php');
	
	checkZone ($_SERVER['REQUEST_URI']);
	
	if (!empty($_POST)) {authorization ($_POST['login'],$_POST['password']); }
	
	$userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '';
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<title><?php echo $pageTitle ?></title>
	</head>
	<body>
		<nav class="navbar navbar-default">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php">Базовые понятия HTML</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php if (isAdmin () === true) { ?>
				<li <?=echoActiveClassIfRequestMatches("admin")?>><a href="admin.php">Панель администратора</a></li>
				<li <?=echoActiveClassIfRequestMatches("list")?>><a href="list.php">Список тестов</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<p class="navbar-text">Вы вошли как: <?= $userName ?></p>
			<li><a href="logout.php?exit=true">Выйти</a></li>
			</ul>
				<?php } elseif (isAdmin () === false) { ?>
				<li <?=echoActiveClassIfRequestMatches("list")?>><a href="list.php">Список тестов</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<p class="navbar-text">Вы вошли как гость: <?= $userName ?></p>
			<li><a href="logout.php?exit=true">Выйти</a></li>
			</ul>
				<?php } else { ?>
			</ul>
			<?php } ?>
		  </div>
		</nav>