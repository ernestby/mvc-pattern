<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title><?= $title ? $title : 'App' ; ?></title>
	<link rel="stylesheet" type="text/css" href="/assets/stylesheets/bootstrap.min.css" />
	<script src="assets/javascripts/jquery-1.6.2.js" type="text/javascript"></script>
</head>
<body>
	<div class="header">
		<div class="container">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="/">Главная</a></li>
				<li role="presentation"><a href="/users/?page=1">Пользователи</a></li>
				<li role="presentation"><a href="/users/signup">Регистрация</a></li>
				<li role="presentation"><a href="/main/contact">Контакты</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<?php include 'app/views/' . $content_view; ?>
	</div>	
</body>
</html>