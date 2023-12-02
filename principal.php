<?php
    session_start();
    include_once('config.php');
    //print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)|| (!isset($_SESSION['id'])== true)|| (!isset($_SESSION['nome'])== true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['id']);
        unset($_SESSION['nome']);
        header('Location: login.php');
        print_r($_SESSION);
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

    // Função para verificar se o usuário tem a função 'admin'
function temFuncaoAdmin($conexao, $idUsuario)
{
    $sql = "SELECT * FROM usuarios_funcoes WHERE id_usuario = $idUsuario AND nome_funcao = 'admin'";
    $result = $conexao->query($sql);
    return $result->num_rows > 0;
}

// Adicione a função que verifica a permissão do usuário
function temPermissao($conexao, $idUsuario, $nomeFuncao)
{
    $sql = "SELECT * FROM usuarios_funcoes WHERE id_usuario = $idUsuario AND nome_funcao = '$nomeFuncao'";
    $result = $conexao->query($sql);
    return $result->num_rows > 0;
}

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
            overflow: hidden;
            overflow-y: auto;
            max-height: 100vh;
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



#menu a {
    text-decoration: none;
    color: white;
    border: 3px solid dodgerblue;
    border-radius: 10px;
    padding: 10px;
    transition: background-color 0.3s ease; /* Adiciona uma transição de cor ao passar o mouse */
    margin-bottom: 10px;
}








    </style>
</head>
<body>
    <div id="menu">
    <?php if (temFuncaoAdmin($conexao, $_SESSION['id'])) : ?>
        <!-- Se o usuário tiver a função 'admin', exibe todos os botões -->
        <a href="funcionarioPesquisa.php"><font color=green>Funcionário</font></a>
        <a href="fornecedorPesquisa.php"><font color=green>Fornecedor</font></a>
        <a href="materiaPrimaPesquisa.php"><font color=green>Matéria Prima</font></a>
        <a href="receitaPesquisa.php"><font color=green>Receitas</font></a>
        <a href="produtoPesquisa.php"><font color=green>Produtos</font></a>
        <a href="estoquePesquisa.php"><font color=green>Estoque</font></a>
        <!--<a href="vendasBalcaoPesquisa.php">Vendas Balcão</a>-->
        <a href="usuarioPesquisa.php"><font color=green>Usuários</font></a>
         <!--<a href="vendaCancelamento.php"><font color=green>Cancelamento de Vendas</font></a>-->
        <a href="caPesquisa.php"><font color=green>Controle de Acesso</font></a>
        <a href="notafiscalMenu.php"><font color=green>Nota Fiscal</font></a>
        <a href="comissaoPesquisa.php"><font color=green>Comissão dos Atendentes</font></a>
        <a href="vendaMenu.php"><font color=green>Vendas</font></a>
        <a href="cpPesquisa.php"><font color=green>Contas  a Pagar</font></a>
        <a href="crPesquisa.php"><font color=green>Contas  a Receber</font></a> 
        <!-- Adicione outros botões conforme necessário -->
    <?php else : ?>
        <!-- Caso contrário, verifica as permissões individuais -->
        <a href="funcionarioPesquisa.php" <?php echo temPermissao($conexao, $_SESSION['id'], 'funcionario') ? '' : 'style="display:none;"'; ?>><font color=green>Funcionário</font></a>
        <a href="fornecedorPesquisa.php" <?php echo temPermissao($conexao, $_SESSION['id'], 'fornecedor') ? '' : 'style="display:none;"'; ?>><font color=green>Fornecedor</font></a>
        <a href="materiaPrimaPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'materia') ? '' : 'style="display:none;"'; ?>><font color=green>Matéria Prima</font></a>
        <a href="receitaPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'receita') ? '' : 'style="display:none;"'; ?>><font color=green>Receitas</font></a>
        <a href="produtoPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'produto') ? '' : 'style="display:none;"'; ?>><font color=green>Produtos</font></a>
        <a href="estoquePesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'estoque') ? '' : 'style="display:none;"'; ?>><font color=green>Estoque</font></a>
        <!--<a href="vendasBalcaoPesquisa.php"<php echo temPermissao($conexao, $_SESSION['id'], 'balcao') ? '' : 'style="display:none;"'; ?>>Vendas Balcão</a>-->
        <a href="usuarioPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'usuario') ? '' : 'style="display:none;"'; ?>><font color=green>Usuários</font></a>
        <!--<a href="cancelamentoVendasPesquisa.php" <php echo temPermissao($conexao, $_SESSION['id'], 'vendascancel') ? '' : 'style="display:none;"'; ?>><font color=green>Cancelamento de Vendas</font></a>-->
        <a href="caPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'acessos') ? '' : 'style="display:none;"'; ?>><font color=green>Controle de Acesso</font></a>
        <a href="notafiscalMenu.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'notaemissao') ? '' : 'style="display:none;"'; ?>>Nota Fiscal</a>
        <a href="#comissaoAtendentes"<?php echo temPermissao($conexao, $_SESSION['id'], 'gerente') ? '' : 'style="display:none;"'; ?>>Comissão dos Atendentes</a>
        <a href="vendaMenu.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'venda') ? '' : 'style="display:none;"'; ?>><font color=green>Vendas</font></a>
        <a href="#promocoes"<?php echo temPermissao($conexao, $_SESSION['id'], 'gerente') ? '' : 'style="display:none;"'; ?>>Promoções</a>
        <a href="cpPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'financeiro') ? '' : 'style="display:none;"'; ?>><font color=green>Contas  a Pagar</font></a>
        <a href="crPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'financeiro') ? '' : 'style="display:none;"'; ?>><font color=green>Contas  a Pagar</font></a>
        <!-- Adicione verificações para outros botões conforme necessário -->
    <?php endif; ?>
      
        

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
