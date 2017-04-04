<?php

	$pageTitle = 'Список тестов | Базовые понятия HTML';

	$choosenJSON = isset($_POST['choosenJSON']) ? $_POST['choosenJSON'] : '';
	
	function allJSONFilesSelect () {
		if (glob("uploads/*.json") != false) {
			echo "<select class=\"form-control\" name=\"choosenJSON\">";
			foreach (glob("uploads/*.json") as $filename) {
				echo "<option>" . $filename . "</option>";
			}
			echo "</select>";
		} else {
			echo "<select id=\"disabledSelect\" class=\"form-control\" name=\"choosenJSON\"><option>Файлы отсутствуют</option></select>";
		}
	}


require_once ('template.header.php');
?>
		<div class="container">
			<div class="page-header">
				<h1>Список доступных для сдачи тестов</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="lead">Здравствуйте, в выпадающем меню выберите тест, который вы хотите сдать и нажмите кнопку «Сдать тест».</p>
					<p class="lead">Вы перейдёте на страницу, где вы сможете ответить на вопросы.</p>
					<form role="form" action="test.php" method="GET">
						<div class="form-group">
							<?php AllJSONFilesSelect (); ?>
						</div>
						<button type="submit" class="btn btn-success" name="submit" value="submit">Сдать тест</button>
						<?php if (isAdmin () === true) { ?>
						<button type="submit" class="btn btn-danger" name="submit" value="delete">Удалить тест</button>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>