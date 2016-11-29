<?php

class UsersController extends Controller
{

	function __construct()
	{
		$this->model = new Model_Users();
		$this->view = new View();
	}

	function actionIndex()
	{	
		$data['title'] = 'Пользователи';

		$start = 0;
		$limit = 2;

		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			$start = ($page - 1) * $limit;
		}										

		$sql = "SELECT u.`login`, u.`email`, u.`avatar`, c.`name` as `country` FROM `users`" . " as u LEFT JOIN `country` as c ON (u.`country_id` = c.id)";

		$data['users'] = $this->model->getAll($sql, $start, $limit);

		$data['total'] = $this->model->getTotalCount('users');
		$data['page'] = $page;
		
		$this->view->generate('users.php', 'layout.php', $data);
	}

	function actionSignUp()
	{
		if (!empty($_POST))
		{
			// var_dump(model::checkToken());die;
			if (model::checkToken())
			{
				$error = false;

				if (empty($_POST['username'])) 
				{
					$data['flash'][] = "Заполните имя.";
					$data['flash_status'] = 'danger';
					$error = true;
					
				}
				else
				{
					$userData['username'] = strip_tags($_POST['username']);
				}

				if (empty($_POST['email'])) 
				{
					$data['flash'][] = "Заполните email.";
					$data['flash_status'] = 'danger';
					$error = true;
				}
				else
				{
					if(	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
					{
	     				$userData['email'] = strip_tags($_POST['email']);
					}
					else
					{
						$data['flash'][] = "Введите email правильно.";
						$data['flash_status'] = 'danger';
						$error = true;
					}
					
				}

				if (empty($_POST['password'])) 
				{
					$data['flash'][] = "Заполните пароль.";
					$data['flash_status'] = 'danger';
					$error = true;
				}

				if ($_POST['password'] != $_POST['password_confirmation'])
				{
					$data['flash'][] = "Пароли не совпадают.";
					$data['flash_status'] = 'danger';
					$error = true;
				}

				
				if (!$error)
				{
					$userData['password'] = strip_tags($_POST['password']); // зашифровать пароль
					$userData['country_id'] = intval($_POST['country']);
					$this->model->insertUser($userData);

					$data['flash'][] = "Аккаунт успешно создан.";
					$data['flash_status'] = 'success';
				}
			}
			
			
		}

		$data['title'] = 'Регистрация';

		$data['token'] = model::generateToken();

		$sql = "SELECT * FROM `country`";

		$data['countries'] = $this->model->getAll($sql);

		$this->view->generate('sign_up.php', 'layout.php', $data);
	}
}