<?php

namespace application\controllers;
use application\core\Controller;

	class CardController extends Controller
	{
		
		public function cardAction($number)
		{
			$purchases=$this->model->getPurchases($number);						// получаем данные про покупку карт
			$cardinfo=$this->model->getCurrentCard($number);					// получаем данные про карту
			$vars = [ 'cards' => $purchases, 'cardinfo' => $cardinfo, ];
			$this->view->render('Card: '.$number,$vars);

			if ( isset( $_POST['activation'] ) ) 							// ждем нажатия кнопки Search
			{
				$this->model->Activation($number);								//вызываем метод модели для активации/деактивации карты
			}

			if ( isset( $_POST['back'] ) )									// ждем нажатия кнопки Search
			{
				$this->view->redirect("/");										//перенаправляем на главную
			}

			if ( isset( $_POST['delete'] ) )								// ждем нажатия кнопки Search
			{
				$this->model->Delete($number);									//вызываем метод модели для удаления карты
				$this->view->redirect("/");										//перенаправляем на главную
			}
		}

	}