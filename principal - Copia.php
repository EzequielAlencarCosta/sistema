<?php
    session_start();
    include_once('config.php');
    // print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    }
    $result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITE | GN</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            text-align: center;
            color: white;
            margin: 0; /* Remove default margin to prevent unwanted space */
            padding: 0; /* Remove default padding */
        }
        .box-container {
            text-align: center; /* Center the inline-block elements */
        }
        .box1 {
            display: inline-block; /* Display elements side by side */
            margin: 10px; /* Add some space between elements */
        }
        a {
            text-decoration: none;
            color: white;
            border: 3px solid dodgerblue;
            border-radius: 10px;
            padding: 10px;
            display: block; /* Display as block to fill the parent container */
        }
        a:hover {
            background-color: dodgerblue;
        }
    </style>
</head>
<body>
    <h1>Fabrica de bolos</h1>
    <h2>Seja bem vindo!</h2>
    <div class="box-container">
        <div class="box1">
            <a href="cadUsuario.php"> Funcionário</a>
        </div>
        <div class="box1">
            <a href="fornecedorPesquisa.php"> <font color=black>Fornecedor</font></a>
        </div>
        <div class="box1">
            <a href="materiaPrimaPesquisa.php" ><font color=black> Materia Prima</font></a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php"><font color=red> Receitas</font></a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php"> Produtos</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Estoque</a>
        </div>
    </div>
    <div class="box-container">
        <div class="box1">
            <a href="cadUsuario.php"> Vendas Balcão</a>
        </div>
        <div class="box1">
            <a href="usuarioPesquisa.php"><font color=black>Usuários</font></a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Orçamento</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Cancelamento de Vendas</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Controle de acesso ao sistema</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Emissão de Nota fiscal</a>
        </div>
    </div>
    <div class="box-container">
        <div class="box1">
            <a href="cadUsuario.php">Cancelamento de nota fiscal</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Comissão dos atendentes</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Vendas online</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Promoções</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Contas a pagar</a>
        </div>
        <div class="box1">
            <a href="cadUsuario.php">Contas a receber</a>
        </div>
    </div>
</body>
</html>
