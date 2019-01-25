<?php

namespace application\controllers;

use application\core\Controller;

	class MainController extends Controller
	{
		
		public function indexAction() 																	// ДЕЙСТВИЕ страницы main/index.php
		{
			if ( !isset( $_POST['sort'] ) && !isset( $_POST['search'] ) )															// ждем нажатия кнопки Sort
			{
				echo "string";
			$result=$this->model->getCards(); 															// получение всех карт
			$vars = [ 'cards' => $result, ];															// параметры для передачи в представление
			$this->view->render('Главная страница',$vars);
			}												// генерируем представление
			foreach ($result as $key => $val) {
				if ( isset( $_POST[$val['number']] ) )												// ждем нажатия кнопки Open
				{
					$this->view->redirect("cards/".$val['number']);										// перенаправляем на личную страницу конкретной карты
				}
			}

			if ( isset( $_POST['create'] ) )														// ждем нажатия кнопки Generate
			{
				$this->model->generateCard();															//вызываем метод модели для генерации карты
			}

			if ( isset( $_POST['sort'] ) )															// ждем нажатия кнопки Sort
			{
				$sorted_result=$this->model->Sort($_POST['sort_field']);								// получаем отсортированные данные
				$sorted_vars = [ 'cards' => $sorted_result, ];
				$this->view->render('Main page',$sorted_vars);									// генерируем представление
			}

			if ( isset( $_POST['search'] ) )														// ждем нажатия кнопки Search
			{
				$searched_result=$this->model->Search($_POST['sort_field'],$_POST['search_field']);		// получаем данные полученные после поиска
				$searched_vars = [ 'cards' => $searched_result, ];
				$this->view->render('Main page',$searched_vars);									// генерируем представление
			}
		} 
	}