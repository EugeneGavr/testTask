<?php

namespace application\models;

use application\core\Model;

	class Main extends Model {
		
		public function getCards()										// МЕТОД для получение всех карт
		{
			return $this->db->queryAct("SELECT * FROM BonusCard");		// выполняем запрос /ПОЛУЧЕНИЕ ВСЕХ КАРТ
		}

		public function generateCard()									// МЕТОД для генерации новой карты
		{
			$number=$this->getCardNum();								// генерируем новый номер карты
			$main_query="INSERT INTO `BonusCard`(`series`, `number`, `born_date`, `death_date`, `use_date`, `sum`, `status`) VALUES (:series,:cardnumber, STR_TO_DATE(:reg_date, '%d-%m-%Y'), STR_TO_DATE(:de_date, '%d-%m-%Y'), STR_TO_DATE(:use_date, '%d-%m-%Y'),:sum,:status)";	// запрос
			$main_params = [
				'series' =>'gold',
				'cardnumber' => $number,
				'reg_date' => date("d-m-Y"),
				'de_date' => date("d-m-Y",strtotime('+5 years')),
				'use_date' => date("d-m-Y"),
				'sum' => rand(100,5000),
				'status' => 'active',
			];															// параметры запроса
			$this->db->no_answer_queryAct($main_query,$main_params);	// выполнение запроса /"ВСТАВКА" карты в таблицу
			$purchAm = rand(1,10);										// генерация случайного числа колличества покупок
			for($i=0;$i<$purchAm;$i++)
			{
				$cost=rand(20,400);										// генерация случайной суммы счета
				$purchQuery="INSERT INTO `Purchases`(`id`, `status`, `cost`, `removed_bonuses`, `date`) VALUES (:id,:status, :cost, :removed_bonuses, STR_TO_DATE(':date', '%d-%m-%Y'))";	// запрос
				$purch_params = [
					'id' => $number,
					'status' => 'success',
					'cost' => $cost,
					'removed_bonuses' => $cost*0.1,
					'date' => date("d-m-Y"),
				];														// параметры запроса
				$this->db->no_answer_queryAct($purchQuery);				// выполнение запроса /"ВСТАВКА" покупок карты в таблицу
			}
			
		}

		private function getCardNum()												// МЕТОД для генерации нового номера карты
		{
			$cardnumbers = $this->db->queryAct("SELECT number FROM BonusCard");		// получаем все имеющиеся номера карта с таблицы
			$newnumber = rand(1000000000000000,9999999999999999);					// генерируем уникальный номер карты
			foreach ($cardnumbers as $value)
			{
				if($newnumber ==$value){$newnumber=getCardNum();}					// проверка на уникальность нового номера карты
			}
			return $newnumber;
		}

		public function Sort($sort_field)								// МЕТОД для сортировки карт
		{
			$query="SELECT * FROM `BonusCard` ORDER BY ".$sort_field;		// запрос
			$result = $this->db->queryS($query);							// выполнение запроса
			return $result;
		}

		public function Search($column, $search_field)									// МЕТОД для поиска карты
		{	
			$query="SELECT * FROM BonusCard WHERE ".$column." LIKE '%".$search_field."%'";		// запрос
			$result = $this->db->queryS($query);										// выполнение запроса
			return $result;
		}
	}