<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $autor = $_POST['autor'];
        $validade_dias = $_POST['validade_dias'];
        $descricao = $_POST['descricao'];
       

        $sqlInsert = "UPDATE receitas
        SET nome='$nome',autor='$autor',validade_dias='$validade_dias',descricao='$descricao'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: receitaPesquisa.php');

?>