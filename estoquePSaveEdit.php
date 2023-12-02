<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];
        $data_validade = $_POST['data_validade'];
        $id_receita = $_POST['id_receita'];
        $preco = $_POST['preco'];
       

        $sqlInsert = "UPDATE produtos a SET  a.quantidade='$quantidade' WHERE a.id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: estoquePesquisa.php');

?>