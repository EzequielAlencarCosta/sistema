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
function carregarDadosPedido($pedido_id) {
    $conn = conectarBanco();

    // Recuperar os itens do pedido da tabela "detalhes_nf" com base no número do pedido
    $sql = "SELECT * FROM detalhes_nf WHERE pedido_id = $pedido_id";
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
    $pedido_id = isset($_POST["pedido_id"]) ? $_POST["pedido_id"] : "";
    $cliente_nome = isset($_POST["cliente_nome"]) ? $_POST["cliente_nome"] : "";
    $cliente_endereco = isset($_POST["cliente_endereco"]) ? $_POST["cliente_endereco"] : "";
    $cliente_telefone = isset($_POST["cliente_telefone"]) ? $_POST["cliente_telefone"] : "";
    $cliente_cpf = isset($_POST["cliente_cpf"]) ? $_POST["cliente_cpf"] : "";
    $empresa_nome = isset($_POST["empresa_nome"]) ? $_POST["empresa_nome"] : "";
    $empresa_cnpj = isset($_POST["empresa_cnpj"]) ? $_POST["empresa_cnpj"] : "";

    // Verificar se o número do pedido está presente
    if (!empty($pedido_id)) {
        // Inserir dados na tabela nota_fiscal
        $conn = conectarBanco();

        $sql_inserir_nota = "INSERT INTO nota_fiscal (pedido_id, cliente_nome, cliente_endereco, cliente_telefone, cliente_cpf, empresa_nome, empresa_cnpj)
                             VALUES ('$pedido_id', '$cliente_nome', '$cliente_endereco', '$cliente_telefone', '$cliente_cpf', '$empresa_nome', '$empresa_cnpj')";

        if ($conn->query($sql_inserir_nota) === TRUE) {
            echo "Nota fiscal gerada com sucesso!";
        } else {
            echo "Erro ao gerar nota fiscal: " . $conn->error;
        }

        $conn->close();

        // Carregar dados do pedido (como no seu código original)
        $dados_pedido = carregarDadosPedido($pedido_id);

        // Exibir a tabela de itens do pedido
        if (!empty($dados_pedido)) {
            echo "<table border='1'>";
            echo "<tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Subtotal</th></tr>";

            foreach ($dados_pedido as $row) {
                echo "<tr>";
                echo "<td>" . $row["PRODUTO"] . "</td>";
                echo "<td>" . $row["quantidade"] . "</td>";
                echo "<td>R$ " . number_format($row["preco_unitario"], 2, ',', '.') . "</td>";
                echo "<td>R$ " . number_format($row["subtotal"], 2, ',', '.') . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum item encontrado para o número do pedido informado.";
        }

        // Encerrar a execução para evitar a exibição duplicada do formulário
        exit();
    }
}
?>

<!-- Restante do seu código HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Nota Fiscal</title>
    <script>
        // Função para carregar dados do pedido via AJAX
        function carregarDadosPedido() {
            var pedido_id = document.getElementById("pedido_id").value;

            // Verificar se o número do pedido está preenchido
            if (pedido_id.trim() !== "") {
                // Criar um objeto XMLHttpRequest
                var xhr = new XMLHttpRequest();

                // Configurar a requisição
                xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Configurar a função de retorno
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Atualizar a tabela com os dados recebidos
                        document.getElementById("tabela_pedido").innerHTML = xhr.responseText;
                    }
                };

                // Enviar a requisição com os dados do formulário
                xhr.send("pedido_id=" + pedido_id);
            } else {
                alert("Por favor, insira o número do pedido.");
            }
        }
    </script>
</head>
<body>

<!-- Formulário -->
<h2>Preencher Nota Fiscal</h2>
<form id="formulario_nota_fiscal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="pedido_id">Número do Pedido:</label>
    <input type="text" id="pedido_id" name="pedido_id" required>
    <input type="button" value="Carregar Dados do Pedido" onclick="carregarDadosPedido()">
    <br><br>
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


    <input type="submit" value="Gerar Nota Fiscal">
</form>

<!-- Tabela de Itens do Pedido -->
<div id="tabela_pedido"></div>

</body>
</html>
