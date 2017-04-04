<?php
session_start();

	function echoActiveClassIfRequestMatches($requestUri) {
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		if ($current_file_name == $requestUri) {
			echo 'class="active"';
		}
	}
	
	function authorization ($login, $password) {
		if (!empty($login) && !empty ($password)) {
			$file = $login .  ".json";
			if (glob($file) != false) {
				$filee = file_get_contents($file);
				if ($filee === $password) {
					unset ($_SESSION['guest']);
					$_SESSION['user']['role'] = 'admin';
					$_SESSION['user']['name'] = $login;
					return 'admin';
				} else {
					return 'wrong password';
				}
			}
		} elseif (!empty ($login)) {
					unset ($_SESSION['admin']);
					$_SESSION['user']['role'] = 'guest';
					$_SESSION['user']['name'] = $login;
					return 'guest';
		} elseif (empty ($login)) {
			return 'no login';
	}
	}
	
	function isAdmin () {
		if (isset($_SESSION['user']['role'])) {
			if ($_SESSION['user']['role'] === 'admin') {
				return true;
			} elseif ($_SESSION['user']['role'] === 'guest') {
				return false;
			} else {
				return null;
			}
		}
	}

	function checkZone ($uri) {
		if (isAdmin () === false or isAdmin () === null) {
			if (strpos($uri, 'admin')) {
				header('HTTP/1.0 403 Forbidden');
				echo 'Доступ запрещён';
				exit;
			}
		}
	}