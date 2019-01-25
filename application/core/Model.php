<?php
	
namespace application\core;

use application\lib\Db;

	abstract class Model
	{
		public $db;					// экмемпляр класса Db 
		public static $card;

		function __construct()
		{
			$this->db = new Db;		// создание экмемпляра класса Db
		}

	}