<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {

        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $codbarras = $_POST['codbarras'];
        $valor = $_POST['valor'];
        $vencimento = $_POST['vencimento'];
        $formapgto = $_POST['formapgto'];




       

        $sqlInsert = "UPDATE contaspagar a SET a.descricao='$descricao', a.codbarras='$codbarras', a.valor='$valor', a.vencimento='$vencimento',a.formapgto='$formapgto' WHERE a.id=$id";

        $result = $conexao->query($sqlInsert);
       print_r($result);
    }
    header('Location: cpPesquisa.php');

?>