<?php

namespace App\Models;

use Core\Model;

class Blog extends Model
{
	protected $table = 'post';

	public function findAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM {$this->table}");
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function checkCategory($column, $value)
	{
		$stmt = $this->db->prepare("SELECT * FROM category WHERE {$column} = ?");
		$stmt->execute([$value]);

		return $stmt->rowCount(); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function checkKeyword($column, $value)
	{
		$stmt = $this->db->prepare("SELECT * FROM keyword WHERE {$column} = ?");
		$stmt->execute([$value]);

		return $stmt->rowCount(); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function insertCategory($value)
	{
		$stmt = $this->db->prepare("INSERT INTO category (category) VALUES (?)");
		$stmt->execute([$value]);

		return $stmt->rowCount(); // renvoie un chiffre > 0 si enregistrement ok sinon 0
	}

	public function insertKeyword($value)
	{
		$stmt = $this->db->prepare("INSERT INTO keyword (keyword) VALUES (?)");
		$stmt->execute([$value]);

		return $stmt->rowCount(); // renvoie un chiffre > 0 si enregistrement ok sinon 0
	}

	public function findAllCategories()
	{
		$stmt = $this->db->prepare("SELECT * FROM category ORDER BY category");
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function findAllKeywords()
	{
		$stmt = $this->db->prepare("SELECT * FROM keyword ORDER BY keyword");
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function deleteCategory($id_category)
	{
		$stmt = $this->db->prepare("DELETE FROM category WHERE id_category = ?");
		$stmt->execute([$id_category]);

		return $stmt->rowCount(); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function deleteKeyword($id_keyword)
	{
		$stmt = $this->db->prepare("DELETE FROM category WHERE id_keyword = ?");
		$stmt->execute([$id_keyword]);

		return $stmt->rowCount(); // renvoie 0 si rien n'est trouvé sinon un chiffre > 0
	}

	public function insertPost($title, $content, $mainImg, $userId)
	{
		$stmt = $this->db->prepare("INSERT INTO post (title, content, main_image, user_id, date_created) VALUES (?, ?, ?, ?, NOW() )");
		$stmt->execute([$title, $content, $mainImg, $userId]);

		return $stmt->rowCount();
	}

	public function insertPostCategory($postId, $categoryId)
	{
		$stmt = $this->db->prepare("INSERT INTO post_category (post_id, category_id) VALUES (?, ?)");
		$stmt->execute([$postId, $categoryId]);

		return $stmt->rowCount();
	}

	public function insertPostKeyword($postId, $keywordId)
	{
		$stmt = $this->db->prepare("INSERT INTO post_keyword (post_id, keyword_id) VALUES (?, ?)");
		$stmt->execute([$postId, $keywordId]);

		return $stmt->rowCount();
	}
}
