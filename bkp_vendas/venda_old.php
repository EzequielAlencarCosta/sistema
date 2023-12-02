<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
    <h1>Minha Página de Venda</h1>

    <h2>Pesquisar Produto</h2>
    <form action="venda_old.php" method="post">
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
                echo "<br><br><li><a href='venda_old.php?add=" . urlencode($productName) . "'>$productName - R$ $productPrice</a></li>";
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
            echo "<br><br><li>$selectedProduct <a href='venda_old.php?remove=" . urlencode($selectedProduct) . "'>Remover</a></li>";
           
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
</body>
</html>
