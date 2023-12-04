<?php
   
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_cad = $_POST['data_cadastro'];
        $cidade = $_POST['cidade'];
        $estado= $_POST['estado'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cnpj = $_POST['cnpj'];

        $sqlInsert = "UPDATE fornecedor
        SET nome='$nome',email='$email',telefone='$telefone',data_cad='$data_cad',cidade='$cidade',estado='$estado',endereco='$endereco',bairro='$bairro',cnpj='$cnpj'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: fornecedorPesquisa.php');

?>