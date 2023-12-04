<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {

        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $codpagamento = $_POST['codpagamento'];
        $valor = $_POST['valor'];
        $dt_recebimento = $_POST['dt_recebimento'];
        $formapgto = $_POST['formapgto'];




       

        $sqlInsert = "UPDATE contasreceber a SET a.descricao='$descricao', a.codpagamento='$codpagamento', a.valor='$valor', a.dt_recebimento='$dt_recebimento',a.formapgto='$formapgto' WHERE a.id=$id";

        $result = $conexao->query($sqlInsert);
       print_r($result);
    }
    header('Location: crPesquisa.php');

?>