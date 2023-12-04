<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Matéria Prima</title>
</head>
<body>
    <h1>Cadastro de Matéria Prima</h1>

    <?php
    include_once('config.php');
    // Conexão com o banco de dados (substitua com suas configurações)
    //$conexao = mysqli_connect("localhost", "root", " ", "pit");

    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Verificar se o fornecedor existe antes de permitir o cadastro
    if (isset($_POST['fornecedor'])) {
        $fornecedor = $_POST['fornecedor'];
        $query = "SELECT * FROM fornecedor WHERE nome = '$fornecedor'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "Fornecedor não encontrado. Por favor, insira um fornecedor válido.";
        } else {
            // O fornecedor existe, você pode prosseguir com o cadastro da matéria-prima.
            // Lembre-se de substituir os campos do formulário abaixo com seus campos específicos.
            $nome = $_POST['nome'];
            $quantidade = $_POST['quantidade'];
            $dataValidade = $_POST['data_validade'];

            // Gerar automaticamente o código da matéria-prima (exemplo: incrementar um ID)
            // Substitua isso com sua lógica real.
            //$codigoMateriaPrima = generateCodigoMateriaPrima();

            // Insira os dados no banco de dados
            $query = "INSERT INTO materiaprima (nome, fornecedor, quantidade, data_validade) VALUES ('$nome', '$fornecedor', $quantidade, '$dataValidade')";

            if (mysqli_query($conexao, $query)) {
                echo "Matéria-prima cadastrada com sucesso!";
            } else {
                echo "Erro ao cadastrar a matéria-prima: " . mysqli_error($conexao);
            }
        }
    }
    ?>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="fornecedor">Fornecedor:</label>
        <input type="text" name="fornecedor" required>
        <button type="button" onclick="buscarFornecedor()">Pesquisar</button><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br>

        <label for="data_validade">Data de Validade:</label>
        <input type="date" name="data_validade" required><br>

        <input type="submit" value="Cadastrar">
    </form>

    <script>
        function buscarFornecedor() {
            // Implemente aqui a lógica para buscar o fornecedor no banco de dados
            // e preencher o campo de fornecedor no formulário.
            if (isset($_POST['fornecedor'])) {
        $fornecedor = $_POST['fornecedor'];
        $query = "SELECT * FROM fornecedor WHERE nome = '$fornecedor'";
        $result = mysqli_query($conexao, $query);
        } 
        if (mysqli_num_rows($result) == 0) {
            echo "Fornecedor não encontrado. Por favor, insira um fornecedor válido.";
    }else {
        <?php echo $result;?> 
                    
    }
    </script>
</body>
</html>