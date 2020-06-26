<?php
require_once 'CRUD.php';
class FuncionarioFilho extends Crud{
	protected $table = 'funcionariofilho';
	private $nome;
	private $dataNascimento;
	
	public function setNome($n)
	{
		$this->nome = $n;
	}
	public function getNome($n)
	{
		return $this->nome;
	}
	public function setDataNascimento($d)
	{
		$this->dataNascimento = $d;
	}
	public function getDataNascimento($n)
	{
		return $this->dataNascimento;
	}
	
	
	public function insert()
	{
		$sql = "insert into $this->table(Nome, DataNascimento) values(:nome, :dataNascimento)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':dataNascimento', $this->dataNascimento);
		return $stmt->execute();
	}
        public function update()
	{
		$sql = "insert into $this->table(Nome, DataNascimento) values(:nome, :dataNascimento)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':dataNascimento', $this->dataNascimento);
		return $stmt->execute();
	}
}