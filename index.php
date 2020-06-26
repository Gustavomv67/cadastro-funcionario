<html>
<div>
<form action="index.php">
  <label for="nome">Nome do Funcionario</label>
  <input type="text" id="nome" name="nome"><br><br>
  <input type="submit" value="Pesquisa">
</form>
</div>
<table>
<thead>
<tr>
<th>Nome</th>
<th>DataNascimento</th>
<th>Numero de Filhos</th>
<th></th>
</tr>
</thead>
<?php 
include 'funcionario.php';
$funcionarios = new Funcionarios();
if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){
	$id = (int)$_GET['id'];
	if($funcionarios->delete($id))
	{
		echo 'deletado com sucesso';
	}
}
if(isset($_GET['nome'])){
	foreach($funcionarios->acharPorNome($_GET['nome']) as $key => $value):?>
	<tbody>	
	<tr>
		<td><?php echo $value->Nome?></td>	
		<td><?php echo $value->DataNascimento?></td>	
		<td><?php echo $value->Filhos?></td>	
		<td>
		<?php echo "<a href='create.php?acao=editar&id=".$value->id."'> Editar</a>";?>
		<?php echo "<a href='index.php?acao=deletar&id=".$value->id."' onclick='return confirm(\"Deseja realmente excluir?\")'>Deletar</a>";?>
		</td>	
	</tr>
</tbody>
<?php endforeach; ?>
<?php } 
else{
	foreach($funcionarios->acharTodos() as $key => $value):?>
	<tbody>	
	<tr>
		<td><?php echo $value->Nome?></td>	
		<td><?php echo $value->DataNascimento?></td>	
		<td><?php echo $value->Filhos?></td>	
		<td>
		<?php echo "<a href='create.php?acao=editar&id=".$value->id."'>Editar</a>";?>
		<?php echo "<a href='index.php?acao=deletar&id=".$value->id."' onclick='return confirm(\"Deseja realmente excluir?\")'>Deletar</a>";?>
		</td>	
	</tr>
</tbody>
<?php endforeach; ?>
<?php } ?>
</table>
<button onclick="location.href = 'create.php';" id="novo">Novo Funcionario</button>
</html>