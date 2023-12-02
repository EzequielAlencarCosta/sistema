<!DOCTYPE html>
<html>
<head>
    <title>Página de Venda</title>
</head>
<body>
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

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productName = $row['produto'];
                $productPrice = $row['preco'];
                echo "<li><a href='venda.php?add=" . urlencode($productName) . "'>$productName - R$ $productPrice</a></li>";
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
            echo "<li>$selectedProduct <a href='venda.php?remove=" . urlencode($selectedProduct) . "'>Remover</a></li>";
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

    <?php
    if (isset($_POST['finalizar'])) {
        // Inserir itens do pedido na tabela 'pedidos'
        $stmt = $db->prepare("INSERT INTO pedidos (codigo_produto, produto, preco) VALUES (:codigo_produto, :produto, :preco)");

        foreach ($_SESSION['cart'] as $selectedProduct) {
            $stmt->bindParam(':codigo_produto', $selectedProduct);
            $stmt->bindParam(':produto', $selectedProduct);
            
            // Recuperar o preço do produto do banco de dados
            $stmtPrice = $db->prepare("SELECT preco FROM produtos WHERE produto = :productName");
            $stmtPrice->bindParam(':productName', $selectedProduct);
            $stmtPrice->execute();
            $productPrice = $stmtPrice->fetchColumn();

            if ($productPrice !== false) {
                $stmt->bindParam(':preco', $productPrice);
            } else {
                $stmt->bindParam(':preco', 0); // Preço padrão, se não for encontrado
            }
            $stmt->execute();
        }

        // Limpar o carrinho após finalizar o pedido
        $_SESSION['cart'] = [];
        echo "Pedido finalizado com sucesso!";
    }
    ?>
</body>
</html>