<?php
require_once 'Banco.php';
abstract class Crud extends DB{
	protected $table;
	abstract public function insert();
	abstract public function update($id);
	public function find($id)
	{
		$sql = "select * from $this->table where id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function findAll()
	{
		$sql = "select * from $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public function delete($id)
	{
		$sql = "delete from $this->table WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
}