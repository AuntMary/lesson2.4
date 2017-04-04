<?php

	$pageTitle = 'Главная | Базовые понятия HTML';

	require_once ('template.header.php');
?>
		<div class="container">
			<div class="page-header">
				<h1>Сдача тестов по теме "Базовые понятия HTML"</h1>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="lead">Вы можете пройти ряд тестов, для лучшего усвоения знаний по теме HTML.</p>
				</div>
				<div class="col-md-6">
				<?php if (isAdmin () === null) { ?>
					<p>Для входа в систему используйте свои логин и пароль, или войдите как гость.</p>
					<form method="post">
					  <div class="form-group">
						<label>Имя пользователя</label>
						<input type="login" class="form-control" name="login" id="login" placeholder="Введите имя пользователя">
					  </div>
					  <div class="form-group">
						<label>Пароль</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
				<?php }?>
				</div>
			</div>
		</div>
	</body>
</html>