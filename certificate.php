<?php
	session_start();
	$userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '';
	header('Content-type: image/png');

	$JSONtest = isset($_POST['JSONtest']) ? $_POST['JSONtest'] : '';
	if (!empty($JSONtest)) {
		$JSONfile = json_decode (file_get_contents("$JSONtest"));
	}
	
	$receivedAnswers = array ();
	foreach ($_POST as $key => $value) {
		if ($key !== 'JSONtest') {
			if (is_array($value)) {
				$receivedAnswers[] = implode (', ', $value);
			} else {
				$receivedAnswers[] = $value;
			}
		}
	}
	
	$rightAnswers = array ();
	if ($JSONtest == true) {
		foreach ($JSONfile as $object) {
			foreach ($object as $key => $question) {
				if ($key == 'rightAnswer') {
					$rightAnswers[] = $question;
				}
			}
		}
	}

	function createCertificate ($rightAnswers, $receivedAnswers, $studentName) {
		$overlap = array_intersect($rightAnswers, $receivedAnswers);
		$score1 = count ($overlap);
		$score2 = round((count ($overlap) / count ($rightAnswers) * 100),0);
		$canvas = imagecreatetruecolor (300, 300);
		$backgroundColor = imagecolorallocate ($canvas, 250, 240, 190);
		$textColor = imagecolorallocate ($canvas, 0, 0, 0);
		$font = __DIR__ . '/assets/arial.ttf';
		imagefill ($canvas, 0, 0, $backgroundColor);
		imagettftext ($canvas, 16, 0 , 30, 80, $textColor, $font, 'Сертификат БП HTML');
		imagettftext ($canvas, 12, 0 , 30, 130, $textColor, $font, 'Уважаемый студент ' . $studentName . ',');
		imagettftext ($canvas, 12, 0 , 30, 150, $textColor, $font, 'ваш результат:');
		imagettftext ($canvas, 12, 0 , 30, 180, $textColor, $font, 'правильных ответов: ' . $score1);
		imagettftext ($canvas, 12, 0 , 30, 200, $textColor, $font, 'набранных баллов: ' . $score2 . ' из 100.');
		imagepng ($canvas);
	}

	if (!empty($_POST)) {
		createCertificate ($rightAnswers, $receivedAnswers, $userName);
	}