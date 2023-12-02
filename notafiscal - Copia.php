<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <title>Formulário de Nota Fiscal</title>
</head>
<body>

<?php
// Função para conectar ao banco de dados (substitua com suas próprias credenciais)

function conectarBanco() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pit";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    return $conn;
}

// Função para carregar os dados do pedido
function carregarDadosPedido($numero_pedido) {
    $conn = conectarBanco();

    // Recuperar os itens do pedido da tabela "pedido" com base no número do pedido
    $sql = "SELECT * FROM pedidos WHERE id = $numero_pedido";
    $result = $conn->query($sql);

    $dados_pedido = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados_pedido[] = $row;
        }
    }

    $conn->close();

    return $dados_pedido;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os dados do formulário
    $numero_pedido = $_POST["numero_pedido"];
    $cliente_nome = $_POST["cliente_nome"];
    $cliente_endereco = $_POST["cliente_endereco"];
    $cliente_telefone = $_POST["cliente_telefone"];
    $cliente_cpf = $_POST["cliente_cpf"];
    $empresa_nome = $_POST["empresa_nome"];
    $empresa_cnpj = $_POST["empresa_cnpj"];

    // Exibir os dados do cliente e da empresa
    echo "<h2>Dados do Cliente</h2>";
    echo "<p><strong>Nome:</strong> $cliente_nome</p>";
    echo "<p><strong>Endereço:</strong> $cliente_endereco</p>";
    echo "<p><strong>Telefone:</strong> $cliente_telefone</p>";
    echo "<p><strong>CPF:</strong> $cliente_cpf</p>";

    echo "<h2>Dados da Empresa</h2>";
    echo "<p><strong>Nome:</strong> $empresa_nome</p>";
    echo "<p><strong>CNPJ:</strong> $empresa_cnpj</p>";

    // Verificar se o botão "Carregar Dados do Pedido" foi pressionado
    if (isset($_POST["carregar_dados_pedido"])) {
        $dados_pedido = carregarDadosPedido($numero_pedido);

        // Exibir a tabela de itens do pedido
        if (!empty($dados_pedido)) {
            echo "<h2>Itens do Pedido</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Produto</th><th>Quantidade</th><th>Valor Unitário</th></tr>";

            foreach ($dados_pedido as $row) {
                echo "<tr>";
                echo "<td>" . $row["produto"] . "</td>";
                echo "<td>" . $row["quantidade"] . "</td>";
                echo "<td>R$ " . number_format($row["valor_unitario"], 2, ',', '.') . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum item encontrado para o número do pedido informado.";
        }
    }
}
?>

<!-- Formulário -->
<h2>Preencher Nota Fiscal</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="numero_pedido">Número do Pedido:</label>
    <input type="text" name="numero_pedido" required><br>

    <label for="cliente_nome">Nome do Cliente:</label>
    <input type="text" name="cliente_nome" required><br>

    <label for="cliente_endereco">Endereço do Cliente:</label>
    <input type="text" name="cliente_endereco" required><br>

    <label for="cliente_telefone">Telefone do Cliente:</label>
    <input type="text" name="cliente_telefone" required><br>

    <label for="cliente_cpf">CPF do Cliente:</label>
    <input type="text" name="cliente_cpf" required><br>

    <label for="empresa_nome">Nome da Empresa:</label>
    <input type="text" name="empresa_nome" required><br>

    <label for="empresa_cnpj">CNPJ da Empresa:</label>
    <input type="text" name="empresa_cnpj" required><br>

    <input type="submit" name="carregar_dados_pedido" value="Carregar Dados do Pedido">
    <input type="submit" value="Gerar Nota Fiscal">
</form>

</body>
</html>
