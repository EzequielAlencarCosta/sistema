<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    { 
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $fornecedor = $_POST['fornecedor'];
        $quantidade = $_POST['quantidade'];
        $data_validade = $_POST['data_validade'];
       


        $sqlInsert = "UPDATE materiaprima  SET quantidade='$quantidade'  WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
            
    }
    header('Location: estoquePesquisa.php');

?>