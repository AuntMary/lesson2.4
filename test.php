<?php
	$pageTitle = 'Сдать тест | Базовые понятия HTML';

	$choosenJSON = isset($_GET['choosenJSON']) ? $_GET['choosenJSON'] : '';
	$filee = @file_get_contents($choosenJSON);
	if (!$filee) {
		header( 'Location: 404.php' ); 
	} else {
	$JSONfile = json_decode (file_get_contents($choosenJSON));
	}

	if ($_GET['submit'] === 'delete') {
		unlink($choosenJSON);
		header( 'Location: list.php' ); 
	}
	
	function showTest ($JSONfile, $choosenJSON) {
	$n = 0;
	echo '<form action="certificate.php" method="post">';
	echo '<div class="form-group"><label>Ваше имя:</label>';
	if ($choosenJSON == true) {
		foreach ($JSONfile as $object) {
			foreach ($object as $key => $question) {
				if ($question == 'radio') {
					$typeFlag = 'radio';
					$n++;
				} elseif ($question == 'check') {
					$typeFlag = 'check';
				} elseif ($question == 'text') {
					$typeFlag = 'text';
				} else {
					if ($typeFlag == 'radio') {
						if ($key == 'question') {
							echo '<label>Вопрос: ' . $question . '</label>';
						} elseif ($key == 'answers') {
							$checkboxes = explode (', ', $question);
							foreach ($checkboxes as $checkbox) {
								echo '<div class="radio">
										<label>
											<input type="radio" name="radio' . $n . '" value="' . $checkbox . '">
												' . $checkbox . '
										</label>
									</div>';	
						}
						}
					} elseif ($typeFlag == 'check') {
						if ($key == 'question') {
							echo '<label>Вопрос: ' . $question . '</label>';
						} elseif ($key == 'answers') {
							$checkboxes = explode (', ', $question);
							foreach ($checkboxes as $checkbox) {
								echo '<div class="checkbox">
										<label>
											<input type="checkbox" name="check[]" value="' . $checkbox . '">
												' . $checkbox . '
										</label>
									</div>';
						}
						}
					} elseif ($typeFlag == 'text') {
						if ($key == 'question') {
							echo '<div class="form-group"><label>Вопрос: ' . $question . '</label>
							<input type="text" class="form-control" name="text" placeholder="Введите ответ">';
						}
					}
				}
			}
		
		}
		echo '<input type="hidden" name="JSONtest" value="' . $choosenJSON . '" />';
		echo '<br/><button type="submit" class="btn btn-default">Submit</button>';
	}
	echo '</form>';
	}

require_once ('template.header.php');

?>
		<div class="container">
			<div class="page-header">
				<h1>Тест <?php echo $choosenJSON; ?></h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php showTest ($JSONfile, $choosenJSON);?>
				</div>
			</div>
		</div>
	</body>
</html>