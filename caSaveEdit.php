<?php
include_once('config.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $selectedFunctions = array();

    // Verifica se cada checkbox está marcado
    $functions = array("funcionario", "fornecedor", "materiaPrima", "admin", "receita", "Produtos", "estoque", "vendas", "usuarios", "comissao", "financeiro");
    foreach ($functions as $function) {
        if (isset($_POST[$function])) {
            $selectedFunctions[] = $function;
        }
    }

    // Limpa as entradas antigas na tabela usuario_funcoes para o usuário
    $sqlDelete = "DELETE FROM usuarios_funcoes WHERE id_usuario = $id";
    $conexao->query($sqlDelete);

    // Insere as novas funções selecionadas na tabela usuario_funcoes
    foreach ($selectedFunctions as $selectedFunction) {
        $sqlInsertFunction = "INSERT INTO usuarios_funcoes (id_usuario, nome_funcao) VALUES ($id, '$selectedFunction')";
        $conexao->query($sqlInsertFunction);
    }

    // Redireciona para a página desejada após o processamento do formulário
    header('Location: caSucesso.php');
    exit();
} else {
    // Se o formulário não foi enviado corretamente, redireciona para a página de pesquisa
    header('Location: caPesquisa.php');
    exit();
}
?>




