<?php

namespace application\models;

use application\core\Model;

	class Card extends Model {

		public function getPurchases($cardnumber) 												// МЕТОД для получение всех покупок выбраной карты
		{
			$query = "SELECT status, cost, removed_bonuses, date FROM Purchases WHERE id=:id";	// запрос
			$params = [
				'id' => $cardnumber,
			];																					// параметры запроса
			$result = $this->db->queryAct($query, $params);										// получаем результат запроса
			return $result;
		}

		public function getCurrentCard($cardnumber)							// МЕТОД для получение даных о выбраной карте
		{
			$query = "SELECT * FROM BonusCard where number=:cardnumber";	// запрос
			$params = [
				'cardnumber' => $cardnumber,
			];																// параметры запроса
			$result = $this->db->queryAct($query, $params);					// получаем результат запроса
			$result = array_shift($result);									// вытягиваем массив из массива
			$result['number']=chunk_split($cardnumber,4," ");				// делим номер карты на 4 части для лучшего визуального восприятия
			return $result;
		}

		public function Activation($cardnumber)														// МЕТОД для активации/деактивации карты
		{
			$query = "SELECT IF((SELECT status FROM BonusCard WHERE number=:cardnumber)='active', 'deactive', 'active')";	// запрос
			$params = [
				'cardnumber' => $cardnumber,
			];																												// параметры запроса
			$act = $this->db->queryAct($query, $params);
			$this->db->no_answer_queryAct("UPDATE `BonusCard` SET `status`='".array_shift($act[0])."'");					// выполняем запрос
		}

		public function Delete($cardnumber)																	// МЕТОД для удаления карты и всех ее покупок
		{
			$params = [
				'cardnumber' => $cardnumber,
			];																								// параметры запроса
			$this->db->no_answer_queryAct("DELETE FROM `BonusCard` WHERE number=:cardnumber", $params);		// выполняем запрос /УДАЛЕНИЕ КАРТЫ
			$this->db->no_answer_queryAct("DELETE FROM `Purchases` WHERE `id`=:cardnumber", $params);		// выполняем запрос /УДАЛЕНИЕ ПОКУПОК КАРТЫ
		}

	}