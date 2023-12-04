<?php
include ('config.php');

// Verificar se há um pedido ativo
$sql_pedido_ativo = "SELECT id FROM pedidos WHERE status = 'A' LIMIT 1";
$result_pedido_ativo = $conexao->query($sql_pedido_ativo);

if ($result_pedido_ativo->num_rows == 0) {
    // Se não houver um pedido ativo, criar um novo pedido
    $sql_create_pedido = "INSERT INTO pedidos (status) VALUES ('A')";
    $conexao->query($sql_create_pedido);

    // Obter o ID do novo pedido
    $pedido_id = $conexao->insert_id; // Obtém o ID gerado automaticamente
} else {
    // Se houver um pedido ativo, obter o ID do pedido existente
    $pedido = $result_pedido_ativo->fetch_assoc();
    $pedido_id = $pedido['id'];
}

// Lógica para adicionar produto ao pedido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST["produto_id"];
    $quantidade = $_POST["quantidade"];


    $sql_produto = "SELECT * FROM produtos WHERE id = '$produto_id'";
    $result_produto = $conexao->query($sql_produto);

    if ($result_produto->num_rows > 0) {
        $produto = $result_produto->fetch_assoc();
        $subtotal = $quantidade * $produto["preco"];
        $precoUnitario= $produto["preco"];


        // Adicionar o item ao carrinho (detalhes_pedido)
        $sql_add_item = "INSERT INTO detalhes_pedido (pedido_id, produto_id, quantidade,preco_unitario, subtotal)
                        VALUES ($pedido_id, $produto_id, $quantidade, $precoUnitario,$subtotal)";
        $conexao->query($sql_add_item);

        
    }
}




//--------pesquisa produto------------------------------------------
if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM produtos WHERE  produto LIKE '%$data%'   ORDER BY produto DESC";
       
    }
    else
    {
        //echo'ols';
      //  $sql = "SELECT * FROM produtos where id='a'"; 
        $sql = "SELECT * FROM produtos ORDER BY id DESC limit 1"; 
    }

    $result = $conexao->query($sql);





// Lógica para inserir informações do pedido e detalhes da venda
//if (isset($_POST["finalizar_pedido"])) {
    // Adicione aqui a lógica para inserir informações do pedido na tabela 'pedidos'
    // e redirecionar para uma página de confirmação ou algo similar.
//}

if (isset($_POST["finalizar_pedido"])) {
    // Calcular o valor total do pedido a partir da tabela detalhes_pedido
    $sql_calculate_total = "SELECT SUM(subtotal) as total FROM detalhes_pedido WHERE pedido_id = '$pedido_id'";
    $result_calculate_total = $conexao->query($sql_calculate_total);
    $id_funcionario= $_POST["id_funcionario"];

    if ($result_calculate_total->num_rows > 0) {
        $total_pedido = $result_calculate_total->fetch_assoc()['total'];
        $horaAtual = new DateTime();
        $horaFormatada = $horaAtual->format('Y-m-d');


        // Antes de finalizar o pedido, atualizar a quantidade na tabela de produtos
        $sql_atualizar_quantidade = "UPDATE produtos p
        INNER JOIN detalhes_pedido dp ON p.id = dp.produto_id
        SET p.quantidade = p.quantidade - dp.quantidade
        WHERE dp.pedido_id = '$pedido_id'";
        $conexao->query($sql_atualizar_quantidade);

        // Atualizar a tabela pedidos com o valor total
        $sql_update_pedido = "UPDATE pedidos SET total = '$total_pedido', status='F',id_funcionario='$id_funcionario',data_pedido = '$horaFormatada' WHERE id = '$pedido_id'";
        $conexao->query($sql_update_pedido);
        
        // Adicione aqui qualquer outra lógica necessária após finalizar o pedido
        // Por exemplo, redirecionar para uma página de confirmação.
        header("Location: vendatabela.php");
        exit();
    }
}



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>SITE | GN</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            text-align: center;
            color: white;
        }
        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
        }
        a{
            text-decoration: none;
            color: white;
            border: 3px solid dodgerblue;
            border-radius: 10px;
            padding: 10px;
        }
        a:hover{
            background-color: dodgerblue;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
        .button {
            position: absolute;
            left: 3%;
            border-radius: 8px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            background-color: #4CAF50; color: black;
        }
        .buttonFinaliza {
            position: absolute;
            left: 3%;
            border-radius: 8px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="principal.php">PAGINA INICIAL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="vendaMenu.php">VENDAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
<h1>Página de Venda</h1>
<!--<h2>Pesquisar Produto</h2>
    <form action="vendatabela.php" method="post">
        <input type="text" name="product1" placeholder="Digite o produto do produto">
        <input type="submit" value="Pesquisar">
    </form>-->
<br>
<br><br>
<!-- Formulário para finalizar o pedido -->
<form action="" method="post" class=buttonFinaliza >
    <button type="submit" name="finalizar_pedido">Finalizar Pedido</button>
    <label for="id_funcionario">ID Funionario:</label>
    <input type="number" name="id_funcionario" required>

</form>


<div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar por nome produto" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
<br><br>

<!--   LISTA RESULTADO DO NOME DO PRODUTO E ID-->
<div class="m-5" >
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">  </th>
                    <th scope="col">Produto</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td> - </td>";
                        echo "<td>".$user_data['produto']."</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>



<!-- FIM LISTA RESILTADO DO NOME DO PRODUTO E ID -->







<!-- Formulário para pesquisar produtos -->
<form action="" method="post">
    <input type="hidden" name="pedido_id" value="<?php echo $pedido_id; ?>">
    <label for="produto_id">ID do Produto:</label>
    <input type="text" name="produto_id" required>
    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" required>

    <button type="submit">Adicionar ao Pedido</button>
    </form>
<br>
<!-- Lista de itens no pedido -->
<h2>Pedido Número: <?php print_r($pedido_id)?></h2>
<div class="m-5" >
<table class="table text-white table-bg">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
        <th>Remover Item</th>
    </tr>
    <?php
   
    // Exibir itens no pedido
    $sql_itens_pedido = "SELECT dp.*, p.produto 
                        FROM detalhes_pedido dp
                        JOIN produtos p ON dp.produto_id = p.id
                        WHERE dp.pedido_id = '$pedido_id'";
    $result_itens_pedido = $conexao->query($sql_itens_pedido);

    if ($result_itens_pedido->num_rows > 0) {
        while ($item = $result_itens_pedido->fetch_assoc()) {
            echo "<tr>
                    <td>{$item['produto']}</td>
                    <td>{$item['quantidade']}</td>
                    <td>{$item['subtotal']}</td>
                    <td>
                        <a class='btn btn-sm btn-danger' href='vendaItemDeleta.php?id=$item[id]' title='Deletar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                    </td>
                </tr>";
        }
    }
    ?>
</table>
</div>







<!-- Formulário para finalizar o pedido 
<form action="" method="post" class=buttonFinaliza >
    <button type="submit" name="finalizar_pedido">Finalizar Pedido</button>
</form>-->

</body>

<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'vendatabela.php?search='+search.value;
    }
</script>

</html>
