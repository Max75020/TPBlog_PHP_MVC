<?php

namespace Core;

require_once ROOT_PATH . '/../Config/config.php';

class Model
{

	protected $table;
	protected $db;

	// faire le construct qui vérifie si la connexion bdd existe sinon on la crée
	public function __construct()
	{
		if (!$this->db) {
			try {
				$this->db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
					\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
					\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
				]);
			} catch (\PDOException $e) {
				die("ERREUR : " . $e->getMessage());
			}
		}
	}

	public function checkBy($column, $value)
	{
		$stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
		$stmt->execute([$value]);

		return $stmt->rowCount(); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}


	public function getlastInsertId()
	{
		return $this->db->lastInsertId();
	}
}
