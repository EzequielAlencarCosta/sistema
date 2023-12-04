<!DOCTYPE html>
<html>
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
   /* background-color: #4CAF50; /* Green */
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
    </style>
</head><body>
    <h1>Minha Página de Venda</h1>

    <h2>Pesquisar Produto</h2>
    <form action="venda.php" method="post">
        <input type="text" name="product" placeholder="Digite o produto do produto">
        <input type="submit" value="Pesquisar">
    </form>

    <h2>Resultado da Pesquisa</h2>
    <ul>
        <?php
        session_start();

        // Conectar ao banco de dados (substitua as credenciais conforme necessário)
        $db = new PDO('mysql:host=localhost;dbname=pit', 'root', '');

        if (isset($_POST['product'])) {
            $search = '%' . $_POST['product'] . '%';

            // Consulta SQL para buscar produtos na tabela 'produtos' que correspondem à pesquisa
            $stmt = $db->prepare("SELECT produto, preco FROM produtos WHERE produto LIKE :search");
            $stmt->bindParam(':search', $search);
            $stmt->execute();

          // // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               // $productName = $row['produto'];
               // $productPrice = $row['preco'];
               // echo "<li><a href='venda.php?add=" . urlencode($productName) . "'>$productName - R$ $productPrice</a></li>";
           // }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productName = $row['produto'];
                $productPrice = $row['preco'];
                $encodedProductName = urlencode($productName);
                echo "<br><li><a href='venda.php?add=$encodedProductName'>$productName - R$ $productPrice</a></li>";
            }

        }
        ?>
    </ul>

    <h2>Itens no Pedido</h2>
    <ul>
        <?php
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_GET['add'])) {
            $selectedProduct = urldecode($_GET['add']);
            array_push($_SESSION['cart'], $selectedProduct);
        }

        if (isset($_GET['remove'])) {
            $removeItem = $_GET['remove'];
            $index = array_search($removeItem, $_SESSION['cart']);
            if ($index !== false) {
                unset($_SESSION['cart'][$index]);
            }
        }

        foreach ($_SESSION['cart'] as $selectedProduct) {
            echo "<br><li>$selectedProduct <a href='venda.php?remove=" . urlencode($selectedProduct) . "'>Remover</a></li>";
        }
        ?>
    </ul>

    <p>Total do Pedido: R$ <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $selectedProduct) {
            // Recuperar o preço do produto do banco de dados
            $stmt = $db->prepare("SELECT preco FROM produtos WHERE produto = :productName");
            $stmt->bindParam(':productName', $selectedProduct);
            $stmt->execute();
            $productPrice = $stmt->fetchColumn();

            if ($productPrice !== false) {
                $total += $productPrice;
            }
        }
        echo number_format($total, 2);
        ?>
    </p>

    <form action="venda.php" method="post">
        <input type="submit" name="finalizar" value="Finalizar Pedido">
    </form>

    <!-- Adicionado o formulário de cancelamento -->
    <h2>Cancelar Pedido</h2>
    <form action="venda.php" method="post">
        <input type="text" name="cancelar_pedido" placeholder="Número do Pedido">
        <input type="submit" value="Cancelar Pedido">
    </form>



    <?php

if (isset($_POST['finalizar'])) {
    // Inserir um novo pedido na tabela 'pedidos'
    $stmtPedido = $db->prepare("INSERT INTO pedidos (data_pedido, cliente_id, endereco_entrega,status,total) VALUES (NOW(), :cliente_id, :endereco_entrega,'F',$total)");
    
    // Substitua os valores abaixo pelos valores reais (ou obtenha esses valores do seu sistema)
    $cliente_id = 1; // Exemplo: id do cliente
    $endereco_entrega = 'Endereço do Cliente'; // Exemplo: endereço do cliente

    $stmtPedido->bindParam(':cliente_id', $cliente_id);
    $stmtPedido->bindParam(':endereco_entrega', $endereco_entrega);
    $stmtPedido->execute();

    // Obter o ID do pedido recém-inserido
    $pedido_id = $db->lastInsertId();

    // Inserir detalhes do pedido na tabela 'detalhes_venda'
    $stmtDetalhes = $db->prepare("INSERT INTO detalhes_venda (pedido_id, produto_id, quantidade, preco_unitario, subtotal) VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario, :subtotal)");

    foreach ($_SESSION['cart'] as $selectedProduct) {
        // Obter o preço e ID do produto do banco de dados
        $stmtPrice = $db->prepare("SELECT id, preco FROM produtos WHERE produto = :productName");
        $stmtPrice->bindParam(':productName', $selectedProduct);
        $stmtPrice->execute();
        $result = $stmtPrice->fetch(PDO::FETCH_ASSOC);

        $produto_id = $result['id'];
        $preco_unitario = $result['preco'];

        // Quantidade é sempre 1 neste exemplo, mas você pode ajustar conforme necessário
        $quantidade = 1;

        // Calcular o subtotal
        $subtotal = $quantidade * $preco_unitario;

        // Inserir detalhes do produto na tabela 'detalhes_venda'
        $stmtDetalhes->bindParam(':pedido_id', $pedido_id);
        $stmtDetalhes->bindParam(':produto_id', $produto_id);
        $stmtDetalhes->bindParam(':quantidade', $quantidade);
        $stmtDetalhes->bindParam(':preco_unitario', $preco_unitario);
        $stmtDetalhes->bindParam(':subtotal', $subtotal);
        $stmtDetalhes->execute();
    }

    // Limpar o carrinho após finalizar o pedido
    $_SESSION['cart'] = [];
    echo "Pedido finalizado com sucesso!";
}

 // Adicionado o bloco de código para cancelar o pedido
 if (isset($_POST['cancelar_pedido'])) {
    $pedido_id_cancelar = $_POST['cancelar_pedido'];

    // Atualizar o status do pedido para 'C' (Cancelado)
    $stmtCancelar = $db->prepare("UPDATE pedidos SET status = 'C' WHERE id = :pedido_id_cancelar");
    $stmtCancelar->bindParam(':pedido_id_cancelar', $pedido_id_cancelar);
    $stmtCancelar->execute();

    echo "Pedido cancelado com sucesso!";
}


?>


</body>
</html>