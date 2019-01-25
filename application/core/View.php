<?php

namespace application\core;

	class View
	{
		public $path;						// маршрут действия нужного вида
		public $layout = 'default.php';

		function __construct($route)
		{
			$this->path = 'application/views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		public function render($title, $vars = [])						// МЕТОД для загузки нужного представления
		{
			extract($vars);
			if(file_exists($this->path))								//если существует даное представление
			{
				ob_start();												// включение буферизации вывода
				require $this->path;
				$content = ob_get_clean();								// получение содержимого текущего буфера и его удаление
				require 'application/views/layouts/'.$this->layout;		//подключение шаблона
			} else{
				echo 'View not found';
			}
		}

		public static function errorCode($code)					// МЕТОД для создания представлений для ошибок
		{
			http_response_code($code);
			$path = 'application/views/errors/'.$code.'.php';
			if(file_exists($path)) {
				require $path;									// загрузка представления для ошибоки
			}
			exit;
		}

		public function redirect($url)		// МЕТОД для перенаправления
		{
			header('location: '.$url);
			exit;
		}

	}