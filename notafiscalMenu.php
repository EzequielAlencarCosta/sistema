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
        <a href="notaEmissaoPesquisa.php"><font color=green>Gerar NF</font></a>
        <a href="nfCancelamento.php"><font color=green>Cancelar NF</font></a>
        <a href="notaEmitidaPesquisa.php"><font color=green>Pesquisar NF</font></a>
        <a href="principal.php"><font color=green>Pagina Inicial</font></a>
        
        
        <!-- Adicione outros botões conforme necessário -->
    <?php else : ?>
        <!-- Caso contrário, verifica as permissões individuais -->
        <a href="notaEmissaoPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'notaemissao') ? '' : 'style="display:none;"'; ?>>Emissão de Nota Fiscal</a>
        <a href="nfCancelamento.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'notacancel') ? '' : 'style="display:none;"'; ?>>Cancelamento de Nota Fiscal</a>
        <a href="notaEmitidaPesquisa.php"<?php echo temPermissao($conexao, $_SESSION['id'], 'notacancel') ? '' : 'style="display:none;"'; ?>><font color=green>Pesquisar NF</font></a>
        <a href="principal.php"><font color=green>Pagina Inicial</font></a>
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
