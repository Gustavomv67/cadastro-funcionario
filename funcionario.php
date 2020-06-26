<?php
require_once 'CRUD.php';
class Funcionarios extends Crud{
	protected $table = 'funcionario';
	private $id;
	private $nome;
	private $dataNascimento;
	private $salario;
	private $atividades;
	
	public function setNome($n)
	{
		$this->nome = $n;
	}
	public function getNome()
	{
		return $this->nome;
	}
	public function setDataNascimento($d)
	{
		$this->dataNascimento = $d;
	}
	public function getDataNascimento()
	{
		return $this->dataNascimento;
	}
	public function setSalario($s)
	{
		$this->salario = $s;
	}
	public function getSalario()
	{
		return $this->salario;
	}
	public function setAtividades($a)
	{
		$this->atividades = $a;
	}
	public function getAtividades()
	{
		return $this->atividades;
	}
	
	
	public function insert()
	{
		$sql = "insert into $this->table(Nome, DataNascimento, Salario, Atividades) values(:nome, :dataNascimento, :salario, :atividades)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':dataNascimento', $this->dataNascimento);
		$stmt->bindParam(':salario', $this->salario);
		$stmt->bindParam(':atividades', $this->atividades);
		return $stmt->execute();
	}
	
	public function update($id)
	{
		$sql = "update $this->table set Nome = :nome, DataNascimento = :dataNascimento, Salario = :salario, Atividades = :atividades WHERE id =".$id;
		$stmt = DB::prepare($sql);
                $stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':dataNascimento', $this->dataNascimento);
		$stmt->bindParam(':salario', $this->salario);
		$stmt->bindParam(':atividades', $this->atividades);
		return $stmt->execute();
	}

	public function acharTodos()
	{
		$sql = "SELECT a.id, a.Nome, a.DataNascimento, COUNT(b.idFuncionario) as Filhos FROM $this->table a LEFT JOIN funcionariofilho b on a.id = b.idFuncionario group by a.id";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function acharPorNome($n)
	{
		$sql = "SELECT a.id, a.Nome, a.DataNascimento, COUNT(b.idFuncionario) as Filhos from $this->table a LEFT JOIN funcionariofilho b on a.id = b.idFuncionario where a.Nome like '%" .$n."%' GROUP BY a.id";
		$stmt = DB::prepare($sql);
		//$stmt->bindParam(':n', $n);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}