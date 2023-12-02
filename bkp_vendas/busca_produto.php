<?php
// Conectar ao banco de dados (substitua pelos seus detalhes de conexão)
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "pit";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter a consulta da solicitação Ajax
$query = $_POST['query'];

// Preparar e executar a consulta no banco de dados
$sql = "SELECT nome_produto FROM produtos WHERE nome_produto LIKE '%$query%'";
$result = $conn->query($sql);

// Armazenar os resultados em um array
$resultados = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row;
    }
}

// Retornar os resultados como JSON
header('Content-Type: application/json');
echo json_encode($resultados);

// Fechar a conexão com o banco de dados
$conn->close();
?>
