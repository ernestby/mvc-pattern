<?php

class MainController extends Controller
{

	function actionIndex()
	{	
		$data['title'] = 'Главная';
		$this->view->generate('main.php', 'layout.php', $data);
	}

	function actionContact()
	{
		$data['title'] = 'Контакты';
		$this->view->generate('contact.php', 'layout.php', $data);
	}
}