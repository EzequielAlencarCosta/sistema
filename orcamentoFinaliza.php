<?php

    if(!empty($_GET['id']))
    {
        include_once('config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM pedidos WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            // Antes de finalizar o pedido, atualizar a quantidade na tabela de produtos
             $sql_atualizar_quantidade = "UPDATE produtos p
             INNER JOIN detalhes_pedido dp ON p.id = dp.produto_id
             SET p.quantidade = p.quantidade - dp.quantidade
             WHERE dp.pedido_id = '$id'";
             $conexao->query($sql_atualizar_quantidade);
            $sqlUpdate = "UPDATE pedidos set status='F' WHERE id=$id";
            $resultDelete = $conexao->query($sqlUpdate);
        }
    }
    header('Location: orcamentoPesquisa.php');
   
?>