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
            display: flex;
            flex-direction: row;
        }

        #menu {
            background-color: #333;
            width: 200px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        #menu a {
            text-decoration: none;
            color: white;
            border: 3px solid dodgerblue;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        #menu a:hover {
            background-color: dodgerblue;
        }

        #conteudo {
            flex: 1;
            text-align: center;
        }

        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="menu">
        <a href="funcionarioPesquisa.php">Funcionário</a>
        <a href="fornecedorPesquisa.php">Fornecedor</a>
        <a href="materiaPrimaPesquisa.php">Matéria Prima</a>
        <a href="#receitas">Receitas</a>
        <a href="#produtos">Produtos</a>
        <a href="#estoque">Estoque</a>
        <a href="#vendasBalcao">Vendas Balcão</a>
        <a href="#usuarios">Usuários</a>
        <a href="#orcamento">Orçamento</a>
        <a href="#cancelamentoVendas">Cancelamento de Vendas</a>
        <a href="#controleAcesso">Controle de Acesso</a>
        <a href="#notaFiscal">Emissão de Nota Fiscal</a>
        <a href="#cancelamentoNotaFiscal">Cancelamento de Nota Fiscal</a>
        <a href="#comissaoAtendentes">Comissão dos Atendentes</a>
        <a href="#vendasOnline">Vendas Online</a>
        <a href="#promocoes">Promoções</a>
        <a href="#contasPagar">Contas a Pagar</a>
        <a href="#contasReceber">Contas a Receber</a>
    </div>

    <div id="conteudo">
        <h1>Fabrica de bolos</h1>
        <h2>Seja bem vindo!</h2>

        <!-- Conteúdo de cada seção -->
        <section id="funcionario">
            <!-- Conteúdo da seção Funcionário -->
        </section>

        <section id="fornecedor">
            <!-- Conteúdo da seção Fornecedor -->
        </section>

        <section id="materiaPrima">
            <!-- Conteúdo da seção Matéria Prima -->
        </section>

        <section id="receitas">
            <!-- Conteúdo da seção Receitas -->
        </section>

        <section id="produtos">
            <!-- Conteúdo da seção Produtos -->
        </section>

        <section id="estoque">
            <!-- Conteúdo da seção Estoque -->
        </section>

        <section id="vendasBalcao">
            <!-- Conteúdo da seção Vendas Balcão -->
        </section>

        <section id="usuarios">
            <!-- Conteúdo da seção Usuários -->
        </section>

        <section id="orcamento">
            <!-- Conteúdo da seção Orçamento -->
        </section>

        <section id="cancelamentoVendas">
            <!-- Conteúdo da seção Cancelamento de Vendas -->
        </section>

        <section id="controleAcesso">
            <!-- Conteúdo da seção Controle de Acesso -->
        </section>

        <section id="notaFiscal">
            <!-- Conteúdo da seção Emissão de Nota Fiscal -->
        </section>

        <section id="cancelamentoNotaFiscal">
            <!-- Conteúdo da seção Cancelamento de Nota Fiscal -->
        </section>

        <section id="comissaoAtendentes">
            <!-- Conteúdo da seção Comissão dos Atendentes -->
        </section>

        <section id="vendasOnline">
            <!-- Conteúdo da seção Vendas Online -->
        </section>

        <section id="promocoes">
            <!-- Conteúdo da seção Promoções -->
        </section>

        <section id="contasPagar">
            <!-- Conteúdo da seção Contas a Pagar -->
        </section>

        <section id="contasReceber">
            <!-- Conteúdo da seção Contas a Receber -->
        </section>
    </div>
</body>
</html>
