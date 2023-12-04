<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    { 
        if (isset($_POST['fornecedor'])) {
            $fornecedor = $_POST['fornecedor'];
            $query = "SELECT * FROM fornecedor WHERE nome = '$fornecedor'";
            $result = mysqli_query($conexao, $query);
    
            if (mysqli_num_rows($result) == 0) {
            echo "FORNECEDOR ' $fornecedor' NÃO ENCONTRADO. POR FAVOR, INSIRA UM FORNECEDOR VALIDO";
            print_r('<br>');
            print_r('<br>');
            } else {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $fornecedor = $_POST['fornecedor'];
        $quantidade = $_POST['quantidade'];
        $data_validade = $_POST['data_validade'];
       

        $sqlInsert = "UPDATE materiaprima
        SET nome='$nome',fornecedor='$fornecedor',quantidade='$quantidade',data_validade='$data_validade'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
            }}
    }
    header('Location: materiaPrimaPesquisa.php');

?>