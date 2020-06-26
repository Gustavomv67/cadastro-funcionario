

<?php
include 'funcionario.php';
include '.funcionariofilho.php.php';
 $funcionario = new Funcionarios();
if(isset($_GET['acao']) && $_GET['acao'] == 'editar')
{
    $resultado = $funcionario->find($_GET['id']);
    $nome = $resultado->Nome;
    $dataNascimento = $resultado->DataNascimento;
    $salario = $resultado->Salario;
    $atividades = $resultado->Atividades;
}
// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $dataNascimentoErro = null;
    $SalarioErro = null;
    $AtividadeErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o nome!';
            $validacao = False;
        }


        if (!empty($_POST['dataNascimento'])) {
            $dataNascimento = $_POST['dataNascimento'];
        } else {
            $dataNascimentoErro = 'Por favor escolha a data de nascimento!';
            $validacao = False;
        }


        if (!empty($_POST['salario'])) {
            $salario = $_POST['salario'];
        } else {
            $salarioErro = 'Por favor digite o salario!';
            $validacao = False;
        }


        if (!empty($_POST['atividades'])) {
            $atividades = $_POST['atividades'];
        } else {
            $atividadeErro = 'Por favor insira as atividades!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {     
        $funcionario->setNome($nome);
        $funcionario->setDataNascimento($dataNascimento);
        $funcionario->setSalario($salario);
        $funcionario->setAtividades($atividades);
        if(isset($_GET['acao']) && $_GET['acao'] == 'editar')
        {
            $id = $_GET['id'];
            if($funcionario->update($id))
            {
            	echo "atualizado com sucesso";
            }
        }
        else
        {
            if($funcionario->insert())
            {
                    echo "inserido com sucesso";
            }
        }
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Contato</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php<?php if(isset($_GET['acao'])) echo '?id='.$_GET['id'].'&acao='.$_GET['acao'] ?>" method="post">

                    <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($dataNascimentoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">dataNascimento</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="dataNascimento" type="text" placeholder="Data de Nascimento"
                                   value="<?php echo !empty($dataNascimento) ? $dataNascimento : ''; ?>">
                            <?php if (!empty($dataNascimentoErro)): ?>
                                <span class="text-danger"><?php echo $dataNascimentoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($salarioErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Salario</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="salario" type="text" placeholder="Salario"
                                   value="<?php echo !empty($salario) ? $salario : ''; ?>">
                            <?php if (!empty($salarioErro)): ?>
                                <span class="text-danger"><?php echo $salarioErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($atividadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Atividades</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="atividades" type="text" placeholder="atividades"
                                   value="<?php echo !empty($atividades) ? $atividades : ''; ?>">
                            <?php if (!empty($atividadeErro)): ?>
                                <span class="text-danger"><?php echo $atividadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        table
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

