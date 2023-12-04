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
       

        $sqlInsert = "UPDATE produtos a SET a.produto='$produto', a.quantidade='$quantidade', a.data_validade='$data_validade', a.id_receita='$id_receita',a.preco='$preco' WHERE a.id=$id";

        $result = $conexao->query($sqlInsert);
       print_r($result);
    }
    header('Location: produtoPesquisa.php');

?>